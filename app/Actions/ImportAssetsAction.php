<?php

namespace App\Actions;

use App\Enums\AssetStatus;
use App\Enums\AssetType;
use App\Models\Asset;
use App\Models\Employee;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ImportAssetsAction
{
    public static function execute(string $filePath): array
    {
        $results = [
            'success' => 0,
            'failed' => 0,
            'errors' => [],
        ];

        try {
            $file = storage_path('app/' . $filePath);
            $handle = fopen($file, 'r');
            
            if (!$handle) {
                throw new \Exception('Unable to open file');
            }

            // Skip BOM and header
            fgets($handle); // Skip BOM line if exists
            $header = fgetcsv($handle); // Skip header
            
            $rowNumber = 2; // Start from row 2 (after header)
            
            while (($row = fgetcsv($handle)) !== false) {
                try {
                    $assetData = self::mapRowToAssetData($row);
                    
                    // Validate the data
                    $validator = Validator::make($assetData, [
                        'code' => 'required|string|max:255|unique:assets,code,' . ($assetData['id'] ?? 'NULL'),
                        'name' => 'required|string|max:255',
                        'description' => 'nullable|string',
                        'type' => 'required|in:' . implode(',', array_column(AssetType::cases(), 'value')),
                        'brand' => 'nullable|string|max:255',
                        'model' => 'nullable|string|max:255',
                        'serial_number' => 'nullable|string|max:255',
                        'purchase_year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
                        'purchase_price' => 'nullable|numeric|min:0',
                        'status' => 'required|in:' . implode(',', array_column(AssetStatus::cases(), 'value')),
                        'location' => 'nullable|string|max:255',
                        'assigned_to' => 'nullable|exists:employees,id',
                    ]);

                    if ($validator->fails()) {
                        $results['errors'][] = "Row {$rowNumber}: " . implode(', ', $validator->errors()->all());
                        $results['failed']++;
                        continue;
                    }

                    // Create or update asset
                    Asset::updateOrCreate(
                        ['code' => $assetData['code']],
                        $assetData
                    );

                    $results['success']++;
                    
                } catch (\Exception $e) {
                    $results['errors'][] = "Row {$rowNumber}: " . $e->getMessage();
                    $results['failed']++;
                }
                
                $rowNumber++;
            }
            
            fclose($handle);
            
        } catch (\Exception $e) {
            $results['errors'][] = 'Import failed: ' . $e->getMessage();
        }

        return $results;
    }

    private static function mapRowToAssetData(array $row): array
    {
        $assignedToName = trim($row[11] ?? '');
        $assignedToId = null;
        
        if ($assignedToName && $assignedToName !== '-') {
            $employee = Employee::where('name', $assignedToName)->first();
            $assignedToId = $employee?->id;
        }

        return [
            'code' => $row[0] ?? null,
            'name' => $row[1] ?? null,
            'description' => $row[2] ?? null,
            'type' => self::mapAssetType($row[3] ?? 'other'),
            'brand' => $row[4] ?? null,
            'model' => $row[5] ?? null,
            'serial_number' => $row[6] ?? null,
            'purchase_year' => !empty($row[7]) ? (int) $row[7] : null,
            'purchase_price' => !empty($row[8]) ? (float) $row[8] : null,
            'status' => self::mapAssetStatus($row[9] ?? 'available'),
            'location' => $row[10] ?? null,
            'assigned_to' => $assignedToId,
        ];
    }

    private static function mapAssetType(string $type): string
    {
        $typeMap = [
            'Vehicle' => 'vehicle',
            'Equipment' => 'equipment',
            'Electronics' => 'electronics',
            'Furniture' => 'furniture',
            'Other' => 'other',
        ];

        return $typeMap[$type] ?? 'other';
    }

    private static function mapAssetStatus(string $status): string
    {
        $statusMap = [
            'Available' => 'available',
            'In Use' => 'in_use',
            'Maintenance' => 'maintenance',
            'Retired' => 'retired',
        ];

        return $statusMap[$status] ?? 'available';
    }
}