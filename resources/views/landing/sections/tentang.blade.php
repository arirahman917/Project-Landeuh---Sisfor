<!-- Tentang Section (Scroll-based) -->
<section id="tentang-container" class="relative w-full h-[400vh] bg-[#F8EDD8]">
    <!-- Sticky Wrapper -->
    <div class="sticky top-0 h-screen w-full overflow-hidden flex flex-col justify-center py-16 md:py-24">
        
        <!-- Ornamen Batik Kiri Atas -->
        <div class="absolute top-10 md:top-20 left-4 md:left-20 opacity-50 pointer-events-none w-32 md:w-48 rotate-[15deg] z-0">
            <img loading="lazy" src="{{ asset('images/assets_lain/batik.png') }}" alt="Ornamen Batik Kiri Atas">
        </div>
        
        <!-- Ornamen Batik Kanan Atas Judul -->
        <div class="absolute top-24 md:top-36 left-1/3 opacity-40 pointer-events-none w-28 md:w-40 hidden md:block -rotate-[15deg] z-0">
            <img loading="lazy" src="{{ asset('images/assets_lain/batik.png') }}" alt="Ornamen Batik Kanan Atas">
        </div>

        <!-- Ornamen Batik Kanan Bawah -->
        <div class="absolute bottom-10 right-4 md:right-20 opacity-40 pointer-events-none w-32 md:w-48 rotate-[180deg] z-0">
            <img loading="lazy" src="{{ asset('images/assets_lain/batik.png') }}" alt="Ornamen Batik Kanan Bawah">
        </div>

        <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 relative flex flex-col z-10 justify-center">
            
            <!-- Content wrapper -->
            <div class="flex flex-col justify-center">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 md:gap-10 lg:gap-16 items-center w-full">
                <!-- Kiri: Teks -->
                <div class="flex flex-col justify-center">
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gray-900 mb-4 md:mb-6 lg:mb-8 tracking-tight">
                        Tentang Akomodasi
                    </h2>
                    
                    <!-- Text container -->
                    <div class="relative h-36 md:h-40 lg:h-44 w-full">
                        <!-- State 1: Tepi Sungai -->
                        <div class="tentang-text-item absolute inset-0 transition-all duration-700 opacity-100 translate-y-0" id="tentang-text-1">
                            <h3 class="text-xl md:text-2xl font-bold text-gray-800 mb-2 md:mb-3">Tepi Sungai</h3>
                            <p class="text-sm md:text-base text-gray-700 leading-relaxed max-w-lg font-medium">
                                Landeuh Village Riverside menghadirkan pengalaman menginap yang nyaman dan menenangkan di tepi sungai, berlokasi di kawasan Karang Tengah, Bogor.
                            </p>
                        </div>
                        <!-- State 2: Cabin & Rumah Industrial -->
                        <div class="tentang-text-item absolute inset-0 transition-all duration-700 opacity-0 translate-y-6 pointer-events-none" id="tentang-text-2">
                            <h3 class="text-xl md:text-2xl font-bold text-gray-800 mb-2 md:mb-3">Cabin & Rumah Industrial</h3>
                            <p class="text-sm md:text-base text-gray-700 leading-relaxed max-w-lg font-medium">
                                Nikmati pengalaman menginap di cabin kayu estetik atau rumah industrial modern kami, sangat cocok untuk bersantai bersama keluarga tercinta.
                            </p>
                        </div>
                        <!-- State 3: Glamping -->
                        <div class="tentang-text-item absolute inset-0 transition-all duration-700 opacity-0 translate-y-6 pointer-events-none" id="tentang-text-3">
                            <h3 class="text-xl md:text-2xl font-bold text-gray-800 mb-2 md:mb-3">Glamping</h3>
                            <p class="text-sm md:text-base text-gray-700 leading-relaxed max-w-lg font-medium">
                                Rasakan sensasi berkemah mewah dengan fasilitas lengkap. Menyatu dengan alam tanpa harus mengorbankan kenyamanan dan kemewahan.
                            </p>
                        </div>
                        <!-- State 4: Paket Corporate -->
                        <div class="tentang-text-item absolute inset-0 transition-all duration-700 opacity-0 translate-y-6 pointer-events-none" id="tentang-text-4">
                            <h3 class="text-xl md:text-2xl font-bold text-gray-800 mb-2 md:mb-3">Paket Corporate</h3>
                            <p class="text-sm md:text-base text-gray-700 leading-relaxed max-w-lg font-medium">
                                Nikmati paket khusus untuk gathering perusahaan, instansi, komunitas, maupun acara keluarga, lengkap dengan akomodasi, konsumsi, dan suasana alam yang mendukung kebersamaan.
                            </p>
                        </div>
                        <!-- State 5: Kedai -->
                        <div class="tentang-text-item absolute inset-0 transition-all duration-700 opacity-0 translate-y-6 pointer-events-none" id="tentang-text-5">
                            <h3 class="text-xl md:text-2xl font-bold text-gray-800 mb-2 md:mb-3">Kedai</h3>
                            <p class="text-sm md:text-base text-gray-700 leading-relaxed max-w-lg font-medium">
                                Nikmati berbagai hidangan lezat dan kopi hangat di kedai kami, dengan pemandangan indah yang langsung menghadap ke arah sungai yang asri.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Kanan: Gambar -->
                <div class="relative h-[240px] md:h-[300px] lg:h-[380px] w-full rounded-2xl md:rounded-3xl overflow-hidden shadow-2xl group">
                    <img loading="lazy" id="tentang-img-1" src="{{ asset('images/akomodasi/glamping_vip/c.webp') }}" class="tentang-img-item absolute inset-0 w-full h-full object-cover transition-all duration-1000 opacity-100 scale-100">
                    <img loading="lazy" id="tentang-img-2" src="{{ asset('images/akomodasi/cabin5/a.webp') }}" class="tentang-img-item absolute inset-0 w-full h-full object-cover transition-all duration-1000 opacity-0 scale-105">
                    <img loading="lazy" id="tentang-img-3" src="{{ asset('images/akomodasi/glamping_vip/d-tentang.webp') }}" class="tentang-img-item absolute inset-0 w-full h-full object-cover transition-all duration-1000 opacity-0 scale-105">
                    <img loading="lazy" id="tentang-img-4" src="{{ asset('images/akomodasi/paket_corporate/a.webp') }}" class="tentang-img-item absolute inset-0 w-full h-full object-cover transition-all duration-1000 opacity-0 scale-105">
                    <img loading="lazy" id="tentang-img-5" src="{{ asset('images/akomodasi/kedai/a.png') }}" class="tentang-img-item absolute inset-0 w-full h-full object-cover transition-all duration-1000 opacity-0 scale-105">
                </div>
                </div> <!-- END GRID -->
                
                <!-- Bottom Timeline Progress -->
                <div class="w-full mt-6 md:mt-10">
                    <div class="flex w-full gap-1 sm:gap-2 md:gap-4 justify-between items-end pb-2">
                        @php
                            $segments = ['Tepi Sungai', 'Cabin & R. Industrial', 'Glamping', 'Paket Corporate', 'Kedai'];
                        @endphp
                        @foreach ($segments as $i => $label)
                        <div class="tentang-segment flex-1 min-w-0 cursor-pointer select-none group"
                             data-segment="{{ $i }}"
                             onclick="window._tentangTimeline?.jumpTo({{ $i }})">
                            <div class="w-full h-[2px] md:h-[3px] bg-[#d5cebd] relative overflow-hidden mb-1.5 md:mb-2 rounded-full">
                                <div class="tentang-progress-bar absolute top-0 left-0 h-full bg-[#1b1b18] rounded-full"
                                     id="tentang-progress-{{ $i + 1 }}"
                                     style="width: 0%; transition: none;"></div>
                            </div>
                            <span class="tentang-seg-label text-[9px] sm:text-[10px] md:text-sm font-medium text-gray-400 block text-center md:text-left leading-tight tracking-tighter sm:tracking-normal group-hover:text-gray-600"
                                  id="tentang-label-{{ $i + 1 }}">
                                {{ $label }}
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<script>
(function() {
    const TOTAL = 5;
    let currentActiveIndex = -1;
    const container = document.getElementById('tentang-container');

    // ── Show a specific segment (text + image + labels) ──
    function showSegment(index) {
        for (let i = 1; i <= TOTAL; i++) {
            const textEl  = document.getElementById('tentang-text-'  + i);
            const imgEl   = document.getElementById('tentang-img-'   + i);
            const labelEl = document.getElementById('tentang-label-' + i);

            const isActive = (i === index + 1);

            if (textEl) {
                if (isActive) {
                    textEl.classList.remove('opacity-0', 'translate-y-6', 'pointer-events-none');
                    textEl.classList.add('opacity-100', 'translate-y-0');
                } else {
                    textEl.classList.add('opacity-0', 'translate-y-6', 'pointer-events-none');
                    textEl.classList.remove('opacity-100', 'translate-y-0');
                }
            }

            if (imgEl) {
                if (isActive) {
                    imgEl.classList.remove('opacity-0', 'scale-105');
                    imgEl.classList.add('opacity-100', 'scale-100');
                } else {
                    imgEl.classList.add('opacity-0', 'scale-105');
                    imgEl.classList.remove('opacity-100', 'scale-100');
                }
            }

            if (labelEl) {
                if (isActive) {
                    labelEl.classList.remove('text-gray-400', 'font-medium');
                    labelEl.classList.add('text-[#1b1b18]', 'font-bold');
                } else {
                    labelEl.classList.remove('text-[#1b1b18]', 'font-bold');
                    labelEl.classList.add('text-gray-400', 'font-medium');
                }
            }
        }
    }

    // ── Handle Scroll Progress ──
    function updateTimelineOnScroll() {
        if (!container) return;
        const rect = container.getBoundingClientRect();
        const winH = window.innerHeight;
        
        // Pinned state distance
        const scrollDistance = rect.height - winH;
        let progress = -rect.top / scrollDistance;
        
        // Clamp progress between 0 and 1
        progress = Math.max(0, Math.min(1, progress));
        
        const overallProgress = progress * TOTAL;
        const activeIndex = Math.min(Math.floor(overallProgress), TOTAL - 1);
        
        // Switch segment content if changed
        if (activeIndex !== currentActiveIndex) {
            showSegment(activeIndex);
            currentActiveIndex = activeIndex;
        }
        
        // Update progress bars smoothly based on scroll
        for (let i = 0; i < TOTAL; i++) {
            const bar = document.getElementById('tentang-progress-' + (i + 1));
            if (!bar) continue;
            bar.style.transition = 'none';
            if (i < activeIndex) {
                bar.style.width = '100%';
            } else if (i === activeIndex) {
                const segmentProgress = (overallProgress - activeIndex) * 100;
                bar.style.width = segmentProgress + '%';
            } else {
                bar.style.width = '0%';
            }
        }
    }

    // ── Jump to a specific segment (user click) ──
    function jumpTo(index) {
        if (!container) return;
        const winH = window.innerHeight;
        const scrollDistance = container.offsetHeight - winH;
        // Calculate offset to scroll to (start of the selected segment + a tiny buffer)
        const targetScrollY = container.offsetTop + (index / TOTAL) * scrollDistance + 5;
        window.scrollTo({ top: targetScrollY, behavior: 'smooth' });
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', () => {
        window.addEventListener('scroll', updateTimelineOnScroll, { passive: true });
        // Initial run
        updateTimelineOnScroll();
    });

    // Expose jumpTo for onclick
    window._tentangTimeline = { jumpTo };
})();
</script>
