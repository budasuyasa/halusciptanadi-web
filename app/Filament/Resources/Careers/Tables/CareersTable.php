<?php

namespace App\Filament\Resources\Careers\Tables;

use App\Filament\Resources\Careers\CareerResource;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class CareersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Posisi')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('location')
                    ->label('Lokasi')
                    ->sortable(),
                TextColumn::make('employment_type')
                    ->label('Jenis')
                    ->badge(),
                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                TextColumn::make('application_deadline')
                    ->label('Batas Lamaran')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->recordUrl(fn (Model $record): string => CareerResource::getUrl('view', ['record' => $record]))
            ->defaultSort('created_at', 'desc')
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
