<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum AssetStatus: string implements HasColor, HasLabel, HasIcon
{
    case AVAILABLE = 'available';
    case IN_USE = 'in_use';
    case MAINTENANCE = 'maintenance';
    case RETIRED = 'retired';

    public function getLabel(): string
    {
        return match ($this) {
            self::AVAILABLE => 'Available',
            self::IN_USE => 'In Use',
            self::MAINTENANCE => 'Maintenance',
            self::RETIRED => 'Retired',
        };
    }

    public function getColor(): string|array
    {
        return match ($this) {
            self::AVAILABLE => 'success',
            self::IN_USE => 'primary',
            self::MAINTENANCE => 'warning',
            self::RETIRED => 'danger',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::AVAILABLE => 'heroicon-o-check-circle',
            self::IN_USE => 'heroicon-o-arrow-path',
            self::MAINTENANCE => 'heroicon-o-wrench',
            self::RETIRED => 'heroicon-o-archive-box',
        };
    }
}
