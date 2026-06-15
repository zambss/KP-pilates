<?php

namespace App\Filament\Exports;

use App\Models\Booking;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class BookingExporter extends Exporter
{
    protected static ?string $model = Booking::class;

    
    public static function getColumns(): array
    {
        return [
              ExportColumn::make('user.name')
                ->label('Member'),

             ExportColumn::make('membership.id')
                ->label('Membership ID'), 

            ExportColumn::make('classSchedule.class.title')
                ->label('Class'),

            ExportColumn::make('classSchedule.coach.name')
                ->label('Coach'),

            ExportColumn::make('classSchedule.date')
                ->label('Date'),

            ExportColumn::make('classSchedule.start_time')
                ->label('Start'),

            ExportColumn::make('classSchedule.end_time')
                ->label('End'),

            ExportColumn::make('status')
                ->label('Status'),

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
