<?php

use App\Livewire\CareerDetail;
use App\Livewire\CareerList;
use App\Livewire\Cart;
use App\Livewire\Checkout;
use App\Livewire\HomePage;
use App\Livewire\NewsDetail;
use App\Livewire\NewsList;
use App\Livewire\OrderStatus;
use App\Livewire\ProductDetail;
use App\Livewire\ProductList;
use Illuminate\Support\Facades\Route;

Route::livewire('/', HomePage::class)->name('home');
Route::livewire('/produk', ProductList::class)->name('products.index');
Route::livewire('/produk/{product:slug}', ProductDetail::class)->name('products.show');
Route::livewire('/keranjang', Cart::class)->name('cart');
Route::livewire('/checkout', Checkout::class)->name('checkout');
Route::livewire('/pesanan/{order:order_number}', OrderStatus::class)->name('orders.show');
Route::livewire('/berita', NewsList::class)->name('news.index');
Route::livewire('/berita/{news:slug}', NewsDetail::class)->name('news.show');
Route::livewire('/karir', CareerList::class)->name('careers.index');
Route::livewire('/karir/{career:slug}', CareerDetail::class)->name('careers.show');

Route::view('/tentang-kami', 'pages.about')->name('about');
Route::view('/kontak', 'pages.contact')->name('contact');
