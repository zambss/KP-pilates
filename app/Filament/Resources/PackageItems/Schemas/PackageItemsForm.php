<?php

namespace App\Filament\Resources\PackageItems\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;
class PackageItemsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                 Forms\Components\Select::make('package_id')
                ->relationship('package', 'name')
                ->required(),
                

            Forms\Components\Select::make('class_id')
                ->relationship('class', 'title')
                ->required(),
                

            Forms\Components\TextInput::make('session_count')
                ->numeric()
                ->required()
                ->minValue(1),
            ]);
    }
}
