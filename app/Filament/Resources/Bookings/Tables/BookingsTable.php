<?php

namespace App\Filament\Resources\Bookings\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;

use Filament\Forms\Components\DatePicker;

use Filament\Actions\Action;
use Filament\Actions\ExportAction;
use Filament\Actions\Exports\Enums\ExportFormat;

use Illuminate\Database\Eloquent\Builder;

use App\Filament\Exports\BookingExporter;
use App\Models\Attendance;

class BookingsTable
{
    public static function configure(Table $table): Table
    {
        return $table

            ->columns([

                TextColumn::make('id')
                    ->label('Booking ID')
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label('Member')
                    ->searchable(),

                TextColumn::make('membership.id')
                    ->label('Membership ID')
                    ->sortable(),

                TextColumn::make('classSchedule.class.title')
                    ->label('Class'),

                TextColumn::make('classSchedule.coach.name')
                    ->label('Coach'),

                TextColumn::make('classSchedule.date')
                    ->label('Class Date')
                    ->date()
                    ->sortable(),

                TextColumn::make('classSchedule.start_time')
                    ->label('Start Time')
                    ->time(),

                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'warning' => 'booked',
                        'success' => 'attended',
                        'danger' => 'cancelled',
                    ]),

                TextColumn::make('created_at')
                    ->label('Booking Date')
                    ->dateTime(),

            ])

            ->filters([

                // Filter booking date
                Filter::make('created_at')
                    ->label('Booking Date')
                    ->form([
                        DatePicker::make('date')
                            ->label('Tanggal Booking'),
                    ])
                    ->query(function (Builder $query, array $data) {

                        return $query->when(
                            $data['date'] ?? null,
                            fn ($query, $date) => $query->whereDate('created_at', $date)
                        );

                    }),

                // Filter class date range
             Filter::make('booking_range')
    ->label('Booking Date Range')
    ->form([
        DatePicker::make('start_date')
            ->label('Dari Tanggal'),

        DatePicker::make('end_date')
            ->label('Sampai Tanggal'),
    ])

    ->query(function (Builder $query, array $data) {

        return $query
            ->when(
                $data['start_date'] ?? null,
                fn ($query, $date) => $query->whereDate('created_at', '>=', $date)
            )
            ->when(
                $data['end_date'] ?? null,
                fn ($query, $date) => $query->whereDate('created_at', '<=', $date)
            );

    }),

                // Filter Coach
                SelectFilter::make('coach')
                    ->relationship('classSchedule.coach', 'name')
                    ->label('Coach'),

                // Filter Class
                SelectFilter::make('class')
                    ->relationship('classSchedule.class', 'title')
                    ->label('Class'),

                // Filter Jam
                SelectFilter::make('schedule')
                    ->relationship('classSchedule', 'start_time')
                    ->label('Jam'),

            ])

            ->headerActions([

                ExportAction::make()
                    ->exporter(BookingExporter::class)
                    ->formats([
                        ExportFormat::Csv,
                        ExportFormat::Xlsx,
                    ]),

            ])

            ->recordActions([

                // Absensi
                Action::make('absensi')
                    ->label('Absensi')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->visible(fn ($record) => $record->status === 'booked')
                    ->requiresConfirmation()

                    ->action(function ($record) {

                        // cegah absensi ganda
                        if (!Attendance::where('booking_id', $record->id)->exists()) {

                            Attendance::create([
                                'booking_id' => $record->id,
                                'user_id' => $record->user_id,
                                'class_schedule_id' => $record->class_schedule_id,
                                'attended_at' => now(),
                            ]);

                        }

                        $record->update([
                            'status' => 'attended',
                        ]);

                    }),

                // Cancel Booking
                Action::make('cancel')
                    ->label('Cancel')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn ($record) => $record && $record->status === 'booked')
                    ->requiresConfirmation()

                    ->action(function ($record) {

                        $membership = $record->membership;

                        if ($membership && $membership->used_sessions > 0) {
                            $membership->decrement('used_sessions');
                        }

                        $record->update([
                            'status' => 'cancelled',
                        ]);

                    }),

            ]);
    }
}