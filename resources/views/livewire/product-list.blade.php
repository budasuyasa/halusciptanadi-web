<div>
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <h1 class="font-display text-3xl font-bold text-gray-900">Produk Kami</h1>

        {{-- Filters --}}
        <div class="mt-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex flex-wrap items-center gap-3">
                <input wire:model.live.debounce.300ms="search" type="search" placeholder="Cari produk..." class="rounded-lg border border-gray-200 px-4 py-2 text-sm focus:border-gold-400 focus:ring-gold-400">
                <select wire:model.live="category" class="rounded-lg border border-gray-200 px-4 py-2 text-sm focus:border-gold-400 focus:ring-gold-400">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->slug }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <select wire:model.live="sort" class="rounded-lg border border-gray-200 px-4 py-2 text-sm focus:border-gold-400 focus:ring-gold-400">
                <option value="newest">Terbaru</option>
                <option value="price_asc">Harga Terendah</option>
                <option value="price_desc">Harga Tertinggi</option>
                <option value="name">Nama A-Z</option>
            </select>
        </div>

        {{-- Product Grid --}}
        <div class="mt-8 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4" wire:loading.class="opacity-50">
            @forelse ($products as $product)
                <div wire:key="product-{{ $product->id }}" class="group rounded-xl border border-gray-100 bg-white shadow-sm transition hover:shadow-md">
                    <a href="{{ route('products.show', $product) }}" wire:navigate>
                        <div class="aspect-square overflow-hidden rounded-t-xl bg-gray-100">
                            @if ($product->primaryImage)
                                <img src="{{ storage_url($product->primaryImage->image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover transition group-hover:scale-105">
                            @else
                                <div class="flex h-full items-center justify-center text-gray-300">
                                    <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z" /></svg>
                                </div>
                            @endif
                        </div>
                    </a>
                    <div class="p-3">
                        <p class="text-xs text-gray-500">{{ $product->category?->name }}</p>
                        <a href="{{ route('products.show', $product) }}" wire:navigate>
                            <h3 class="mt-1 text-sm font-medium text-gray-900 group-hover:text-gold-700">{{ $product->name }}</h3>
                        </a>
                        <div class="mt-2 flex items-center gap-2">
                            @if ($product->sale_price)
                                <span class="text-sm font-bold text-gold-700">Rp {{ number_format($product->sale_price, 0, ',', '.') }}</span>
                                <span class="text-xs text-gray-400 line-through">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            @else
                                <span class="text-sm font-bold text-gold-700">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            @endif
                        </div>
                        <button wire:click="addToCart({{ $product->id }})" class="mt-3 w-full rounded-lg bg-gold-500 px-3 py-1.5 text-xs font-medium text-white transition hover:bg-gold-600">
                            Tambah ke Keranjang
                        </button>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center text-gray-500">
                    <p>Tidak ada produk ditemukan.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $products->links() }}
        </div>
    </div>
</div>
