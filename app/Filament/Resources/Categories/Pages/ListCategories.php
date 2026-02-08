<?php

namespace App\Filament\Resources\Categories\Pages;

use App\Exports\CategoryTemplateExport;
use App\Filament\Resources\Categories\CategoryResource;
use App\Imports\CategoriesImport;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('importCategories')
                ->label('Import')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('gray')
                ->form([
                    FileUpload::make('file')
                        ->label('File XLSX')
                        ->acceptedFileTypes([
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                            'application/vnd.ms-excel',
                        ])
                        ->required()
                        ->disk('local')
                        ->directory('imports')
                        ->helperText('Upload file XLSX dengan kolom: name, slug, description, sort_order, is_active'),
                ])
                ->action(function (array $data): void {
                    $import = new CategoriesImport;
                    Excel::import($import, storage_path('app/private/'.$data['file']));

                    Notification::make()
                        ->title('Import selesai')
                        ->body("{$import->getImportedCount()} kategori ditambahkan, {$import->getUpdatedCount()} diperbarui.")
                        ->success()
                        ->send();
                }),
            Action::make('downloadTemplate')
                ->label('Download Template')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('gray')
                ->action(function () {
                    return Excel::download(new CategoryTemplateExport, 'template-kategori.xlsx');
                }),
            CreateAction::make(),
        ];
    }
}
