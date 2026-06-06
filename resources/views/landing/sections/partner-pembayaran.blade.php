{{-- Section Partner Pembayaran --}}
<section class="partner-section relative py-12" style="background-color:#F5EDD8;">

    <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#D9C49A]/50 to-transparent"></div>
    <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#D9C49A]/50 to-transparent"></div>

    <!-- Batik Ornaments -->
    <!-- Batik Ornaments -->
    <div class="absolute inset-0 pointer-events-none select-none z-0" aria-hidden="true">
        <img loading="lazy" src="{{ asset('images/assets_lain/batik.png') }}" alt=""
             class="absolute top-0 right-10 w-40 md:w-56 opacity-50 translate-y-4 rotate-[15deg]">
        <img loading="lazy" src="{{ asset('images/assets_lain/batik.png') }}" alt=""
             class="absolute bottom-4 left-10 w-32 md:w-48 opacity-40 -rotate-[15deg] scale-x-[-1]">
    </div>

    <div class="relative z-10">

        {{-- Heading --}}
        <div class="text-center mb-9 px-6" data-partner-heading>
            <h2 class="font-sans text-2xl md:text-[1.75rem] font-bold text-[#2C1810] leading-tight">
                Partner Pembayaran Kami
            </h2>
            <div class="mt-3 flex items-center justify-center gap-2">
                <span class="pline block h-0.5 w-8 bg-[#B5793A]" style="transform-origin:right;"></span>
                <span class="text-[#B5793A] text-xs">✦</span>
                <span class="pline-r block h-0.5 w-8 bg-[#B5793A]" style="transform-origin:left;"></span>
            </div>
        </div>

        @php
            // w = max lebar slot (px), h = max tinggi slot (px)
            // Ubah angka w/h untuk atur ukuran tiap logo secara independen
            $row1 = [
                ['file'=>'bca.png',       'name'=>'BCA',        'w'=>80,  'h'=>19],
                ['file'=>'mandiri.png',   'name'=>'Mandiri',    'w'=>210,  'h'=>92],
                ['file'=>'dana.png',      'name'=>'DANA',       'w'=>116,  'h'=>40],
                ['file'=>'gopay.png',     'name'=>'GoPay',      'w'=>125,  'h'=>52],
                ['file'=>'shopeepay.png', 'name'=>'ShopeePay',  'w'=>132,  'h'=>62],
                ['file'=>'jcb.png',       'name'=>'JCB',        'w'=>62,  'h'=>40],
                ['file'=>'alfamart.png',  'name'=>'Alfamart',   'w'=>96,  'h'=>32],
                ['file'=>'indomaret.png', 'name'=>'Indomaret',  'w'=>88,  'h'=>28],
            ];
            $row2 = [
                ['file'=>'bri.png',         'name'=>'BRI',        'w'=>130,  'h'=>50],
                ['file'=>'bni.png',         'name'=>'BNI',        'w'=>62,  'h'=>22],
                ['file'=>'ovo.png',         'name'=>'OVO',        'w'=>68,  'h'=>28],
                ['file'=>'linkaja.png',     'name'=>'LinkAja',    'w'=>56,  'h'=>30],
                ['file'=>'qris.png',        'name'=>'QRIS',       'w'=>140,  'h'=>50],
                ['file'=>'mastercard.png',  'name'=>'Mastercard', 'w'=>44,  'h'=>28],
                ['file'=>'atm_bersama.png', 'name'=>'ATM Bersama','w'=>102,  'h'=>42],
                ['file'=>'g4158.png',       'name'=>'Partner',    'w'=>58,  'h'=>32],
            ];
        @endphp

        {{-- ROW 1 --}}
        <div id="pWrap1" style="overflow:hidden; margin-bottom:20px; -webkit-mask-image:linear-gradient(to right,transparent 0%,black 7%,black 93%,transparent 100%); mask-image:linear-gradient(to right,transparent 0%,black 7%,black 93%,transparent 100%);">
            <div id="pRow1"
                 style="display:flex; flex-direction:row; flex-wrap:nowrap; align-items:center; gap:40px; width:max-content; will-change:transform;">
                @foreach ([1,2,3] as $c)
                    @foreach ($row1 as $p)
                        {{-- Slot TETAP 110px — jarak antar logo selalu sama --}}
                        <div style="flex-shrink:0; display:flex; align-items:center; justify-content:center; width:110px; height:40px;" title="{{ $p['name'] }}">
                            <img loading="lazy" src="{{ asset('images/partner-pembayaran/'.$p['file']) }}"
                                 alt="{{ $p['name'] }}"
                                 draggable="false"
                                 style="display:block; max-width:{{ $p['w'] }}px; max-height:{{ $p['h'] }}px; width:auto; height:auto; object-fit:contain; opacity:0.72; transition:opacity .3s; user-select:none;"
                                 onmouseenter="this.style.opacity=1"
                                 onmouseleave="this.style.opacity=0.72">
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>

        {{-- ROW 2 (offset zigzag) --}}
        <div id="pWrap2" style="overflow:hidden; -webkit-mask-image:linear-gradient(to right,transparent 0%,black 7%,black 93%,transparent 100%); mask-image:linear-gradient(to right,transparent 0%,black 7%,black 93%,transparent 100%);">
            <div id="pRow2"
                 style="display:flex; flex-direction:row; flex-wrap:nowrap; align-items:center; gap:40px; width:max-content; will-change:transform;">
                @foreach ([1,2,3] as $c)
                    @foreach ($row2 as $p)
                        {{-- Slot TETAP 110px — jarak antar logo selalu sama --}}
                        <div style="flex-shrink:0; display:flex; align-items:center; justify-content:center; width:110px; height:40px;" title="{{ $p['name'] }}">
                            <img loading="lazy" src="{{ asset('images/partner-pembayaran/'.$p['file']) }}"
                                 alt="{{ $p['name'] }}"
                                 draggable="false"
                                 style="display:block; max-width:{{ $p['w'] }}px; max-height:{{ $p['h'] }}px; width:auto; height:auto; object-fit:contain; opacity:0.72; transition:opacity .3s; user-select:none;"
                                 onmouseenter="this.style.opacity=1"
                                 onmouseleave="this.style.opacity=0.72">
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>

    </div>
