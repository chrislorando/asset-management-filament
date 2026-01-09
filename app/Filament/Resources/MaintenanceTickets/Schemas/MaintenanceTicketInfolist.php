<?php

namespace App\Filament\Resources\MaintenanceTickets\Schemas;

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MaintenanceTicketInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('filament::resources.maintenance_tickets') . ' Information')
                    ->description('Basic information about maintenance ticket')
                    ->icon('heroicon-o-ticket')
                    ->schema([
                        TextEntry::make('ticket_number')
                            ->label(__('Ticket Number')),
                        
                        TextEntry::make('asset.name')
                            ->label(__('Asset')),
                        
                        TextEntry::make('reportedBy.name')
                            ->label(__('Reported By')),
                        
                        TextEntry::make('title')
                            ->label(__('Title')),
                    ]),
                
                Section::make('Details')
                    ->description('Ticket details and status')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        TextEntry::make('description')
                            ->label(__('Description'))
                            ->markdown()
                            ->columnSpanFull(),
                        
                        TextEntry::make('priority')
                            ->label(__('Priority'))
                            ->badge()
                            ->color(fn (TicketPriority $state): string => $state->getColor()),
                        
                        TextEntry::make('status')
                            ->label(__('Status'))
                            ->badge()
                            ->color(fn (TicketStatus $state): string => $state->getColor()),
                        
                        TextEntry::make('due_date')
                            ->label(__('Due Date'))
                            ->date(),
                        
                        TextEntry::make('resolved_at')
                            ->label(__('Resolved At'))
                            ->dateTime()
                            ->placeholder('Not Resolved'),
                    ]),
            ]);
    }
}
