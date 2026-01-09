<?php

namespace App\Filament\Resources\Projects\Schemas;

use App\Enums\ProjectStatus;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()->schema([
                    Section::make(__('filament::resources.projects') . ' Information')
                        ->description('Basic information about project')
                        ->icon('heroicon-o-clipboard-document-list')
                        ->schema([
                            TextInput::make('code')
                                ->label(__('Code'))
                                ->required()
                                ->maxLength(50)
                                ->unique(ignoreRecord: true),
                            TextInput::make('name')
                                ->label(__('Name'))
                                ->required()
                                ->maxLength(255),
                            Textarea::make('description')
                                ->label(__('Description'))
                                ->rows(4)
                                ->maxLength(65535),
                        ]),
                ])
                ->columnSpan(1),

                Group::make()->schema([
                    Section::make('Project Details')
                    ->description('Project timeline and details')
                    ->icon('heroicon-o-calendar-days')
                    ->schema([
                       
                        
                        DatePicker::make('start_date')
                            ->label(__('Start Date'))
                            ->required(),
                        
                        DatePicker::make('end_date')
                            ->label(__('End Date'))
                            ->required()
                            ->after('start_date'),
                        
                        TextInput::make('budget')
                            ->label(__('Budget'))
                            ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(',')
                            ->numeric()
                            ->prefix('SAR')
                            ->step(0.01),
                        
                        Select::make('status')
                            ->label(__('Status'))
                            ->options(ProjectStatus::class)
                            ->enum(ProjectStatus::class)
                            ->required()
                            ->default(ProjectStatus::PLANNING),
                    ]),
                ])
                ->columnSpan(1),
                
                
                
            ]);
    }
}
