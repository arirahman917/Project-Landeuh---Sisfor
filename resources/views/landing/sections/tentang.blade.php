<!-- Tentang Section -->
<section id="tentang" class="relative w-full py-16 md:py-24 bg-[#F8EDD8] overflow-hidden">
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
                <div class="flex w-full gap-2 md:gap-6 justify-between overflow-x-auto pb-2">
                    <!-- Segment 1 -->
                    <div class="flex-1 min-w-[100px] cursor-pointer" onclick="selectTentangSegment(0)">
                        <div class="w-full h-[3px] bg-[#d5cebd] relative overflow-hidden mb-2 rounded-full">
                            <div id="tentang-progress-1" class="absolute top-0 left-0 h-full bg-[#1b1b18] rounded-full transition-all duration-500" style="width: 100%;"></div>
                        </div>
                        <span id="tentang-label-1" class="text-[11px] md:text-sm font-bold text-[#1b1b18] transition-colors duration-300 block text-center md:text-left">Tepi Sungai</span>
                    </div>
                    <!-- Segment 2 -->
                    <div class="flex-1 min-w-[140px] cursor-pointer" onclick="selectTentangSegment(1)">
                        <div class="w-full h-[3px] bg-[#d5cebd] relative overflow-hidden mb-2 rounded-full">
                            <div id="tentang-progress-2" class="absolute top-0 left-0 h-full bg-[#1b1b18] rounded-full transition-all duration-500" style="width: 0%;"></div>
                        </div>
                        <span id="tentang-label-2" class="text-[11px] md:text-sm font-medium text-gray-400 transition-colors duration-300 block text-center md:text-left">Cabin & Rumah Industrial</span>
                    </div>
                    <!-- Segment 3 -->
                    <div class="flex-1 min-w-[100px] cursor-pointer" onclick="selectTentangSegment(2)">
                        <div class="w-full h-[3px] bg-[#d5cebd] relative overflow-hidden mb-2 rounded-full">
                            <div id="tentang-progress-3" class="absolute top-0 left-0 h-full bg-[#1b1b18] rounded-full transition-all duration-500" style="width: 0%;"></div>
                        </div>
                        <span id="tentang-label-3" class="text-[11px] md:text-sm font-medium text-gray-400 transition-colors duration-300 block text-center md:text-left">Glamping</span>
                    </div>
                    <!-- Segment 4 -->
                    <div class="flex-1 min-w-[120px] cursor-pointer" onclick="selectTentangSegment(3)">
                        <div class="w-full h-[3px] bg-[#d5cebd] relative overflow-hidden mb-2 rounded-full">
                            <div id="tentang-progress-4" class="absolute top-0 left-0 h-full bg-[#1b1b18] rounded-full transition-all duration-500" style="width: 0%;"></div>
                        </div>
                        <span id="tentang-label-4" class="text-[11px] md:text-sm font-medium text-gray-400 transition-colors duration-300 block text-center md:text-left">Paket Corporate</span>
                    </div>
                    <!-- Segment 5 -->
                    <div class="flex-1 min-w-[80px] cursor-pointer" onclick="selectTentangSegment(4)">
                        <div class="w-full h-[3px] bg-[#d5cebd] relative overflow-hidden mb-2 rounded-full">
                            <div id="tentang-progress-5" class="absolute top-0 left-0 h-full bg-[#1b1b18] rounded-full transition-all duration-500" style="width: 0%;"></div>
                        </div>
                        <span id="tentang-label-5" class="text-[11px] md:text-sm font-medium text-gray-400 transition-colors duration-300 block text-center md:text-left">Kedai</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
    (function() {
        const totalStates = 5;
        let activeIndex = 0;
        let autoRotateTimer = null;

        window.selectTentangSegment = function(index) {
            activeIndex = index;
            for (let i = 1; i <= totalStates; i++) {
                const textItem = document.getElementById('tentang-text-' + i);
                const imgItem = document.getElementById('tentang-img-' + i);
                const labelItem = document.getElementById('tentang-label-' + i);
                const segProgressEl = document.getElementById('tentang-progress-' + i);

                if (i === index + 1) {
                    textItem?.classList.remove('opacity-0', 'translate-y-6', 'pointer-events-none');
                    textItem?.classList.add('opacity-100', 'translate-y-0');

                    imgItem?.classList.remove('opacity-0', 'scale-105');
                    imgItem?.classList.add('opacity-100', 'scale-100');

                    labelItem?.classList.remove('text-gray-400', 'font-medium');
                    labelItem?.classList.add('text-[#1b1b18]', 'font-bold');

                    if (segProgressEl) segProgressEl.style.width = '100%';
                } else {
                    textItem?.classList.add('opacity-0', 'translate-y-6', 'pointer-events-none');
                    textItem?.classList.remove('opacity-100', 'translate-y-0');

                    imgItem?.classList.add('opacity-0', 'scale-105');
                    imgItem?.classList.remove('opacity-100', 'scale-100');

                    labelItem?.classList.add('text-gray-400', 'font-medium');
                    labelItem?.classList.remove('text-[#1b1b18]', 'font-bold');

                    if (segProgressEl) segProgressEl.style.width = '0%';
                }
            }
            restartAutoRotate();
        };

        function startAutoRotate() {
            autoRotateTimer = setInterval(() => {
                activeIndex = (activeIndex + 1) % totalStates;
                selectTentangSegment(activeIndex);
            }, 10000); // Automatically switch every 10 seconds
        }

        function restartAutoRotate() {
            if (autoRotateTimer) clearInterval(autoRotateTimer);
            startAutoRotate();
        }

        document.addEventListener('DOMContentLoaded', () => {
            selectTentangSegment(0);
        });
    })();
</script>
