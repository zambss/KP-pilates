<?php

namespace App\Filament\Exports;

use App\Models\PackageOrder;
use App\Models\PackageOrderr;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Number;

class PackageOrderExporter extends Exporter
{
    protected static ?string $model = PackageOrderr::class;

    public static function getColumns(): array
    {
        return [
          ExportColumn::make('id')
                ->label('Order ID'),

            ExportColumn::make('user.name')
                ->label('User'),

            ExportColumn::make('package.name')
                ->label('Package'),

            ExportColumn::make('price')
                ->label('Price'),

            ExportColumn::make('status')
                ->label('Status'),

            ExportColumn::make('created_at')
                ->label('Order Date'),

        ];
    }
 public static function getEloquentQuery(): Builder
    {
        return PackageOrderr::query()
            ->with(['user', 'package'])
            ->where('status', 'approved'); // hanya yang success
    }
    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your package order export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
