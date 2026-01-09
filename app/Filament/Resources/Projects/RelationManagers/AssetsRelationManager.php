<?php

namespace App\Filament\Resources\Projects\RelationManagers;

use App\Enums\AssetStatus;
use App\Enums\AssetType;
use App\Models\Asset;
use App\Models\ProjectAsset;
use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AssetsRelationManager extends RelationManager
{
    protected static string $relationship = 'assets';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->model(ProjectAsset::class)
            ->schema([
                \Filament\Forms\Components\DatePicker::make('assigned_date')
                    ->required()
                    ->label('Assigned Date'),
                \Filament\Forms\Components\DatePicker::make('returned_date')
                    ->label('Returned Date')
                    ->nullable(),
                Textarea::make('notes')
                    ->label('Notes')
                    ->columnSpanFull()
                    ->nullable(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('code')
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('type')
                    ->badge()
                    ->searchable(),
                TextColumn::make('purchase_price')
                    ->money('SAR')
                    ->alignLeft(),
                TextColumn::make('pivot.assigned_date')
                    ->date()
                    ->sortable()
                    ->label('Assigned Date'),
                TextColumn::make('pivot.returned_date')
                    ->date()
                    ->sortable()
                    ->label('Returned Date')
                    ->placeholder('Still assigned'),
                TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                TextColumn::make('pivot.notes')
                    ->label('Notes')
                    ->limit(30)
                    ->toggleable(),
           
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->headerActions([
                AttachAction::make()
                ->label('Add Asset')
                    ->recordSelect(fn (Select $select) => $select
                        ->options(function () {
                            return Asset::where('status', AssetStatus::AVAILABLE)
                                ->pluck('name', 'id');
                        })
                        ->searchable()
                        ->getSearchResultsUsing(function (string $search) {
                            return Asset::where('name', 'like', "%{$search}%")
                                ->orWhere('code', 'like', "%{$search}%")
                                ->limit(50)
                                ->pluck('name', 'id');
                        })
                        ->required()
                        ->label('Asset')
                    )
                    ->form(fn (AttachAction $action) => [
                        $action->getRecordSelect(),
                        \Filament\Forms\Components\DatePicker::make('pivot.assigned_date')
                            ->required()
                            ->default(now())
                            ->label('Assigned Date'),
                        \Filament\Forms\Components\DatePicker::make('pivot.returned_date')
                            ->label('Returned Date')
                            ->default(now())
                            ->nullable(),
                        Textarea::make('pivot.notes')
                            ->label('Notes')
                            ->columnSpanFull()
                            ->nullable(),
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
                DetachAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DetachBulkAction::make(),
                ]),
            ]);
    }
}
