<?php

namespace App\Filament\Resources\Assets\Tables;

use App\Enums\AssetStatus;
use App\Enums\AssetType;
use App\Filament\Imports\AssetImporter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ExportBulkAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\ImportAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class AssetsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label(__('Code'))
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('type')
                    ->label(__('Type'))
                    ->badge()
                    ->color(fn (AssetType $state): string => $state->getColor()),
                
                TextColumn::make('brand')
                    ->label(__('Brand'))
                    ->searchable(),
                
                TextColumn::make('model')
                    ->label(__('Model'))
                    ->searchable(),
                
                TextColumn::make('status')
                    ->label(__('Status'))
                    ->badge()
                    ->color(fn (AssetStatus $state): string => $state->getColor()),
                
                TextColumn::make('assignedTo.name')
                    ->label(__('Assigned To'))
                    ->default('-')
                    ->sortable(),
                
                TextColumn::make('location')
                    ->label(__('Location'))
                    ->searchable()
                    ->toggleable(),
                
                TextColumn::make('purchase_price')
                    ->label(__('Purchase Price'))
                    ->money('IDR')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label(__('Type'))
                    ->options(AssetType::class),
                
                SelectFilter::make('status')
                    ->label(__('Status'))
                    ->options(AssetStatus::class),
                
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(\App\Filament\Exports\AssetsExporter::class),
                ImportAction::make('importAssets')
                    ->importer(AssetImporter::class)
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
                ExportBulkAction::make()
                    ->exporter(\App\Filament\Exports\AssetsExporter::class),
            ]);
    }
}
