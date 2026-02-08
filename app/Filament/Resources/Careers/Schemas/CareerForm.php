<?php

namespace App\Filament\Resources\Careers\Schemas;

use App\Enums\EmploymentType;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CareerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Lowongan')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul Posisi')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Select::make('location')
                            ->label('Lokasi')
                            ->options([
                                'Denpasar' => 'Denpasar',
                                'Singaraja' => 'Singaraja',
                                'Negara' => 'Negara',
                            ])
                            ->required(),
                        Select::make('employment_type')
                            ->label('Jenis Pekerjaan')
                            ->options(EmploymentType::class)
                            ->required(),
                        TextInput::make('department')
                            ->label('Departemen')
                            ->maxLength(255),
                        TextInput::make('salary_range')
                            ->label('Kisaran Gaji')
                            ->maxLength(255),
                    ]),
                Section::make('Detail')
                    ->schema([
                        RichEditor::make('description')
                            ->label('Deskripsi')
                            ->required()
                            ->columnSpanFull(),
                        RichEditor::make('requirements')
                            ->label('Persyaratan')
                            ->columnSpanFull(),
                        RichEditor::make('benefits')
                            ->label('Benefit')
                            ->columnSpanFull(),
                    ]),
                Section::make('Pengaturan')
                    ->columns(2)
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                        DatePicker::make('application_deadline')
                            ->label('Batas Lamaran'),
                    ]),
            ]);
    }
}
