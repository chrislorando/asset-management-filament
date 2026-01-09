<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum OperationStatus: string implements HasColor, HasLabel, HasIcon
{
    case ONGOING = 'ongoing';
    case COMPLETED = 'completed';

    public function getLabel(): string
    {
        return match ($this) {
            self::ONGOING => 'Ongoing',
            self::COMPLETED => 'Completed',
        };
    }

    public function getColor(): string|array
    {
        return match ($this) {
            self::ONGOING => 'info',
            self::COMPLETED => 'success',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::ONGOING => 'heroicon-o-arrow-path',
            self::COMPLETED => 'heroicon-o-check-circle',
        };
    }
}
