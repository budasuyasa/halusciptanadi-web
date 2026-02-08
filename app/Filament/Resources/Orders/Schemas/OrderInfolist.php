<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Pesanan')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('order_number')
                            ->label('No. Pesanan'),
                        TextEntry::make('status')
                            ->label('Status Pesanan')
                            ->badge(),
                        TextEntry::make('payment_status')
                            ->label('Status Pembayaran')
                            ->badge(),
                        TextEntry::make('payment_method')
                            ->label('Metode Pembayaran')
                            ->placeholder('-'),
                    ]),
                Section::make('Data Pelanggan')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('customer_name')
                            ->label('Nama'),
                        TextEntry::make('customer_email')
                            ->label('Email'),
                        TextEntry::make('customer_phone')
                            ->label('Telepon'),
                    ]),
                Section::make('Alamat Pengiriman')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('shipping_address')
                            ->label('Alamat')
                            ->columnSpanFull(),
                        TextEntry::make('shipping_city')
                            ->label('Kota'),
                        TextEntry::make('shipping_province')
                            ->label('Provinsi'),
                        TextEntry::make('shipping_postal_code')
                            ->label('Kode Pos'),
                    ]),
                Section::make('Total')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('subtotal')
                            ->label('Subtotal')
                            ->money('IDR'),
                        TextEntry::make('shipping_cost')
                            ->label('Ongkir')
                            ->money('IDR'),
                        TextEntry::make('total')
                            ->label('Total')
                            ->money('IDR'),
                    ]),
                Section::make('Catatan')
                    ->schema([
                        TextEntry::make('notes')
                            ->label('Catatan')
                            ->placeholder('-'),
                    ]),
                Section::make('Waktu')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Dibuat')
                            ->dateTime('d M Y H:i'),
                        TextEntry::make('paid_at')
                            ->label('Dibayar')
                            ->dateTime('d M Y H:i')
                            ->placeholder('-'),
                        TextEntry::make('expired_at')
                            ->label('Kedaluwarsa')
                            ->dateTime('d M Y H:i')
                            ->placeholder('-'),
                        TextEntry::make('updated_at')
                            ->label('Diperbarui')
                            ->dateTime('d M Y H:i'),
                    ]),
            ]);
    }
}
