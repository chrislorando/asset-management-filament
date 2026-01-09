<?php

namespace App\Filament\Resources\Assets\Schemas;

use App\Enums\AssetStatus;
use App\Enums\AssetType;
use App\Models\Employee;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AssetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()->schema([
                    Section::make(__('filament::resources.assets') . ' Information')
                    ->description('Basic information about asset')
                    ->icon('heroicon-o-cube')
                    ->schema([
                        Grid::make()->schema([
                            TextInput::make('code')
                            ->label(__('Code'))
                            ->required()
                            ->maxLength(20),

                        TextInput::make('name')
                            ->label(__('Name'))
                            ->required()
                            ->maxLength(255),
                        
                        TextInput::make('brand')
                            ->label(__('Brand'))
                            ->required()
                            ->maxLength(100),
                        
                        TextInput::make('model')
                            ->label(__('Model'))
                            ->required()
                            ->maxLength(100),
                        
                        Select::make('type')
                            ->label(__('Type'))
                            ->options(AssetType::class)
                            ->enum(AssetType::class)
                            ->required(),
                        ])->columns(2)
                    ])
                    ->columnSpanFull(),
                ])
                ->columnSpanFull(),
                
                Group::make()->schema([
                    Section::make('Details')
                        ->description('Additional asset details')
                        ->icon('heroicon-o-document-text')
                        ->schema([
                            Grid::make()->schema([
                                Textarea::make('description')
                                    ->label(__('Description'))
                                    ->rows(3)
                                    ->maxLength(65535)
                                    ->columnSpanFull(),
                                
                                TextInput::make('serial_number')
                                    ->label(__('Serial Number'))
                                    ->maxLength(100),
                                
                                TextInput::make('purchase_price')
                                    ->label(__('Purchase Price'))
                                    ->numeric()
                                    ->prefix('SAR'),
                                
                                TextInput::make('purchase_year')
                                    ->label(__('Purchase Year'))
                                    ->numeric()
                                    ->minValue(1900)
                                    ->maxValue(date('Y')),
                                
                                TextInput::make('location')
                                    ->label(__('Location'))
                                    ->maxLength(255),
                                
                                Select::make('status')
                                    ->label(__('Status'))
                                    ->options(AssetStatus::class)
                                    ->enum(AssetStatus::class)
                                    ->required()
                                    ->default(AssetStatus::AVAILABLE),
                                
                                Select::make('assigned_to')
                                    ->label(__('Assigned To'))
                                    ->relationship('assignedTo', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->nullable(),
                            ])->columns(2),
                        ])->columnSpanFull()
                        
                    ])
                ->columnSpanFull(),
            ]);
    }
}
