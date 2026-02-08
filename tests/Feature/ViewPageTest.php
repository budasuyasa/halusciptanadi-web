<?php

use App\Filament\Resources\Careers\Pages\ViewCareer as ViewCareerPage;
use App\Filament\Resources\Categories\Pages\ViewCategory as ViewCategoryPage;
use App\Filament\Resources\News\Pages\ViewNews as ViewNewsPage;
use App\Filament\Resources\Orders\Pages\ViewOrder as ViewOrderPage;
use App\Filament\Resources\Partners\Pages\ViewPartner as ViewPartnerPage;
use App\Filament\Resources\Products\Pages\ViewProduct as ViewProductPage;
use App\Filament\Resources\Suppliers\Pages\ViewSupplier as ViewSupplierPage;
use App\Models\Career;
use App\Models\Category;
use App\Models\News;
use App\Models\Order;
use App\Models\Partner;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

beforeEach(function () {
    actingAs(User::factory()->create());
});

it('can render category view page', function () {
    $category = Category::factory()->create();

    Livewire::test(ViewCategoryPage::class, [
        'record' => $category->id,
    ])
        ->assertOk();
});

it('can render product view page', function () {
    $product = Product::factory()
        ->for(Category::factory())
        ->create();

    Livewire::test(ViewProductPage::class, [
        'record' => $product->id,
    ])
        ->assertOk();
});

it('can render order view page', function () {
    $order = Order::factory()->create();

    Livewire::test(ViewOrderPage::class, [
        'record' => $order->id,
    ])
        ->assertOk();
});

it('can render news view page', function () {
    $news = News::factory()->create();

    Livewire::test(ViewNewsPage::class, [
        'record' => $news->id,
    ])
        ->assertOk();
});

it('can render partner view page', function () {
    $partner = Partner::factory()->create();

    Livewire::test(ViewPartnerPage::class, [
        'record' => $partner->id,
    ])
        ->assertOk();
});

it('can render career view page', function () {
    $career = Career::factory()->create();

    Livewire::test(ViewCareerPage::class, [
        'record' => $career->id,
    ])
        ->assertOk();
});

it('can render supplier view page', function () {
    $supplier = Supplier::factory()->create();

    Livewire::test(ViewSupplierPage::class, [
        'record' => $supplier->id,
    ])
        ->assertOk();
});
