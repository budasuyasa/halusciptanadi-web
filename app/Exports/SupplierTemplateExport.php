<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SupplierTemplateExport implements FromArray, WithHeadings, WithStyles
{
    public function headings(): array
    {
        return [
            'name',
            'contact_person',
            'email',
            'phone',
            'address',
            'city',
            'description',
            'bank_name',
            'bank_account_number',
            'bank_account_name',
            'payment_terms',
            'credit_limit',
            'tax_id',
            'is_active',
        ];
    }

    public function array(): array
    {
        return [
            [
                'PT Sumber Makmur',
                'Budi Santoso',
                'budi@sumbermakmur.co.id',
                '0361-123456',
                'Jl. Raya Denpasar No. 10',
                'Denpasar',
                'Supplier minyak goreng',
                'BCA',
                '1234567890',
                'PT Sumber Makmur',
                'Net 30',
                '50000000',
                '12.345.678.9-012.345',
                'true',
            ],
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
