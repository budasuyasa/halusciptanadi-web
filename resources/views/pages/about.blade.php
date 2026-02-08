<x-layouts.app>
    <x-slot:title>Tentang Kami - Halus Ciptanadi</x-slot:title>

    <div class="mx-auto max-w-4xl px-4 py-12 sm:px-6 lg:px-8">
        <h1 class="font-display text-3xl font-bold text-gray-900">Tentang Kami</h1>

        <div class="prose prose-lg mt-8 max-w-none text-gray-600">
            <p>
                <strong>PT Halus Ciptanadi</strong> adalah perusahaan distribusi yang berbasis di Bali, menyediakan produk-produk kebutuhan rumah tangga berkualitas tinggi termasuk minyak goreng, bumbu masak, mie, minuman, dan berbagai produk rumah tangga lainnya.
            </p>
            <p>
                Dengan motto <em>"Kepuasan anda adalah kebahagiaan kami"</em>, kami berkomitmen untuk memberikan layanan distribusi terbaik dengan menjangkau seluruh wilayah Bali melalui jaringan cabang kami.
            </p>
        </div>

        {{-- Locations --}}
        <section class="mt-12">
            <h2 class="font-display text-2xl font-bold text-gray-900">Lokasi Kami</h2>
            <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-3">
                <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-gold-50 text-gold-600">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                    </div>
                    <h3 class="mt-4 font-semibold text-gray-900">Kantor Pusat - Denpasar</h3>
                    <p class="mt-2 text-sm text-gray-600">Jl. Cargo Permai Gg. Nusa Indah II No. 4, Ubung, Denpasar Utara, Bali</p>
                </div>
                <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-gold-50 text-gold-600">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                    </div>
                    <h3 class="mt-4 font-semibold text-gray-900">Cabang Singaraja</h3>
                    <p class="mt-2 text-sm text-gray-600">Jl. A. Yani, Singaraja, Buleleng, Bali</p>
                </div>
                <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-gold-50 text-gold-600">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                    </div>
                    <h3 class="mt-4 font-semibold text-gray-900">Cabang Negara</h3>
                    <p class="mt-2 text-sm text-gray-600">Jl. Ngurah Rai, Negara, Jembrana, Bali</p>
                </div>
            </div>
        </section>
    </div>
</x-layouts.app>
