<?php

namespace App\Imports;

use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class CategoriesImport implements SkipsEmptyRows, ToCollection, WithHeadingRow, WithValidation
{
    protected int $importedCount = 0;

    protected int $updatedCount = 0;

    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {
            $slug = ! empty($row['slug']) ? $row['slug'] : Str::slug($row['name']);

            $category = Category::firstOrNew(['slug' => $slug]);
            $isNew = ! $category->exists;

            $category->fill([
                'name' => $row['name'],
                'slug' => $slug,
                'description' => $row['description'] ?? null,
                'sort_order' => $row['sort_order'] ?? 0,
                'is_active' => isset($row['is_active']) ? filter_var($row['is_active'], FILTER_VALIDATE_BOOLEAN) : true,
            ]);

            $category->save();

            $isNew ? $this->importedCount++ : $this->updatedCount++;
        }
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
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
