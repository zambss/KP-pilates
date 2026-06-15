<?php

namespace App\Filament\Resources\Bookings\Schemas;

use App\Models\ClassSchedule;
use Filament\Schemas\Schema;
use Filament\Forms;


class BookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\Select::make('user_id')
                ->relationship('user', 'name')
                ->required(),
            Forms\Components\Select::make('membership_id')
                ->relationship('membership', 'id')
                ->required(),
            Forms\Components\Select::make('class_schedule_id')
                ->label('Kelas & Jadwal')
                ->options(
                    ClassSchedule::with('class')->get()->mapWithKeys(function ($schedule) {
                        return [
                            $schedule->id =>
                            $schedule->class->title
                                . ' | '
                                . $schedule->date
                                . ' '
                                . $schedule->start_time
                                . ' - '
                                . $schedule->end_time
                        ];
                    })
                )

                ->required(),

            Forms\Components\Select::make('status')
                ->options([
                    'booked' => 'Booked',
                    'attended' => 'Attended',
                    'cancelled' => 'Cancelled',
                ])
                ->required(),
        ]);
    }
}
