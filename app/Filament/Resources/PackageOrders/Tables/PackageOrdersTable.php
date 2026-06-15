<?php

namespace App\Filament\Resources\PackageOrders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables;
use App\Models\Membership;
use Filament\Actions\Action;
use Illuminate\Support\Facades\DB;
use Filament\Actions\ExportAction;
use Filament\Actions\Exports\Enums\ExportFormat;
use App\Filament\Exports\PackageOrderExporter;

class PackageOrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->searchable(),

                Tables\Columns\TextColumn::make('package.name')
                    ->label('Paket'),

                Tables\Columns\TextColumn::make('price')
                    ->money('IDR'),

                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger'  => 'rejected',
                    ]),
            ])
            ->headerActions([
                ExportAction::make()
                    ->label('Export Approved Orders')
                    ->exporter(PackageOrderExporter::class)
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
                    ->visible(fn($record) => $record->status === 'pending')

                    ->action(function ($record) {
                        DB::transaction(function () use ($record) {

                            $package = $record->package()->with('items')->first();

                            foreach ($package->items as $item) {
                                Membership::create([
                                    'user_id'         => $record->user_id,
                                    'class_id'        => $item->class_id,
                                    'total_sessions' => $item->session_count,
                                    'used_sessions'  => 0,
                                    'start_date'     => now(),
                                    'end_date'       => now()->addDays(30),
                                    'status'         => 'active',
                                ]);
                            }

                            $record->update(['status' => 'approved']);
                        });
                    })
                    ->requiresConfirmation()
                    ->successNotificationTitle('Promo berhasil di-approve'),
            ]);
    }
}
