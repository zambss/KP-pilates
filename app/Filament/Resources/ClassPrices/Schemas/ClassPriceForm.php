<?php

namespace App\Filament\Resources\ClassPrices\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;
use Filament\Forms\Form;
class ClassPriceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                 Forms\Components\Select::make('class_id')
                ->label('Kelas')
                ->relationship('class', 'title')
                ->searchable()
                ->preload()
                ->required(),

            Forms\Components\TextInput::make('session_count')
                ->label('Jumlah Sesi')
                ->numeric()
                ->minValue(1)
                ->required(),
Forms\Components\TextInput::make('bonus_sessions')
    ->label('Bonus Sesi')
    ->numeric()
    ->default(0),
            Forms\Components\TextInput::make('price')
                ->label('Harga')
                ->numeric()
                ->prefix('Rp')
                ->required(),
        ]);
        
    }
}
