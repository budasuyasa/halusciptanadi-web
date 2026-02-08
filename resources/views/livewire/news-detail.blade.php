<div>
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            {{-- Article --}}
            <article class="lg:col-span-2">
                <nav class="mb-4 text-sm text-gray-500">
                    <a href="{{ route('home') }}" wire:navigate class="hover:text-gold-600">Beranda</a>
                    <span class="mx-1">/</span>
                    <a href="{{ route('news.index') }}" wire:navigate class="hover:text-gold-600">Berita</a>
                    <span class="mx-1">/</span>
                    <span class="text-gray-700">{{ Str::limit($news->title, 40) }}</span>
                </nav>

                @if ($news->featured_image)
                    <div class="aspect-video overflow-hidden rounded-xl bg-gray-100">
                        <img src="{{ storage_url($news->featured_image) }}" alt="{{ $news->title }}" class="h-full w-full object-cover">
                    </div>
                @endif

                <div class="mt-6">
                    <h1 class="font-display text-3xl font-bold text-gray-900">{{ $news->title }}</h1>
                    <div class="mt-3 flex items-center gap-4 text-sm text-gray-500">
                        @if ($news->author)
                            <span>Oleh {{ $news->author->name }}</span>
                        @endif
                        <span>{{ $news->published_at?->translatedFormat('d F Y') }}</span>
                    </div>
                </div>

                <div class="prose prose-lg mt-8 max-w-none text-gray-700">
                    {!! $news->body !!}
                </div>
            </article>

            {{-- Sidebar --}}
            <aside>
                <div class="sticky top-20">
                    <h3 class="font-display text-lg font-bold text-gray-900">Berita Lainnya</h3>
                    <div class="mt-4 space-y-4">
                        @foreach ($recentArticles as $recent)
                            <a href="{{ route('news.show', $recent) }}" wire:navigate wire:key="recent-{{ $recent->id }}" class="group block">
                                <p class="text-xs text-gray-500">{{ $recent->published_at?->translatedFormat('d F Y') }}</p>
                                <p class="mt-1 text-sm font-medium text-gray-700 group-hover:text-gold-700">{{ $recent->title }}</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>
