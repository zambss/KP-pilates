<?php

namespace App\Filament\Resources\ClassPrices\Pages;

use App\Filament\Resources\ClassPrices\ClassPriceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditClassPrice extends EditRecord
{
    protected static string $resource = ClassPriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
