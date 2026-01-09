<?php

namespace App\Filament\Resources\EmployeeDocuments\Schemas;

use App\Enums\DocumentType;
use App\Models\Employee;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EmployeeDocumentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('filament::resources.employee_documents') . ' Information')
                    ->description('Document information and type')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Select::make('employee_id')
                            ->label(__('Employee'))
                            ->relationship('employee', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        
                        Select::make('document_type')
                            ->label(__('Document Type'))
                            ->options(DocumentType::class)
                            ->enum(DocumentType::class)
                            ->required(),
                        
                        FileUpload::make('file_path')
                            ->label(__('Document File'))
                            ->required()
                            ->directory('employee-documents')
                            ->acceptedFileTypes(['application/pdf', 'image/*'])
                            ->maxSize(5120),
                    ]),
                
                Section::make('Document Dates')
                    ->description('Issue and expiry dates')
                    ->icon('heroicon-o-calendar-days')
                    ->schema([
                        DatePicker::make('issue_date')
                            ->label(__('Issue Date'))
                            ->required(),
                        
                        DatePicker::make('expiry_date')
                            ->label(__('Expiry Date'))
                            ->nullable()
                            ->reactive()
                            ->after('issue_date'),
                        
                        Toggle::make('is_expired')
                            ->label(__('Is Expired'))
                            ->helperText('Automatically updated based on expiry date')
                            ->disabled(),
                    ]),
            ]);
    }
}
