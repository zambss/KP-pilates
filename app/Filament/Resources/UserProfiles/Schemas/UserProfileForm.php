<?php

namespace App\Filament\Resources\UserProfiles\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;

class UserProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\Select::make('user_id')
                ->relationship('user', 'name')
                ->required(),

            Forms\Components\TextInput::make('phone'),

            Forms\Components\Textarea::make('address'),

            Forms\Components\Textarea::make('health_note'),

            Forms\Components\TextInput::make('emergency_contact'),

            Forms\Components\Select::make('status')
                ->options([
                    'active' => 'Active',
                    'inactive' => 'Inactive',
                ]),
               Forms\Components\FileUpload::make('avatar')
    ->image()
    ->disk('public')
    ->directory('avatars')
    ->visibility('public'),
    
        ]);
    }
}
