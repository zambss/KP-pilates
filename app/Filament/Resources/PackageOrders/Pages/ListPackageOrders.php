<?php

namespace App\Filament\Resources\PackageOrders\Pages;

use App\Filament\Resources\PackageOrders\PackageOrderResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPackageOrders extends ListRecords
{
    protected static string $resource = PackageOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
