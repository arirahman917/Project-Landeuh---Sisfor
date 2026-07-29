{{-- Section Jelajahi --}}
<section class="jelajahi-section relative py-20" style="background-color: #F5EDD8;">

    {{-- Batik Background Ornaments --}}
    <div class="absolute inset-0 pointer-events-none select-none z-0" aria-hidden="true">
        <img loading="lazy" src="{{ asset('images/assets_lain/batik.png') }}" alt=""
             class="absolute top-0 left-0 w-52 opacity-40 -translate-x-6 -translate-y-6 rotate-[-12deg]">
        <img loading="lazy" src="{{ asset('images/assets_lain/batik.png') }}" alt=""
             class="absolute bottom-0 left-0 w-48 opacity-40 -translate-x-4 translate-y-4 rotate-[8deg]">
        <img loading="lazy" src="{{ asset('images/assets_lain/batik.png') }}" alt=""
             class="absolute top-0 right-0 w-52 opacity-40 translate-x-6 -translate-y-6 rotate-[12deg] scale-x-[-1]">
        <img loading="lazy" src="{{ asset('images/assets_lain/batik.png') }}" alt=""
             class="absolute bottom-0 right-0 w-48 opacity-40 translate-x-4 translate-y-4 rotate-[-8deg] scale-x-[-1]">
    </div>

    <div class="relative z-10 max-w-6xl mx-auto px-8">
        <div class="flex flex-col md:flex-row items-center md:items-center gap-10 md:gap-16">

            {{-- Left: Title --}}
            <div class="jelajahi-title-wrap flex-shrink-0 text-center md:text-left" data-jelajahi-title>
                <h2 class="jelajahi-heading font-sans text-5xl md:text-6xl font-bold text-[#2C1810] leading-tight tracking-tight">
                    Jelajahi
                </h2>
                <div class="mt-4 flex items-center gap-2 justify-center md:justify-start">
                    <span class="jelajahi-line block h-0.5 w-10 bg-[#B5793A] origin-left"></span>
                    <span class="text-[#B5793A] text-base">✦</span>
                </div>
            </div>

            {{-- Right: Cards --}}
            <div class="jelajahi-cards flex gap-5 overflow-x-auto md:overflow-visible pb-2 md:pb-0 snap-x snap-mandatory md:snap-none w-full md:w-auto">

                @php
                    $items = [
                        [
                            'label' => 'Cabin',
                            'image' => asset('images/akomodasi/cabin1/a.webp'),
                            'href'  => '/akomodasi?jenis=Cabin',
                        ],
                        [
                            'label' => 'Rumah Industrial',
                            'image' => asset('images/akomodasi/industrial2/a.webp'),
                            'href'  => '/akomodasi?jenis=Rumah Industrial',
                        ],
                        [
                            'label' => 'Glamping',
                            'image' => asset('images/akomodasi/glamping_vip/c.webp'),
                            'href'  => '/akomodasi?jenis=Glamping',
                        ],
                        [
                            'label' => 'Paket Corporate',
                            'image' => asset('images/akomodasi/paket_corporate/b.webp'),
                            'href'  => '/paket-corporate',
                        ],
                    ];
                @endphp

                @foreach ($items as $index => $item)
                    <a href="{{ $item['href'] }}"
                       class="jelajahi-card group relative flex-shrink-0 snap-center
                              w-[220px] md:w-[240px] h-[200px] md:h-[220px]
                              rounded-2xl overflow-hidden cursor-pointer
                              shadow-md hover:shadow-xl
                              transition-shadow duration-400"
                       style="animation-delay: {{ $index * 120 }}ms"
                       data-jelajahi-card>

                        {{-- Image --}}
                        <img loading="lazy" src="{{ $item['image'] }}"
                             alt="{{ $item['label'] }}"
                             class="absolute inset-0 w-full h-full object-cover
                                    scale-100 group-hover:scale-105
                                    transition-transform duration-500 ease-out">

                        {{-- Gradient overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t
                                    from-black/60 via-black/10 to-transparent
                                    group-hover:from-black/70
                                    transition-all duration-400"></div>

                        {{-- Label --}}
                        <div class="absolute bottom-0 left-0 right-0 px-4 pb-4 text-center">
                            <span class="jelajahi-label block font-sans text-white text-lg font-semibold
                                         drop-shadow-md tracking-wide
                                         translate-y-0 group-hover:-translate-y-1
                                         transition-transform duration-300">
                                {{ $item['label'] }}
                            </span>
                        </div>

                        {{-- Warm tint on hover --}}
                        <div class="absolute inset-0 bg-[#B5793A]/0 group-hover:bg-[#B5793A]/10
                                    transition-colors duration-400 rounded-2xl"></div>
                    </a>
                @endforeach

            </div>
        </div>
    </div>
</section>

{{-- Styles --}}
@once
    @push('styles')
    <style>
        .jelajahi-section {
            font-family: 'Georgia', 'Times New Roman', serif;
        }

        /* Title entrance */
        [data-jelajahi-title] {
            opacity: 0;
            transform: translateX(-24px);
            transition: opacity 0.55s ease, transform 0.55s ease;
        }
        [data-jelajahi-title].is-visible {
            opacity: 1;
            transform: translateX(0);
        }

        /* Accent line grow */
        [data-jelajahi-title] .jelajahi-line {
            transform: scaleX(0);
            transition: transform 0.55s ease 0.35s;
        }
        [data-jelajahi-title].is-visible .jelajahi-line {
            transform: scaleX(1);
        }

        /* Card entrance */
        [data-jelajahi-card] {
            opacity: 0;
            transform: translateY(24px) scale(0.97);
            transition: opacity 0.5s ease, transform 0.5s ease,
                        box-shadow 0.4s ease;
        }
        [data-jelajahi-card].is-visible {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        /* Scrollbar hide on mobile */
        .jelajahi-cards::-webkit-scrollbar { display: none; }
        .jelajahi-cards { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
    @endpush
@endonce

{{-- Scripts --}}
@once
    @push('scripts')
    <script>
        (function () {
            const io = new IntersectionObserver(
                (entries) => entries.forEach(e => {
                    if (e.isIntersecting) {
                        e.target.classList.add('is-visible');
                        io.unobserve(e.target);
                    }
                }),
                { threshold: 0.15 }
            );

            document
                .querySelectorAll('[data-jelajahi-title], [data-jelajahi-card]')
                .forEach(el => io.observe(el));
        })();
    </script>
    @endpush
@endonce