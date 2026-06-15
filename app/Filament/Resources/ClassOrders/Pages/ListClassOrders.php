<?php

namespace App\Filament\Resources\ClassOrders\Pages;

use App\Filament\Resources\ClassOrders\ClassOrderResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListClassOrders extends ListRecords
{
    protected static string $resource = ClassOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
