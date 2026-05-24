{{-- Section Populer Akomodasi --}}
<section class="populer-akomodasi-section relative py-20 bg-[#F5EDD8]">

    {{-- Batik Ornament: Bottom Left --}}
    <div class="absolute bottom-0 left-0 pointer-events-none select-none z-0" aria-hidden="true">
        <img src="{{ asset('images/assets_lain/batik.png') }}"
             alt=""
             class="w-48 md:w-64 opacity-40 -translate-x-6 translate-y-6 rotate-[-15deg]"
             draggable="false">
    </div>

    <div class="relative z-10 max-w-6xl mx-auto px-6">

        {{-- Header --}}
        <div class="text-center mb-14" data-populer-animate>
            <h2 class="font-sans text-4xl md:text-5xl font-bold text-[#2C1810] tracking-tight mb-3">
                Akomodasi Terpopuler
            </h2>
            <div class="flex items-center justify-center gap-3">
                <span class="divider-line block h-px w-16 bg-[#B5793A]"></span>
                <span class="text-[#B5793A] text-lg">✦</span>
                <span class="divider-line block h-px w-16 bg-[#B5793A]"></span>
            </div>
            <p class="mt-4 text-[#5D4037] max-w-2xl mx-auto text-lg">
                Pilihan favorit pengunjung untuk pengalaman menginap yang tak terlupakan
            </p>
        </div>

        {{-- Cards Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($populerAccommodations as $index => $item)
                <div class="populer-card group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 border border-[#C9A96E]/20"
                     style="animation-delay: {{ $index * 150 }}ms"
                     data-populer-item>
                    
                    {{-- Image Container --}}
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset(is_array($item->gambar) && count($item->gambar) > 0 ? $item->gambar[0] : $item->gambar) }}" 
                             alt="{{ $item->judul }}" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-md px-3 py-1 rounded-full flex items-center gap-1 shadow-sm">
                            <span class="text-yellow-500 text-sm">★</span>
                            <span class="text-[#2C1810] text-sm font-bold">4.9</span>
                        </div>
                        <div class="absolute bottom-4 left-4">
                            <span class="bg-[#B5793A] text-white text-xs font-bold px-3 py-1 rounded-lg uppercase tracking-wider">
                                {{ $item->jenis }}
                            </span>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-[#2C1810] mb-2 group-hover:text-[#B5793A] transition-colors">
                            {{ $item->judul }}
                        </h3>
                        <div class="flex items-center gap-2 mb-4 text-[#5D4037]">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                            <span class="text-sm">Landeuh Village, Riverside</span>
                        </div>
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div>
                                <span class="text-xs text-gray-500 block">Mulai dari</span>
                                <span class="text-[#B5793A] font-bold text-lg">Rp {{ number_format($item->harga_weekday, 0, ',', '.') }}</span>
                                <span class="text-xs text-gray-500">/malam</span>
                            </div>
                            <a href="{{ route('akomodasi.index') }}" 
                               class="bg-[#2C1810] hover:bg-[#B5793A] text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-colors duration-300">
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- View All Button --}}
        <div class="mt-16 text-center" data-populer-animate>
            <a href="{{ route('akomodasi.index') }}" 
               class="inline-flex items-center gap-2 text-[#2C1810] font-bold hover:text-[#B5793A] transition-colors group">
                Lihat Semua Akomodasi
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 transition-transform group-hover:translate-x-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                </svg>
            </a>
        </div>
    </div>
</section>

{{-- Styles --}}
@once
    @push('styles')
    <style>
        .populer-akomodasi-section {
            font-family: 'Georgia', 'Times New Roman', serif;
        }

        [data-populer-item] {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        [data-populer-item].is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        [data-populer-animate] {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        [data-populer-animate].is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        .divider-line {
            transform: scaleX(0);
            transition: transform 0.8s ease 0.4s;
        }

        [data-populer-animate].is-visible .divider-line {
            transform: scaleX(1);
        }
    </style>
    @endpush
@endonce

{{-- Scripts --}}
@once
    @push('scripts')
    <script>
        (function () {
            const observer = new IntersectionObserver(
                (entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-visible');
                            observer.unobserve(entry.target);
                        }
                    });
                },
                { threshold: 0.1 }
            );

            document.querySelectorAll('[data-populer-item], [data-populer-animate]')
                    .forEach((el) => observer.observe(el));
        })();
    </script>
    @endpush
@endonce
