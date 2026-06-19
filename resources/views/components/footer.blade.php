<footer class="footer-root relative" style="background-color: #F5EDD8;">

    {{-- ══ Batik ornaments ══ --}}
    <div class="absolute inset-0 pointer-events-none select-none z-0" aria-hidden="true">
        <img src="{{ asset('images/assets_lain/batik.png') }}" alt=""
             class="absolute -top-20 -right-10 w-48 md:w-64 opacity-50 rotate-[20deg] scale-x-[-1]">
        <img src="{{ asset('images/assets_lain/batik.png') }}" alt=""
             class="absolute bottom-10 -left-15 w-40 md:w-56 opacity-40 rotate-[-15deg]">
        <img src="{{ asset('images/assets_lain/batik.png') }}" alt=""
             class="absolute top-1/2 left-1/3 -translate-x-1/2 -translate-y-1/2 w-64 md:w-96 opacity-[0.15] rotate-[45deg]">
             
        {{-- Subtle warm glow center --}}
        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[800px] h-48 opacity-30 pointer-events-none"
             style="background: radial-gradient(ellipse at center bottom, #D4A853 0%, transparent 70%);"></div>
    </div>

    {{-- ══ MAIN CONTENT ══ --}}
    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-12 pt-10 pb-8 lg:pt-16 lg:pb-10">

        {{-- Top grid --}}
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-12 gap-x-6 gap-y-8 lg:gap-8">

            {{-- ── COL 1: Brand ── --}}
            <div class="col-span-2 md:col-span-4 lg:col-span-3 flex flex-col gap-4" data-footer-col>
                
                {{-- Logo and short desc flexed horizontally on mobile for compactness --}}
                <div class="flex flex-row lg:flex-col items-center lg:items-start gap-4 lg:gap-5">
                    <a href="{{ url('/') }}" class="inline-block w-fit group shrink-0">
                        <img src="{{ asset('images/logo-landeuh.png') }}"
                             alt="Landeuh Village Riverside"
                             class="h-12 lg:h-16 w-auto object-contain
                                    group-hover:opacity-90 transition-opacity duration-300">
                    </a>
                    <p class="text-[#2C1810]/75 text-[11px] lg:text-sm leading-relaxed max-w-[210px]">
                        Penginapan tepi sungai yang memadukan ketenangan alam dengan kenyamanan modern.
                    </p>
                </div>

                {{-- Gold rule --}}
                <div class="flex items-center gap-2 hidden lg:flex">
                    <span class="block h-px w-6 bg-[#B5793A]"></span>
                    <span class="text-[#B5793A] text-[10px]">✦</span>
                    <span class="block h-px flex-1 bg-[#B5793A]/20"></span>
                </div>

                {{-- Social icons --}}
                <div class="flex items-center gap-2.5 mt-1 lg:mt-0">
                    <a href="https://wa.me/6282114640277" target="_blank" rel="noopener"
                       class="footer-social-btn" title="WhatsApp" aria-label="WhatsApp">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                            <path d="M12 0C5.373 0 0 5.373 0 12c0 2.118.554 4.107 1.523 5.83L.057 23.5l5.805-1.52A11.945 11.945 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 0 1-5.006-1.367l-.36-.214-3.724.976.994-3.624-.235-.373A9.818 9.818 0 1 1 12 21.818z"/>
                        </svg>
                    </a>
                    <a href="https://instagram.com/landeuhvillageriverside" target="_blank" rel="noopener"
                       class="footer-social-btn" title="Instagram" aria-label="Instagram">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/>
                        </svg>
                    </a>
                    <a href="https://tiktok.com/@landeuh" target="_blank" rel="noopener"
                       class="footer-social-btn" title="TikTok" aria-label="TikTok">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 0 0-.79-.05 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.33-6.34V8.69a8.19 8.19 0 0 0 4.78 1.53V6.77a4.85 4.85 0 0 1-1.01-.08z"/>
                        </svg>
                    </a>
                    <a href="mailto:landeuhvillage@gmail.com"
                       class="footer-social-btn" title="Email" aria-label="Email">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="4" width="20" height="16" rx="2"/>
                            <polyline points="2,4 12,13 22,4"/>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- ── COL 2: Navigasi ── --}}
            <div class="col-span-1 lg:col-span-2 lg:col-start-5" data-footer-col style="transition-delay:.1s">
                <h3 class="footer-col-title">Navigasi</h3>
                <ul class="mt-3 lg:mt-5 space-y-2 lg:space-y-3">
                    @foreach([
                        ['label'=>'Beranda',   'href'=> url('/') . '#hero'],
                        ['label'=>'Tentang',   'href'=> url('/') . '#tentang'],
                        ['label'=>'Akomodasi', 'href'=> url('/akomodasi')],
                        ['label'=>'Fasilitas', 'href'=> url('/') . '#fasilitas'],
                        ['label'=>'FAQ',       'href'=> url('/') . '#faq'],
                    ] as $nav)
                    <li>
                        <a href="{{ $nav['href'] }}" class="footer-nav-link group flex items-center gap-1.5 text-[11px] lg:text-[13.6px]">
                            <span class="footer-nav-arrow">›</span>
                            {{ $nav['label'] }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- ── COL 3: Kontak ── --}}
            <div class="col-span-1 lg:col-span-3 lg:col-start-7" data-footer-col style="transition-delay:.2s">
                <h3 class="footer-col-title">Kontak</h3>
                <ul class="mt-3 lg:mt-5 space-y-3 lg:space-y-4">
                    <li class="flex items-start gap-2.5 lg:gap-3">
                        <span class="footer-icon-wrap mt-0.5 scale-90 lg:scale-100 transform origin-top-left">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
                                <circle cx="12" cy="9" r="2.5"/>
                            </svg>
                        </span>
                        <p class="text-[#2C1810]/75 text-[10px] lg:text-sm leading-relaxed">
                            Kp. Wangun Landeuh, Karang Tengah,<br>
                            Kec. Babakan Madang,<br>
                            Kabupaten Bogor 16810
                        </p>
                    </li>
                    <li class="flex items-center gap-2.5 lg:gap-3">
                        <span class="footer-icon-wrap scale-90 lg:scale-100 transform origin-left">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.27h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9a16 16 0 0 0 6 6l1.09-1.09a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
                            </svg>
                        </span>
                        <a href="https://wa.me/6282114640277" target="_blank"
                           class="text-[#2C1810]/75 text-[10px] lg:text-sm hover:text-[#B5793A] transition-colors duration-200">
                            +62 821-1464-0277
                        </a>
                    </li>
                    <li class="flex items-center gap-2.5 lg:gap-3">
                        <span class="footer-icon-wrap scale-90 lg:scale-100 transform origin-left">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/>
                                <polyline points="12,6 12,12 16,14"/>
                            </svg>
                        </span>
                        <p class="text-[#2C1810]/75 text-[10px] lg:text-sm">Check-in 14.00 – 21.00</p>
                    </li>
                </ul>
            </div>

            {{-- ── COL 4: Maps ── --}}
            <div class="col-span-2 md:col-span-4 lg:col-span-4 lg:col-start-10" data-footer-col style="transition-delay:.3s">
                <h3 class="footer-col-title">Lokasi Kami</h3>
                <div class="mt-3 lg:mt-5 footer-map-wrap relative rounded-[12px] lg:rounded-2xl overflow-hidden"
                     style="box-shadow: 0 2px 20px rgba(90,50,20,0.12), 0 0 0 1px rgba(181,121,58,0.25);">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.479605702551!2d106.92752767356!3d-6.5871501643895645!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69b9ce4fe9db63%3A0x98aeee984c294049!2sLandeuh!5e0!3m2!1sen!2sid!4v1778247169554!5m2!1sen!2sid"
                        width="100%"
                        style="border:0; display:block;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Lokasi Landeuh Village Riverside"
                        class="h-[100px] lg:h-[200px] rounded-[12px] lg:rounded-2xl">
                    </iframe>
                </div>
                <div class="flex justify-end lg:justify-start">
                    <a href="https://maps.google.com/?q=Landeuh+Village+Riverside" target="_blank" rel="noopener"
                       class="mt-2 lg:mt-3 inline-flex items-center gap-1.5 text-[#B5793A] text-[10px] lg:text-xs
                              hover:text-[#8B4A1A] transition-colors duration-200 group">
                        <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6M15 3h6v6M10 14L21 3"/>
                        </svg>
                        <span class="group-hover:underline underline-offset-2">Buka di Google Maps</span>
                    </a>
                </div>
            </div>

        </div>{{-- /grid --}}

        {{-- ══ Divider ══ --}}
        <div class="mt-14 mb-8 flex items-center gap-4">
            <div class="flex-1 h-px" style="background: linear-gradient(to right, transparent, #B5793A40);"></div>
            <span class="text-[#B5793A]/50 text-xs tracking-widest">✦ ✦ ✦</span>
            <div class="flex-1 h-px" style="background: linear-gradient(to left, transparent, #B5793A40);"></div>
        </div>

        {{-- ══ Bottom bar ══ --}}
        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 text-[#2C1810]/60 text-xs">
            <p>© {{ date('Y') }} Landeuh Village Riverside. All rights reserved.</p>
            <div class="flex items-center gap-4">
                <a href="#" class="hover:text-[#2C1810]/85 transition-colors duration-200">Privasi</a>
                <span class="opacity-40">·</span>
                <a href="#" class="hover:text-[#2C1810]/85 transition-colors duration-200">Syarat</a>
            </div>
        </div>

    </div>
</footer>

<style>
    /* ── Entrance ── */
    [data-footer-col] {
        opacity: 0;
        transform: translateY(18px);
        transition: opacity 0.55s ease, transform 0.55s ease;
    }
    [data-footer-col].footer-visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* ── Column heading ── */
    .footer-col-title {
        font-size: 0.65rem;
        font-weight: 700;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: #2C1810;
        position: relative;
        padding-bottom: 10px;
    }
    .footer-col-title::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0;
        width: 20px; height: 1.5px;
        background: #B5793A;
        border-radius: 2px;
        transition: width 0.5s ease 0.25s;
    }
    [data-footer-col].footer-visible .footer-col-title::after { width: 36px; }

    /* ── Nav links ── */
    .footer-nav-link {
        color: rgba(44, 24, 16, 0.75);
        font-size: 0.85rem;
        transition: color 0.2s;
    }
    .footer-nav-link:hover { color: #B5793A; }

    .footer-nav-arrow {
        color: #B5793A;
        opacity: 0;
        transform: translateX(-4px);
        transition: opacity 0.2s, transform 0.2s;
        font-size: 1rem;
        line-height: 1;
    }
    .footer-nav-link:hover .footer-nav-arrow {
        opacity: 1;
        transform: translateX(0);
    }

    /* ── Icon badge ── */
    .footer-icon-wrap {
        flex-shrink: 0;
        width: 26px; height: 26px;
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        background: rgba(181,121,58,0.1);
        border: 1px solid rgba(181,121,58,0.22);
        color: #B5793A;
    }

    /* ── Social buttons ── */
    .footer-social-btn {
        width: 36px; height: 36px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        background: rgba(181,121,58,0.08);
        border: 1px solid rgba(181,121,58,0.22);
        color: rgba(44, 24, 16, 0.75);
        transition: all 0.22s ease;
    }
    .footer-social-btn:hover {
        background: rgba(181,121,58,0.18);
        border-color: rgba(181,121,58,0.5);
        color: #8B4A1A;
        transform: translateY(-2px);
        box-shadow: 0 4px 14px rgba(181,121,58,0.2);
    }

    /* ── Map hover ring ── */
    .footer-map-wrap {
        transition: box-shadow 0.3s ease;
    }
    .footer-map-wrap:hover {
        box-shadow: 0 4px 28px rgba(90,50,20,0.18), 0 0 0 2px rgba(181,121,58,0.4) !important;
    }
</style>

<script>
(function () {
    const cols = document.querySelectorAll('[data-footer-col]');
    if (!cols.length) return;
    const io = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) { e.target.classList.add('footer-visible'); io.unobserve(e.target); }
        });
    }, { threshold: 0.1 });
    cols.forEach(c => io.observe(c));
})();
</script>
