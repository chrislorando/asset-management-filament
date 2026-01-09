<?php

namespace App\Filament\Resources\MaintenanceTickets\Schemas;

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use App\Models\Asset;
use App\Models\User;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MaintenanceTicketForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('filament::resources.maintenance_tickets') . ' Information')
                    ->description('Basic information about maintenance ticket')
                    ->icon('heroicon-o-ticket')
                    ->schema([
                        TextInput::make('ticket_number')
                            ->label(__('Ticket Number'))
                            ->disabled()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(50),
                        
                        Select::make('asset_id')
                            ->label(__('Asset'))
                            ->relationship('asset', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->live(),
                        
                        Select::make('reported_by')
                            ->label(__('Reported By'))
                            ->relationship('reportedBy', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        
                        TextInput::make('title')
                            ->label(__('Title'))
                            ->required()
                            ->maxLength(255),
                    ]),
                
                Section::make('Details')
                    ->description('Ticket details and status')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Textarea::make('description')
                            ->label(__('Description'))
                            ->required()
                            ->rows(4)
                            ->maxLength(65535),
                        
                        Select::make('priority')
                            ->label(__('Priority'))
                            ->options(TicketPriority::class)
                            ->enum(TicketPriority::class)
                            ->required()
                            ->default(TicketPriority::MEDIUM),
                        
                        Select::make('status')
                            ->label(__('Status'))
                            ->options(TicketStatus::class)
                            ->enum(TicketStatus::class)
                            ->required()
                            ->default(TicketStatus::OPEN)
                            ->live()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) { 
                                if ($state->value === TicketStatus::RESOLVED->value) {
                                    $set('resolved_at', now());
                                } else {
                                    $set('resolved_at', null);
                                }
                            }),
                    
                        
                        DatePicker::make('due_date')
                            ->label(__('Due Date'))
                            ->nullable(),
                        
                        DateTimePicker::make('resolved_at')
                            ->label(__('Resolved At'))
                            ->nullable()
                            ->disabled(function ($get) {
                                $status = $get('status')->value;
                                return !$status || $status !== TicketStatus::RESOLVED->value;
                            })
                            ->reactive()
                            ->dehydrated(true),
                    ]),
            ]);
    }
}
