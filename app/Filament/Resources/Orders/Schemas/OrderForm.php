<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Pesanan')
                    ->columns(2)
                    ->schema([
                        TextInput::make('order_number')
                            ->label('No. Pesanan')
                            ->disabled(),
                        Select::make('status')
                            ->label('Status Pesanan')
                            ->options(OrderStatus::class)
                            ->required(),
                        Select::make('payment_status')
                            ->label('Status Pembayaran')
                            ->options(PaymentStatus::class)
                            ->required(),
                        TextInput::make('payment_method')
                            ->label('Metode Pembayaran')
                            ->disabled(),
                    ]),
                Section::make('Data Pelanggan')
                    ->columns(2)
                    ->schema([
                        TextInput::make('customer_name')
                            ->label('Nama')
                            ->required(),
                        TextInput::make('customer_email')
                            ->label('Email')
                            ->email()
                            ->required(),
                        TextInput::make('customer_phone')
                            ->label('Telepon')
                            ->tel()
                            ->required(),
                    ]),
                Section::make('Alamat Pengiriman')
                    ->columns(2)
                    ->schema([
                        Textarea::make('shipping_address')
                            ->label('Alamat')
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('shipping_city')
                            ->label('Kota')
                            ->required(),
                        TextInput::make('shipping_province')
                            ->label('Provinsi')
                            ->required(),
                        TextInput::make('shipping_postal_code')
                            ->label('Kode Pos')
                            ->required(),
                    ]),
                Section::make('Total')
                    ->columns(3)
                    ->schema([
                        TextInput::make('subtotal')
                            ->label('Subtotal')
                            ->numeric()
                            ->prefix('Rp')
                            ->disabled(),
                        TextInput::make('shipping_cost')
                            ->label('Ongkir')
                            ->numeric()
                            ->prefix('Rp')
                            ->disabled(),
                        TextInput::make('total')
                            ->label('Total')
                            ->numeric()
                            ->prefix('Rp')
                            ->disabled(),
                    ]),
                Section::make('Catatan')
                    ->schema([
                        Textarea::make('notes')
                            ->label('Catatan')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
