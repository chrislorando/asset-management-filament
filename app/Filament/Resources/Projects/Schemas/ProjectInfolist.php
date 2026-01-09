<?php

namespace App\Filament\Resources\Projects\Schemas;

use App\Enums\ProjectStatus;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProjectInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('filament::resources.projects') . ' Information')
                    ->description('Basic information about project')
                    ->icon('heroicon-o-clipboard-document-list')
                    ->schema([
                        TextEntry::make('name')
                            ->label(__('Name')),
                        
                        TextEntry::make('code')
                            ->label(__('Code')),
                        
                        TextEntry::make('status')
                            ->label(__('Status'))
                            ->badge()
                            ->color(fn (ProjectStatus $state): string => $state->getColor()),
                    ]),
                
                Section::make('Timeline')
                    ->description('Project timeline and duration')
                    ->icon('heroicon-o-calendar-days')
                    ->schema([
                        TextEntry::make('start_date')
                            ->label(__('Start Date'))
                            ->date(),
                        
                        TextEntry::make('end_date')
                            ->label(__('End Date'))
                            ->date(),
                        
                        TextEntry::make('budget')
                            ->label(__('Budget'))
                            ->money('SAR'),
                    ]),
                
                Section::make('Description')
                    ->description('Project description and details')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        TextEntry::make('description')
                            ->label(__('Description'))
                            ->hiddenLabel()
                            ->markdown()
                            ->columnSpanFull(),
                    ])->columnSpanFull(),
              
            ]);
    }
}
