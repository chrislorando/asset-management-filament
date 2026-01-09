<?php

namespace App\Observers;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

abstract class BaseObserver
{
    /**
     * Log a model creation
     */
    protected function logCreate(Model $model): void
    {
        $attributes = $model->getAttributes();
        $filtered = $this->removeTimestamps($attributes);
        $this->logAudit("create", $model, null, $filtered);
    }

    /**
     * Log a model update
     */
    protected function logUpdate(Model $model): void
    {
        $oldValues = $this->getOriginal($model);
        $newValues = $this->getChanges($model);

        // Only log if there are actual changes
        if (!empty($newValues)) {
            $this->logAudit("update", $model, $oldValues, $newValues);
        }
    }

    /**
     * Log a model deletion
     */
    protected function logDelete(Model $model): void
    {
        $this->logAudit("delete", $model, $this->getOriginal($model), null);
    }

    /**
     * Log a model restoration (soft delete)
     */
    protected function logRestore(Model $model): void
    {
        $this->logAudit("restore", $model, null, $this->getChanges($model));
    }

    /**
     * Log a model force deletion
     */
    protected function logForceDelete(Model $model): void
    {
        $this->logAudit("force_delete", $model, $this->getOriginal($model), null);
    }

    /**
     * Create an audit log entry
     */
    private function logAudit(string $action, Model $model, ?array $oldValues, ?array $newValues): void
    {
        try {
            // Get user ID safely - allow null if not authenticated
            $userId = null;
            try {
                if (Auth::check()) {
                    $userId = Auth::id();
                }
            } catch (\Exception $e) {
                // Auth not available, continue with null user_id
            }

            AuditLog::create([
                'user_id' => $userId,
                'action' => $action,
                'model_type' => get_class($model),
                'model_id' => $model->getKey(),
                'old_values' => $oldValues,
                'new_values' => $newValues,
                'ip_address' => $this->getIpAddress(),
                'user_agent' => $this->getUserAgent(),
            ]);
        } catch (\Exception $e) {
            // Log detailed error for debugging
            $errorData = [
                'action' => $action,
                'model' => get_class($model),
                'model_id' => $model->getKey(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ];
            
            try {
                logger()->error('Audit logging failed', $errorData);
            } catch (\Exception $logException) {
                error_log('Audit logging failed: ' . $e->getMessage());
            }
        }
    }

    /**
     * Get IP address safely
     */
    private function getIpAddress(): ?string
    {
        try {
            return Request::ip();
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Get user agent safely
     */
    private function getUserAgent(): ?string
    {
        try {
            return Request::userAgent();
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Get original values from model
     */
    protected function getOriginal(Model $model): array
    {
        return $model->getOriginal();
    }

    /**
     * Get changed values from model
     */
    protected function getChanges(Model $model): array
    {
        $changes = $model->getChanges();
        
        // Remove timestamps and only keep actual field changes
        $filteredChanges = [];
        foreach ($changes as $key => $value) {
            if (!in_array($key, ["created_at", "updated_at", "deleted_at"])) {
                $filteredChanges[$key] = $value;
            }
        }

        return $this->filterSensitiveData($filteredChanges);
    }

    /**
     * Filter sensitive fields that shouldn't be logged
     */
    protected function filterSensitiveData(array $data): array
    {
        $sensitiveFields = [
            "password",
            "remember_token",
            "two_factor_secret",
            "two_factor_recovery_codes",
        ];

        foreach ($sensitiveFields as $field) {
            if (array_key_exists($field, $data)) {
                $data[$field] = "[FILTERED]";
            }
        }

        return $data;
    }

    /**
     * Remove timestamps from data
     */
    protected function removeTimestamps(array $data): array
    {
        $filtered = [];
        foreach ($data as $key => $value) {
            if (!in_array($key, ["created_at", "updated_at", "deleted_at"])) {
                $filtered[$key] = $value;
            }
        }
        return $this->filterSensitiveData($filtered);
    }
}
