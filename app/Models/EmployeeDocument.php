<?php

namespace App\Models;

use App\Enums\DocumentType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class EmployeeDocument extends Model
{
    use HasFactory;

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
            'document_type' => DocumentType::class,
        ];
    }

    /**
     * Get the employee that owns the document
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
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
}
