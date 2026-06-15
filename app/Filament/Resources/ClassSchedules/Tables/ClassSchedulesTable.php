<?php

namespace App\Filament\Resources\ClassSchedules\Tables;

use App\Filament\Resources\ClassSchedules\ClassScheduleResource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Actions\Action;
use Filament\Actions\ExportAction;
use Filament\Actions\Exports\Enums\ExportFormat;
use App\Filament\Exports\ClassScheduleExporter;
use Illuminate\Support\Facades\Auth;

class ClassSchedulesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('class.title'),
                Tables\Columns\TextColumn::make('coach.name'),
                Tables\Columns\TextColumn::make('date')->date(),
                Tables\Columns\TextColumn::make('quota')->badge(),
            ])

            ->headerActions([
                ExportAction::make()
                    ->label('Export Schedule')
                    ->exporter(ClassScheduleExporter::class)
                    ->formats([
                        ExportFormat::Xlsx,
                        ExportFormat::Csv,
                    ]),
            ])

            ->recordActions([

                Action::make('edit')
                    ->label('Edit')
                    ->icon('heroicon-o-pencil')
                    ->url(fn ($record) =>
                        ClassScheduleResource::getUrl('edit', [
                            'record' => $record,
                        ])
                    )
                    ->visible(fn () => Auth::user()->role === 'super_admin'),

                Action::make('delete')
                    ->label('Delete')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(fn ($record) => $record->delete())
                    ->visible(fn () => Auth::user()->role === 'super_admin'),

            ]);
    }
}