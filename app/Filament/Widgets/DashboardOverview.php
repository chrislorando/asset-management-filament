<?php

namespace App\Filament\Widgets;

use App\Enums\TicketStatus;
use App\Models\MaintenanceTicket;
use App\Models\EmployeeDocument;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardOverview extends BaseWidget
{
    protected static ?int $sort = 2;

    protected static ?string $poll = '60s';

    public function getColumns(): int | array
    {
        return 2;
    }

    protected function getStats(): array
    {
        $openTickets = MaintenanceTicket::where('status', TicketStatus::OPEN->value)->count();
        
        // Documents expiring in 30 days
        $expiringDocuments = EmployeeDocument::where('expiry_date', '>=', now())
            ->where('expiry_date', '<=', now()->addDays(30))
            ->count();

        return [
            Stat::make('Open Tickets', $openTickets)
                ->description('Pending maintenance')
                ->icon('heroicon-o-ticket')
                ->color('warning')
                ->url(route('filament.admin.resources.maintenance-tickets.index')),

            Stat::make('Documents Expiring', $expiringDocuments)
                ->description('Within 30 days')
                ->icon('heroicon-o-document-text')
                ->color('danger')
                ->url(route('filament.admin.resources.employee-documents.index')),
        ];
    }
}