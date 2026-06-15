<?php

namespace App\Filament\Resources\PackageItems\Pages;

use App\Filament\Resources\PackageItems\PackageItemsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPackageItems extends EditRecord
{
    protected static string $resource = PackageItemsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