</section>

{{-- Styles --}}
@once
    @push('styles')
    <style>
        [data-partner-heading] {
            opacity: 0;
            transform: translateY(14px);
            transition: opacity 0.55s ease, transform 0.55s ease;
        }
        [data-partner-heading].is-visible { opacity: 1; transform: translateY(0); }

        [data-partner-heading] .pline {
            transform: scaleX(0);
            transition: transform 0.5s ease 0.3s;
        }
        [data-partner-heading].is-visible .pline { transform: scaleX(1); }

        [data-partner-heading] .pline-r {
            transform: scaleX(0);
            transition: transform 0.5s ease 0.3s;
        }
        [data-partner-heading].is-visible .pline-r { transform: scaleX(1); }
    </style>
    @endpush
@endonce

{{-- Scripts --}}
@once
    @push('scripts')
    <script>
    (function () {
        /* Heading observer */
        const heading = document.querySelector('[data-partner-heading]');
        if (heading) {
            const io = new IntersectionObserver(entries => {
                entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('is-visible'); io.unobserve(e.target); }});
            }, { threshold: 0.2 });
            io.observe(heading);
        }

        /* ─── SHARED pause state ─── */
        let globalPaused = false;

        ['pWrap1','pWrap2'].forEach(id => {
            const el = document.getElementById(id);
            if (!el) return;
            el.addEventListener('mouseenter', () => globalPaused = true);
            el.addEventListener('mouseleave', () => globalPaused = false);
        });

        /* ─── Marquee engine ─── */
        const SPEED = 65;   /* px / detik — SAMA untuk kedua baris */
        const GAP   = 40;   /* harus sama dengan CSS gap di atas */

        function startMarquee(trackId, startOffset) {
            const track = document.getElementById(trackId);
            if (!track) return;

            const cells   = track.children;
            const oneCopy = cells.length / 3;

            let pos    = startOffset || 0;
            let lastTs = null;
            let oneW   = 0;

            function measure() {
                let w = 0;
                for (let i = 0; i < oneCopy; i++) {
                    w += cells[i].getBoundingClientRect().width;
                }
                w += GAP * oneCopy;
                oneW = w;
            }

            function tick(ts) {
                if (lastTs === null) lastTs = ts;
                const dt = ts - lastTs;
                lastTs   = ts;

                if (!globalPaused && oneW > 0) {
                    pos += (SPEED * dt) / 1000;
                    if (pos >= oneW) pos -= oneW;
                    track.style.transform = `translateX(-${pos}px)`;
                }
                requestAnimationFrame(tick);
            }

            /* Tunda sedikit agar semua gambar sudah ter-render */
            setTimeout(() => {
                measure();
                window.addEventListener('resize', measure);
                requestAnimationFrame(tick);
            }, 150);
        }

        /* Row 2 mulai offset setengah lebar 1 logo+gap = zigzag effect */
        startMarquee('pRow1', 0);
        startMarquee('pRow2', 64); /* 64px offset awal = zigzag */
    })();
    </script>
    @endpush
@endonce
