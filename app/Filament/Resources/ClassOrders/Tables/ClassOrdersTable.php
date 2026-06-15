<?php

namespace App\Filament\Resources\ClassOrders\Tables;

use App\Filament\Resources\ClassOrders\ClassOrderResource;
use App\Models\Membership;
use Filament\Actions\Action;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\ExportAction;
use Filament\Actions\Exports\Enums\ExportFormat;
use App\Filament\Exports\ClassOrderExporter;
class ClassOrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Order ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->searchable(),

                Tables\Columns\TextColumn::make('class.title')
                    ->label('Kelas'),

                Tables\Columns\TextColumn::make('total_sessions')
                    ->label('Sesi')
                    ->badge(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'paid',
                    ]),
            ])
->headerActions([
    ExportAction::make()
        ->label('Export Paid Orders')
        ->exporter(ClassOrderExporter::class)
        ->formats([
            ExportFormat::Xlsx,
            ExportFormat::Csv,
        ])
])
           ->recordActions([
    Action::make('approve')
        ->label('Approve')
        ->icon('heroicon-o-check-circle')
        ->color('success')
        ->visible(fn ($record) => $record->status === 'pending')
        ->requiresConfirmation()
        ->modalHeading('Approve Order')
        ->modalDescription('Apakah kamu yakin ingin meng-ACC order ini? Membership akan langsung aktif.')
        ->modalSubmitActionLabel('Ya, Approve')
        ->modalCancelActionLabel('Batal')
        ->action(function ($record) {

            if ($record->status !== 'pending') {
                return;
            }

            // buat membership otomatis
            Membership::create([
    'user_id'            => $record->user_id,
    'class_id'           => $record->class_id,
    'class_order_id'     => $record->id,
    'start_date'         => now(),
    'end_date'           => now()->addDays(30),
    'total_sessions'     => $record->total_sessions,
    'remaining_sessions' => $record->total_sessions,
    'status'             => 'active',
]);


            // update status order
           $record->update([
    'status' => 'approved',
]);

        })
        ->successNotificationTitle('Order berhasil di-approve'),

   
    Action::make('delete')
        ->label('Delete')
        ->icon('heroicon-o-trash')
        ->color('danger')
        ->requiresConfirmation()
        ->action(fn ($record) => $record->delete()),
]);

    }
}
