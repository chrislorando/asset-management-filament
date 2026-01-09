<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-chart-bar';

    // protected static ?string $navigationLabel = 'Dashboard';

    protected static ?int $navigationSort = -2;


    public function getColumns(): int | array
    {
        return [
            'md' => 2,
            'xl' => 3,
        ];
    }

    public function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\AssetStatsOverview::class,
            \App\Filament\Widgets\DashboardOverview::class,
        ];
    }
}