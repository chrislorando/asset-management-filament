<?php

namespace App\Filament\Resources\Employees\Schemas;

use App\Models\Employee;
use Filament\Infolists\Components\IconEntry;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class EmployeeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Employee Information')
                    ->description('Basic employee details')
                    ->schema([
                        TextEntry::make('code'),
                        TextEntry::make('name'),
                        TextEntry::make('department'),
                        TextEntry::make('position'),
                    ])
                    ->columns(2),
                Section::make('Contact Information')
                    ->description('Contact details')
                    ->schema([
                        TextEntry::make('phone')
                            ->icon('heroicon-o-phone'),
                        TextEntry::make('email')
                            ->label('Email address')
                            ->icon('heroicon-o-envelope'),
                    ])
                    ->columns(1),
                Section::make('Employment Details')
                    ->description('Employment information')
                    ->schema([
                        TextEntry::make('hire_date')
                            ->date()
                            ->icon('heroicon-o-calendar'),
                        TextEntry::make('status')
                            ->badge()
                            ->icon(fn (Employee $record): string => $record->status->getIcon()),
                    ])
                    ->columns(2),
                Section::make('Timestamps')
                    ->description('Record timestamps')
                    ->schema([
                        TextEntry::make('created_at')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('updated_at')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('deleted_at')
                            ->dateTime()
                            ->placeholder('-')
                            ->visible(fn (Employee $record): bool => $record->trashed()),
                    ])
                    ->columns(2)
                    ->collapsible(),
            ]);
    }
}
