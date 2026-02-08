<?php

use App\Livewire\Cart;
use Livewire\Livewire;

it('shows empty cart message when no items', function () {
    Livewire::test(Cart::class)
        ->assertSee('Keranjang belanja kosong');
});

it('displays cart items from session', function () {
    session()->put('cart', [
        1 => ['name' => 'Minyak Goreng', 'price' => 25000, 'image' => null, 'quantity' => 2],
    ]);

    Livewire::test(Cart::class)
        ->assertSee('Minyak Goreng')
        ->assertSet('cart.1.quantity', 2);
});

it('updates item quantity', function () {
    session()->put('cart', [
        1 => ['name' => 'Minyak Goreng', 'price' => 25000, 'image' => null, 'quantity' => 1],
    ]);

    Livewire::test(Cart::class)
        ->call('updateQuantity', 1, 5)
        ->assertSet('cart.1.quantity', 5)
        ->assertDispatched('cart-updated');

    expect(session()->get('cart.1.quantity'))->toBe(5);
});

it('removes item when quantity set to zero', function () {
    session()->put('cart', [
        1 => ['name' => 'Minyak Goreng', 'price' => 25000, 'image' => null, 'quantity' => 1],
    ]);

    Livewire::test(Cart::class)
        ->call('updateQuantity', 1, 0)
        ->assertDispatched('cart-updated');

    expect(session()->get('cart'))->not->toHaveKey(1);
});

it('removes a specific item', function () {
    session()->put('cart', [
        1 => ['name' => 'Minyak Goreng', 'price' => 25000, 'image' => null, 'quantity' => 1],
        2 => ['name' => 'Bumbu Racik', 'price' => 10000, 'image' => null, 'quantity' => 3],
    ]);

    Livewire::test(Cart::class)
        ->call('removeItem', 1)
        ->assertDispatched('cart-updated');

    $cart = session()->get('cart');
    expect($cart)->not->toHaveKey(1)
        ->and($cart)->toHaveKey(2);
});

it('clears the entire cart', function () {
    session()->put('cart', [
        1 => ['name' => 'Minyak Goreng', 'price' => 25000, 'image' => null, 'quantity' => 1],
        2 => ['name' => 'Bumbu Racik', 'price' => 10000, 'image' => null, 'quantity' => 3],
    ]);

    Livewire::test(Cart::class)
        ->call('clearCart')
        ->assertSet('cart', [])
        ->assertDispatched('cart-updated');

    expect(session()->get('cart'))->toBeNull();
});

it('calculates total correctly', function () {
    session()->put('cart', [
        1 => ['name' => 'Minyak Goreng', 'price' => 25000, 'image' => null, 'quantity' => 2],
        2 => ['name' => 'Bumbu Racik', 'price' => 10000, 'image' => null, 'quantity' => 3],
    ]);

    $component = Livewire::test(Cart::class);

    expect($component->instance()->getTotal())->toBe(80000);
});
