<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Enums\UserRole;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('filament::resources.users') . ' Information')
                    ->description('Basic user information')
                    ->icon('heroicon-o-user')
                    ->schema([
                        TextInput::make('name')
                            ->label(__('Name'))
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->label(__('Email Address'))
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true),

                        Select::make('role')
                            ->label(__('Role'))
                            ->options(UserRole::class)
                            ->enum(UserRole::class)
                            ->required()
                            ->default(UserRole::ASSET_SUPERVISOR),
                            
                        DateTimePicker::make('email_verified_at'),
                   
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Security')
                    ->schema([
                        Checkbox::make('change_password')
                            ->label('Change Password')
                            ->dehydrated(false)
                            ->live()
                            ->default(fn (string $operation) => $operation === 'create')
                            ->hidden(fn (string $operation) => $operation === 'create')
                            ->columnSpanFull(),
                        TextInput::make('password')
                            ->password()
                            ->revealable()
                            ->confirmed()
                            ->required(fn (string $operation, $get) => $operation === 'create' || $get('change_password'))
                            ->disabled(fn (string $operation, $get) => $operation === 'edit' && ! $get('change_password')),
                        TextInput::make('password_confirmation')
                            ->password()
                            ->revealable()
                            ->required(fn (string $operation, $get) => $operation === 'create' || $get('change_password'))
                            ->disabled(fn (string $operation, $get) => $operation === 'edit' && ! $get('change_password'))
                            ->dehydrated(false),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}
