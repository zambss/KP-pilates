<?php

namespace App\Filament\Resources\PackageItems\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables;
class PackageItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('package.name')
                ->label('Package')
                ->searchable(),

            Tables\Columns\TextColumn::make('class.title')
                ->label('Class')
                ->searchable(),

            Tables\Columns\TextColumn::make('session_count')
                ->label('Sessions')
                ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
