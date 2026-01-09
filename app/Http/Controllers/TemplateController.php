<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\StreamedResponse;

class TemplateController extends Controller
{
    public function employeesTemplate(): StreamedResponse
    {
        $headers = [
            'Employee Code',
            'Name',
            'Department',
            'Position',
            'Phone',
            'Email',
            'Hire Date (YYYY-MM-DD)',
            'Status (Active/Inactive/Terminated)',
        ];

        $exampleData = [
            ['EMP001', 'John Doe', 'IT', 'Software Engineer', '+1234567890', 'john@example.com', '2024-01-15', 'Active'],
            ['EMP002', 'Jane Smith', 'HR', 'HR Manager', '+1234567891', 'jane@example.com', '2023-06-10', 'Active'],
            ['EMP003', 'Bob Wilson', 'Finance', 'Accountant', '+1234567892', 'bob@example.com', '2022-03-20', 'Inactive'],
        ];

        $callback = function () use ($headers, $exampleData) {
            $file = fopen('php://output', 'w');
            
            // Add BOM to fix UTF-8 issues in Excel
            fputs($file, "\xEF\xBB\xBF");
            
            // Header row
            fputcsv($file, $headers);
            
            // Example data rows
            foreach ($exampleData as $row) {
                fputcsv($file, $row);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="employees_import_template.csv"',
        ]);
    }

    public function assetsTemplate(): StreamedResponse
    {
        $headers = [
            'Asset Code',
            'Name',
            'Description',
            'Type (Vehicle/Equipment/Electronics/Furniture/Other)',
            'Brand',
            'Model',
            'Serial Number',
            'Purchase Year',
            'Purchase Price',
            'Status (Available/In Use/Maintenance/Retired)',
            'Location',
            'Assigned To (Employee Name or -)',
        ];

        $exampleData = [
            ['AST001', 'Laptop Dell XPS', 'High-performance laptop for development', 'Electronics', 'Dell', 'XPS 15', 'DLXPS123456', '2024', '1500.00', 'Available', 'IT Office', '-'],
            ['AST002', 'Company Car', 'Toyota Camry for sales team', 'Vehicle', 'Toyota', 'Camry', 'TOYCAM789012', '2023', '25000.00', 'In Use', 'Parking Lot', 'John Doe'],
            ['AST003', 'Office Desk', 'Ergonomic office desk', 'Furniture', 'IKEA', 'MARKUS', 'IKEA345678', '2024', '299.00', 'Available', 'Office Floor 1', '-'],
        ];

        $callback = function () use ($headers, $exampleData) {
            $file = fopen('php://output', 'w');
            
            // Add BOM to fix UTF-8 issues in Excel
            fputs($file, "\xEF\xBB\xBF");
            
            // Header row
            fputcsv($file, $headers);
            
            // Example data rows
            foreach ($exampleData as $row) {
                fputcsv($file, $row);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="assets_import_template.csv"',
        ]);
    }
}