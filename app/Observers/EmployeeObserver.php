<?php

namespace App\Observers;

use App\Models\Employee;

class EmployeeObserver extends BaseObserver
{
    /**
     * Handle the Employee "created" event.
     */
    public function created(Employee $employee): void
    {
        $this->logCreate($employee);
    }

    /**
     * Handle the Employee "updated" event.
     */
    public function updated(Employee $employee): void
    {
        $this->logUpdate($employee);
    }

    /**
     * Handle the Employee "deleted" event.
     */
    public function deleted(Employee $employee): void
    {
        $this->logDelete($employee);
    }

    /**
     * Handle the Employee "restored" event.
     */
    public function restored(Employee $employee): void
    {
        $this->logRestore($employee);
    }

    /**
     * Handle the Employee "forceDeleted" event.
     */
    public function forceDeleted(Employee $employee): void
    {
        $this->logForceDelete($employee);
    }
}
