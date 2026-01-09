<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum TicketPriority: string implements HasColor, HasLabel, HasIcon
{
    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';
    case URGENT = 'urgent';

    public function getLabel(): string
    {
        return match ($this) {
            self::LOW => 'Low',
            self::MEDIUM => 'Medium',
            self::HIGH => 'High',
            self::URGENT => 'Urgent',
        };
    }

    public function getColor(): string|array
    {
        return match ($this) {
            self::LOW => 'success',
            self::MEDIUM => 'info',
            self::HIGH => 'warning',
            self::URGENT => 'danger',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::LOW => 'heroicon-o-signal',
            self::MEDIUM => 'heroicon-o-signal',
            self::HIGH => 'heroicon-o-exclamation-triangle',
            self::URGENT => 'heroicon-o-exclamation-circle',
        };
    }
}
