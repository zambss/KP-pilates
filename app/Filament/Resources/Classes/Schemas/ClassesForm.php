<?php

namespace App\Filament\Resources\Classes\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;

class ClassesForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
             Forms\Components\TextInput::make('title')
                ->label('Nama Kelas')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('category')
                ->label('Category')
                ->required(),

             Forms\Components\TextInput::make('description')
                ->label('Deskripsi')
                ->required(),

           
        ]);
    }
}
          
