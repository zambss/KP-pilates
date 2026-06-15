<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Membership;
use App\Models\Booking;

use App\Models\PackageOrderr;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total User', User::count())
                ->icon('heroicon-o-users')
                ->color('primary'),

            Stat::make('Member Aktif', Membership::where('status', 'active')->count())
                ->icon('heroicon-o-identification')
                ->color('success'),

            Stat::make('Booking Hari Ini', Booking::whereDate('created_at', today())->count())
                ->icon('heroicon-o-calendar-days')
                ->color('warning'),

            Stat::make('Order Pending', PackageOrderr::where('status', 'pending')->count())
                ->icon('heroicon-o-clock')
                ->color('danger'),
        ];
    }
}
