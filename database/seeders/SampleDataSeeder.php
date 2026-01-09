<?php

namespace Database\Seeders;

use App\Enums\AssetStatus;
use App\Enums\AssetType;
use App\Enums\EmployeeStatus;
use App\Models\Asset;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample employees
        $employees = [
            [
                'code' => 'EMP001',
                'name' => 'Ahmed Mohammed',
                'department' => 'Engineering',
                'position' => 'Senior Engineer',
                'phone' => '+971501234567',
                'email' => 'ahmed@example.com',
                'hire_date' => '2023-01-15',
                'status' => EmployeeStatus::ACTIVE,
            ],
            [
                'code' => 'EMP002',
                'name' => 'Fatima Ali',
                'department' => 'Finance',
                'position' => 'Accountant',
                'phone' => '+971501234568',
                'email' => 'fatima@example.com',
                'hire_date' => '2023-03-20',
                'status' => EmployeeStatus::ACTIVE,
            ],
            [
                'code' => 'EMP003',
                'name' => 'Omar Hassan',
                'department' => 'Operations',
                'position' => 'Operations Manager',
                'phone' => '+971501234569',
                'email' => 'omar@example.com',
                'hire_date' => '2022-06-10',
                'status' => EmployeeStatus::ACTIVE,
            ],
        ];

        foreach ($employees as $employee) {
            Employee::create($employee);
        }

        // Create sample assets
        $assets = [
            [
                'code' => 'AST001',
                'name' => 'Toyota Hilux Pickup',
                'description' => '2023 Model, White color',
                'type' => AssetType::VEHICLE,
                'brand' => 'Toyota',
                'model' => 'Hilux',
                'serial_number' => 'VIN123456789',
                'purchase_year' => 2023,
                'purchase_price' => 85000.00,
                'status' => AssetStatus::AVAILABLE,
                'location' => 'Dubai Office',
            ],
            [
                'code' => 'AST002',
                'name' => 'MacBook Pro 16"',
                'description' => 'M3 Max, 36GB RAM, 1TB SSD',
                'type' => AssetType::ELECTRONICS,
                'brand' => 'Apple',
                'model' => 'MacBook Pro',
                'serial_number' => 'MBP987654321',
                'purchase_year' => 2023,
                'purchase_price' => 4500.00,
                'status' => AssetStatus::IN_USE,
                'location' => 'Dubai Office',
                'assigned_to' => 1, // Ahmed Mohammed
            ],
            [
                'code' => 'AST003',
                'name' => 'Office Desk',
                'description' => 'Large wooden desk with drawers',
                'type' => AssetType::FURNITURE,
                'brand' => 'IKEA',
                'model' => 'BEKANT',
                'serial_number' => 'FURN456789',
                'purchase_year' => 2022,
                'purchase_price' => 1200.00,
                'status' => AssetStatus::AVAILABLE,
                'location' => 'Dubai Office',
            ],
            [
                'code' => 'AST004',
                'name' => 'Excavator CAT 320',
                'description' => 'Heavy construction equipment',
                'type' => AssetType::EQUIPMENT,
                'brand' => 'Caterpillar',
                'model' => '320',
                'serial_number' => 'CAT789456123',
                'purchase_year' => 2022,
                'purchase_price' => 250000.00,
                'status' => AssetStatus::MAINTENANCE,
                'location' => 'Construction Site A',
            ],
        ];

        foreach ($assets as $asset) {
            Asset::create($asset);
        }

        $this->command->info('Sample data created successfully!');
    }
}
