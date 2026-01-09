<?php

namespace App\Observers;

use App\Models\User;

class UserObserver extends BaseObserver
{
    /**
     * Handle User "created" event.
     */
    public function created(User $user): void
    {
        $this->logCreate($user);
    }

    /**
     * Handle User "updated" event.
     */
    public function updated(User $user): void
    {
        $this->logUpdate($user);
    }

    /**
     * Handle User "deleted" event.
     */
    public function deleted(User $user): void
    {
        $this->logDelete($user);
    }
}
