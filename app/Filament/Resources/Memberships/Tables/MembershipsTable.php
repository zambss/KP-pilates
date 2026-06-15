<?php

namespace App\Filament\Resources\Memberships\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class MembershipsTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
             TextColumn::make('id'),
            TextColumn::make('user.name'),
            TextColumn::make('class.title'),
            TextColumn::make('status')->badge(),
            TextColumn::make('end_date')->date(),
        ]);
    }
}
