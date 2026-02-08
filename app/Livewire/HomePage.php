<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\News;
use App\Models\Partner;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Halus Ciptanadi - Distributor Produk Rumah Tangga di Bali')]
class HomePage extends Component
{
    public function render()
    {
        return view('livewire.home-page', [
            'featuredProducts' => Product::query()
                ->with('category')
                ->active()
                ->featured()
                ->latest()
                ->limit(8)
                ->get(),
            'categories' => Category::query()
                ->active()
                ->ordered()
                ->get(),
            'partners' => Partner::query()
                ->active()
                ->ordered()
                ->get(),
            'latestNews' => News::query()
                ->published()
                ->latest('published_at')
                ->limit(3)
                ->get(),
        ]);
    }
}
