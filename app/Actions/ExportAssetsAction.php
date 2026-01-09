<?php

namespace App\Actions;

use App\Models\Asset;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportAssetsAction
{
    public static function execute(array $records = null): StreamedResponse
    {
        $assets = $records ? Asset::whereIn('id', $records)->get() : Asset::all();

        $headers = [
            'Asset Code',
            'Name',
            'Description',
            'Type',
            'Brand',
            'Model',
            'Serial Number',
            'Purchase Year',
            'Purchase Price',
            'Status',
            'Location',
            'Assigned To',
        ];

        $callback = function () use ($assets, $headers) {
            $file = fopen('php://output', 'w');
            
            // Add BOM to fix UTF-8 issues in Excel
            fputs($file, "\xEF\xBB\xBF");
            
            // Header row
            fputcsv($file, $headers);
            
            // Data rows
            foreach ($assets as $asset) {
                fputcsv($file, [
                    $asset->code,
                    $asset->name,
                    $asset->description,
                    $asset->type->getLabel(),
                    $asset->brand,
                    $asset->model,
                    $asset->serial_number,
                    $asset->purchase_year,
                    $asset->purchase_price,
                    $asset->status->getLabel(),
                    $asset->location,
                    $asset->assignedTo?->name ?? '-',
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="assets_' . date('Y-m-d_H-i-s') . '.csv"',
        ]);
    }
}