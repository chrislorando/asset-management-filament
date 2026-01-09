<?php

namespace App\Filament\Resources\AuditLogs\Schemas;

use Filament\Infolists\Components\KeyValueEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AuditLogInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('filament::resources.audit_logs') . ' Information')
                    ->description('Audit log entry details')
                    ->icon('heroicon-o-clipboard-document-list')
                    ->schema([
                        TextEntry::make('user.name')
                            ->label(__('User')),
                        
                        TextEntry::make('action')
                            ->label(__('Action'))
                            ->badge()
                            ->color('info'),
                        
                        TextEntry::make('model_type')
                            ->label(__('Model Type')),
                        
                        TextEntry::make('model_id')
                            ->label(__('Model ID')),
                        
                        TextEntry::make('ip_address')
                            ->label(__('IP Address')),

                        TextEntry::make('user_agent')
                            ->label(__('User Agent'))
                            ->columnSpanFull(),
                        
                        TextEntry::make('created_at')
                            ->label(__('Timestamp'))
                            ->dateTime(),
                    ]),
                
                Section::make('Changes')
                    ->description('Old and new values comparison')
                    ->icon('heroicon-o-arrows-right-left')
                    ->schema([
                        KeyValueEntry::make('old_values')
                            ->label(__('Old Values'))
                            ->columnSpanFull(),
                        
                        KeyValueEntry::make('new_values')
                            ->label(__('New Values'))
                            ->columnSpanFull(),
                    ]),
                
          
            ]);
    }
}