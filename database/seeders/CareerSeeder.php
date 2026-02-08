<?php

namespace Database\Seeders;

use App\Models\Career;
use Illuminate\Database\Seeder;

class CareerSeeder extends Seeder
{
    public function run(): void
    {
        Career::factory()->count(4)->create();
        Career::factory()->inactive()->count(1)->create();
    }
}
