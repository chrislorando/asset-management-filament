<?php

namespace App\Observers;

use App\Models\AssetOperation;

class AssetOperationObserver extends BaseObserver
{
    /**
     * Handle the AssetOperation "created" event.
     */
    public function created(AssetOperation $operation): void
    {
        $this->logCreate($operation);
    }

    /**
     * Handle the AssetOperation "updated" event.
     */
    public function updated(AssetOperation $operation): void
    {
        $this->logUpdate($operation);
    }

    /**
     * Handle the AssetOperation "deleted" event.
     */
    public function deleted(AssetOperation $operation): void
    {
        $this->logDelete($operation);
    }
}
