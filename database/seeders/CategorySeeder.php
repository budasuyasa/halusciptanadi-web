<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Minyak Goreng', 'description' => 'Berbagai jenis minyak goreng berkualitas untuk kebutuhan memasak sehari-hari.', 'sort_order' => 1],
            ['name' => 'Bumbu Masak', 'description' => 'Bumbu masak siap pakai untuk berbagai masakan.', 'sort_order' => 2],
            ['name' => 'Mie', 'description' => 'Mie instan dan mie kering berbagai rasa.', 'sort_order' => 3],
            ['name' => 'Minuman', 'description' => 'Minuman kemasan siap minum.', 'sort_order' => 4],
            ['name' => 'Produk Rumah Tangga', 'description' => 'Produk kebutuhan rumah tangga sehari-hari.', 'sort_order' => 5],
        ];

        foreach ($categories as $category) {
            Category::create([
                ...$category,
                'slug' => Str::slug($category['name']),
                'is_active' => true,
            ]);
        }
    }
}
