<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run admin users seeder
        $this->call(AdminUserSeeder::class);

        // Run employee seeder first (assets depend on employees)
        $this->call(EmployeeSeeder::class);

        // Run asset seeder
        $this->call(AssetSeeder::class);

        // Run project seeder (depends on assets)
        $this->call(ProjectSeeder::class);

        // Run asset operations seeder
        $this->call(AssetOperationSeeder::class);

        // Run maintenance tickets seeder
        $this->call(MaintenanceTicketSeeder::class);

        // Run employee documents seeder
        $this->call(EmployeeDocumentSeeder::class);

        // Run sample data seeder
        // $this->call(SampleDataSeeder::class);
    }
}
