<?php

namespace App\Providers;

use App\Observers\AssetDocumentObserver;
use App\Observers\AssetObserver;
use App\Observers\AssetOperationObserver;
use App\Observers\EmployeeDocumentObserver;
use App\Observers\EmployeeObserver;
use App\Observers\MaintenanceTicketObserver;
use App\Observers\ProjectObserver;
use App\Observers\UserObserver;
use App\Models\Asset;
use App\Models\AssetDocument;
use App\Models\AssetOperation;
use App\Models\Employee;
use App\Models\EmployeeDocument;
use App\Models\MaintenanceTicket;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register observers for all models that need audit logging
        $this->registerObservers();
    }

    /**
     * Register all model observers
     */
    private function registerObservers(): void
    {
        Asset::observe(AssetObserver::class);
        User::observe(UserObserver::class);
        Employee::observe(EmployeeObserver::class);
        Project::observe(ProjectObserver::class);
        AssetOperation::observe(AssetOperationObserver::class);
        MaintenanceTicket::observe(MaintenanceTicketObserver::class);
        EmployeeDocument::observe(EmployeeDocumentObserver::class);
        AssetDocument::observe(AssetDocumentObserver::class);
    }
}
