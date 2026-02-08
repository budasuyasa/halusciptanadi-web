<?php

use App\Models\Career;
use App\Models\Category;
use App\Models\News;
use App\Models\Product;

it('renders the home page', function () {
    $this->get('/')
        ->assertSuccessful();
});

it('renders the product list page', function () {
    $this->get('/produk')
        ->assertSuccessful();
});

it('renders the product detail page', function () {
    $product = Product::factory()
        ->for(Category::factory())
        ->create();

    $this->get('/produk/' . $product->slug)
        ->assertSuccessful();
});

it('renders the cart page', function () {
    $this->get('/keranjang')
        ->assertSuccessful();
});

it('renders the news list page', function () {
    $this->get('/berita')
        ->assertSuccessful();
});

it('renders the news detail page for published articles', function () {
    $news = News::factory()->published()->create();

    $this->get('/berita/' . $news->slug)
        ->assertSuccessful();
});

it('returns 404 for unpublished news articles', function () {
    $news = News::factory()->create(['is_published' => false]);

    $this->get('/berita/' . $news->slug)
        ->assertNotFound();
});

it('renders the career list page', function () {
    $this->get('/karir')
        ->assertSuccessful();
});

it('renders the career detail page for active careers', function () {
    $career = Career::factory()->create(['is_active' => true]);

    $this->get('/karir/' . $career->slug)
        ->assertSuccessful();
});

it('returns 404 for inactive careers', function () {
    $career = Career::factory()->inactive()->create();

    $this->get('/karir/' . $career->slug)
        ->assertNotFound();
});

it('renders the about page', function () {
    $this->get('/tentang-kami')
        ->assertSuccessful()
        ->assertSee('Tentang Kami');
});

it('renders the contact page', function () {
    $this->get('/kontak')
        ->assertSuccessful()
        ->assertSee('Hubungi Kami');
});
