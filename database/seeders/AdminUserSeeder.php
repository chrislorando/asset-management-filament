<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Super Admin
        User::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'role' => UserRole::SUPER_ADMIN,
            ]
        );

        // Create HR user
        User::firstOrCreate(
            ['email' => 'hr@example.com'],
            [
                'name' => 'HR Manager',
                'password' => Hash::make('password'),
                'role' => UserRole::HR,
            ]
        );

        // Create Finance user
        User::firstOrCreate(
            ['email' => 'finance@example.com'],
            [
                'name' => 'Finance Manager',
                'password' => Hash::make('password'),
                'role' => UserRole::FINANCE,
            ]
        );

        // Create Asset Supervisor
        User::firstOrCreate(
            ['email' => 'asset@example.com'],
            [
                'name' => 'Asset Supervisor',
                'password' => Hash::make('password'),
                'role' => UserRole::ASSET_SUPERVISOR,
            ]
        );

        $this->command->info('Admin users created successfully!');
        $this->command->info('Email: superadmin@example.com | Password: password');
    }
}
