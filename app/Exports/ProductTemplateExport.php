<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductTemplateExport implements FromArray, WithHeadings, WithStyles
{
    public function headings(): array
    {
        return [
            'name',
            'slug',
            'sku',
            'category',
            'description',
            'short_description',
            'price',
            'sale_price',
            'stock',
            'unit',
            'weight',
            'is_active',
            'is_featured',
            'sort_order',
        ];
    }

    public function array(): array
    {
        return [
            ['Minyak Goreng Premium 1L', 'minyak-goreng-premium-1l', 'MGP-001', 'Minyak Goreng', 'Minyak goreng premium kualitas terbaik', 'Minyak goreng premium', 25000, 22000, 100, 'pcs', 1.00, 'true', 'false', 1],
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
