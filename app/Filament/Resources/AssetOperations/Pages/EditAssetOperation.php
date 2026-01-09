<?php

namespace App\Filament\Resources\AssetOperations\Pages;

use App\Filament\Resources\AssetOperations\AssetOperationResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditAssetOperation extends EditRecord
{
    protected static string $resource = AssetOperationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
