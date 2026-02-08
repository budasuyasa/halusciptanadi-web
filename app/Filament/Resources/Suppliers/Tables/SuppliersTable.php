<?php

namespace App\Filament\Resources\Suppliers\Tables;

use App\Filament\Resources\Suppliers\SupplierResource;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class SuppliersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('contact_person')
                    ->label('Kontak Person')
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('Telepon'),
                TextColumn::make('city')
                    ->label('Kota')
                    ->searchable(),
                TextColumn::make('products_count')
                    ->label('Produk')
                    ->counts('products')
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
            ])
            ->recordUrl(fn (Model $record): string => SupplierResource::getUrl('view', ['record' => $record]))
            ->defaultSort('name')
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
