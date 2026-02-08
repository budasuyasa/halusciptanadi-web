<?php

namespace App\Filament\Resources\Suppliers\Pages;

use App\Exports\SupplierTemplateExport;
use App\Filament\Resources\Suppliers\SupplierResource;
use App\Imports\SuppliersImport;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;

class ListSuppliers extends ListRecords
{
    protected static string $resource = SupplierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('importSuppliers')
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
                        ->helperText('Upload file XLSX dengan kolom: name, contact_person, email, phone, city, dll.'),
                ])
                ->action(function (array $data): void {
                    $import = new SuppliersImport;
                    Excel::import($import, storage_path('app/private/'.$data['file']));

                    Notification::make()
                        ->title('Import selesai')
                        ->body("{$import->getImportedCount()} supplier ditambahkan, {$import->getUpdatedCount()} diperbarui.")
                        ->success()
                        ->send();
                }),
            Action::make('downloadTemplate')
                ->label('Download Template')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('gray')
                ->action(function () {
                    return Excel::download(new SupplierTemplateExport, 'template-supplier.xlsx');
                }),
            CreateAction::make(),
        ];
    }
}
