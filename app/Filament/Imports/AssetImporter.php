<?php

namespace App\Filament\Imports;

use App\Enums\AssetStatus;
use App\Enums\AssetType;
use App\Models\Asset;
use App\Models\Employee;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class AssetImporter extends Importer
{
    protected static ?string $model = Asset::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('code')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('name')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('description'),
            ImportColumn::make('type')
                ->requiredMapping()
                ->castStateUsing(function (string $state): string {
                    // Try to find enum by label first, then by value
                    $state = strtolower(trim($state));
                    
                    foreach (AssetType::cases() as $case) {
                        if (strtolower($case->getLabel()) === $state || $case->value === $state) {
                            return $case->value;
                        }
                    }
                    
                    return AssetType::OTHER->value;
                })
                ->rules(['required', 'in:' . implode(',', array_column(AssetType::cases(), 'value'))]),
            ImportColumn::make('brand'),
            ImportColumn::make('model'),
            ImportColumn::make('serial_number'),
            ImportColumn::make('purchase_year')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('purchase_price')
                ->numeric(decimalPlaces: 2)
                ->castStateUsing(function (string $state): ?float {
                    if (blank($state)) return null;
                    
                    // Clean currency formatting
                    $state = preg_replace('/[^0-9.]/', '', $state);
                    return round(floatval($state), 2);
                })
                ->rules(['numeric', 'min:0']),
            ImportColumn::make('status')
                ->requiredMapping()
                ->castStateUsing(function (string $state): string {
                    // Try to find enum by label first, then by value
                    $state = strtolower(trim($state));
                    
                    foreach (AssetStatus::cases() as $case) {
                        if (strtolower($case->getLabel()) === $state || $case->value === $state) {
                            return $case->value;
                        }
                    }
                    
                    return AssetStatus::AVAILABLE->value;
                })
                ->rules(['required', 'in:' . implode(',', array_column(AssetStatus::cases(), 'value'))]),
            ImportColumn::make('location'),
            ImportColumn::make('assigned_to')
                ->castStateUsing(function (string $state): ?int {
                    if (blank($state) || $state === '-') {
                        return null;
                    }

                    $employee = Employee::where('name', trim($state))->first();
                    return $employee?->id;
                })
                ->rules(['nullable', 'exists:employees,id']),
        ];
    }

    public function resolveRecord(): ?Asset
    {
        return Asset::firstOrNew([
            'code' => $this->data['code'] ?? null,
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your asset import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
