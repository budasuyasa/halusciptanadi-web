<div>
    <div class="mx-auto max-w-3xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="text-center">
            <svg class="mx-auto h-16 w-16 text-green-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <h1 class="mt-4 font-display text-3xl font-bold text-gray-900">Pesanan Berhasil Dibuat</h1>
            <p class="mt-2 text-gray-500">No. Pesanan: <span class="font-mono font-semibold text-gray-900">{{ $order->order_number }}</span></p>
        </div>

        <div class="mt-8 rounded-xl border border-gray-100 bg-white p-6">
            {{-- Status --}}
            <div class="flex flex-wrap gap-4">
                <div class="rounded-lg bg-gold-50 px-4 py-2">
                    <p class="text-xs text-gray-500">Status Pesanan</p>
                    <p class="text-sm font-semibold" style="color: {{ $order->status->getColor() === 'warning' ? '#c49a3e' : ($order->status->getColor() === 'success' ? '#16a34a' : '#6b7280') }}">
                        {{ $order->status->getLabel() }}
                    </p>
                </div>
                <div class="rounded-lg bg-gold-50 px-4 py-2">
                    <p class="text-xs text-gray-500">Status Pembayaran</p>
                    <p class="text-sm font-semibold" style="color: {{ $order->payment_status->getColor() === 'success' ? '#16a34a' : ($order->payment_status->getColor() === 'danger' ? '#dc2626' : '#c49a3e') }}">
                        {{ $order->payment_status->getLabel() }}
                    </p>
                </div>
            </div>

            {{-- Customer Info --}}
            <div class="mt-6 grid grid-cols-1 gap-4 border-t border-gray-100 pt-6 sm:grid-cols-2">
                <div>
                    <h3 class="text-sm font-semibold text-gray-900">Data Pemesan</h3>
                    <div class="mt-2 space-y-1 text-sm text-gray-600">
                        <p>{{ $order->customer_name }}</p>
                        <p>{{ $order->customer_email }}</p>
                        <p>{{ $order->customer_phone }}</p>
                    </div>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-900">Alamat Pengiriman</h3>
                    <div class="mt-2 space-y-1 text-sm text-gray-600">
                        <p>{{ $order->shipping_address }}</p>
                        <p>{{ $order->shipping_city }}, {{ $order->shipping_province }} {{ $order->shipping_postal_code }}</p>
                    </div>
                </div>
            </div>

            {{-- Items --}}
            <div class="mt-6 border-t border-gray-100 pt-6">
                <h3 class="text-sm font-semibold text-gray-900">Item Pesanan</h3>
                <div class="mt-3 divide-y divide-gray-50">
                    @foreach ($order->items as $item)
                        <div class="flex justify-between py-2 text-sm">
                            <div>
                                <p class="font-medium text-gray-900">{{ $item->product_name }}</p>
                                <p class="text-gray-500">{{ $item->quantity }} x Rp {{ number_format($item->product_price, 0, ',', '.') }}</p>
                            </div>
                            <p class="font-medium">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4 space-y-1 border-t border-gray-100 pt-4 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Subtotal</span>
                        <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Ongkir</span>
                        <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-lg font-bold">
                        <span>Total</span>
                        <span class="text-gold-700">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('home') }}" wire:navigate class="text-sm font-medium text-gold-600 hover:text-gold-700">&larr; Kembali ke Beranda</a>
        </div>
    </div>
</div>
