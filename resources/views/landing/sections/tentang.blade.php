<!-- Tentang Section -->
<section id="tentang-section" class="relative w-full h-[400vh] bg-[#F8EDD8]">
    <!-- Sticky container -->
    <div class="sticky top-0 h-screen w-full flex flex-col justify-center overflow-hidden pt-16 lg:pt-20">
        
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

        <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 relative flex flex-col z-10 h-full justify-center pb-2 md:pb-6">
            
            <!-- Content wrapper: flex-1 centers the grid and timeline vertically -->
            <div class="flex-1 flex flex-col justify-center mt-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-8 lg:gap-16 items-center w-full">
                <!-- Kiri: Teks -->
                <div class="flex flex-col justify-center">
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gray-900 mb-4 md:mb-6 lg:mb-10 tracking-tight">
                        Tentang Akomodasi
                    </h2>
                    
                    <!-- Text container -->
                    <div class="relative h-32 md:h-40 lg:h-48 w-full">
                        <!-- State 1: Tepi Sungai -->
                        <div class="tentang-text-item absolute inset-0 transition-all duration-700 opacity-100 translate-y-0" id="tentang-text-1">
                            <h3 class="text-xl md:text-2xl font-bold text-gray-800 mb-2 md:mb-3">Tepi Sungai</h3>
                            <p class="text-sm md:text-base text-gray-700 leading-relaxed max-w-lg font-medium">
                                Landeuh Village Riverside menghadirkan pengalaman menginap yang nyaman dan menenangkan di tepi sungai, berlokasi di kawasan Karang Tengah, Bogor.
                            </p>
                        </div>
                        <!-- State 2: Cabin & Rumah Industrial -->
                        <div class="tentang-text-item absolute inset-0 transition-all duration-700 opacity-0 translate-y-8 pointer-events-none" id="tentang-text-2">
                            <h3 class="text-xl md:text-2xl font-bold text-gray-800 mb-2 md:mb-3">Cabin & Rumah Industrial</h3>
                            <p class="text-sm md:text-base text-gray-700 leading-relaxed max-w-lg font-medium">
                                Nikmati pengalaman menginap di cabin kayu estetik atau rumah industrial modern kami, sangat cocok untuk bersantai bersama keluarga tercinta.
                            </p>
                        </div>
                        <!-- State 3: Glamping -->
                        <div class="tentang-text-item absolute inset-0 transition-all duration-700 opacity-0 translate-y-8 pointer-events-none" id="tentang-text-3">
                            <h3 class="text-xl md:text-2xl font-bold text-gray-800 mb-2 md:mb-3">Glamping</h3>
                            <p class="text-sm md:text-base text-gray-700 leading-relaxed max-w-lg font-medium">
                                Rasakan sensasi berkemah mewah dengan fasilitas lengkap. Menyatu dengan alam tanpa harus mengorbankan kenyamanan dan kemewahan.
                            </p>
                        </div>
                        <!-- State 4: Kedai -->
                        <div class="tentang-text-item absolute inset-0 transition-all duration-700 opacity-0 translate-y-8 pointer-events-none" id="tentang-text-4">
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
                    <img loading="lazy" id="tentang-img-4" src="{{ asset('images/akomodasi/kedai/a.png') }}" class="tentang-img-item absolute inset-0 w-full h-full object-cover transition-all duration-1000 opacity-0 scale-105">
                </div>
                </div> <!-- END GRID -->
                
                <!-- Bottom Timeline Progress -->
                <div class="w-full mt-4 md:mt-8" style="padding-top: 2rem;">
                    <div class="flex w-full gap-2 md:gap-6 justify-between">
                        <!-- Segment 1 -->
                        <div class="flex-1 cursor-pointer" onclick="scrollToTentangSegment(0)">
                            <div class="w-full h-[2px] md:h-[3px] bg-[#d5cebd] relative overflow-hidden mb-2 rounded-full">
                                <div id="tentang-progress-1" class="absolute top-0 left-0 h-full bg-[#1b1b18] rounded-full transition-all duration-100 ease-out" style="width: 0%;"></div>
                            </div>
                            <span id="tentang-label-1" class="text-[10px] md:text-sm font-bold text-[#1b1b18] transition-colors duration-300">Tepi Sungai</span>
                        </div>
                        <!-- Segment 2 -->
                        <div class="flex-1 cursor-pointer" onclick="scrollToTentangSegment(1)">
                            <div class="w-full h-[2px] md:h-[3px] bg-[#d5cebd] relative overflow-hidden mb-2 rounded-full">
                                <div id="tentang-progress-2" class="absolute top-0 left-0 h-full bg-[#1b1b18] rounded-full transition-all duration-100 ease-out" style="width: 0%;"></div>
                            </div>
                            <span id="tentang-label-2" class="text-[10px] md:text-sm font-medium text-gray-400 transition-colors duration-300">Cabin & Rumah Industrial</span>
                        </div>
                        <!-- Segment 3 -->
                        <div class="flex-1 cursor-pointer" onclick="scrollToTentangSegment(2)">
                            <div class="w-full h-[2px] md:h-[3px] bg-[#d5cebd] relative overflow-hidden mb-2 rounded-full">
                                <div id="tentang-progress-3" class="absolute top-0 left-0 h-full bg-[#1b1b18] rounded-full transition-all duration-100 ease-out" style="width: 0%;"></div>
                            </div>
                            <span id="tentang-label-3" class="text-[10px] md:text-sm font-medium text-gray-400 transition-colors duration-300">Glamping</span>
                        </div>
                        <!-- Segment 4 -->
                        <div class="flex-1 cursor-pointer" onclick="scrollToTentangSegment(3)">
                            <div class="w-full h-[2px] md:h-[3px] bg-[#d5cebd] relative overflow-hidden mb-2 rounded-full">
                                <div id="tentang-progress-4" class="absolute top-0 left-0 h-full bg-[#1b1b18] rounded-full transition-all duration-100 ease-out" style="width: 0%;"></div>
                            </div>
                            <span id="tentang-label-4" class="text-[10px] md:text-sm font-medium text-gray-400 transition-colors duration-300">Kedai</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const section = document.getElementById('tentang-section');
        const totalStates = 4;
        let currentState = -1;

        function updateTentangProgress() {
            const rect = section.getBoundingClientRect();
            const startScroll = rect.top;
            const totalScrollableDistance = rect.height - window.innerHeight;
            
            let progress = 0;
            if (startScroll > 0) {
                progress = 0;
            } else if (-startScroll >= totalScrollableDistance) {
                progress = 1;
            } else {
                progress = -startScroll / totalScrollableDistance;
            }

            const activeState = Math.min(Math.floor(progress * totalStates), totalStates - 1);
            
            for (let i = 0; i < totalStates; i++) {
                const segProgressEl = document.getElementById('tentang-progress-' + (i + 1));
                if (i < activeState) {
                    segProgressEl.style.width = '100%';
                } else if (i === activeState) {
                    const localProgress = (progress - (i * (1 / totalStates))) / (1 / totalStates);
                    segProgressEl.style.width = (localProgress * 100) + '%';
                } else {
                    segProgressEl.style.width = '0%';
                }
            }
            
            if (activeState !== currentState) {
                currentState = activeState;

                for (let i = 1; i <= totalStates; i++) {
                    const textItem = document.getElementById('tentang-text-' + i);
                    const imgItem = document.getElementById('tentang-img-' + i);
                    const labelItem = document.getElementById('tentang-label-' + i);

                    if (i === activeState + 1) {
                        // Active
                        textItem.classList.remove('opacity-0', 'translate-y-8', 'pointer-events-none');
                        textItem.classList.add('opacity-100', 'translate-y-0');

                        imgItem.classList.remove('opacity-0', 'scale-105');
                        imgItem.classList.add('opacity-100', 'scale-100');

                        labelItem.classList.remove('text-gray-400', 'font-medium');
                        labelItem.classList.add('text-[#1b1b18]', 'font-bold');
                    } else {
                        // Inactive
                        textItem.classList.add('opacity-0', 'translate-y-8', 'pointer-events-none');
                        textItem.classList.remove('opacity-100', 'translate-y-0');

                        imgItem.classList.add('opacity-0', 'scale-105');
                        imgItem.classList.remove('opacity-100', 'scale-100');

                        labelItem.classList.add('text-gray-400', 'font-medium');
                        labelItem.classList.remove('text-[#1b1b18]', 'font-bold');
                    }
                }
            }
        }

        window.addEventListener('scroll', updateTentangProgress);
        // initial call
        updateTentangProgress();
    });

    // Function to click on the label and smoothly jump to that segment
    window.scrollToTentangSegment = function(index) {
        const section = document.getElementById('tentang-section');
        const totalScrollableDistance = section.getBoundingClientRect().height - window.innerHeight;
        const segmentHeight = totalScrollableDistance / 4;
        
        // Target scroll Y = section top + (segmentHeight * index) + small offset to hit the segment perfectly
        const offset = window.pageYOffset + section.getBoundingClientRect().top + (segmentHeight * index) + 10;
        
        window.scrollTo({
            top: offset,
            behavior: 'smooth'
        });
    }
</script>
