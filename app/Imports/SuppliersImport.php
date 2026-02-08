<?php

namespace App\Imports;

use App\Models\Supplier;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SuppliersImport implements SkipsEmptyRows, ToCollection, WithHeadingRow, WithValidation
{
    protected int $importedCount = 0;

    protected int $updatedCount = 0;

    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {
            $supplier = ! empty($row['email'])
                ? Supplier::firstOrNew(['email' => $row['email']])
                : new Supplier;

            $isNew = ! $supplier->exists;

            $supplier->fill([
                'name' => $row['name'],
                'contact_person' => $row['contact_person'] ?? null,
                'email' => $row['email'] ?? null,
                'phone' => $row['phone'] ?? null,
                'address' => $row['address'] ?? null,
                'city' => $row['city'] ?? null,
                'description' => $row['description'] ?? null,
                'bank_name' => $row['bank_name'] ?? null,
                'bank_account_number' => $row['bank_account_number'] ?? null,
                'bank_account_name' => $row['bank_account_name'] ?? null,
                'payment_terms' => $row['payment_terms'] ?? null,
                'credit_limit' => $row['credit_limit'] ?? null,
                'tax_id' => $row['tax_id'] ?? null,
                'is_active' => isset($row['is_active']) ? filter_var($row['is_active'], FILTER_VALIDATE_BOOLEAN) : true,
            ]);

            $supplier->save();

            $isNew ? $this->importedCount++ : $this->updatedCount++;
        }
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'contact_person' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
            'city' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'bank_name' => ['nullable', 'string', 'max:255'],
            'bank_account_number' => ['nullable', 'string', 'max:255'],
            'bank_account_name' => ['nullable', 'string', 'max:255'],
            'payment_terms' => ['nullable', 'string', 'max:255'],
            'credit_limit' => ['nullable', 'numeric', 'min:0'],
            'tax_id' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable'],
        ];
    }

    public function getImportedCount(): int
    {
        return $this->importedCount;
    }

    public function getUpdatedCount(): int
    {
        return $this->updatedCount;
    }
}
