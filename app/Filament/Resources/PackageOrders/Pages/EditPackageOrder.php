<?php

namespace App\Filament\Resources\PackageOrders\Pages;

use App\Filament\Resources\PackageOrders\PackageOrderResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPackageOrder extends EditRecord
{
    protected static string $resource = PackageOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
