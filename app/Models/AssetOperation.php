<?php

namespace App\Models;

use App\Enums\OperationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class AssetOperation extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_id',
        'employee_id',
        'start_time',
        'end_time',
        'hours_used',
        'notes',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'start_time' => 'datetime',
            'end_time' => 'datetime',
            'hours_used' => 'decimal:2',
            'status' => OperationStatus::class,
        ];
    }

    /**
     * Get the asset for the operation
     */
    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }

    /**
     * Get the employee for the operation
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Calculate hours used from start and end time
     */
    // public function calculateHoursUsed(): void
    // {
    //     if ($this->start_time && $this->end_time) {
    //         $this->hours_used = $this->end_time->diffInHours($this->start_time);
    //     }
    // }

    /**
     * Automatically calculate hours when end_time is set
     */
    protected function setEndTimeAttribute($value)
    {
        $this->attributes['end_time'] = $value;

        if ($value && $this->attributes['start_time'] ?? null) {
            $endTime = is_string($value) ? \Carbon\Carbon::parse($value) : $value;
            $startTime = is_string($this->attributes['start_time']) ? \Carbon\Carbon::parse($this->attributes['start_time']) : $this->attributes['start_time'];
            $this->attributes['hours_used'] = abs($endTime->diffInHours($startTime));
        }
    }

    /**
     * Scope to filter ongoing operations
     */
    public function scopeOngoing($query)
    {
        return $query->where('status', OperationStatus::ONGOING);
    }

    /**
     * Scope to filter completed operations
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', OperationStatus::COMPLETED);
    }
}
