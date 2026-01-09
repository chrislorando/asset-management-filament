<?php

namespace App\Filament\Resources\AssetOperations\Pages;

use App\Filament\Resources\AssetOperations\AssetOperationResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAssetOperation extends ViewRecord
{
    protected static string $resource = AssetOperationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
