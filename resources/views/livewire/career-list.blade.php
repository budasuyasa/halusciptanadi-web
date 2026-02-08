<div>
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <h1 class="font-display text-3xl font-bold text-gray-900">Karir</h1>
        <p class="mt-2 text-gray-600">Bergabunglah bersama kami dan bangun karir Anda di PT Halus Ciptanadi.</p>

        {{-- Filter --}}
        <div class="mt-6">
            <select wire:model.live="location" class="rounded-lg border border-gray-200 px-4 py-2 text-sm focus:border-gold-400 focus:ring-gold-400">
                <option value="">Semua Lokasi</option>
                <option value="Denpasar">Denpasar</option>
                <option value="Singaraja">Singaraja</option>
                <option value="Negara">Negara</option>
            </select>
        </div>

        <div class="mt-6 space-y-4">
            @forelse ($careers as $career)
                <a href="{{ route('careers.show', $career) }}" wire:navigate wire:key="career-{{ $career->id }}" class="group block rounded-xl border border-gray-100 bg-white p-6 shadow-sm transition hover:border-gold-200 hover:shadow-md">
                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 group-hover:text-gold-700">{{ $career->title }}</h2>
                            <div class="mt-1 flex flex-wrap items-center gap-2 text-sm text-gray-500">
                                <span class="inline-flex items-center rounded-full bg-gold-50 px-2.5 py-0.5 text-xs font-medium text-gold-700">{{ $career->employment_type->getLabel() }}</span>
                                <span>{{ $career->location }}</span>
                                @if ($career->department)
                                    <span>&middot; {{ $career->department }}</span>
                                @endif
                            </div>
                        </div>
                        @if ($career->application_deadline)
                            <p class="text-sm text-gray-500">Batas: {{ $career->application_deadline->translatedFormat('d F Y') }}</p>
                        @endif
                    </div>
                    @if ($career->salary_range)
                        <p class="mt-2 text-sm font-medium text-gold-600">{{ $career->salary_range }}</p>
                    @endif
                </a>
            @empty
                <div class="py-12 text-center text-gray-500">
                    <p>Belum ada lowongan tersedia saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
