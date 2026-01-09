<?php

namespace App\Filament\Resources\MaintenanceTickets\Pages;

use App\Filament\Resources\MaintenanceTickets\MaintenanceTicketResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMaintenanceTicket extends ViewRecord
{
    protected static string $resource = MaintenanceTicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
