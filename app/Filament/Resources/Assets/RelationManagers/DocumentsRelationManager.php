<?php

namespace App\Filament\Resources\Assets\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use App\Enums\AssetDocumentType;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class DocumentsRelationManager extends RelationManager
{
    protected static string $relationship = 'documents';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('filament::resources.asset_documents') . ' Information')
                    ->description('Document information and type')
                    ->icon('heroicon-o-document-text')
                    ->schema([

                        
                        Select::make('document_type')
                            ->label(__('Document Type'))
                            ->options(AssetDocumentType::class)
                            ->enum(AssetDocumentType::class)
                            ->required(),
                        
                        FileUpload::make('file_path')
                            ->label(__('Document File'))
                            ->required()
                            ->directory('asset-documents')
                            ->visibility('public')
                            ->acceptedFileTypes(['application/pdf', 'image/*'])
                            ->maxSize(5120),
                    ]),
                
                Section::make('Document Dates')
                    ->description('Issue and expiry dates')
                    ->icon('heroicon-o-calendar-days')
                    ->schema([
                        DatePicker::make('issue_date')
                            ->label(__('Issue Date'))
                            ->default(now())
                            ->required(),
                        
                        DatePicker::make('expiry_date')
                            ->label(__('Expiry Date'))
                            ->nullable()
                            ->reactive()
                            ->default(now())
                            ->after('issue_date'),
                        
                        Toggle::make('is_expired')
                            ->label(__('Is Expired'))
                            ->helperText('Automatically updated based on expiry date')
                            ->disabled(),
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('document_type')
                    ->label(__('Document Type'))
                    ->badge()
                    ->color(fn (AssetDocumentType $state): string => $state->getColor()),
                
                TextColumn::make('file_path')
                    ->label(__('File'))
                    ->formatStateUsing(fn ($state) => basename($state))
                    ->url(fn ($record) => $record->file_path ? Storage::disk()->url($record->file_path) : null)
                    ->openUrlInNewTab()
                    ->limit(30)
                    ->color('primary')
                    ->icon('heroicon-o-document-arrow-down'),
                
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
                    ->options(AssetDocumentType::class),
                
                SelectFilter::make('is_expired')
                    ->label(__('Expired'))
                    ->options([
                        '1' => 'Expired',
                        '0' => 'Not Expired',
                    ]),
            ])
            ->headerActions([
                CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['asset_id'] = $this->ownerRecord->id;
                        return $data;
                    }),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
