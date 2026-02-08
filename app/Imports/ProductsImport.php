<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsImport implements SkipsEmptyRows, ToCollection, WithHeadingRow, WithValidation
{
    protected int $importedCount = 0;

    protected int $updatedCount = 0;

    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {
            $slug = ! empty($row['slug']) ? $row['slug'] : Str::slug($row['name']);

            $product = ! empty($row['sku'])
                ? Product::firstOrNew(['sku' => $row['sku']])
                : new Product;

            $isNew = ! $product->exists;

            $categoryId = null;
            if (! empty($row['category'])) {
                $category = Category::query()
                    ->where('name', $row['category'])
                    ->orWhere('slug', $row['category'])
                    ->first();
                $categoryId = $category?->id;
            }

            $product->fill([
                'name' => $row['name'],
                'slug' => $slug,
                'sku' => $row['sku'] ?? null,
                'category_id' => $categoryId ?? $product->category_id,
                'description' => $row['description'] ?? null,
                'short_description' => $row['short_description'] ?? null,
                'price' => $row['price'],
                'sale_price' => $row['sale_price'] ?? null,
                'stock' => $row['stock'] ?? 0,
                'unit' => $row['unit'] ?? null,
                'weight' => $row['weight'] ?? null,
                'is_active' => isset($row['is_active']) ? filter_var($row['is_active'], FILTER_VALIDATE_BOOLEAN) : true,
                'is_featured' => isset($row['is_featured']) ? filter_var($row['is_featured'], FILTER_VALIDATE_BOOLEAN) : false,
                'sort_order' => $row['sort_order'] ?? 0,
            ]);

            $product->save();

            $isNew ? $this->importedCount++ : $this->updatedCount++;
        }
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'sku' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'short_description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'sale_price' => ['nullable', 'numeric', 'min:0'],
            'stock' => ['nullable', 'integer', 'min:0'],
            'unit' => ['nullable', 'string', 'max:50'],
            'weight' => ['nullable', 'numeric', 'min:0'],
            'is_active' => ['nullable'],
            'is_featured' => ['nullable'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
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
