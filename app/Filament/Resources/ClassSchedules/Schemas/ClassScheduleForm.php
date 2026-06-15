<?php

namespace App\Filament\Resources\ClassSchedules\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;
class ClassScheduleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\Select::make('class_id')
                ->relationship('class','title')->required(),
            Forms\Components\Select::make('coach_id')
                ->relationship('coach','name')->required(),
            Forms\Components\DatePicker::make('date')->required(),
            Forms\Components\TimePicker::make('start_time')->required(),
            Forms\Components\TimePicker::make('end_time')->required(),
            Forms\Components\TextInput::make('quota')->numeric()->required(),
        ]);
    }
}

