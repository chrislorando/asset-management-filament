<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Asset;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      
        $projects = [
            [
                'name' => 'Office Renovation Jakarta',
                'code' => 'PRJ-2023-001',
                'description' => 'Complete renovation of Jakarta head office including new furniture and IT equipment setup',
                'start_date' => '2023-01-15',
                'end_date' => '2023-03-30',
                'status' => 'completed',
                'budget' => 500000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Field Equipment Upgrade',
                'code' => 'PRJ-2023-002',
                'description' => 'Upgrade and replacement of field operation equipment across all sites',
                'start_date' => '2023-04-01',
                'end_date' => '2023-08-31',
                'status' => 'completed',
                'budget' => 750000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'IT Infrastructure Modernization',
                'code' => 'PRJ-2023-003',
                'description' => 'Complete overhaul of IT infrastructure including servers, networks, and workstations',
                'start_date' => '2023-06-01',
                'end_date' => '2023-12-15',
                'status' => 'active',
                'budget' => 1200000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Surabaya Branch Setup',
                'code' => 'PRJ-2024-001',
                'description' => 'Setup new branch office in Surabaya with complete furniture and equipment',
                'start_date' => '2024-01-10',
                'end_date' => '2024-03-20',
                'status' => 'active',
                'budget' => 300000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fleet Management System',
                'code' => 'PRJ-2024-002',
                'description' => 'Implementation of GPS tracking and fleet management system for all company vehicles',
                'start_date' => '2024-02-01',
                'end_date' => '2024-05-30',
                'status' => 'planning',
                'budget' => 150000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Project::insert($projects);

        // Get asset IDs for assignment
        $vehicles = Asset::where('type', 'vehicle')->pluck('id')->toArray();
        $equipment = Asset::where('type', 'equipment')->pluck('id')->toArray();
        $electronics = Asset::where('type', 'electronics')->pluck('id')->toArray();
        $furniture = Asset::where('type', 'furniture')->pluck('id')->toArray();

        // Asset assignments for projects
        $projectAssets = [
            // Project 1: Office Renovation Jakarta
            [
                'project_id' => 1,
                'asset_id' => $furniture[0] ?? 11, // Executive Desk
                'assigned_date' => '2023-01-20',
                'returned_date' => '2023-03-30',
                'notes' => 'Used during renovation, returned to manager office',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_id' => 1,
                'asset_id' => $furniture[1] ?? 12, // Meeting Table
                'assigned_date' => '2023-02-01',
                'returned_date' => '2023-03-25',
                'notes' => 'Temporary setup in temporary office',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_id' => 1,
                'asset_id' => $equipment[2] ?? 6, // Compressor
                'assigned_date' => '2023-01-15',
                'returned_date' => '2023-03-30',
                'notes' => 'Used for renovation work',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Project 2: Field Equipment Upgrade
            [
                'project_id' => 2,
                'asset_id' => $vehicles[0] ?? 1, // Toyota Hilux
                'assigned_date' => '2023-04-01',
                'returned_date' => '2023-08-31',
                'notes' => 'Used for equipment transport and installation',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_id' => 2,
                'asset_id' => $equipment[0] ?? 4, // Generator
                'assigned_date' => '2023-04-15',
                'returned_date' => '2023-08-20',
                'notes' => 'Provided power for remote site installations',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_id' => 2,
                'asset_id' => $equipment[1] ?? 5, // Water Pump
                'assigned_date' => '2023-05-01',
                'returned_date' => '2023-08-15',
                'notes' => 'Used for site preparation work',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Project 3: IT Infrastructure Modernization
            [
                'project_id' => 3,
                'asset_id' => $electronics[0] ?? 7, // Laptop Dell
                'assigned_date' => '2023-06-01',
                'returned_date' => null,
                'notes' => 'Used by IT team for infrastructure deployment',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_id' => 3,
                'asset_id' => $electronics[1] ?? 8, // Laptop HP
                'assigned_date' => '2023-06-15',
                'returned_date' => null,
                'notes' => 'Used for network configuration and testing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_id' => 3,
                'asset_id' => $electronics[3] ?? 10, // iPhone
                'assigned_date' => '2023-07-01',
                'returned_date' => null,
                'notes' => 'Project coordination and communication',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Project 4: Surabaya Branch Setup
            [
                'project_id' => 4,
                'asset_id' => $vehicles[1] ?? 2, // Honda CR-V
                'assigned_date' => '2024-01-10',
                'returned_date' => null,
                'notes' => 'Used for branch setup coordination',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_id' => 4,
                'asset_id' => $furniture[3] ?? 14, // Filing Cabinet
                'assigned_date' => '2024-01-15',
                'returned_date' => null,
                'notes' => 'Installed in Surabaya branch office',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_id' => 4,
                'asset_id' => $electronics[2] ?? 9, // iPad
                'assigned_date' => '2024-02-01',
                'returned_date' => null,
                'notes' => 'Used for presentations and client meetings',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('project_asset')->insert($projectAssets);
    }
}