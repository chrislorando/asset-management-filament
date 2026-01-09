<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AuditLog extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "action",
        "model_type",
        "model_id",
        "old_values",
        "new_values",
        "ip_address",
        "user_agent",
    ];

    protected function casts(): array
    {
        return [
            "old_values" => "array",
            "new_values" => "array",
        ];
    }

    /**
     * Get the user who performed the action
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the audited model
     */
    public function auditable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Log an activity
     */
    public static function log(string $action, string $modelType, int $modelId, ?array $oldValues = null, ?array $newValues = null): self
    {
        return self::create([
            "user_id" => Auth::id(),
            "action" => $action,
            "model_type" => $modelType,
            "model_id" => $modelId,
            "old_values" => $oldValues,
            "new_values" => $newValues,
            "ip_address" => request()->ip() ?? null,
            "user_agent" => request()->userAgent() ?? null,
        ]);
    }

    /**
     * Scope to filter logs for a specific model
     */
    public function scopeForModel($query, string $modelType, int $modelId)
    {
        return $query->where("model_type", $modelType)
            ->where("model_id", $modelId);
    }

    /**
     * Scope to filter by action
     */
    public function scopeByAction($query, string $action)
    {
        return $query->where("action", $action);
    }

    /**
     * Scope to filter by user
     */
    public function scopeByUser($query, int $userId)
    {
        return $query->where("user_id", $userId);
    }

    /**
     * Get formatted action name
     */
    public function getFormattedActionAttribute(): string
    {
        return match($this->action) {
            "create" => "Created",
            "update" => "Updated",
            "delete" => "Deleted",
            "restore" => "Restored",
            "force_delete" => "Force Deleted",
            default => ucfirst($this->action),
        };
    }

    /**
     * Get model name without namespace
     */
    public function getModelNameAttribute(): string
    {
        return class_basename($this->model_type);
    }

    /**
     * Get human-readable description of changes
     */
    public function getChangesDescriptionAttribute(): string
    {
        if ($this->action === "create") {
            return "Created new " . $this->model_name . " with ID: " . $this->model_id;
        }

        if ($this->action === "delete" || $this->action === "force_delete") {
            return "Deleted " . $this->model_name . " with ID: " . $this->model_id;
        }

        if ($this->action === "update" && $this->old_values && $this->new_values) {
            $changes = [];
            foreach ($this->new_values as $key => $newValue) {
                $oldValue = $this->old_values[$key] ?? null;
                if ($oldValue !== $newValue) {
                    $changes[] = "{$key}: " . ($oldValue ?? "null") . " → " . ($newValue ?? "null");
                }
            }
            return implode(", ", $changes);
        }

        return $this->action . " on " . $this->model_name;
    }
}
