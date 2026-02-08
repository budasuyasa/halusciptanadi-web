<header class="sticky top-0 z-50 bg-white shadow-sm" x-data="{ open: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            {{-- Logo --}}
            <a href="{{ route('home') }}" wire:navigate class="flex items-center gap-2">
                <span class="font-display text-xl font-bold text-gold-700">Halus Ciptanadi</span>
            </a>

            {{-- Desktop Nav --}}
            <nav class="hidden items-center gap-6 md:flex">
                <a href="{{ route('home') }}" wire:navigate class="text-sm font-medium text-gray-700 transition hover:text-gold-600 data-current:text-gold-700 data-current:font-semibold">Beranda</a>
                <a href="{{ route('products.index') }}" wire:navigate class="text-sm font-medium text-gray-700 transition hover:text-gold-600 data-current:text-gold-700 data-current:font-semibold">Produk</a>
                <a href="{{ route('news.index') }}" wire:navigate class="text-sm font-medium text-gray-700 transition hover:text-gold-600 data-current:text-gold-700 data-current:font-semibold">Berita</a>
                <a href="{{ route('careers.index') }}" wire:navigate class="text-sm font-medium text-gray-700 transition hover:text-gold-600 data-current:text-gold-700 data-current:font-semibold">Karir</a>
                <a href="{{ route('about') }}" wire:navigate class="text-sm font-medium text-gray-700 transition hover:text-gold-600 data-current:text-gold-700 data-current:font-semibold">Tentang Kami</a>
                <a href="{{ route('contact') }}" wire:navigate class="text-sm font-medium text-gray-700 transition hover:text-gold-600 data-current:text-gold-700 data-current:font-semibold">Kontak</a>
            </nav>

            {{-- Cart & Mobile Toggle --}}
            <div class="flex items-center gap-4">
                <livewire:cart-icon />

                <button @click="open = !open" class="md:hidden" aria-label="Toggle menu">
                    <svg x-show="!open" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg x-show="open" x-cloak class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Nav --}}
    <div x-show="open" x-transition x-cloak class="border-t border-gray-100 bg-white md:hidden">
        <nav class="flex flex-col gap-1 px-4 py-3">
            <a href="{{ route('home') }}" wire:navigate @click="open = false" class="rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gold-50 hover:text-gold-700">Beranda</a>
            <a href="{{ route('products.index') }}" wire:navigate @click="open = false" class="rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gold-50 hover:text-gold-700">Produk</a>
            <a href="{{ route('news.index') }}" wire:navigate @click="open = false" class="rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gold-50 hover:text-gold-700">Berita</a>
            <a href="{{ route('careers.index') }}" wire:navigate @click="open = false" class="rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gold-50 hover:text-gold-700">Karir</a>
            <a href="{{ route('about') }}" wire:navigate @click="open = false" class="rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gold-50 hover:text-gold-700">Tentang Kami</a>
            <a href="{{ route('contact') }}" wire:navigate @click="open = false" class="rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gold-50 hover:text-gold-700">Kontak</a>
        </nav>
    </div>
</header>
