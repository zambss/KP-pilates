<?php

namespace App\Filament\Widgets;


use App\Models\PackageOrderr;
use Filament\Tables;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class PendingOrders extends TableWidget
{
    // ✅ HARUS PUBLIC
    public function getHeading(): string
    {
        return 'Order Pending';
    }

    protected function getTableQuery(): Builder
    {
        return PackageOrderr::query()
            ->where('status', 'pending')
            ->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('user.name')
                ->label('User'),

            Tables\Columns\TextColumn::make('package.name')
                ->label('Paket'),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Tanggal')
                ->date('d M Y'),
        ];
    }

    // ✅ HARUS PUBLIC
    public function getTableRecordsPerPage(): int
    {
        return 5;
    }
}
