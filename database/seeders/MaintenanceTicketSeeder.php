<?php

namespace Database\Seeders;

use App\Models\MaintenanceTicket;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaintenanceTicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing maintenance tickets
        MaintenanceTicket::query()->delete();

        $tickets = [
            [
                'ticket_number' => 'MT-2024-001',
                'asset_id' => 3, // Suzuki Carry (maintenance status)
                'reported_by' => 1, // Ahmad Pratama (Super Admin)
                'title' => 'Engine won\'t start',
                'description' => 'Vehicle fails to start, battery seems fine, possibly starter motor issue. Vehicle was working fine yesterday.',
                'priority' => 'high',
                'status' => 'open',
                'due_date' => '2024-01-15',
                'resolved_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ticket_number' => 'MT-2024-002',
                'asset_id' => 7, // Laptop Dell
                'reported_by' => 1, // Ahmad Pratama (employee who uses it)
                'title' => 'Overheating issue',
                'description' => 'Laptop becomes very hot after 30 minutes of use, fan seems to be working but not cooling properly.',
                'priority' => 'medium',
                'status' => 'in_progress',
                'due_date' => '2024-01-12',
                'resolved_at' => null,
                'created_at' => now()->subDays(2),
                'updated_at' => now(),
            ],
            [
                'ticket_number' => 'MT-2024-003',
                'asset_id' => 4, // Generator
                'reported_by' => 2, // Rudi Hermawan (who used it last)
                'title' => 'Fuel leak detected',
                'description' => 'Small fuel leak noticed around the fuel tank connection. Need immediate attention to prevent safety hazards.',
                'priority' => 'urgent',
                'status' => 'resolved',
                'due_date' => '2024-01-09',
                'resolved_at' => '2024-01-09 14:30:00',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(1),
            ],
            [
                'ticket_number' => 'MT-2024-004',
                'asset_id' => 13, // Meeting Table
                'reported_by' => 2, // Siti Nurhaliza
                'title' => 'Scratch on table surface',
                'description' => 'Deep scratch noticed on the table surface during morning meeting. May need refinishing.',
                'priority' => 'low',
                'status' => 'open',
                'due_date' => '2024-01-20',
                'resolved_at' => null,
                'created_at' => now()->subDays(1),
                'updated_at' => now(),
            ],
            [
                'ticket_number' => 'MT-2024-005',
                'asset_id' => 10, // iPhone
                'reported_by' => 3, // Dewi Lestari
                'title' => 'Battery draining quickly',
                'description' => 'Battery life significantly reduced, phone dies within 4 hours even with minimal usage.',
                'priority' => 'medium',
                'status' => 'in_progress',
                'due_date' => '2024-01-13',
                'resolved_at' => null,
                'created_at' => now()->subDays(3),
                'updated_at' => now(),
            ],
            [
                'ticket_number' => 'MT-2024-006',
                'asset_id' => 15, // Projector
                'reported_by' => 2, // Indah Permata
                'title' => 'Display flickering issue',
                'description' => 'Projector display flickers intermittently, especially during first 15 minutes of use. Affects presentation quality.',
                'priority' => 'medium',
                'status' => 'closed',
                'due_date' => '2024-01-08',
                'resolved_at' => '2024-01-08 16:45:00',
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(2),
            ],
            [
                'ticket_number' => 'MT-2024-007',
                'asset_id' => 5, // Water Pump
                'reported_by' => 3, // Eko Prasetyo
                'title' => 'Unusual noise during operation',
                'description' => 'Water pump making grinding noise during operation, performance seems affected. Need immediate inspection.',
                'priority' => 'high',
                'status' => 'open',
                'due_date' => '2024-01-11',
                'resolved_at' => null,
                'created_at' => now()->subHours(6),
                'updated_at' => now(),
            ],
            [
                'ticket_number' => 'MT-2024-008',
                'asset_id' => 2, // Honda CR-V
                'reported_by' => 1, // Ahmad Pratama
                'title' => 'Air conditioning not cooling',
                'description' => 'AC system blowing warm air, may need refrigerant recharge or compressor inspection.',
                'priority' => 'low',
                'status' => 'resolved',
                'due_date' => '2024-01-10',
                'resolved_at' => '2024-01-10 11:20:00',
                'created_at' => now()->subDays(4),
                'updated_at' => now()->subDays(2),
            ],
            [
                'ticket_number' => 'MT-2024-009',
                'asset_id' => 6, // Compressor
                'reported_by' => 4, // Rudi Hermawan
                'title' => 'Pressure gauge malfunctioning',
                'description' => 'Pressure gauge showing inconsistent readings, unable to monitor proper pressure levels.',
                'priority' => 'medium',
                'status' => 'open',
                'due_date' => '2024-01-14',
                'resolved_at' => null,
                'created_at' => now()->subHours(12),
                'updated_at' => now(),
            ],
            [
                'ticket_number' => 'MT-2024-010',
                'asset_id' => 8, // Laptop HP
                'reported_by' => 3, // Budi Santoso
                'title' => 'Trackpad not responding properly',
                'description' => 'Trackpad cursor jumps randomly, making it difficult to work. External mouse works fine.',
                'priority' => 'low',
                'status' => 'in_progress',
                'due_date' => '2024-01-16',
                'resolved_at' => null,
                'created_at' => now()->subDays(2),
                'updated_at' => now(),
            ],
        ];

        MaintenanceTicket::insert($tickets);
    }
}