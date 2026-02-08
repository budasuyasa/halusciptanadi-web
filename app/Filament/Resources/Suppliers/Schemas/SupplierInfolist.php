<?php

namespace App\Filament\Resources\Suppliers\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SupplierInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Supplier')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('name')
                            ->label('Nama Supplier'),
                        TextEntry::make('contact_person')
                            ->label('Kontak Person')
                            ->placeholder('-'),
                        TextEntry::make('email')
                            ->label('Email')
                            ->placeholder('-'),
                        TextEntry::make('phone')
                            ->label('Telepon')
                            ->placeholder('-'),
                        TextEntry::make('address')
                            ->label('Alamat')
                            ->columnSpanFull()
                            ->placeholder('-'),
                        TextEntry::make('city')
                            ->label('Kota')
                            ->placeholder('-'),
                        TextEntry::make('description')
                            ->label('Deskripsi')
                            ->columnSpanFull()
                            ->placeholder('-'),
                        IconEntry::make('is_active')
                            ->label('Aktif')
                            ->boolean(),
                    ]),
                Section::make('Informasi Keuangan')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('bank_name')
                            ->label('Nama Bank')
                            ->placeholder('-'),
                        TextEntry::make('bank_account_number')
                            ->label('Nomor Rekening')
                            ->placeholder('-'),
                        TextEntry::make('bank_account_name')
                            ->label('Atas Nama Rekening')
                            ->placeholder('-'),
                        TextEntry::make('payment_terms')
                            ->label('Termin Pembayaran')
                            ->placeholder('-'),
                        TextEntry::make('credit_limit')
                            ->label('Limit Kredit')
                            ->money('IDR')
                            ->placeholder('-'),
                        TextEntry::make('tax_id')
                            ->label('NPWP')
                            ->placeholder('-'),
                    ]),
                Section::make('Statistik')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('products_count')
                            ->label('Jumlah Produk')
                            ->counts('products'),
                        TextEntry::make('created_at')
                            ->label('Dibuat')
                            ->dateTime('d M Y H:i'),
                        TextEntry::make('updated_at')
                            ->label('Diperbarui')
                            ->dateTime('d M Y H:i'),
                    ]),
            ]);
    }
}
