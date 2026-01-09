<?php

namespace App\Filament\Imports;

use App\Enums\EmployeeStatus;
use App\Models\Employee;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class EmployeeImporter extends Importer
{
    protected static ?string $model = Employee::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('code')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('name')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('department')
                ->rules(['nullable', 'string', 'max:255']),
            ImportColumn::make('position')
                ->rules(['nullable', 'string', 'max:255']),
            ImportColumn::make('phone')
                ->rules(['nullable', 'string', 'max:255']),
            ImportColumn::make('email')
                ->rules(['nullable', 'email', 'max:255']),
            ImportColumn::make('hire_date')
                ->castStateUsing(function (string $state): ?string {
                    $date = trim($state);
                    if (blank($date)) return null;
                    
                    // Try multiple date formats
                    $formats = ['Y-m-d', 'd/m/Y', 'm/d/Y', 'Y/m/d'];
                    
                    foreach ($formats as $format) {
                        if ($parsed = \DateTime::createFromFormat($format, $date)) {
                            return $parsed->format('Y-m-d');
                        }
                    }
                    
                    return null;
                })
                ->rules(['nullable', 'date']),
            ImportColumn::make('status')
                ->requiredMapping()
                ->castStateUsing(function (string $state): string {
                    // Try to find enum by label first, then by value
                    $state = strtolower(trim($state));
                    
                    foreach (EmployeeStatus::cases() as $case) {
                        if (strtolower($case->getLabel()) === $state || $case->value === $state) {
                            return $case->value;
                        }
                    }
                    
                    return EmployeeStatus::ACTIVE->value;
                })
                ->rules(['required', 'in:' . implode(',', array_column(EmployeeStatus::cases(), 'value'))]),
        ];
    }

    public function resolveRecord(): ?Employee
    {
        return Employee::firstOrNew([
            'code' => $this->data['code'] ?? null,
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your employee import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
