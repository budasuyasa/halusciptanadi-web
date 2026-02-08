<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Produk')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('name')
                            ->label('Nama Produk'),
                        TextEntry::make('slug'),
                        TextEntry::make('category.name')
                            ->label('Kategori'),
                        TextEntry::make('supplier.name')
                            ->label('Supplier')
                            ->placeholder('-'),
                        TextEntry::make('sku')
                            ->label('SKU')
                            ->placeholder('-'),
                        TextEntry::make('short_description')
                            ->label('Deskripsi Singkat')
                            ->columnSpanFull(),
                        TextEntry::make('description')
                            ->label('Deskripsi')
                            ->html()
                            ->columnSpanFull(),
                    ]),
                Section::make('Harga & Stok')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('price')
                            ->label('Harga')
                            ->money('IDR'),
                        TextEntry::make('sale_price')
                            ->label('Harga Diskon')
                            ->money('IDR')
                            ->placeholder('-'),
                        TextEntry::make('stock')
                            ->label('Stok'),
                        TextEntry::make('unit')
                            ->label('Satuan'),
                        TextEntry::make('weight')
                            ->label('Berat (kg)'),
                    ]),
                Section::make('Pengaturan')
                    ->columns(3)
                    ->schema([
                        IconEntry::make('is_active')
                            ->label('Aktif')
                            ->boolean(),
                        IconEntry::make('is_featured')
                            ->label('Unggulan')
                            ->boolean(),
                        TextEntry::make('sort_order')
                            ->label('Urutan'),
                    ]),
                Section::make('Waktu')
                    ->columns(2)
                    ->schema([
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
