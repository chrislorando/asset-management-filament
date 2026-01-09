<?php

namespace App\Models;

use App\Enums\AssetDocumentType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssetDocument extends Model
{
    protected $fillable = [
        'employee_id',
        'document_type',
        'file_path',
        'issue_date',
        'expiry_date',
        'is_expired',
    ];

    protected function casts(): array
    {
        return [
            'issue_date' => 'date',
            'expiry_date' => 'date',
            'is_expired' => 'boolean',
            'document_type' => AssetDocumentType::class,
        ];
    }

    /**
     * Check if document is expiring soon (within 30 days)
     */
    public function isExpiring(): bool
    {
        if (!$this->expiry_date) {
            return false;
        }

        return $this->expiry_date->lte(now()->addDays(30));
    }

    /**
     * Automatically update is_expired based on expiry_date
     */
    protected function setExpiryDateAttribute($value)
    {
        $this->attributes['expiry_date'] = $value;

        if ($value) {
            $this->attributes['is_expired'] = now()->gt($value);
        }
    }

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }
}
