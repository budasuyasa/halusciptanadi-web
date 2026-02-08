<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\User;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $author = User::first();

        News::factory()
            ->count(5)
            ->published()
            ->create(['author_id' => $author->id]);

        News::factory()
            ->count(2)
            ->create(['author_id' => $author->id]);
    }
}
