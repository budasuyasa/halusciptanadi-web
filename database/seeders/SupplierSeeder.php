<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = Supplier::factory()->count(5)->create();

        $products = Product::all();

        foreach ($products as $product) {
            $product->update([
                'supplier_id' => $suppliers->random()->id,
            ]);
        }
    }
}
