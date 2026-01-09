<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum AssetDocumentType: string implements HasColor, HasLabel, HasIcon
{
    case INVOICE = 'invoice';
    case WARRANTY = 'warranty';
    case MANUAL = 'manual';
    case CERTIFICATE = 'certificate';
    case MAINTENANCE = 'maintenance';
    case INSURANCE = 'insurance';
    case PHOTO = 'photo';
    case CONTRACT = 'contract';
    case LICENSE = 'license';
    case OTHER = 'other';

    public function getLabel(): string
    {
        return match ($this) {
            self::INVOICE => 'Invoice',
            self::WARRANTY => 'Warranty',
            self::MANUAL => 'Manual',
            self::CERTIFICATE => 'Certificate',
            self::MAINTENANCE => 'Maintenance',
            self::INSURANCE => 'Insurance',
            self::PHOTO => 'Photo',
            self::CONTRACT => 'Contract',
            self::LICENSE => 'License',
            self::OTHER => 'Other',
        };
    }

    public function getColor(): string|array
    {
        return match ($this) {
            self::INVOICE => 'danger',
            self::WARRANTY => 'warning',
            self::MANUAL => 'info',
            self::CERTIFICATE => 'success',
            self::MAINTENANCE => 'primary',
            self::INSURANCE => 'purple',
            self::PHOTO => 'gray',
            self::CONTRACT => 'pink',
            self::LICENSE => 'orange',
            self::OTHER => 'gray',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::INVOICE => 'heroicon-o-document-text',
            self::WARRANTY => 'heroicon-o-shield-check',
            self::MANUAL => 'heroicon-o-book-open',
            self::CERTIFICATE => 'heroicon-o-rectangle-stack',
            self::MAINTENANCE => 'heroicon-o-wrench-screwdriver',
            self::INSURANCE => 'heroicon-o-shield-check',
            self::PHOTO => 'heroicon-o-photo',
            self::CONTRACT => 'heroicon-o-document-duplicate',
            self::LICENSE => 'heroicon-o-key',
            self::OTHER => 'heroicon-o-document',
        };
    }
}