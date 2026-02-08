<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            SettingsSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            NewsSeeder::class,
            PartnerSeeder::class,
            SupplierSeeder::class,
            CareerSeeder::class,
        ]);
    }
}
