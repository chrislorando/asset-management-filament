<?php

namespace App\Filament\Resources\AssetOperations\Schemas;

use App\Enums\OperationStatus;
use App\Models\Asset;
use App\Models\Employee;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AssetOperationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('filament::resources.asset_operations') . ' Information')
                    ->description('Basic information about asset operation')
                    ->icon('heroicon-o-cog')
                    ->schema([
                        Select::make('asset_id')
                            ->label(__('Asset'))
                            ->relationship('asset', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->live(),
                        
                        Select::make('employee_id')
                            ->label(__('Employee'))
                            ->relationship('employee', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        
                        Select::make('status')
                            ->label(__('Status'))
                            ->options(OperationStatus::class)
                            ->enum(OperationStatus::class)
                            ->required()
                            ->default(OperationStatus::ONGOING),
                    ]),
                
                Section::make('Operation Details')
                    ->description('Operation timing and details')
                    ->icon('heroicon-o-clock')
                    ->schema([
                        DateTimePicker::make('start_time')
                            ->label(__('Start Time'))
                            ->required()
                            ->live()
                            ->afterStateUpdated(fn ($state, callable $set) => $set('hours_used', null)),
                        
                        DateTimePicker::make('end_time')
                            ->label(__('End Time'))
                            ->nullable()
                            ->live()
                            ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                if ($state && $get('start_time')) {
                                    $start = \Carbon\Carbon::parse($get('start_time'));
                                    $end = \Carbon\Carbon::parse($state);
                                    $hours = abs($end->diffInHours($start));
                                    $set('hours_used', round($hours, 1));
                                } else {
                                    $set('hours_used', null);
                                }
                            }),
                        
                        TextInput::make('hours_used')
                            ->label(__('Hours Used'))
                            ->numeric()
                            ->step(0.1)
                            ->disabled()
                            ->helperText('Automatically calculated from start and end time')
                            ->dehydrated(false),
                        
                        Textarea::make('notes')
                            ->label(__('Notes'))
                            ->rows(3)
                            ->maxLength(65535),
                    ]),
            ]);
    }
}
