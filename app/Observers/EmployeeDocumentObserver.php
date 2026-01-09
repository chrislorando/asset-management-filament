<?php

namespace App\Observers;

use App\Models\EmployeeDocument;

class EmployeeDocumentObserver extends BaseObserver
{
    /**
     * Handle the EmployeeDocument "created" event.
     */
    public function created(EmployeeDocument $document): void
    {
        $this->logCreate($document);
    }

    /**
     * Handle the EmployeeDocument "updated" event.
     */
    public function updated(EmployeeDocument $document): void
    {
        $this->logUpdate($document);
    }

    /**
     * Handle the EmployeeDocument "deleted" event.
     */
    public function deleted(EmployeeDocument $document): void
    {
        $this->logDelete($document);
    }
}
