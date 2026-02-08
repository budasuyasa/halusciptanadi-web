<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Keranjang - Halus Ciptanadi')]
class Cart extends Component
{
    public array $cart = [];

    public function mount(): void
    {
        $this->cart = session()->get('cart', []);
    }

    public function updateQuantity(int $productId, int $quantity): void
    {
        if ($quantity <= 0) {
            $this->removeItem($productId);

            return;
        }

        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $this->cart);
            $this->dispatch('cart-updated');
        }
    }

    public function removeItem(int $productId): void
    {
        unset($this->cart[$productId]);
        session()->put('cart', $this->cart);
        $this->dispatch('cart-updated');
    }

    public function clearCart(): void
    {
        $this->cart = [];
        session()->forget('cart');
        $this->dispatch('cart-updated');
    }

    public function getTotal(): int
    {
        return collect($this->cart)->sum(fn ($item) => $item['price'] * $item['quantity']);
    }

    public function render()
    {
        return view('livewire.cart', [
            'total' => $this->getTotal(),
        ]);
    }
}
