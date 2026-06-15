<?php

namespace App\Filament\Resources\Packages\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;
class PackageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
             Forms\Components\TextInput::make('name')
                ->label('Package Name')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('price')
                ->numeric()
                ->required()
                ->prefix('Rp'),

            Forms\Components\Toggle::make('is_active')
                ->label('Active')
                ->default(true),
        
            ]);
    }
}
