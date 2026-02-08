<div>
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        {{-- Breadcrumb --}}
        <nav class="mb-6 text-sm text-gray-500">
            <a href="{{ route('home') }}" wire:navigate class="hover:text-gold-600">Beranda</a>
            <span class="mx-1">/</span>
            <a href="{{ route('products.index') }}" wire:navigate class="hover:text-gold-600">Produk</a>
            <span class="mx-1">/</span>
            <span class="text-gray-700">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
            {{-- Images --}}
            <div>
                @if ($product->images->isNotEmpty())
                    <div class="aspect-square overflow-hidden rounded-xl bg-gray-100">
                        <img src="{{ storage_url($product->images->first()->image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                    </div>
                    @if ($product->images->count() > 1)
                        <div class="mt-4 grid grid-cols-4 gap-2">
                            @foreach ($product->images->skip(1) as $image)
                                <div wire:key="img-{{ $image->id }}" class="aspect-square overflow-hidden rounded-lg bg-gray-100">
                                    <img src="{{ storage_url($image->image) }}" alt="{{ $image->alt_text ?? $product->name }}" class="h-full w-full object-cover">
                                </div>
                            @endforeach
                        </div>
                    @endif
                @else
                    <div class="flex aspect-square items-center justify-center rounded-xl bg-gray-100 text-gray-300">
                        <svg class="h-24 w-24" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z" /></svg>
                    </div>
                @endif
            </div>

            {{-- Info --}}
            <div>
                <p class="text-sm text-gold-600">{{ $product->category?->name }}</p>
                <h1 class="mt-1 font-display text-3xl font-bold text-gray-900">{{ $product->name }}</h1>

                <div class="mt-4 flex items-baseline gap-3">
                    @if ($product->sale_price)
                        <span class="text-3xl font-bold text-gold-700">Rp {{ number_format($product->sale_price, 0, ',', '.') }}</span>
                        <span class="text-lg text-gray-400 line-through">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    @else
                        <span class="text-3xl font-bold text-gold-700">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    @endif
                </div>

                @if ($product->short_description)
                    <p class="mt-4 text-gray-600">{{ $product->short_description }}</p>
                @endif

                <div class="mt-6 flex items-center gap-4">
                    <div class="flex items-center rounded-lg border border-gray-200">
                        <button wire:click="decrementQuantity" class="px-3 py-2 text-gray-500 hover:text-gray-700">-</button>
                        <input wire:model="quantity" type="number" min="1" class="w-16 border-x border-gray-200 py-2 text-center text-sm [appearance:textfield] [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none">
                        <button wire:click="incrementQuantity" class="px-3 py-2 text-gray-500 hover:text-gray-700">+</button>
                    </div>
                    <button wire:click="addToCart" class="rounded-lg bg-gold-600 px-8 py-2.5 text-sm font-semibold text-white transition hover:bg-gold-700">
                        Tambah ke Keranjang
                    </button>
                </div>

                <div class="mt-6 space-y-2 text-sm text-gray-500">
                    @if ($product->sku)
                        <p><span class="font-medium text-gray-700">SKU:</span> {{ $product->sku }}</p>
                    @endif
                    @if ($product->unit)
                        <p><span class="font-medium text-gray-700">Satuan:</span> {{ $product->unit }}</p>
                    @endif
                    @if ($product->weight)
                        <p><span class="font-medium text-gray-700">Berat:</span> {{ $product->weight }} kg</p>
                    @endif
                    <p>
                        <span class="font-medium text-gray-700">Stok:</span>
                        @if ($product->stock > 0)
                            <span class="text-green-600">Tersedia ({{ $product->stock }})</span>
                        @else
                            <span class="text-red-500">Habis</span>
                        @endif
                    </p>
                </div>

                @if ($product->description)
                    <div class="mt-8 border-t border-gray-100 pt-6">
                        <h2 class="font-display text-lg font-bold text-gray-900">Deskripsi</h2>
                        <div class="prose prose-sm mt-3 max-w-none text-gray-600">{!! $product->description !!}</div>
                    </div>
                @endif
            </div>
        </div>

        {{-- Related Products --}}
        @if ($relatedProducts->isNotEmpty())
            <section class="mt-16">
                <h2 class="font-display text-2xl font-bold text-gray-900">Produk Terkait</h2>
                <div class="mt-6 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
                    @foreach ($relatedProducts as $related)
                        <a href="{{ route('products.show', $related) }}" wire:navigate wire:key="related-{{ $related->id }}" class="group rounded-xl border border-gray-100 bg-white shadow-sm transition hover:shadow-md">
                            <div class="aspect-square overflow-hidden rounded-t-xl bg-gray-100">
                                @if ($related->primaryImage)
                                    <img src="{{ storage_url($related->primaryImage->image) }}" alt="{{ $related->name }}" class="h-full w-full object-cover transition group-hover:scale-105">
                                @else
                                    <div class="flex h-full items-center justify-center text-gray-300">
                                        <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z" /></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="p-3">
                                <h3 class="text-sm font-medium text-gray-900 group-hover:text-gold-700">{{ $related->name }}</h3>
                                <span class="mt-1 text-sm font-bold text-gold-700">Rp {{ number_format($related->effective_price, 0, ',', '.') }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</div>
