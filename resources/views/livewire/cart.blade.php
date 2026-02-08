<div>
    <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        <h1 class="font-display text-3xl font-bold text-gray-900">Keranjang Belanja</h1>

        @if (empty($cart))
            <div class="mt-12 text-center">
                <svg class="mx-auto h-16 w-16 text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" /></svg>
                <p class="mt-4 text-gray-500">Keranjang belanja kosong</p>
                <a href="{{ route('products.index') }}" wire:navigate class="mt-6 inline-block rounded-lg bg-gold-600 px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-gold-700">
                    Mulai Belanja
                </a>
            </div>
        @else
            <div class="mt-6 divide-y divide-gray-100 rounded-xl border border-gray-100 bg-white">
                @foreach ($cart as $productId => $item)
                    <div wire:key="cart-{{ $productId }}" class="flex items-center gap-4 p-4">
                        <div class="h-16 w-16 shrink-0 overflow-hidden rounded-lg bg-gray-100">
                            @if ($item['image'])
                                <img src="{{ storage_url($item['image']) }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover">
                            @endif
                        </div>
                        <div class="flex-1">
                            <h3 class="text-sm font-medium text-gray-900">{{ $item['name'] }}</h3>
                            <p class="mt-1 text-sm text-gold-700">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <button wire:click="updateQuantity({{ $productId }}, {{ $item['quantity'] - 1 }})" class="rounded border border-gray-200 px-2 py-1 text-sm hover:bg-gray-50">-</button>
                            <span class="w-8 text-center text-sm">{{ $item['quantity'] }}</span>
                            <button wire:click="updateQuantity({{ $productId }}, {{ $item['quantity'] + 1 }})" class="rounded border border-gray-200 px-2 py-1 text-sm hover:bg-gray-50">+</button>
                        </div>
                        <p class="w-28 text-right text-sm font-medium">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                        <button wire:click="removeItem({{ $productId }})" class="text-gray-400 transition hover:text-red-500">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 flex items-center justify-between">
                <button wire:click="clearCart" class="text-sm text-gray-500 underline hover:text-red-500">Kosongkan keranjang</button>
                <div class="text-right">
                    <p class="text-sm text-gray-500">Total</p>
                    <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($total, 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <a href="{{ route('checkout') }}" wire:navigate class="rounded-lg bg-gold-600 px-8 py-3 text-sm font-semibold text-white transition hover:bg-gold-700">
                    Lanjut ke Checkout
                </a>
            </div>
        @endif
    </div>
</div>
