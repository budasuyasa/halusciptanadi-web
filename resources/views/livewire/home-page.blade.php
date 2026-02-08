<div>
    {{-- Hero --}}
    <section class="bg-gradient-to-br from-gold-50 to-gold-100 py-16 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
            <h1 class="font-display text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">
                Halus Ciptanadi
            </h1>
            <p class="mx-auto mt-4 max-w-2xl text-lg text-gray-600">
                Kepuasan anda adalah kebahagiaan kami
            </p>
            <p class="mx-auto mt-2 max-w-xl text-sm text-gray-500">
                Distributor minyak goreng, bumbu masak, dan produk rumah tangga terpercaya di Bali
            </p>
            <a href="{{ route('products.index') }}" wire:navigate class="mt-8 inline-block rounded-lg bg-gold-600 px-8 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-gold-700">
                Lihat Produk
            </a>
        </div>
    </section>

    {{-- Categories --}}
    @if ($categories->isNotEmpty())
        <section class="py-12 sm:py-16">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <h2 class="font-display text-2xl font-bold text-gray-900">Kategori Produk</h2>
                <div class="mt-6 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-5">
                    @foreach ($categories as $cat)
                        <a href="{{ route('products.index', ['category' => $cat->slug]) }}" wire:navigate wire:key="cat-{{ $cat->id }}" class="group rounded-xl border border-gray-100 bg-white p-4 text-center shadow-sm transition hover:border-gold-200 hover:shadow-md">
                            @if ($cat->image)
                                <img src="{{ storage_url($cat->image) }}" alt="{{ $cat->name }}" class="mx-auto h-16 w-16 rounded-lg object-cover">
                            @else
                                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-lg bg-gold-50 text-gold-600">
                                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" /><path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" /></svg>
                                </div>
                            @endif
                            <p class="mt-2 text-sm font-medium text-gray-700 group-hover:text-gold-700">{{ $cat->name }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Featured Products --}}
    @if ($featuredProducts->isNotEmpty())
        <section class="bg-gray-50 py-12 sm:py-16">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between">
                    <h2 class="font-display text-2xl font-bold text-gray-900">Produk Unggulan</h2>
                    <a href="{{ route('products.index') }}" wire:navigate class="text-sm font-medium text-gold-600 hover:text-gold-700">Lihat semua &rarr;</a>
                </div>
                <div class="mt-6 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
                    @foreach ($featuredProducts as $product)
                        <a href="{{ route('products.show', $product) }}" wire:navigate wire:key="prod-{{ $product->id }}" class="group rounded-xl border border-gray-100 bg-white shadow-sm transition hover:shadow-md">
                            <div class="aspect-square overflow-hidden rounded-t-xl bg-gray-100">
                                @if ($product->primaryImage)
                                    <img src="{{ storage_url($product->primaryImage->image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover transition group-hover:scale-105">
                                @else
                                    <div class="flex h-full items-center justify-center text-gray-300">
                                        <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z" /></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="p-3">
                                <p class="text-xs text-gray-500">{{ $product->category?->name }}</p>
                                <h3 class="mt-1 text-sm font-medium text-gray-900 group-hover:text-gold-700">{{ $product->name }}</h3>
                                <div class="mt-2 flex items-center gap-2">
                                    @if ($product->sale_price)
                                        <span class="text-sm font-bold text-gold-700">Rp {{ number_format($product->sale_price, 0, ',', '.') }}</span>
                                        <span class="text-xs text-gray-400 line-through">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    @else
                                        <span class="text-sm font-bold text-gold-700">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Partners --}}
    @if ($partners->isNotEmpty())
        <section class="py-12 sm:py-16">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <h2 class="text-center font-display text-2xl font-bold text-gray-900">Partner Kami</h2>
                <div class="mt-8 flex flex-wrap items-center justify-center gap-8">
                    @foreach ($partners as $partner)
                        <div wire:key="partner-{{ $partner->id }}" class="flex h-16 items-center">
                            @if ($partner->logo)
                                <img src="{{ storage_url($partner->logo) }}" alt="{{ $partner->name }}" class="h-12 object-contain grayscale transition hover:grayscale-0">
                            @else
                                <span class="text-sm font-medium text-gray-400">{{ $partner->name }}</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Latest News --}}
    @if ($latestNews->isNotEmpty())
        <section class="bg-gray-50 py-12 sm:py-16">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between">
                    <h2 class="font-display text-2xl font-bold text-gray-900">Berita Terbaru</h2>
                    <a href="{{ route('news.index') }}" wire:navigate class="text-sm font-medium text-gold-600 hover:text-gold-700">Semua berita &rarr;</a>
                </div>
                <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($latestNews as $article)
                        <a href="{{ route('news.show', $article) }}" wire:navigate wire:key="news-{{ $article->id }}" class="group overflow-hidden rounded-xl border border-gray-100 bg-white shadow-sm transition hover:shadow-md">
                            @if ($article->featured_image)
                                <div class="aspect-video overflow-hidden bg-gray-100">
                                    <img src="{{ storage_url($article->featured_image) }}" alt="{{ $article->title }}" class="h-full w-full object-cover transition group-hover:scale-105">
                                </div>
                            @endif
                            <div class="p-4">
                                <p class="text-xs text-gray-500">{{ $article->published_at?->translatedFormat('d F Y') }}</p>
                                <h3 class="mt-1 font-medium text-gray-900 group-hover:text-gold-700">{{ $article->title }}</h3>
                                @if ($article->excerpt)
                                    <p class="mt-2 line-clamp-2 text-sm text-gray-500">{{ $article->excerpt }}</p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</div>
