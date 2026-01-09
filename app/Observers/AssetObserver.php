<?php

namespace App\Observers;

use App\Models\Asset;

class AssetObserver extends BaseObserver
{
    /**
     * Handle the Asset "created" event.
     */
    public function created(Asset $asset): void
    {
        $this->logCreate($asset);
    }

    /**
     * Handle the Asset "updated" event.
     */
    public function updated(Asset $asset): void
    {
        $this->logUpdate($asset);
    }

    /**
     * Handle the Asset "deleted" event.
     */
    public function deleted(Asset $asset): void
    {
        $this->logDelete($asset);
    }

    /**
     * Handle the Asset "restored" event.
     */
    public function restored(Asset $asset): void
    {
        $this->logRestore($asset);
    }

    /**
     * Handle the Asset "forceDeleted" event.
     */
    public function forceDeleted(Asset $asset): void
    {
        $this->logForceDelete($asset);
    }
}
