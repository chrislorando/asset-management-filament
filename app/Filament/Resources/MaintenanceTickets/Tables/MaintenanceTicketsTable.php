<?php

namespace App\Filament\Resources\MaintenanceTickets\Tables;

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class MaintenanceTicketsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ticket_number')
                    ->label(__('Ticket Number'))
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('asset.name')
                    ->label(__('Asset'))
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('title')
                    ->label(__('Title'))
                    ->searchable()
                    ->sortable(),
                
                BadgeColumn::make('priority')
                    ->label(__('Priority'))
                    ->color(fn (TicketPriority $state): string => $state->getColor()),
                
                BadgeColumn::make('status')
                    ->label(__('Status'))
                    ->color(fn (TicketStatus $state): string => $state->getColor()),
                
                TextColumn::make('reportedBy.name')
                    ->label(__('Reported By'))
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('due_date')
                    ->label(__('Due Date'))
                    ->date()
                    ->sortable(),
                
                TextColumn::make('resolved_at')
                    ->label(__('Resolved At'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('priority')
                    ->label(__('Priority'))
                    ->options(TicketPriority::class),
                
                SelectFilter::make('status')
                    ->label(__('Status'))
                    ->options(TicketStatus::class),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
