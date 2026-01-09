<?php

namespace App\Observers;

use App\Models\AssetDocument;
use Illuminate\Support\Facades\Storage;

class AssetDocumentObserver extends BaseObserver
{
    /**
     * Handle the EmployeeDocument "created" event.
     */
    public function created(AssetDocument $document): void
    {
        $this->logCreate($document);
    }

    /**
     * Handle the EmployeeDocument "updated" event.
     */
    public function updated(AssetDocument $document): void
    {
        $this->logUpdate($document);
    }

    /**
     * Handle the EmployeeDocument "deleted" event.
     */
    public function deleted(AssetDocument $document): void
    {
        $this->logDelete($document);
    }
}
