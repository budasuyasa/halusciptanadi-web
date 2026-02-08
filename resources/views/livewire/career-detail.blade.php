<div>
    <div class="mx-auto max-w-3xl px-4 py-8 sm:px-6 lg:px-8">
        <nav class="mb-6 text-sm text-gray-500">
            <a href="{{ route('home') }}" wire:navigate class="hover:text-gold-600">Beranda</a>
            <span class="mx-1">/</span>
            <a href="{{ route('careers.index') }}" wire:navigate class="hover:text-gold-600">Karir</a>
            <span class="mx-1">/</span>
            <span class="text-gray-700">{{ $career->title }}</span>
        </nav>

        <h1 class="font-display text-3xl font-bold text-gray-900">{{ $career->title }}</h1>

        <div class="mt-3 flex flex-wrap items-center gap-3 text-sm text-gray-500">
            <span class="inline-flex items-center rounded-full bg-gold-50 px-3 py-1 text-xs font-medium text-gold-700">{{ $career->employment_type->getLabel() }}</span>
            <span>{{ $career->location }}</span>
            @if ($career->department)
                <span>&middot; {{ $career->department }}</span>
            @endif
            @if ($career->salary_range)
                <span>&middot; {{ $career->salary_range }}</span>
            @endif
        </div>

        @if ($career->application_deadline)
            <p class="mt-4 rounded-lg bg-gold-50 px-4 py-2 text-sm text-gold-800">
                Batas lamaran: <strong>{{ $career->application_deadline->translatedFormat('d F Y') }}</strong>
            </p>
        @endif

        <div class="mt-8 space-y-8">
            @if ($career->description)
                <div>
                    <h2 class="font-display text-xl font-bold text-gray-900">Deskripsi</h2>
                    <div class="prose prose-sm mt-3 max-w-none text-gray-600">{!! $career->description !!}</div>
                </div>
            @endif

            @if ($career->requirements)
                <div>
                    <h2 class="font-display text-xl font-bold text-gray-900">Persyaratan</h2>
                    <div class="prose prose-sm mt-3 max-w-none text-gray-600">{!! $career->requirements !!}</div>
                </div>
            @endif

            @if ($career->benefits)
                <div>
                    <h2 class="font-display text-xl font-bold text-gray-900">Benefit</h2>
                    <div class="prose prose-sm mt-3 max-w-none text-gray-600">{!! $career->benefits !!}</div>
                </div>
            @endif
        </div>

        <div class="mt-10 rounded-xl border border-gold-200 bg-gold-50 p-6 text-center">
            <h3 class="text-lg font-semibold text-gray-900">Tertarik dengan posisi ini?</h3>
            <p class="mt-2 text-sm text-gray-600">Kirim lamaran Anda melalui email atau hubungi kami via WhatsApp.</p>
            <a href="{{ route('contact') }}" wire:navigate class="mt-4 inline-block rounded-lg bg-gold-600 px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-gold-700">Hubungi Kami</a>
        </div>
    </div>
</div>
