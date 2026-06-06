<!-- Fasilitas Section -->
<section class="fasilitas-section relative py-20" style="background-color: #F5EDD8;">

    <!-- Batik Ornament: Top Right -->
    <div class="absolute top-0 right-0 pointer-events-none select-none z-0" aria-hidden="true">
        <img loading="lazy" src="{{ asset('images/assets_lain/batik.png') }}"
             alt=""
             class="w-48 md:w-64 opacity-40 translate-x-6 -translate-y-6 rotate-[15deg] scale-x-[-1]"
             draggable="false">
    </div>

    <div class="relative z-10 max-w-6xl mx-auto px-6">

        <!-- Header -->
        <div class="text-center mb-14" data-fasilitas-animate>
            <h2 class="fasilitas-title font-sans text-4xl md:text-5xl font-bold text-[#2C1810] tracking-tight mb-3">
                Fasilitas
            </h2>
            <div class="flex items-center justify-center gap-3">
                <span class="divider-line block h-px w-16 bg-[#B5793A]"></span>
                <span class="text-[#B5793A] text-lg">✦</span>
                <span class="divider-line block h-px w-16 bg-[#B5793A]"></span>
            </div>
        </div>

        <!-- Fasilitas Grid: flex-wrap for 3 rows auto -->
        <div class="fasilitas-grid flex flex-wrap justify-center gap-2 md:gap-4">

            @php
                $fasilitas = [
                    [
                        'label' => 'Dipinggir Sungai',
                        'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l1.5-1.5c1.5-1.5 4.5-1.5 6 0s4.5 1.5 6 0l1.5-1.5M3.75 17.25l1.5-1.5c1.5-1.5 4.5-1.5 6 0s4.5 1.5 6 0l1.5-1.5M3.75 9.75l1.5-1.5c1.5-1.5 4.5-1.5 6 0s4.5 1.5 6 0l1.5-1.5" />'
                    ],
                    [
                        'label' => 'Kedai',
                        'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016A3.001 3.001 0 0021 9.349m-18 0a2.995 2.995 0 002.25 1.066A2.995 2.995 0 007.5 9.349m-3.75 0A2.995 2.995 0 016 8.285c.34-.498.87-.855 1.5-.985m8.25 2.05A2.995 2.995 0 0118 8.285c-.34-.498-.87-.855-1.5-.985m0 0V4.5h-9v2.8m9 0H7.5" />'
                    ],
                    [
                        'label' => 'Area Bermain Anak',
                        'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z" />'
                    ],
                    [
                        'label' => 'Area Api Unggun',
                        'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 00.495-7.467 5.99 5.99 0 00-1.925 3.546 5.974 5.974 0 01-2.133-1.001A3.75 3.75 0 0012 18z" />'
                    ],
                    [
                        'label' => 'Perlengkapan BBQ',
                        'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25v-1.5m0 1.5c-1.355 0-2.697.056-4.024.166C6.845 8.51 6 9.473 6 10.608v2.513m6-4.871c1.355 0 2.697.056 4.024.166C17.155 8.51 18 9.473 18 10.608v2.513M15 8.25v-1.5m-6 1.5v-1.5m12 9.75l-1.5.75a3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0L3 16.5m18-4.5a9 9 0 00-18 0" />'
                    ],
                    [
                        'label' => 'Gratis Parkir',
                        'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />'
                    ],
                    [
                        'label' => 'Ruang Makan Outdoor',
                        'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />'
                    ],
                    [
                        'label' => 'Dapur',
                        'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />'
                    ],
                    [
                        'label' => 'Shower',
                        'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 007.92 12.446A9 9 0 1112 2.992z M7.5 14.25l1-1m0 0l1-1m-1 1l-1-1m1 1l1 1" />'
                    ],
                    [
                        'label' => 'Alat Pembuat Kopi/Teh',
                        'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23.693L5 14.5m14.8.8l.8 1.2a1 1 0 01-.8 1.6H4.2a1 1 0 01-.8-1.6l.8-1.2" />'
                    ],
                    [
                        'label' => 'Balkon',
                        'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />'
                    ],
                    [
                        'label' => 'Toilet',
                        'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 012.25-2.25h7.5A2.25 2.25 0 0118 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 004.5 9v.878m13.5-3A2.25 2.25 0 0119.5 9v.878m0 0a2.246 2.246 0 00-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0121 12v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6c0-.98.626-1.813 1.5-2.122" />'
                    ],
                    [
                        'label' => 'Sajadah',
                        'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />'
                    ],
                ];
            @endphp

            @foreach ($fasilitas as $index => $item)
                <div class="fasilitas-card group relative flex items-center gap-2.5 md:gap-3 bg-white/60 backdrop-blur-sm
                            border border-[#C9A96E]/30 rounded-lg md:rounded-xl px-3.5 py-2 md:px-5 md:py-3.5
                            hover:bg-white/90 hover:border-[#B5793A]/60 hover:shadow-md
                            transition-all duration-300 cursor-default"
                     style="animation-delay: {{ $index * 60 }}ms"
                     data-fasilitas-item>
                    <!-- Icon wrapper -->
                    <div class="fasilitas-icon flex-shrink-0 w-7 h-7 md:w-9 md:h-9 rounded-md md:rounded-lg
                                flex items-center justify-center
                                bg-[#F0E2C4] group-hover:bg-[#B5793A]/15
                                transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#B5793A" class="w-4 h-4 md:w-5 md:h-5">
                            {!! $item['svg'] !!}
                        </svg>
                    </div>
                    <!-- Label -->
                    <span class="fasilitas-label text-[#2C1810] text-xs md:text-sm font-medium leading-tight">
                        {{ $item['label'] }}
                    </span>
                    <!-- Subtle hover accent line -->
                    <span class="absolute bottom-0 left-3 right-3 md:left-4 md:right-4 h-px bg-[#B5793A]/0
                                 group-hover:bg-[#B5793A]/30 transition-all duration-300 rounded-full"></span>
                </div>
            @endforeach

        </div>
    </div>
</section>

<!-- Styles -->
@once
    @push('styles')
    <style>
        /* ── Section base ── */
        .fasilitas-section {
            font-family: 'Georgia', 'Times New Roman', serif;
        }

        /* ── Title entrance ── */
        .fasilitas-title {
            text-shadow: 0 1px 2px rgba(44, 24, 16, 0.08);
        }

        /* ── Card entrance animation ── */
        [data-fasilitas-item] {
            opacity: 0;
            transform: translateY(18px);
            transition: opacity 0.45s ease, transform 0.45s ease,
                        background-color 0.3s, border-color 0.3s, box-shadow 0.3s;
        }

        [data-fasilitas-item].is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ── Header entrance ── */
        [data-fasilitas-animate] {
            opacity: 0;
            transform: translateY(-12px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        [data-fasilitas-animate].is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ── Divider lines animate ── */
        .divider-line {
            transform: scaleX(0);
            transform-origin: center;
            transition: transform 0.6s ease 0.3s;
        }
        [data-fasilitas-animate].is-visible .divider-line {
            transform: scaleX(1);
        }
    </style>
    @endpush
@endonce

<!-- Scripts -->
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
                { threshold: 0.12 }
            );

            document.querySelectorAll('[data-fasilitas-item], [data-fasilitas-animate]')
                    .forEach((el) => observer.observe(el));
        })();
    </script>
    @endpush
@endonce