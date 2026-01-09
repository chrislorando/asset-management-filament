<?php

namespace App\Filament\Exports;

use App\Models\Asset;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class AssetsExporter extends Exporter
{
    protected static ?string $model = Asset::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('code')
                ->label('Asset Code'),
            ExportColumn::make('name')
                ->label('Asset Name'),
            ExportColumn::make('description')
                ->label('Description'),
            ExportColumn::make('type')
                ->label('Type')
                ->formatStateUsing(fn ($state) => $state->getLabel()),
            ExportColumn::make('brand')
                ->label('Brand'),
            ExportColumn::make('model')
                ->label('Model'),
            ExportColumn::make('serial_number')
                ->label('Serial Number'),
            ExportColumn::make('purchase_year')
                ->label('Purchase Year'),
            ExportColumn::make('purchase_price')
                ->label('Purchase Price'),
            ExportColumn::make('status')
                ->label('Status')
                ->formatStateUsing(fn ($state) => $state->getLabel()),
            ExportColumn::make('location')
                ->label('Location'),
            ExportColumn::make('assignedTo.name')
                ->label('Assigned To')
                ->formatStateUsing(fn ($state) => $state ?? '-'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your asset export has completed and ' . number_format($export->total_rows) . ' ' . str('row')->plural($export->total_rows) . ' exported.';

        if ($export->total_failures > 0) {
            $body .= ' ' . number_format($export->total_failures) . ' ' . str('row')->plural($export->total_failures) . ' failed to export.';
        }

        return $body;
    }
}