<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CategoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Kategori')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('name')
                            ->label('Nama Kategori'),
                        TextEntry::make('slug'),
                        TextEntry::make('description')
                            ->label('Deskripsi')
                            ->html()
                            ->columnSpanFull(),
                        ImageEntry::make('image')
                            ->label('Gambar')
                            ->columnSpanFull(),
                        TextEntry::make('sort_order')
                            ->label('Urutan'),
                        IconEntry::make('is_active')
                            ->label('Aktif')
                            ->boolean(),
                    ]),
                Section::make('Statistik')
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
                    ])
                    ->columns(3),
            ]);
    }
}
