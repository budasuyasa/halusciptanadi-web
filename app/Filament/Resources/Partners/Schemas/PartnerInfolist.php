<?php

namespace App\Filament\Resources\Partners\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PartnerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Partner')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('name')
                            ->label('Nama Partner'),
                        TextEntry::make('website_url')
                            ->label('Website')
                            ->url(fn ($state) => $state)
                            ->openUrlInNewTab()
                            ->placeholder('-'),
                        ImageEntry::make('logo')
                            ->label('Logo')
                            ->columnSpanFull(),
                        TextEntry::make('description')
                            ->label('Deskripsi')
                            ->columnSpanFull()
                            ->placeholder('-'),
                        TextEntry::make('sort_order')
                            ->label('Urutan'),
                        IconEntry::make('is_active')
                            ->label('Aktif')
                            ->boolean(),
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
