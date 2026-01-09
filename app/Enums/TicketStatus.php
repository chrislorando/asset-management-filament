<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum TicketStatus: string implements HasColor, HasLabel, HasIcon
{
    case OPEN = 'open';
    case IN_PROGRESS = 'in_progress';
    case RESOLVED = 'resolved';
    case CLOSED = 'closed';

    public function getLabel(): string
    {
        return match ($this) {
            self::OPEN => 'Open',
            self::IN_PROGRESS => 'In Progress',
            self::RESOLVED => 'Resolved',
            self::CLOSED => 'Closed',
        };
    }

    public function getColor(): string|array
    {
        return match ($this) {
            self::OPEN => 'danger',
            self::IN_PROGRESS => 'warning',
            self::RESOLVED => 'success',
            self::CLOSED => 'gray',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::OPEN => 'heroicon-o-envelope-open',
            self::IN_PROGRESS => 'heroicon-o-arrow-path',
            self::RESOLVED => 'heroicon-o-check-circle',
            self::CLOSED => 'heroicon-o-archive-box',
        };
    }
}
