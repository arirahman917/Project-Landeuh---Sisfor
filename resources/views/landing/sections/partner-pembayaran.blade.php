<!-- Partner Pembayaran Section -->
<section id="partner-pembayaran" class="partner-pembayaran-section relative py-16 overflow-hidden" style="background-color: #F8EDD8;">
    <div class="relative z-10 max-w-6xl mx-auto px-6">

        <!-- Header -->
        <div class="text-center mb-10" data-partner-heading>
            <h2 class="font-sans text-3xl md:text-4xl font-bold text-[#2C1810] tracking-tight mb-2">
                Partner Pembayaran
            </h2>
            <div class="flex items-center justify-center gap-3">
                <span class="pline block h-px w-12 bg-[#B5793A] origin-right"></span>
                <span class="text-[#B5793A] text-sm">✦</span>
                <span class="pline-r block h-px w-12 bg-[#B5793A] origin-left"></span>
            </div>
            <p class="text-xs md:text-sm text-stone-500 mt-2">Mendukung berbagai metode pembayaran instan, aman, dan terpercaya</p>
        </div>

        @php
            $row1 = [
                ['file'=>'bca.png',       'name'=>'BCA',        'w'=>80,  'h'=>19],
                ['file'=>'mandiri.png',   'name'=>'Mandiri',    'w'=>210, 'h'=>92],
                ['file'=>'dana.png',      'name'=>'DANA',       'w'=>116, 'h'=>40],
                ['file'=>'gopay.png',     'name'=>'GoPay',      'w'=>125, 'h'=>52],
                ['file'=>'shopeepay.png', 'name'=>'ShopeePay',  'w'=>132, 'h'=>62],
                ['file'=>'jcb.png',       'name'=>'JCB',        'w'=>62,  'h'=>40],
                ['file'=>'alfamart.png',  'name'=>'Alfamart',   'w'=>96,  'h'=>32],
                ['file'=>'indomaret.png', 'name'=>'Indomaret',  'w'=>88,  'h'=>28],
            ];
            $row2 = [
                ['file'=>'bri.png',         'name'=>'BRI',        'w'=>130, 'h'=>50],
                ['file'=>'bni.png',         'name'=>'BNI',        'w'=>62,  'h'=>22],
                ['file'=>'ovo.png',         'name'=>'OVO',        'w'=>68,  'h'=>28],
                ['file'=>'linkaja.png',     'name'=>'LinkAja',    'w'=>56,  'h'=>30],
                ['file'=>'qris.png',        'name'=>'QRIS',       'w'=>140, 'h'=>50],
                ['file'=>'mastercard.png',  'name'=>'Mastercard', 'w'=>44,  'h'=>28],
                ['file'=>'atm_bersama.png', 'name'=>'ATM Bersama','w'=>102, 'h'=>42],
                ['file'=>'g4158.png',       'name'=>'Partner',    'w'=>58,  'h'=>32],
            ];
        @endphp

        {{-- ROW 1 --}}
        <div class="marquee-wrapper" style="overflow:hidden; margin-bottom:20px; -webkit-mask-image:linear-gradient(to right,transparent 0%,black 7%,black 93%,transparent 100%); mask-image:linear-gradient(to right,transparent 0%,black 7%,black 93%,transparent 100%);">
            <div class="marquee-track marquee-row1" style="display:flex; flex-direction:row; flex-wrap:nowrap; align-items:center; gap:40px; width:max-content; will-change:transform;">
                @foreach ([1, 2] as $c)
                    @foreach ($row1 as $p)
                        <div style="flex-shrink:0; display:flex; align-items:center; justify-content:center; width:110px; height:40px;" title="{{ $p['name'] }}">
                            <img loading="lazy" decoding="async" width="{{ $p['w'] }}" height="{{ $p['h'] }}"
                                 src="{{ asset('images/partner-pembayaran/'.$p['file']) }}"
                                 alt="{{ $p['name'] }}"
                                 draggable="false"
                                 style="display:block; max-width:{{ $p['w'] }}px; max-height:{{ $p['h'] }}px; width:auto; height:auto; object-fit:contain; opacity:0.75; transition:opacity .3s; user-select:none;"
                                 class="hover:opacity-100 transition-opacity">
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>

        {{-- ROW 2 --}}
        <div class="marquee-wrapper" style="overflow:hidden; -webkit-mask-image:linear-gradient(to right,transparent 0%,black 7%,black 93%,transparent 100%); mask-image:linear-gradient(to right,transparent 0%,black 7%,black 93%,transparent 100%);">
            <div class="marquee-track marquee-row2" style="display:flex; flex-direction:row; flex-wrap:nowrap; align-items:center; gap:40px; width:max-content; will-change:transform;">
                @foreach ([1, 2] as $c)
                    @foreach ($row2 as $p)
                        <div style="flex-shrink:0; display:flex; align-items:center; justify-content:center; width:110px; height:40px;" title="{{ $p['name'] }}">
                            <img loading="lazy" decoding="async" width="{{ $p['w'] }}" height="{{ $p['h'] }}"
                                 src="{{ asset('images/partner-pembayaran/'.$p['file']) }}"
                                 alt="{{ $p['name'] }}"
                                 draggable="false"
                                 style="display:block; max-width:{{ $p['w'] }}px; max-height:{{ $p['h'] }}px; width:auto; height:auto; object-fit:contain; opacity:0.75; transition:opacity .3s; user-select:none;"
                                 class="hover:opacity-100 transition-opacity">
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

        @keyframes marqueeScroll {
            0% { transform: translate3d(0, 0, 0); }
            100% { transform: translate3d(calc(-50% - 20px), 0, 0); }
        }

        .marquee-row1 {
            animation: marqueeScroll 25s linear infinite;
        }

        .marquee-row2 {
            animation: marqueeScroll 25s linear infinite;
            animation-delay: -6s; /* Offset for zigzag effect */
        }

        .marquee-wrapper:hover .marquee-track {
            animation-play-state: paused;
        }
    </style>
    @endpush
@endonce

{{-- Scripts --}}
@once
    @push('scripts')
    <script>
    (function () {
        const heading = document.querySelector('[data-partner-heading]');
        if (heading) {
            const io = new IntersectionObserver(entries => {
                entries.forEach(e => {
                    if (e.isIntersecting) {
                        e.target.classList.add('is-visible');
                        io.unobserve(e.target);
                    }
                });
            }, { threshold: 0.2 });
            io.observe(heading);
        }
    })();
    </script>
    @endpush
@endonce
