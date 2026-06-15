<?php

namespace App\Filament\Resources\ClassPrices\Pages;

use App\Filament\Resources\ClassPrices\ClassPriceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListClassPrices extends ListRecords
{
    protected static string $resource = ClassPriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
