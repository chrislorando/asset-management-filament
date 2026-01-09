<?php

namespace App\Models;

use App\Enums\EmployeeStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'department',
        'position',
        'phone',
        'email',
        'hire_date',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'hire_date' => 'date',
            'status' => EmployeeStatus::class,
        ];
    }

    /**
     * Get all documents for the employee
     */
    public function documents(): HasMany
    {
        return $this->hasMany(EmployeeDocument::class);
    }

    /**
     * Get all assets assigned to the employee
     */
    public function assignedAssets(): HasMany
    {
        return $this->hasMany(Asset::class, 'assigned_to');
    }

    /**
     * Get all operations for the employee
     */
    public function operations(): HasMany
    {
        return $this->hasMany(AssetOperation::class);
    }

    /**
     * Scope to filter active employees
     */
    public function scopeActive($query)
    {
        return $query->where('status', EmployeeStatus::ACTIVE);
    }

    /**
     * Scope to filter by department
     */
    public function scopeByDepartment($query, $department)
    {
        return $query->where('department', $department);
    }
}
