<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        $categories->each(function (Category $category) {
            Product::factory()
                ->count(fake()->numberBetween(3, 6))
                ->for($category)
                ->create();

            Product::factory()
                ->featured()
                ->count(1)
                ->for($category)
                ->create();
        });
    }
}
