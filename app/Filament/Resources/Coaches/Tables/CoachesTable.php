<?php

namespace App\Filament\Resources\Coaches\Tables;

use App\Filament\Resources\Coaches\CoachResource;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Actions\Action;
use Filament\forms;
class CoachesTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
           Tables\Columns\ImageColumn::make('photo')
          ->disk('public')
    ->circular(),
            Tables\Columns\TextColumn::make('name')->searchable(),
        ])
        ->recordActions([
                Action::make('edit')
                    ->label('Edit')
                    ->icon('heroicon-o-pencil')
                    ->url(fn ($record) =>
                        CoachResource::getUrl('edit', [
                            'record' => $record,
                        ])
                    ),

                Action::make('delete')
                    ->label('Delete')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(fn ($record) => $record->delete()),
            ]);
    }
}
