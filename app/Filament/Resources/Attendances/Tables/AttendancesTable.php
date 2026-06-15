<?php

namespace App\Filament\Resources\Attendances\Tables;

use App\Models\Attendance;
use Illuminate\Support\Carbon;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Actions\ExportAction;
use Filament\Actions\Exports\Enums\ExportFormat;


use App\Filament\Exports\AttendancesExporter;

class AttendancesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                   Tables\Columns\TextColumn::make('user.name')
                    ->label('Member')
                    ->searchable(),
                  Tables\Columns\TextColumn::make('classSchedule.class.title')
                    ->label('Class'),

                 Tables\Columns\TextColumn::make('classSchedule.coach.name')
                    ->label('Coach'),
                

                Tables\Columns\TextColumn::make('attended_at')
                    ->label('Waktu Hadir')
                    ->dateTime(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime(),

            
            ])
            ->filters([
                //
            ])
             ->headerActions([

                ExportAction::make()
                    ->exporter(AttendancesExporter::class)
                    ->formats([
                        ExportFormat::Csv,
                        ExportFormat::Xlsx,
                    ]),

            ])
            ->actions([

    Action::make('absensi')
        ->label('Absensi')
        ->icon('heroicon-o-check')
        ->color('success')

        ->visible(fn ($record) => !$record->attendance)

        ->action(function ($record) {

            Attendance::create([
                'booking_id' => $record->id,
                'user_id' => $record->user_id,
                'class_schedule_id' => $record->class_schedule_id,
                'attended_at' => Carbon::now(),
            ]);

        })

        ->requiresConfirmation()
        ->successNotificationTitle('Absensi berhasil'),

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
