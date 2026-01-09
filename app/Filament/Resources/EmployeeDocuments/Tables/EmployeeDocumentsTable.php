<?php

namespace App\Filament\Resources\EmployeeDocuments\Tables;

use App\Enums\DocumentType;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class EmployeeDocumentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('employee.name')
                    ->label(__('Employee'))
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('document_type')
                    ->label(__('Document Type'))
                    ->badge()
                    ->color(fn (DocumentType $state): string => $state->getColor()),
                
                TextColumn::make('file_path')
                    ->label(__('File Name'))
                    ->formatStateUsing(fn ($state) => basename($state))
                    ->limit(30)
                    ->searchable(),
                
                TextColumn::make('issue_date')
                    ->label(__('Issue Date'))
                    ->date()
                    ->sortable(),
                
                TextColumn::make('expiry_date')
                    ->label(__('Expiry Date'))
                    ->date()
                    ->sortable()
                    ->default('-'),
                
                IconColumn::make('is_expired')
                    ->label(__('Expired'))
                    ->boolean(),
                
                TextColumn::make('is_expiring')
                    ->label(__('Expiring Soon'))
                    ->getStateUsing(fn ($record) => $record->isExpiring() ? 'Yes' : 'No')
                    ->badge()
                    ->color(fn ($state) => $state === 'Yes' ? 'warning' : 'success'),
            ])
            ->filters([
                SelectFilter::make('document_type')
                    ->label(__('Document Type'))
                    ->options(DocumentType::class),
                
                SelectFilter::make('is_expired')
                    ->label(__('Expired'))
                    ->options([
                        '1' => 'Expired',
                        '0' => 'Not Expired',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
