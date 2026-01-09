<?php

namespace App\Filament\Resources\EmployeeDocuments\Schemas;

use App\Enums\DocumentType;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Schemas\Schema;

class EmployeeDocumentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('filament::resources.employee_documents') . ' Information')
                    ->description('Document information and type')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        TextEntry::make('employee.name')
                            ->label(__('Employee')),
                        
                        TextEntry::make('document_type')
                            ->label(__('Document Type'))
                            ->badge()
                            ->color(fn (DocumentType $state): string => $state->getColor()),
                        
                        TextEntry::make('file_path')
                            ->label(__('Document File'))
                            ->formatStateUsing(fn ($state) => basename($state))
                            ->limit(30),
                    ]),
                
                Section::make('Document Status')
                    ->description('Document expiry and status information')
                    ->icon('heroicon-o-flag')
                    ->schema([
                        TextEntry::make('issue_date')
                            ->label(__('Issue Date'))
                            ->date(),
                        
                        TextEntry::make('expiry_date')
                            ->label(__('Expiry Date'))
                            ->date()
                            ->placeholder('No expiry date'),
                        
                        IconEntry::make('is_expired')
                            ->label(__('Is Expired'))
                            ->boolean(),
                        
                        TextEntry::make('is_expiring')
                            ->label(__('Expiring Soon'))
                            ->getStateUsing(fn ($record) => $record->isExpiring() ? 'Yes (within 30 days)' : 'No')
                            ->badge()
                            ->color(fn ($state) => str_contains($state, 'Yes') ? 'warning' : 'success'),
                    ]),
            ]);
    }
}
