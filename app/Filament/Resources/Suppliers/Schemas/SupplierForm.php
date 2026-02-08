<?php

namespace App\Filament\Resources\Suppliers\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SupplierForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Supplier')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Supplier')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('contact_person')
                            ->label('Kontak Person')
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->label('Telepon')
                            ->tel()
                            ->maxLength(255),
                        Textarea::make('address')
                            ->label('Alamat')
                            ->columnSpanFull(),
                        TextInput::make('city')
                            ->label('Kota')
                            ->maxLength(255),
                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->columnSpanFull(),
                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                    ]),
                Section::make('Informasi Keuangan')
                    ->columns(2)
                    ->schema([
                        TextInput::make('bank_name')
                            ->label('Nama Bank')
                            ->maxLength(255),
                        TextInput::make('bank_account_number')
                            ->label('Nomor Rekening')
                            ->maxLength(255),
                        TextInput::make('bank_account_name')
                            ->label('Atas Nama Rekening')
                            ->maxLength(255),
                        TextInput::make('payment_terms')
                            ->label('Termin Pembayaran')
                            ->maxLength(255),
                        TextInput::make('credit_limit')
                            ->label('Limit Kredit')
                            ->numeric()
                            ->prefix('Rp'),
                        TextInput::make('tax_id')
                            ->label('NPWP')
                            ->maxLength(255),
                    ]),
            ]);
    }
}
