<?php

namespace App\Filament\Resources\AssetOperations\Pages;

use App\Filament\Resources\AssetOperations\AssetOperationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAssetOperations extends ListRecords
{
    protected static string $resource = AssetOperationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
