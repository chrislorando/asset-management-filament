<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum UserRole: string implements HasColor, HasLabel, HasIcon
{
    case SUPER_ADMIN = 'super_admin';
    case HR = 'hr';
    case FINANCE = 'finance';
    case ASSET_SUPERVISOR = 'asset_supervisor';

    public function getLabel(): string
    {
        return match ($this) {
            self::SUPER_ADMIN => 'Super Admin',
            self::HR => 'HR',
            self::FINANCE => 'Finance',
            self::ASSET_SUPERVISOR => 'Asset Supervisor',
        };
    }

    public function getColor(): string|array
    {
        return match ($this) {
            self::SUPER_ADMIN => 'danger',
            self::HR => 'primary',
            self::FINANCE => 'success',
            self::ASSET_SUPERVISOR => 'warning',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::SUPER_ADMIN => 'heroicon-o-shield-check',
            self::HR => 'heroicon-o-user-group',
            self::FINANCE => 'heroicon-o-banknotes',
            self::ASSET_SUPERVISOR => 'heroicon-o-cube',
        };
    }
}
