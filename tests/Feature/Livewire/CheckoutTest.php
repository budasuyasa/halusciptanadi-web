<?php

use App\Livewire\Checkout;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Livewire\Livewire;

it('redirects to cart when cart is empty', function () {
    Livewire::test(Checkout::class)
        ->assertRedirect(route('cart'));
});

it('renders checkout form when cart has items', function () {
    session()->put('cart', [
        1 => ['name' => 'Minyak Goreng', 'price' => 25000, 'image' => null, 'quantity' => 1],
    ]);

    Livewire::test(Checkout::class)
        ->assertSuccessful()
        ->assertSee('Minyak Goreng');
});

it('validates required fields on place order', function () {
    session()->put('cart', [
        1 => ['name' => 'Minyak Goreng', 'price' => 25000, 'image' => null, 'quantity' => 1],
    ]);

    Livewire::test(Checkout::class)
        ->call('placeOrder')
        ->assertHasErrors([
            'customer_name' => 'required',
            'customer_email' => 'required',
            'customer_phone' => 'required',
            'shipping_address' => 'required',
            'shipping_city' => 'required',
            'shipping_postal_code' => 'required',
        ]);
});

it('validates email format', function () {
    session()->put('cart', [
        1 => ['name' => 'Minyak Goreng', 'price' => 25000, 'image' => null, 'quantity' => 1],
    ]);

    Livewire::test(Checkout::class)
        ->set('customer_email', 'not-an-email')
        ->call('placeOrder')
        ->assertHasErrors(['customer_email' => 'email']);
});

it('creates an order with items on successful checkout', function () {
    $product = Product::factory()->for(Category::factory())->create([
        'price' => 25000,
        'stock' => 10,
    ]);

    session()->put('cart', [
        $product->id => [
            'name' => $product->name,
            'price' => 25000,
            'image' => null,
            'quantity' => 2,
        ],
    ]);

    Livewire::test(Checkout::class)
        ->set('customer_name', 'John Doe')
        ->set('customer_email', 'john@example.com')
        ->set('customer_phone', '081234567890')
        ->set('shipping_address', 'Jl. Test No. 1')
        ->set('shipping_city', 'Denpasar')
        ->set('shipping_province', 'Bali')
        ->set('shipping_postal_code', '80119')
        ->call('placeOrder')
        ->assertDispatched('cart-updated')
        ->assertRedirect();

    $order = Order::first();
    expect($order)->not->toBeNull()
        ->and($order->customer_name)->toBe('John Doe')
        ->and($order->customer_email)->toBe('john@example.com')
        ->and((float) $order->total)->toBe(50000.00)
        ->and($order->items)->toHaveCount(1)
        ->and($order->items->first()->quantity)->toBe(2);

    // Stock should be decremented
    expect($product->fresh()->stock)->toBe(8);

    // Cart should be cleared
    expect(session()->get('cart'))->toBeNull();
});

it('generates a unique order number', function () {
    $product = Product::factory()->for(Category::factory())->create([
        'price' => 10000,
        'stock' => 100,
    ]);

    session()->put('cart', [
        $product->id => [
            'name' => $product->name,
            'price' => 10000,
            'image' => null,
            'quantity' => 1,
        ],
    ]);

    Livewire::test(Checkout::class)
        ->set('customer_name', 'Test User')
        ->set('customer_email', 'test@example.com')
        ->set('customer_phone', '081234567890')
        ->set('shipping_address', 'Jl. Test')
        ->set('shipping_city', 'Denpasar')
        ->set('shipping_province', 'Bali')
        ->set('shipping_postal_code', '80119')
        ->call('placeOrder');

    $order = Order::first();
    expect($order->order_number)->toStartWith('HC-');
});
