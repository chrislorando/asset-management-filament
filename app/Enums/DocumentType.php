<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum DocumentType: string implements HasColor, HasLabel, HasIcon
{
    case PASSPORT = 'passport';
    case VISA = 'visa';
    case DRIVING_LICENSE = 'driving_license';
    case NATIONAL_ID = 'national_id';
    case WORK_PERMIT = 'work_permit';
    case MEDICAL_CERTIFICATE = 'medical_certificate';
    case CONTRACT = 'contract';
    case OTHER = 'other';

    public function getLabel(): string
    {
        return match ($this) {
            self::PASSPORT => 'Passport',
            self::VISA => 'Visa',
            self::DRIVING_LICENSE => 'Driving License',
            self::NATIONAL_ID => 'National ID',
            self::WORK_PERMIT => 'Work Permit',
            self::MEDICAL_CERTIFICATE => 'Medical Certificate',
            self::CONTRACT => 'Contact',
            self::OTHER => 'Other',
        };
    }

    public function getColor(): string|array
    {
        return match ($this) {
            self::PASSPORT => 'primary',
            self::VISA => 'info',
            self::DRIVING_LICENSE => 'success',
            self::NATIONAL_ID => 'warning',
            self::WORK_PERMIT => 'purple',
            self::MEDICAL_CERTIFICATE => 'pink',
            self::CONTRACT => 'info',
            self::OTHER => 'gray',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::PASSPORT => 'heroicon-o-rectangle-stack',
            self::VISA => 'heroicon-o-globe-alt',
            self::DRIVING_LICENSE => 'heroicon-o-identification',
            self::NATIONAL_ID => 'heroicon-o-badge-check',
            self::WORK_PERMIT => 'heroicon-o-document-text',
            self::MEDICAL_CERTIFICATE => 'heroicon-o-heart',
            self::CONTRACT => 'heroicon-o-document-text',
            self::OTHER => 'heroicon-o-document',
        };
    }
}
