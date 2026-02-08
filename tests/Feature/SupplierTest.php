<?php

use App\Filament\Resources\Suppliers\Pages\CreateSupplier;
use App\Filament\Resources\Suppliers\Pages\EditSupplier;
use App\Filament\Resources\Suppliers\Pages\ListSuppliers;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

beforeEach(function () {
    actingAs(User::factory()->create());
});

it('has supplier hasMany products relationship', function () {
    $supplier = Supplier::factory()->create();
    Product::factory()
        ->count(3)
        ->for(Category::factory())
        ->for($supplier)
        ->create();

    $supplier->refresh();

    expect($supplier->products)->toHaveCount(3);
});

it('has product belongsTo supplier relationship', function () {
    $supplier = Supplier::factory()->create();
    $product = Product::factory()
        ->for(Category::factory())
        ->for($supplier)
        ->create();

    expect($product->supplier->id)->toBe($supplier->id);
});

it('allows product without supplier', function () {
    $product = Product::factory()
        ->for(Category::factory())
        ->create(['supplier_id' => null]);

    expect($product->supplier)->toBeNull();
});

it('scopes active suppliers', function () {
    Supplier::factory()->count(3)->create();
    Supplier::factory()->inactive()->count(2)->create();

    expect(Supplier::query()->active()->count())->toBe(3);
});

it('can render supplier list page', function () {
    Supplier::factory()->count(3)->create();

    Livewire::test(ListSuppliers::class)
        ->assertOk();
});

it('can render supplier create page', function () {
    Livewire::test(CreateSupplier::class)
        ->assertOk();
});

it('can render supplier edit page', function () {
    $supplier = Supplier::factory()->create();

    Livewire::test(EditSupplier::class, [
        'record' => $supplier->id,
    ])
        ->assertOk();
});

it('validates supplier name is required on create', function () {
    Livewire::test(CreateSupplier::class)
        ->fillForm([
            'name' => null,
        ])
        ->call('create')
        ->assertHasFormErrors(['name' => 'required']);
});

it('does not expose suppliers on public routes', function () {
    Supplier::factory()->count(3)->create();

    $this->get('/')->assertDontSee('Supplier');
    $this->get('/produk')->assertDontSee('Supplier');
});
