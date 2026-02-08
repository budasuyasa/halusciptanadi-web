<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class CartIcon extends Component
{
    public int $count = 0;

    public function mount(): void
    {
        $this->count = $this->getCount();
    }

    #[On('cart-updated')]
    public function updateCount(): void
    {
        $this->count = $this->getCount();
    }

    private function getCount(): int
    {
        return collect(session()->get('cart', []))->sum('quantity');
    }

    public function render()
    {
        return view('livewire.cart-icon');
    }
}
