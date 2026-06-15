<?php

namespace App\Filament\Exports;

use App\Models\ClassSchedule;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class ClassScheduleExporter extends Exporter
{
    protected static ?string $model = ClassSchedule::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('Schedule ID'),

            ExportColumn::make('class.title')
                ->label('Class'),

            ExportColumn::make('coach.name')
                ->label('Coach'),

            ExportColumn::make('date')
                ->label('Date'),

            ExportColumn::make('quota')
                ->label('Quota'),

            ExportColumn::make('created_at')
                ->label('Created At'),

        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your class schedule export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
