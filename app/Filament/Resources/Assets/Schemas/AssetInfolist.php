<?php

namespace App\Filament\Resources\Assets\Schemas;

use App\Enums\AssetStatus;
use App\Enums\AssetType;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Schemas\Schema;

class AssetInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('filament::resources.assets') . ' Information')
                    ->description('Basic information about asset')
                    ->icon('heroicon-o-cube')
                    ->schema([
                        TextEntry::make('code')
                            ->label(__('Code'))
                            ->icon('heroicon-o-tag'),
                        
                        TextEntry::make('name')
                            ->label(__('Name'))
                            ->weight('semibold'),

                        TextEntry::make('brand')
                            ->label(__('Brand'))
                            ->icon('heroicon-o-building-office'),

                        TextEntry::make('model')
                            ->label(__('Model'))
                            ->icon('heroicon-o-cube'),
                        
                        TextEntry::make('type')
                            ->label(__('Type'))
                            ->badge()
                            ->color(fn (AssetType $state): string => $state->getColor())
                            ->icon(fn (AssetType $state): string => $state->getIcon()),
                        
                       TextEntry::make('description')
                            ->label(__('Description'))
                            ->markdown()
                            ->placeholder('No description available'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                
                Section::make('Details')
                    ->description('Additional asset details')
                    ->icon('heroicon-o-document-text')
                    ->columns(2)
                    ->schema([

                    TextEntry::make('serial_number')
                            ->label(__('Serial Number'))
                            ->icon('heroicon-o-hashtag'),

                            TextEntry::make('purchase_year')
                            ->label(__('Purchase Year'))
                            ->icon('heroicon-o-calendar')
                            ->badge()
                            ->color('primary'),
                        
                        TextEntry::make('purchase_price')
                            ->label(__('Purchase Price'))
                            ->money('IDR')
                            ->icon('heroicon-o-currency-dollar')
                            ->weight('semibold')
                            ->color('success'),

                        TextEntry::make('location')
                            ->label(__('Location'))
                            ->icon('heroicon-o-map-pin')
                            ->placeholder('Not specified'),

                        TextEntry::make('status')
                            ->label(__('Status'))
                            ->badge()
                            ->color(fn (AssetStatus $state): string => $state->getColor()),

                        TextEntry::make('assignedTo.name')
                            ->label(__('Assigned To'))
                            ->icon('heroicon-o-user')
                            ->placeholder('Unassigned')
                            ->badge(fn ($record) => $record->assignedTo ? 'success' : 'secondary'),
                        
                    ])
                    ->columnSpanFull(),
                
         
            ]);
    }
}
