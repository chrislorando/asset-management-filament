<?php

namespace App\Observers;

use App\Models\MaintenanceTicket;

class MaintenanceTicketObserver extends BaseObserver
{
    /**
     * Handle the MaintenanceTicket "created" event.
     */
    public function created(MaintenanceTicket $ticket): void
    {
        $this->logCreate($ticket);
    }

    /**
     * Handle the MaintenanceTicket "updated" event.
     */
    public function updated(MaintenanceTicket $ticket): void
    {
        $this->logUpdate($ticket);
    }

    /**
     * Handle the MaintenanceTicket "deleted" event.
     */
    public function deleted(MaintenanceTicket $ticket): void
    {
        $this->logDelete($ticket);
    }
}
