<?php

namespace App\Filament\Resources\Careers\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CareerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Lowongan')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('title')
                            ->label('Judul Posisi'),
                        TextEntry::make('slug'),
                        TextEntry::make('location')
                            ->label('Lokasi'),
                        TextEntry::make('employment_type')
                            ->label('Jenis Pekerjaan')
                            ->badge(),
                        TextEntry::make('department')
                            ->label('Departemen')
                            ->placeholder('-'),
                        TextEntry::make('salary_range')
                            ->label('Kisaran Gaji')
                            ->placeholder('-'),
                    ]),
                Section::make('Detail')
                    ->schema([
                        TextEntry::make('description')
                            ->label('Deskripsi')
                            ->html()
                            ->columnSpanFull(),
                        TextEntry::make('requirements')
                            ->label('Persyaratan')
                            ->html()
                            ->columnSpanFull(),
                        TextEntry::make('benefits')
                            ->label('Benefit')
                            ->html()
                            ->columnSpanFull(),
                    ]),
                Section::make('Pengaturan')
                    ->columns(2)
                    ->schema([
                        IconEntry::make('is_active')
                            ->label('Aktif')
                            ->boolean(),
                        TextEntry::make('application_deadline')
                            ->label('Batas Lamaran')
                            ->date('d M Y')
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
