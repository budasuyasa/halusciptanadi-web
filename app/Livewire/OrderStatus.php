<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrderStatus extends Component
{
    public Order $order;

    public function mount(Order $order): void
    {
        $this->order = $order->load('items');
    }

    public function title(): string
    {
        return 'Pesanan #' . $this->order->order_number . ' - Halus Ciptanadi';
    }

    public function render()
    {
        return view('livewire.order-status');
    }
}
