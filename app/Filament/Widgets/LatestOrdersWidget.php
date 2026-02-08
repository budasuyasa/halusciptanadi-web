<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestOrdersWidget extends TableWidget
{
    protected static ?int $sort = 1;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('Pesanan Terbaru')
            ->query(fn (): Builder => Order::query()->latest()->limit(5))
            ->columns([
                TextColumn::make('order_number')
                    ->label('No. Pesanan'),
                TextColumn::make('customer_name')
                    ->label('Pelanggan'),
                TextColumn::make('total')
                    ->label('Total')
                    ->money('IDR'),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge(),
                TextColumn::make('payment_status')
                    ->label('Pembayaran')
                    ->badge(),
                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y H:i'),
            ])
            ->paginated(false);
    }
}
