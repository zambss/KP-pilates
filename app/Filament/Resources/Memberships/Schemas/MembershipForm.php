<?php

namespace App\Filament\Resources\Memberships\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;

class MembershipForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\Select::make('user_id')
                ->relationship('user', 'name')
                ->required(),

            Forms\Components\Select::make('class_id')
                ->relationship('class', 'title') // ambil kolom name dari tabel classes
                ->searchable()
                ->required(),

            Forms\Components\DatePicker::make('start_date')->required(),
            Forms\Components\DatePicker::make('end_date')->required(),

            Forms\Components\TextInput::make('total_sessions')->numeric(),
            Forms\Components\TextInput::make('used_sessions')->numeric(),

            Forms\Components\Select::make('status')
                ->options([
                    'active' => 'Active',
                    'expired' => 'Expired',
                ]),
        ]);
    }
}
