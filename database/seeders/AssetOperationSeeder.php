<?php

namespace Database\Seeders;

use App\Models\AssetOperation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssetOperationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $operations = [
            // Vehicle Operations
            [
                'asset_id' => 1, // Toyota Hilux
                'employee_id' => 4, // Dewi Lestari
                'start_time' => '2024-01-08 08:00:00',
                'end_time' => '2024-01-08 17:00:00',
                'hours_used' => 9.0,
                'notes' => 'Field visit to Site A for equipment inspection',
                'status' => 'completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'asset_id' => 1, // Toyota Hilux
                'employee_id' => 7, // Eko Prasetyo
                'start_time' => '2024-01-09 07:30:00',
                'end_time' => '2024-01-09 16:30:00',
                'hours_used' => 9.0,
                'notes' => 'Transport materials to Site B',
                'status' => 'completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'asset_id' => 2, // Honda CR-V
                'employee_id' => 2, // Siti Nurhaliza
                'start_time' => '2024-01-10 09:00:00',
                'end_time' => '2024-01-10 12:00:00',
                'hours_used' => 3.0,
                'notes' => 'Client meeting in Jakarta Selatan',
                'status' => 'completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Equipment Operations
            [
                'asset_id' => 4, // Generator
                'employee_id' => 5, // Rudi Hermawan
                'start_time' => '2024-01-08 10:00:00',
                'end_time' => '2024-01-08 18:00:00',
                'hours_used' => 8.0,
                'notes' => 'Backup power during electrical maintenance',
                'status' => 'completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'asset_id' => 5, // Water Pump
                'employee_id' => 7, // Eko Prasetyo
                'start_time' => '2024-01-09 06:00:00',
                'end_time' => '2024-01-09 14:00:00',
                'hours_used' => 8.0,
                'notes' => 'Water drainage at construction site',
                'status' => 'completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'asset_id' => 6, // Compressor
                'employee_id' => 5, // Rudi Hermawan
                'start_time' => '2024-01-10 08:00:00',
                'end_time' => 1,
                'hours_used' => 1,
                'notes' => 'Ongoing operation for pneumatic tools',
                'status' => 'ongoing',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Electronics Operations
            [
                'asset_id' => 7, // Laptop Dell
                'employee_id' => 1, // Ahmad Pratama
                'start_time' => '2024-01-08 09:00:00',
                'end_time' => '2024-01-08 18:00:00',
                'hours_used' => 9.0,
                'notes' => 'Software development work',
                'status' => 'completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'asset_id' => 8, // Laptop HP
                'employee_id' => 3, // Budi Santoso
                'start_time' => '2024-01-08 08:30:00',
                'end_time' => '2024-01-08 17:30:00',
                'hours_used' => 9.0,
                'notes' => 'Financial reporting and analysis',
                'status' => 'completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'asset_id' => 10, // iPhone
                'employee_id' => 4, // Dewi Lestari
                'start_time' => '2024-01-09 08:00:00',
                'end_time' => '2024-01-09 18:00:00',
                'hours_used' => 10.0,
                'notes' => 'Business communication and field coordination',
                'status' => 'completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'asset_id' => 7, // Laptop Dell
                'employee_id' => 1, // Ahmad Pratama
                'start_time' => '2024-01-09 09:00:00',
                'end_time' => 1,
                'hours_used' => 1,
                'notes' => 'Current development sprint work',
                'status' => 'ongoing',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Furniture Usage (tracking usage time)
            [
                'asset_id' => 11, // Executive Chair
                'employee_id' => 2, // Siti Nurhaliza
                'start_time' => '2024-01-08 08:00:00',
                'end_time' => '2024-01-08 17:00:00',
                'hours_used' => 9.0,
                'notes' => 'Daily office work',
                'status' => 'completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'asset_id' => 12, // Executive Desk
                'employee_id' => 3, // Budi Santoso
                'start_time' => '2024-01-08 08:30:00',
                'end_time' => '2024-01-08 17:30:00',
                'hours_used' => 9.0,
                'notes' => 'Financial documentation and meetings',
                'status' => 'completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Other Equipment
            [
                'asset_id' => 15, // Projector
                'employee_id' => 6, // Indah Permata
                'start_time' => '2024-01-08 13:00:00',
                'end_time' => '2024-01-08 15:00:00',
                'hours_used' => 2.0,
                'notes' => 'Marketing presentation to potential client',
                'status' => 'completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'asset_id' => 15, // Projector
                'employee_id' => 1, // Ahmad Pratama
                'start_time' => '2024-01-10 14:00:00',
                'end_time' => '2024-01-10 16:00:00',
                'hours_used' => 2.0,
                'notes' => 'Technical demonstration to stakeholders',
                'status' => 'completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        AssetOperation::insert($operations);
    }
}