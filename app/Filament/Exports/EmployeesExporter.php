<?php

namespace App\Filament\Exports;

use App\Models\Employee;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class EmployeesExporter extends Exporter
{
    protected static ?string $model = Employee::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('code')
                ->label('Employee Code'),
            ExportColumn::make('name')
                ->label('Employee Name'),
            ExportColumn::make('department')
                ->label('Department'),
            ExportColumn::make('position')
                ->label('Position'),
            ExportColumn::make('phone')
                ->label('Phone'),
            ExportColumn::make('email')
                ->label('Email'),
            ExportColumn::make('hire_date')
                ->label('Hire Date')
                ->formatStateUsing(fn ($state) => $state?->format('Y-m-d')),
            ExportColumn::make('status')
                ->label('Status')
                ->formatStateUsing(fn ($state) => $state->getLabel()),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your employee export has completed and ' . number_format($export->total_rows) . ' ' . str('row')->plural($export->total_rows) . ' exported.';

        if ($export->total_failures > 0) {
            $body .= ' ' . number_format($export->total_failures) . ' ' . str('row')->plural($export->total_failures) . ' failed to export.';
        }

        return $body;
    }
}