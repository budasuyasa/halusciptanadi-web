<?php

namespace App\Filament\Resources\News\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class NewsInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Konten Berita')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('title')
                            ->label('Judul'),
                        TextEntry::make('slug'),
                        TextEntry::make('excerpt')
                            ->label('Ringkasan')
                            ->columnSpanFull(),
                        TextEntry::make('body')
                            ->label('Isi Berita')
                            ->html()
                            ->columnSpanFull(),
                        ImageEntry::make('featured_image')
                            ->label('Gambar Utama')
                            ->columnSpanFull(),
                    ]),
                Section::make('Publikasi')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('author.name')
                            ->label('Penulis'),
                        IconEntry::make('is_published')
                            ->label('Terbitkan')
                            ->boolean(),
                        TextEntry::make('published_at')
                            ->label('Tanggal Terbit')
                            ->dateTime('d M Y H:i')
                            ->placeholder('-'),
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
