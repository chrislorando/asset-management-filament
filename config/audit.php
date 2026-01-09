<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Audit Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your audit logging settings. You can enable/disable audit 
    | logging for specific models, configure retention, and set other options.
    |
    */

    "enabled" => env("AUDIT_ENABLED", true),

    /*
    |--------------------------------------------------------------------------
    | Models to Audit
    |--------------------------------------------------------------------------
    |
    | Specify which models should have audit logging enabled. Set to null to audit all
    | models, or provide an array of model class names.
    |
    */
    "models" => null, // Audit all models, or: ["App\Models\Asset", "App\Models\User"]

    /*
    |--------------------------------------------------------------------------
    | Actions to Audit
    |--------------------------------------------------------------------------
    |
    | Specify which actions should be logged. Set to null to log all actions.
    |
    */
    "actions" => ["create", "update", "delete", "restore", "force_delete"],

    /*
    |--------------------------------------------------------------------------
    | Sensitive Data Filtering
    |--------------------------------------------------------------------------
    |
    | Configure which fields should be filtered in audit logs.
    |
    */
    "sensitive_fields" => [
        "password",
        "remember_token", 
        "two_factor_secret",
        "two_factor_recovery_codes",
        "api_token",
        "personal_access_tokens",
    ],

    /*
    |--------------------------------------------------------------------------
    | Audit Retention
    |--------------------------------------------------------------------------
    |
    | How long to keep audit logs. Set to null to keep indefinitely.
    | Use carbon format like "90 days", "1 year", etc.
    |
    */
    "retention" => null,

    /*
    |--------------------------------------------------------------------------
    | Exclude IPs
    |--------------------------------------------------------------------------
    |
    | Array of IP addresses to exclude from audit logging.
    |
    */
    "exclude_ips" => [
        // "127.0.0.1",
        // "::1",
    ],

    /*
    |--------------------------------------------------------------------------
    | Exclude Users
    |--------------------------------------------------------------------------
    |
    | Array of user IDs to exclude from audit logging (for system operations).
    |
    */
    "exclude_users" => [
        // 1, // System user ID
    ],
];
