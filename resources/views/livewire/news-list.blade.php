<div>
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <h1 class="font-display text-3xl font-bold text-gray-900">Berita</h1>

        <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($articles as $article)
                <a href="{{ route('news.show', $article) }}" wire:navigate wire:key="article-{{ $article->id }}" class="group overflow-hidden rounded-xl border border-gray-100 bg-white shadow-sm transition hover:shadow-md">
                    @if ($article->featured_image)
                        <div class="aspect-video overflow-hidden bg-gray-100">
                            <img src="{{ storage_url($article->featured_image) }}" alt="{{ $article->title }}" class="h-full w-full object-cover transition group-hover:scale-105">
                        </div>
                    @endif
                    <div class="p-4">
                        <p class="text-xs text-gray-500">{{ $article->published_at?->translatedFormat('d F Y') }}</p>
                        <h2 class="mt-1 font-medium text-gray-900 group-hover:text-gold-700">{{ $article->title }}</h2>
                        @if ($article->excerpt)
                            <p class="mt-2 line-clamp-2 text-sm text-gray-500">{{ $article->excerpt }}</p>
                        @endif
                    </div>
                </a>
            @empty
                <div class="col-span-full py-12 text-center text-gray-500">
                    <p>Belum ada berita.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $articles->links() }}
        </div>
    </div>
</div>
