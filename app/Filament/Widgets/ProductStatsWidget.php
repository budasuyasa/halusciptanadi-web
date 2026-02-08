<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProductStatsWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Produk', Product::query()->count())
                ->description('Semua produk'),
            Stat::make('Produk Aktif', Product::query()->where('is_active', true)->count())
                ->description('Produk yang ditampilkan')
                ->color('success'),
            Stat::make('Kategori', Category::query()->count())
                ->description('Total kategori'),
        ];
    }
}
