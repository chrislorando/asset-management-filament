<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProjectAsset extends Pivot
{
    protected $table = 'project_asset';

    protected $fillable = [
        'project_id',
        'asset_id',
        'assigned_date',
        'returned_date',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'assigned_date' => 'date',
            'returned_date' => 'date',
        ];
    }

    /**
     * Get the project that owns the project asset
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the asset that owns the project asset
     */
    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }
}
