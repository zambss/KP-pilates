<?php

namespace App\Filament\Resources\Coaches\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;
class CoachForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\FileUpload::make('photo')
                ->image()
                ->disk('public')
                ->directory('coaches')
                ->visibility('public'),
                
        ]);
    }
}

