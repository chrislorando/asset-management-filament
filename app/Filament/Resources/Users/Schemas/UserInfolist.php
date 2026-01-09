<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Enums\UserRole;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('filament::resources.users') . ' Information')
                    ->description('Basic user information')
                    ->icon('heroicon-o-user')
                    ->schema([
                        TextEntry::make('name')
                            ->label(__('Name')),
                        
                        TextEntry::make('email')
                            ->label(__('Email Address')),
                        
                        TextEntry::make('role')
                            ->label(__('Role'))
                            ->badge()
                            ->color(fn (UserRole $state): string => $state->getColor()),
                        
                        TextEntry::make('email_verified_at')
                            ->label(__('Email Verified At'))
                            ->dateTime()
                            ->placeholder(__('Not verified')),
                      
                    ]),
                
                Section::make('Timestamps')
                    ->description('Account timestamps')
                    ->icon('heroicon-o-clock')
                    ->schema([
                        TextEntry::make('created_at')
                            ->label(__('Created At'))
                            ->dateTime()
                            ->placeholder('-'),
                        
                        TextEntry::make('updated_at')
                            ->label(__('Updated At'))
                            ->dateTime()
                            ->placeholder('-'),
                    ]),
            ]);
    }
}
