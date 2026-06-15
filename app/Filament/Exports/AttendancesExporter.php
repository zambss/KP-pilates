<?php

namespace App\Filament\Exports;

use App\Models\Attendance;

use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class AttendancesExporter extends Exporter
{
    protected static ?string $model = Attendance::class;

    
    public static function getColumns(): array
    {
        return [
             ExportColumn::make('user.name')
                ->label('Member'),


            ExportColumn::make('classSchedule.class.title')
                ->label('Class'),

            ExportColumn::make('classSchedule.coach.name')
                ->label('Coach'),

            ExportColumn::make('attended_at')
                ->label('WAktu Hadir'),
            ExportColumn::make('created_at')
                ->label('Booking Date'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your booking export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
