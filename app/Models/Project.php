<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'start_date',
        'end_date',
        'status',
        'budget',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'budget' => 'decimal:2',
            'status' => ProjectStatus::class,
        ];
    }

    /**
     * Get all assets for the project
     */
    public function assets(): BelongsToMany
    {
        return $this->belongsToMany(Asset::class, 'project_asset')
            ->using(ProjectAsset::class)
            ->withPivot('id', 'assigned_date', 'returned_date', 'notes')
            ->withTimestamps();
    }

    /**
     * Get total assets count
     */
    public function getTotalAssetsCountAttribute(): int
    {
        return $this->assets()->count();
    }

    /**
     * Scope to filter active projects
     */
    public function scopeActive($query)
    {
        return $query->where('status', ProjectStatus::ACTIVE);
    }

    /**
     * Scope to filter by status
     */
    public function scopeByStatus($query, ProjectStatus $status)
    {
        return $query->where('status', $status);
    }
}
