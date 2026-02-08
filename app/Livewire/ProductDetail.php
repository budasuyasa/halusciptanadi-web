<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductDetail extends Component
{
    public Product $product;

    public int $quantity = 1;

    public function mount(Product $product): void
    {
        $this->product = $product->load('category', 'images');
    }

    public function incrementQuantity(): void
    {
        $this->quantity++;
    }

    public function decrementQuantity(): void
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart(): void
    {
        $cart = session()->get('cart', []);
        $id = $this->product->id;

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $this->quantity;
        } else {
            $cart[$id] = [
                'name' => $this->product->name,
                'price' => $this->product->effective_price,
                'image' => $this->product->primaryImage?->image,
                'quantity' => $this->quantity,
            ];
        }

        session()->put('cart', $cart);
        $this->dispatch('cart-updated');
        $this->quantity = 1;
    }

    public function title(): string
    {
        return $this->product->name . ' - Halus Ciptanadi';
    }

    public function render()
    {
        return view('livewire.product-detail', [
            'relatedProducts' => Product::query()
                ->with('primaryImage')
                ->active()
                ->where('category_id', $this->product->category_id)
                ->where('id', '!=', $this->product->id)
                ->limit(4)
                ->get(),
        ]);
    }
}
