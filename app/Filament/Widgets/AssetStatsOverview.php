<?php

namespace App\Filament\Widgets;

use App\Enums\AssetStatus;
use App\Models\Asset;
use App\Models\AssetOperation;
use App\Models\MaintenanceTicket;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AssetStatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected static ?string $poll = '60s';

    protected function getStats(): array
    {
        $totalAssets = Asset::count();
        $activeAssets = Asset::whereIn('status', [AssetStatus::AVAILABLE->value, AssetStatus::IN_USE->value])->count();
        $maintenanceAssets = Asset::where('status', AssetStatus::MAINTENANCE->value)->count();
        $inactiveAssets = Asset::where('status', AssetStatus::RETIRED->value)->count();

        return [
            Stat::make('Total Assets', $totalAssets)
                ->description('All assets in system')
                ->icon('heroicon-o-rectangle-stack')
                ->color('primary'),

            Stat::make('Active Assets', $activeAssets)
                ->description('Available & In Use')
                ->icon('heroicon-o-check-circle')
                ->color('success'),

            Stat::make('Under Maintenance', $maintenanceAssets)
                ->description('Assets being repaired')
                ->icon('heroicon-o-wrench')
                ->color('warning'),

            Stat::make('Inactive Assets', $inactiveAssets)
                ->description('Retired assets')
                ->icon('heroicon-o-x-circle')
                ->color('danger'),
        ];
    }
}