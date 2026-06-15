<?php

namespace App\Filament\Resources\ClassOrders\Pages;

use App\Filament\Resources\ClassOrders\ClassOrderResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditClassOrder extends EditRecord
{
    protected static string $resource = ClassOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
