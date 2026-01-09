<?php

namespace App\Models;

use App\Enums\AssetStatus;
use App\Enums\AssetType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'description',
        'type',
        'brand',
        'model',
        'serial_number',
        'purchase_year',
        'purchase_price',
        'status',
        'location',
        'assigned_to',
    ];

    protected function casts(): array
    {
        return [
            'purchase_year' => 'integer',
            'purchase_price' => 'decimal:2',
            'type' => AssetType::class,
            'status' => AssetStatus::class,
        ];
    }

    /**
     * Get the employee that the asset is assigned to
     */
    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'assigned_to');
    }

    /**
     * Get all operations for the asset
     */
    public function operations(): HasMany
    {
        return $this->hasMany(AssetOperation::class);
    }

    /**
     * Get all maintenance tickets for the asset
     */
    public function maintenanceTickets(): HasMany
    {
        return $this->hasMany(MaintenanceTicket::class);
    }

    /**
     * Get all documents for the asset
     */
    public function documents(): HasMany
    {
        return $this->hasMany(AssetDocument::class);
    }

    /**
     * Get all projects for the asset
     */
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_asset')
            ->using(ProjectAsset::class)
            ->withPivot('id', 'assigned_date', 'returned_date')
            ->withTimestamps();
    }

    /**
     * Scope to filter available assets
     */
    public function scopeAvailable($query)
    {
        return $query->where('status', AssetStatus::AVAILABLE);
    }

    /**
     * Scope to filter assets in use
     */
    public function scopeInUse($query)
    {
        return $query->where('status', AssetStatus::IN_USE);
    }

    /**
     * Scope to filter by type
     */
    public function scopeByType($query, AssetType $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope to filter by status
     */
    public function scopeByStatus($query, AssetStatus $status)
    {
        return $query->where('status', $status);
    }
}
