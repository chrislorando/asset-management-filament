<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum ProjectStatus: string implements HasColor, HasLabel, HasIcon
{
    case PLANNING = 'planning';
    case ACTIVE = 'active';
    case ON_HOLD = 'on_hold';
    case COMPLETED = 'completed';

    public function getLabel(): string
    {
        return match ($this) {
            self::PLANNING => 'Planning',
            self::ACTIVE => 'Active',
            self::ON_HOLD => 'On Hold',
            self::COMPLETED => 'Completed',
        };
    }

    public function getColor(): string|array
    {
        return match ($this) {
            self::PLANNING => 'info',
            self::ACTIVE => 'success',
            self::ON_HOLD => 'warning',
            self::COMPLETED => 'gray',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::PLANNING => 'heroicon-o-clipboard-document-list',
            self::ACTIVE => 'heroicon-o-play-circle',
            self::ON_HOLD => 'heroicon-o-pause-circle',
            self::COMPLETED => 'heroicon-o-check-circle',
        };
    }
}
