{{-- Section FAQ --}}
<section class="faq-section relative py-16 md:py-20" id="faq" style="background-color: #FDFDFC;">

    {{-- Batik Ornaments --}}
    <div class="absolute inset-0 pointer-events-none select-none z-0" aria-hidden="true">
        <img loading="lazy" src="{{ asset('images/assets_lain/batik.png') }}" alt=""
             class="absolute top-100 -right-45 w-82 opacity-40 translate-x-6 -translate-y-4 rotate-[12deg] scale-x-[-1]">
        <img loading="lazy" src="{{ asset('images/assets_lain/batik.png') }}" alt=""
             class="absolute bottom-0 left-0 w-44 opacity-40 -translate-x-4 translate-y-4 rotate-[6deg]">
    </div>

    <div class="relative z-10 max-w-6xl mx-auto px-6">
        <div class="flex flex-col md:flex-row gap-12 md:gap-16 items-start">

        {{-- LEFT: Heading --}}
        <div class="md:w-72 flex-shrink-0 md:sticky md:top-28" data-faq-heading>
            <h2 class="faq-title font-sans text-3xl md:text-4xl font-bold text-[#2C1810] leading-tight">
                Pertanyaan yang Sering Diajukan
            </h2>
            <div class="mt-5 flex items-center gap-2">
                <span class="faq-line block h-0.5 w-10 bg-[#B5793A] origin-left"></span>
                <span class="text-[#B5793A] text-sm">✦</span>
            </div>
        </div>

        {{-- RIGHT: Accordion --}}
        <div class="flex-1 min-w-0">
        @php
            $faqs = [
                [
                    'q' => 'Kapan waktu check-in dan check-out di Landeuh Village Riverside?',
                    'a' => 'Check-in dimulai pukul 14.00 – 21.00 WIB dan check-out maksimal pukul 12.00 WIB. Informasi lebih lanjut mengenai reservasi dapat dikonfirmasi melalui admin kami.',
                ],
                [
                    'q' => 'Jenis akomodasi apa saja yang tersedia di Landeuh Village Riverside?',
                    'a' => 'Landeuh Village Riverside menawarkan pilihan akomodasi berupa cabin villa dan glamping bernuansa alami yang berada di area tepi sungai dengan suasana sejuk dan menenangkan.',
                ],
                [
                    'q' => 'Apakah Landeuh Village Riverside cocok untuk keluarga dan rombongan?',
                    'a' => 'Tentu. Suasana alam yang nyaman serta area yang luas membuat Landeuh Village Riverside cocok untuk liburan keluarga, gathering, hingga quality time bersama pasangan maupun teman.',
                ],
                [
                    'q' => 'Apakah tersedia area untuk bersantai atau berkumpul bersama?',
                    'a' => 'Tersedia berbagai area santai yang nyaman untuk berkumpul bersama keluarga, pasangan, maupun teman sambil menikmati suasana sungai dan udara alam yang sejuk.',
                ],
                [
                    'q' => 'Apakah tersedia tempat makan di area Landeuh Village Riverside?',
                    'a' => 'Tersedia Kedai Wangun yang dapat dinikmati pengunjung untuk bersantai dan menikmati hidangan selama menginap di Landeuh Village Riverside.',
                ],
                [
                    'q' => 'Bagaimana cara melakukan reservasi di Landeuh Village Riverside?',
                    'a' => 'Reservasi dapat dilakukan langsung melalui website dengan proses booking yang mudah dan pembayaran yang aman. Ketersediaan cabin villa dan glamping akan terupdate secara realtime sesuai unit yang masih tersedia.',
                ],
            ];
        @endphp

        <div class="faq-list space-y-3" id="faqAccordion">
            @foreach ($faqs as $index => $faq)
                <div class="faq-item"
                     style="animation-delay: {{ $index * 80 }}ms"
                     data-faq-item>

                    <button type="button"
                            class="faq-trigger w-full flex items-center justify-between gap-4
                                   text-left px-6 py-5 rounded-2xl
                                   bg-white/50 border border-[#D9C49A]/40
                                   hover:bg-white/80 hover:border-[#B5793A]/40
                                   transition-all duration-300 group"
                            aria-expanded="false"
                            data-faq-trigger>

                        <span class="faq-question font-sans text-[#2C1810] text-base md:text-[0.95rem] font-semibold leading-snug
                                     group-hover:text-[#8B4A1A] transition-colors duration-300">
                            {{ $faq['q'] }}
                        </span>

                        {{-- Icon --}}
                        <span class="faq-icon flex-shrink-0 w-8 h-8 rounded-full
                                     flex items-center justify-center
                                     bg-[#F0E2C4] border border-[#D9C49A]/60
                                     group-hover:bg-[#B5793A]/15 group-hover:border-[#B5793A]/40
                                     transition-all duration-300"
                              aria-hidden="true">
                            <svg class="faq-chevron w-4 h-4 text-[#B5793A]"
                                 style="transition: transform 0.4s cubic-bezier(.77,0,.18,1); transform: rotate(0deg);"
                                 viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 6L8 10L12 6" stroke="currentColor" stroke-width="1.8"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </button>

                    {{-- Answer panel --}}
                    <div class="faq-panel overflow-hidden"
                         style="max-height: 0; transition: max-height 0.45s cubic-bezier(.77,0,.18,1);"
                         data-faq-panel>
                        <div class="px-6 pt-3 pb-5">
                            <p class="text-[#5C3D2A]/80 text-sm md:text-[0.9rem] leading-relaxed font-sans">
                                {{ $faq['a'] }}
                            </p>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

        </div>{{-- end right col --}}
        </div>{{-- end flex row --}}
    </div>
</section>

{{-- Styles --}}
@once
    @push('styles')
    <style>
        /* Heading entrance */
        [data-faq-heading] {
            opacity: 0;
            transform: translateX(-18px);
            transition: opacity 0.55s ease, transform 0.55s ease;
        }
        [data-faq-heading].is-visible { opacity: 1; transform: translateX(0); }

        [data-faq-heading] .faq-line {
            transform: scaleX(0);
            transition: transform 0.55s ease 0.35s;
        }
        [data-faq-heading].is-visible .faq-line { transform: scaleX(1); }

        /* Item entrance */
        [data-faq-item] {
            opacity: 0;
            transform: translateY(16px);
            transition: opacity 0.45s ease, transform 0.45s ease;
        }
        [data-faq-item].is-visible { opacity: 1; transform: translateY(0); }

        /* Open state: trigger bg */
        .faq-item.is-open .faq-trigger {
            background-color: rgba(255,255,255,0.92);
            border-color: rgba(181,121,58,0.45);
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }
        .faq-item.is-open .faq-icon {
            background-color: rgba(181,121,58,0.15);
            border-color: rgba(181,121,58,0.4);
        }
        .faq-chevron {
            transition: transform 0.4s cubic-bezier(.77,0,.18,1);
        }
        .faq-item.is-open .faq-chevron {
            transform: rotate(180deg);
        }
        .faq-item.is-open .faq-question {
            color: #8B4A1A;
        }

        /* Open state: answer bg */
        .faq-item.is-open .faq-panel {
            background-color: rgba(255,255,255,0.92);
            border: 1px solid rgba(181,121,58,0.45);
            border-top: none;
            border-bottom-left-radius: 1rem;
            border-bottom-right-radius: 1rem;
        }

        /* Subtle left accent on open answer (Removed per user request) */
        .faq-item.is-open .faq-panel > div {
            margin-left: 0.25rem;
            padding-left: 1.25rem;
        }
    </style>
    @endpush
@endonce

{{-- Scripts --}}
@once
    @push('scripts')
    <script>
    (function () {

        /* ── Intersection Observer for entrance animation ── */
        const io = new IntersectionObserver(
            (entries) => entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('is-visible');
                    io.unobserve(e.target);
                }
            }),
            { threshold: 0.1 }
        );
        document.querySelectorAll('[data-faq-heading], [data-faq-item]')
                .forEach(el => io.observe(el));

        /* ── Accordion logic ── */
        function openItem(item) {
            const panel   = item.querySelector('[data-faq-panel]');
            const trigger = item.querySelector('[data-faq-trigger]');
            const chevron = item.querySelector('.faq-chevron');
            item.classList.add('is-open');
            trigger.setAttribute('aria-expanded', 'true');
            panel.style.maxHeight = panel.scrollHeight + 'px';
            if (chevron) chevron.style.transform = 'rotate(180deg)';
        }

        function closeItem(item) {
            const panel   = item.querySelector('[data-faq-panel]');
            const trigger = item.querySelector('[data-faq-trigger]');
            const chevron = item.querySelector('.faq-chevron');
            item.classList.remove('is-open');
            trigger.setAttribute('aria-expanded', 'false');
            panel.style.maxHeight = '0';
            if (chevron) chevron.style.transform = 'rotate(0deg)';
        }

        document.querySelectorAll('[data-faq-trigger]').forEach(trigger => {
            trigger.addEventListener('click', () => {
                const item     = trigger.closest('[data-faq-item]');
                const isOpen   = item.classList.contains('is-open');
                const allItems = document.querySelectorAll('[data-faq-item]');

                // Close all
                allItems.forEach(closeItem);

                // Open clicked if it was closed
                if (!isOpen) openItem(item);
            });
        });

        // Open first item by default
        const firstItem = document.querySelector('[data-faq-item]');
        if (firstItem) openItem(firstItem);

    })();
    </script>
    @endpush
@endonce