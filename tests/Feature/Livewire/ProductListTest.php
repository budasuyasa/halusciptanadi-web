<?php

use App\Livewire\ProductList;
use App\Models\Category;
use App\Models\Product;
use Livewire\Livewire;

it('displays active products', function () {
    $product = Product::factory()->for(Category::factory())->create(['is_active' => true]);
    $inactive = Product::factory()->for(Category::factory())->create(['is_active' => false]);

    Livewire::test(ProductList::class)
        ->assertSee($product->name)
        ->assertDontSee($inactive->name);
});

it('filters products by search', function () {
    $category = Category::factory()->create();
    $matching = Product::factory()->for($category)->create(['name' => 'Minyak Goreng Bimoli']);
    $other = Product::factory()->for($category)->create(['name' => 'Bumbu Racik']);

    Livewire::test(ProductList::class)
        ->set('search', 'Bimoli')
        ->assertSee($matching->name)
        ->assertDontSee($other->name);
});

it('filters products by category', function () {
    $categoryA = Category::factory()->create(['slug' => 'minyak']);
    $categoryB = Category::factory()->create(['slug' => 'bumbu']);
    $productA = Product::factory()->for($categoryA)->create();
    $productB = Product::factory()->for($categoryB)->create();

    Livewire::test(ProductList::class)
        ->set('category', 'minyak')
        ->assertSee($productA->name)
        ->assertDontSee($productB->name);
});

it('adds a product to the cart', function () {
    $product = Product::factory()->for(Category::factory())->create([
        'price' => 25000,
        'is_active' => true,
    ]);

    Livewire::test(ProductList::class)
        ->call('addToCart', $product->id)
        ->assertDispatched('cart-updated');

    $cart = session()->get('cart');
    expect($cart)->toHaveKey($product->id)
        ->and($cart[$product->id]['quantity'])->toBe(1)
        ->and($cart[$product->id]['name'])->toBe($product->name);
});

it('increments quantity when adding same product again', function () {
    $product = Product::factory()->for(Category::factory())->create([
        'price' => 25000,
        'is_active' => true,
    ]);

    Livewire::test(ProductList::class)
        ->call('addToCart', $product->id)
        ->call('addToCart', $product->id);

    $cart = session()->get('cart');
    expect($cart[$product->id]['quantity'])->toBe(2);
});

it('resets page when search changes', function () {
    Livewire::test(ProductList::class)
        ->set('search', 'test')
        ->assertSet('search', 'test');
});

it('sorts products by price ascending', function () {
    $category = Category::factory()->create();
    $cheap = Product::factory()->for($category)->create(['price' => 10000, 'name' => 'Cheap']);
    $expensive = Product::factory()->for($category)->create(['price' => 50000, 'name' => 'Expensive']);

    Livewire::test(ProductList::class)
        ->set('sort', 'price_asc')
        ->assertSeeInOrder([$cheap->name, $expensive->name]);
});
