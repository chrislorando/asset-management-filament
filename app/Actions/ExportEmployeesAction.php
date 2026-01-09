<?php

namespace App\Actions;

use App\Models\Employee;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportEmployeesAction
{
    public static function execute(array $records = null): StreamedResponse
    {
        $employees = $records ? Employee::whereIn('id', $records)->get() : Employee::all();

        $headers = [
            'Employee Code',
            'Name',
            'Department',
            'Position',
            'Phone',
            'Email',
            'Hire Date',
            'Status',
        ];

        $callback = function () use ($employees, $headers) {
            $file = fopen('php://output', 'w');
            
            // Add BOM to fix UTF-8 issues in Excel
            fputs($file, "\xEF\xBB\xBF");
            
            // Header row
            fputcsv($file, $headers);
            
            // Data rows
            foreach ($employees as $employee) {
                fputcsv($file, [
                    $employee->code,
                    $employee->name,
                    $employee->department,
                    $employee->position,
                    $employee->phone,
                    $employee->email,
                    $employee->hire_date?->format('Y-m-d'),
                    $employee->status->getLabel(),
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="employees_' . date('Y-m-d_H-i-s') . '.csv"',
        ]);
    }
}