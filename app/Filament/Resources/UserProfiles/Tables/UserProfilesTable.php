<?php

namespace App\Filament\Resources\UserProfiles\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class UserProfilesTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('user.name')->label('User'),
            Tables\Columns\TextColumn::make('phone'),
            Tables\Columns\TextColumn::make('status')->badge(),
        ]);
    }
}
