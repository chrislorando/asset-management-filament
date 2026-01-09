<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum AssetType: string implements HasColor, HasLabel, HasIcon
{
    case VEHICLE = 'vehicle';
    case EQUIPMENT = 'equipment';
    case ELECTRONICS = 'electronics';
    case FURNITURE = 'furniture';
    case OTHER = 'other';

    public function getLabel(): string
    {
        return match ($this) {
            self::VEHICLE => 'Vehicle',
            self::EQUIPMENT => 'Equipment',
            self::ELECTRONICS => 'Electronics',
            self::FURNITURE => 'Furniture',
            self::OTHER => 'Other',
        };
    }

    public function getColor(): string|array
    {
        return match ($this) {
            self::VEHICLE => 'danger',
            self::EQUIPMENT => 'warning',
            self::ELECTRONICS => 'info',
            self::FURNITURE => 'success',
            self::OTHER => 'gray',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::VEHICLE => 'heroicon-o-truck',
            self::EQUIPMENT => 'heroicon-o-wrench-screwdriver',
            self::ELECTRONICS => 'heroicon-o-computer-desktop',
            self::FURNITURE => 'heroicon-o-home',
            self::OTHER => 'heroicon-o-question-mark-circle',
        };
    }
}
