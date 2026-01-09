<?php

namespace App\Observers;

use App\Models\Project;

class ProjectObserver extends BaseObserver
{
    /**
     * Handle the Project "created" event.
     */
    public function created(Project $project): void
    {
        $this->logCreate($project);
    }

    /**
     * Handle the Project "updated" event.
     */
    public function updated(Project $project): void
    {
        $this->logUpdate($project);
    }

    /**
     * Handle the Project "deleted" event.
     */
    public function deleted(Project $project): void
    {
        $this->logDelete($project);
    }
}
