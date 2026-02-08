<div>
    <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        <h1 class="font-display text-3xl font-bold text-gray-900">Checkout</h1>

        <div class="mt-8 grid grid-cols-1 gap-8 lg:grid-cols-5">
            {{-- Form --}}
            <form wire:submit="placeOrder" class="lg:col-span-3">
                <div class="space-y-6 rounded-xl border border-gray-100 bg-white p-6">
                    <h2 class="font-display text-lg font-bold text-gray-900">Data Pemesan</h2>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <label for="customer_name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input wire:model="customer_name" id="customer_name" type="text" class="mt-1 block w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:border-gold-400 focus:ring-gold-400">
                            @error('customer_name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="customer_email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input wire:model="customer_email" id="customer_email" type="email" class="mt-1 block w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:border-gold-400 focus:ring-gold-400">
                            @error('customer_email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="customer_phone" class="block text-sm font-medium text-gray-700">No. Telepon</label>
                            <input wire:model="customer_phone" id="customer_phone" type="tel" class="mt-1 block w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:border-gold-400 focus:ring-gold-400">
                            @error('customer_phone') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <h2 class="mt-6 font-display text-lg font-bold text-gray-900">Alamat Pengiriman</h2>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <label for="shipping_address" class="block text-sm font-medium text-gray-700">Alamat</label>
                            <textarea wire:model="shipping_address" id="shipping_address" rows="3" class="mt-1 block w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:border-gold-400 focus:ring-gold-400"></textarea>
                            @error('shipping_address') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="shipping_city" class="block text-sm font-medium text-gray-700">Kota</label>
                            <input wire:model="shipping_city" id="shipping_city" type="text" class="mt-1 block w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:border-gold-400 focus:ring-gold-400">
                            @error('shipping_city') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="shipping_province" class="block text-sm font-medium text-gray-700">Provinsi</label>
                            <input wire:model="shipping_province" id="shipping_province" type="text" class="mt-1 block w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:border-gold-400 focus:ring-gold-400">
                            @error('shipping_province') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="shipping_postal_code" class="block text-sm font-medium text-gray-700">Kode Pos</label>
                            <input wire:model="shipping_postal_code" id="shipping_postal_code" type="text" class="mt-1 block w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:border-gold-400 focus:ring-gold-400">
                            @error('shipping_postal_code') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label for="notes" class="block text-sm font-medium text-gray-700">Catatan (opsional)</label>
                            <textarea wire:model="notes" id="notes" rows="2" class="mt-1 block w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:border-gold-400 focus:ring-gold-400"></textarea>
                        </div>
                    </div>

                    <button type="submit" class="mt-4 w-full rounded-lg bg-gold-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-gold-700" wire:loading.attr="disabled">
                        <span wire:loading.remove>Buat Pesanan</span>
                        <span wire:loading>Memproses...</span>
                    </button>
                </div>
            </form>

            {{-- Order Summary --}}
            <div class="lg:col-span-2">
                <div class="sticky top-20 rounded-xl border border-gray-100 bg-white p-6">
                    <h2 class="font-display text-lg font-bold text-gray-900">Ringkasan Pesanan</h2>
                    <div class="mt-4 divide-y divide-gray-50">
                        @foreach ($cart as $productId => $item)
                            <div class="flex justify-between py-2 text-sm">
                                <span class="text-gray-600">{{ $item['name'] }} x{{ $item['quantity'] }}</span>
                                <span class="font-medium">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4 border-t border-gray-100 pt-4">
                        <div class="flex justify-between text-lg font-bold">
                            <span>Total</span>
                            <span class="text-gold-700">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
