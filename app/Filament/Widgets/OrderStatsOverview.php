<?php

namespace App\Filament\Widgets;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrderStatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 0;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Pesanan', Order::query()->count())
                ->description('Semua pesanan'),
            Stat::make('Pesanan Baru', Order::query()->where('status', OrderStatus::Pending)->count())
                ->description('Menunggu diproses')
                ->color('warning'),
            Stat::make('Pendapatan', 'Rp ' . number_format(Order::query()->where('payment_status', PaymentStatus::Paid)->sum('total'), 0, ',', '.'))
                ->description('Total pendapatan')
                ->color('success'),
        ];
    }
}
