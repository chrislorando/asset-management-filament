<?php

namespace App\Filament\Resources\AssetOperations;

use App\Filament\Resources\AssetOperations\Pages\CreateAssetOperation;
use App\Filament\Resources\AssetOperations\Pages\EditAssetOperation;
use App\Filament\Resources\AssetOperations\Pages\ListAssetOperations;
use App\Filament\Resources\AssetOperations\Pages\ViewAssetOperation;
use App\Filament\Resources\AssetOperations\Schemas\AssetOperationForm;
use App\Filament\Resources\AssetOperations\Schemas\AssetOperationInfolist;
use App\Filament\Resources\AssetOperations\Tables\AssetOperationsTable;
use App\Models\AssetOperation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class AssetOperationResource extends Resource
{
    protected static ?string $model = AssetOperation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?int $navigationSort = 4;

    protected static string|UnitEnum|null $navigationGroup = 'Asset Inventory';

    public static function getModelLabel(): string
    {
        return __('filament::resources.asset_operations');
    }

    public static function form(Schema $schema): Schema
    {
        return AssetOperationForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AssetOperationInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AssetOperationsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAssetOperations::route('/'),
            'create' => CreateAssetOperation::route('/create'),
            'view' => ViewAssetOperation::route('/{record}'),
            'edit' => EditAssetOperation::route('/{record}/edit'),
        ];
    }
}
