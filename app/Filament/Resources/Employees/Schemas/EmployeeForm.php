<?php

namespace App\Filament\Resources\Employees\Schemas;

use App\Enums\EmployeeStatus;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EmployeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                         Section::make('Employee Information')
                        ->description('Basic employee details')
                        ->schema([
                            TextInput::make('code')
                                ->required()
                                ->unique(ignoreRecord: true)
                                ->maxLength(255),
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('department')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('position')
                                ->required()
                                ->maxLength(255),
                        ])
                    ])
                    ->columnSpan(['lg' => 1]),

                Group::make()
                    ->schema([
                         Section::make('Contact Information')
                            ->description('Contact details')
                            ->schema([
                                TextInput::make('phone')
                                    ->tel()
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('email')
                                    ->label('Email address')
                                    ->email()
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255),
                            ]),
                        Section::make('Employment Details')
                            ->description('Employment information')
                            ->schema([
                                DatePicker::make('hire_date')
                                    ->required()
                                    ->maxDate(now()),
                                Select::make('status')
                                    ->options(EmployeeStatus::class)
                                    ->default(EmployeeStatus::ACTIVE)
                                    ->required(),
                            ])
                            ->columns(2),
                    ])
                    ->columnSpan(['lg' => 1]),
               
                
            ]);
    }
}
