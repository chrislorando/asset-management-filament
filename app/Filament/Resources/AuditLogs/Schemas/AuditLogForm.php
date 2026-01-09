<?php

namespace App\Filament\Resources\AuditLogs\Schemas;

use Filament\Schemas\Schema;

class AuditLogForm
{
    public static function configure(Schema $schema): Schema
    {
        // Audit logs are typically read-only, created automatically
        // No form configuration needed
        return $schema->components([]);
    }
}
