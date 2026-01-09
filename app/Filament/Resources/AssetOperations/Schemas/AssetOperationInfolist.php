<?php

namespace App\Filament\Resources\AssetOperations\Schemas;

use App\Enums\OperationStatus;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AssetOperationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('filament::resources.asset_operations') . ' Information')
                    ->description('Basic information about asset operation')
                    ->icon('heroicon-o-cog')
                    ->schema([
                        TextEntry::make('asset.name')
                            ->label(__('Asset')),
                        
                        TextEntry::make('employee.name')
                            ->label(__('Employee')),
                        
                        TextEntry::make('status')
                            ->label(__('Status'))
                            ->badge()
                            ->color(fn (OperationStatus $state): string => $state->getColor()),
                    ]),
                
                Section::make('Operation Details')
                    ->description('Operation timing and details')
                    ->icon('heroicon-o-clock')
                    ->schema([
                        TextEntry::make('start_time')
                            ->label(__('Start Time'))
                            ->dateTime(),
                        
                        TextEntry::make('end_time')
                            ->label(__('End Time'))
                            ->dateTime()
                            ->formatStateUsing(fn ($state) => $state ? $state->format('Y-m-d H:i:s') : '-'),
                        
                        TextEntry::make('hours_used')
                            ->label(__('Hours Used'))
                            ->numeric(decimalPlaces: 2),
                        
                        TextEntry::make('notes')
                            ->label(__('Notes'))
                            ->markdown()
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
