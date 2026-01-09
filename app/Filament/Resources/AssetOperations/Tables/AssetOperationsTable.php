<?php

namespace App\Filament\Resources\AssetOperations\Tables;

use App\Enums\OperationStatus;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class AssetOperationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('asset.name')
                    ->label(__('Asset'))
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('employee.name')
                    ->label(__('Employee'))
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('start_time')
                    ->label(__('Start Time'))
                    ->dateTime()
                    ->sortable(),
                
                TextColumn::make('end_time')
                    ->label(__('End Time'))
                    ->dateTime()
                    ->sortable()
                    ->default('-'),
                
                TextColumn::make('hours_used')
                    ->label(__('Hours Used'))
                    ->numeric(decimalPlaces: 2)
                    ->sortable(),
                
                BadgeColumn::make('status')
                    ->label(__('Status'))
                    ->color(fn (OperationStatus $state): string => $state->getColor()),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label(__('Status'))
                    ->options(OperationStatus::class),
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
