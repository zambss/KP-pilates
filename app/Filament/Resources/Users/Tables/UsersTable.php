<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->searchable(),
            Tables\Columns\TextColumn::make('email'),
            Tables\Columns\TextColumn::make('role')
                ->badge()
                ->colors([
                    'primary' => 'customer',
                    'warning' => 'admin',
                    'danger' => 'super_admin',
                ]),
            Tables\Columns\TextColumn::make('created_at')->date(),
        ]);
    }
}
