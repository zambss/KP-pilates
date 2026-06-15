<?php

namespace App\Filament\Exports;

use App\Models\ClassOrder;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Number;

class ClassOrderExporter extends Exporter
{
    protected static ?string $model = ClassOrder::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('Order ID'),

            ExportColumn::make('user.name')
                ->label('User'),

            ExportColumn::make('class.title')
                ->label('Class'),

            ExportColumn::make('total_sessions')
                ->label('Sessions'),

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
        return ClassOrder::query()
            ->with(['user', 'class'])
            ->where('status', 'paid'); // hanya export yang paid
    }
    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your class order export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
