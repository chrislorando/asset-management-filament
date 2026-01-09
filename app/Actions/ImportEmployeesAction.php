<?php

namespace App\Actions;

use App\Enums\EmployeeStatus;
use App\Models\Employee;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ImportEmployeesAction
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
                    $employeeData = self::mapRowToEmployeeData($row);
                    
                    // Validate the data
                    $validator = Validator::make($employeeData, [
                        'code' => 'required|string|max:255|unique:employees,code,' . ($employeeData['id'] ?? 'NULL'),
                        'name' => 'required|string|max:255',
                        'department' => 'nullable|string|max:255',
                        'position' => 'nullable|string|max:255',
                        'phone' => 'nullable|string|max:255',
                        'email' => 'nullable|email|max:255',
                        'hire_date' => 'nullable|date',
                        'status' => 'required|in:' . implode(',', array_column(EmployeeStatus::cases(), 'value')),
                    ]);

                    if ($validator->fails()) {
                        $results['errors'][] = "Row {$rowNumber}: " . implode(', ', $validator->errors()->all());
                        $results['failed']++;
                        continue;
                    }

                    // Create or update employee
                    Employee::updateOrCreate(
                        ['code' => $employeeData['code']],
                        $employeeData
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

    private static function mapRowToEmployeeData(array $row): array
    {
        return [
            'code' => $row[0] ?? null,
            'name' => $row[1] ?? null,
            'department' => $row[2] ?? null,
            'position' => $row[3] ?? null,
            'phone' => $row[4] ?? null,
            'email' => $row[5] ?? null,
            'hire_date' => !empty($row[6]) ? $row[6] : null,
            'status' => self::mapStatus($row[7] ?? 'active'),
        ];
    }

    private static function mapStatus(string $status): string
    {
        $statusMap = [
            'Active' => 'active',
            'Inactive' => 'inactive',
            'Terminated' => 'terminated',
        ];

        return $statusMap[$status] ?? 'active';
    }
}