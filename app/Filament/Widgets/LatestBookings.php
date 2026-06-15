<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Filament\Tables;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestBookings extends TableWidget
{
    protected function getHeading(): string
    {
        return 'Booking Terbaru';
    }

    protected function getTableQuery(): Builder
    {
        return Booking::query()->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('user.name')
                ->label('User'),

            Tables\Columns\TextColumn::make('status')
                ->badge()
                ->colors([
                    'warning' => 'booked',
                    'success' => 'attended',
                    'danger'  => 'cancelled',
                ]),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Tanggal')
                ->dateTime('d M Y H:i'),
        ];
    }

    // 🔥 HARUS PUBLIC
    public function getTableRecordsPerPage(): int
    {
        return 5;
    }
}
