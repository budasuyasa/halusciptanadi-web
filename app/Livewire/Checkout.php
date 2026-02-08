<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Checkout - Halus Ciptanadi')]
class Checkout extends Component
{
    public string $customer_name = '';

    public string $customer_email = '';

    public string $customer_phone = '';

    public string $shipping_address = '';

    public string $shipping_city = '';

    public string $shipping_province = 'Bali';

    public string $shipping_postal_code = '';

    public string $notes = '';

    protected function rules(): array
    {
        return [
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:500',
            'shipping_city' => 'required|string|max:255',
            'shipping_province' => 'required|string|max:255',
            'shipping_postal_code' => 'required|string|max:10',
            'notes' => 'nullable|string|max:500',
        ];
    }

    public function mount(): void
    {
        if (empty(session()->get('cart', []))) {
            $this->redirect(route('cart'));
        }
    }

    public function placeOrder(): void
    {
        $this->validate();

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            $this->redirect(route('cart'));

            return;
        }

        $subtotal = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);

        $order = Order::create([
            'customer_name' => $this->customer_name,
            'customer_email' => $this->customer_email,
            'customer_phone' => $this->customer_phone,
            'shipping_address' => $this->shipping_address,
            'shipping_city' => $this->shipping_city,
            'shipping_province' => $this->shipping_province,
            'shipping_postal_code' => $this->shipping_postal_code,
            'notes' => $this->notes,
            'subtotal' => $subtotal,
            'shipping_cost' => 0,
            'total' => $subtotal,
        ]);

        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);

            $order->items()->create([
                'product_id' => $productId,
                'product_name' => $item['name'],
                'product_price' => $item['price'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);

            if ($product) {
                $product->decrement('stock', $item['quantity']);
            }
        }

        session()->forget('cart');
        $this->dispatch('cart-updated');

        $this->redirect(route('orders.show', $order));
    }

    public function render()
    {
        $cart = session()->get('cart', []);

        return view('livewire.checkout', [
            'cart' => $cart,
            'total' => collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']),
        ]);
    }
}
