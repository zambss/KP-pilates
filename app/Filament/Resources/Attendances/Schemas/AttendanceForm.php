<?php

namespace App\Filament\Resources\Attendances\Schemas;

use App\Models\ClassSchedule;
use Filament\Schemas\Schema;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
class AttendanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                   Forms\Components\Select::make('booking_id')
                    ->relationship('booking', 'id')
                    ->required(),

                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
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

                Forms\Components\DateTimePicker::make('attended_at')
                    ->required(),
            
            ]);
    }
}
