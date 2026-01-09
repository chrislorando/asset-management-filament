<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = [
            [
                'code' => 'EMP001',
                'name' => 'Ahmad Pratama',
                'department' => 'IT',
                'position' => 'Software Engineer',
                'phone' => '+6281234567890',
                'email' => 'ahmad.pratama@company.com',
                'hire_date' => '2022-01-15',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'EMP002',
                'name' => 'Siti Nurhaliza',
                'department' => 'HR',
                'position' => 'HR Manager',
                'phone' => '+6281234567891',
                'email' => 'siti.nurhaliza@company.com',
                'hire_date' => '2021-03-20',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'EMP003',
                'name' => 'Budi Santoso',
                'department' => 'Finance',
                'position' => 'Finance Manager',
                'phone' => '+6281234567892',
                'email' => 'budi.santoso@company.com',
                'hire_date' => '2020-06-10',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'EMP004',
                'name' => 'Dewi Lestari',
                'department' => 'Operations',
                'position' => 'Operations Supervisor',
                'phone' => '+6281234567893',
                'email' => 'dewi.lestari@company.com',
                'hire_date' => '2022-09-05',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'EMP005',
                'name' => 'Rudi Hermawan',
                'department' => 'IT',
                'position' => 'System Administrator',
                'phone' => '+6281234567894',
                'email' => 'rudi.hermawan@company.com',
                'hire_date' => '2023-02-01',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'EMP006',
                'name' => 'Indah Permata',
                'department' => 'Marketing',
                'position' => 'Marketing Specialist',
                'phone' => '+6281234567895',
                'email' => 'indah.permata@company.com',
                'hire_date' => '2023-04-15',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'EMP007',
                'name' => 'Eko Prasetyo',
                'department' => 'Operations',
                'position' => 'Field Operator',
                'phone' => '+6281234567896',
                'email' => 'eko.prasetyo@company.com',
                'hire_date' => '2022-11-20',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'EMP008',
                'name' => 'Maya Sari',
                'department' => 'Finance',
                'position' => 'Accountant',
                'phone' => '+6281234567897',
                'email' => 'maya.sari@company.com',
                'hire_date' => '2021-08-10',
                'status' => 'inactive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'EMP009',
                'name' => 'Fajar Nugroho',
                'department' => 'IT',
                'position' => 'DevOps Engineer',
                'phone' => '+6281234567898',
                'email' => 'fajar.nugroho@company.com',
                'hire_date' => '2023-06-01',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'EMP010',
                'name' => 'Rina Wijaya',
                'department' => 'HR',
                'position' => 'HR Assistant',
                'phone' => '+6281234567899',
                'email' => 'rina.wijaya@company.com',
                'hire_date' => '2023-07-15',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Employee::insert($employees);
    }
}