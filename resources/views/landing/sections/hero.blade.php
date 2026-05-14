<section class="relative w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4" style="margin-bottom: 1rem;">
    <!-- Ornamen Batik -->
    <div class="absolute -top-6 -left-6 opacity-50 pointer-events-none w-32 md:w-48 rotate-12 z-0">
        <img src="{{ asset('images/assets_lain/batik.png') }}" alt="Ornamen Batik">
    </div>
    <div class="absolute top-100 -right-8 opacity-40 pointer-events-none w-32 md:w-52 -rotate-12 scale-x-[-1] z-0">
        <img src="{{ asset('images/assets_lain/batik.png') }}" alt="Ornamen Batik">
    </div>

    <!-- Hero Content Wrapper -->
    <div class="relative w-full flex flex-col items-center">
        <!-- Carousel Container -->
        <div class="relative w-full h-[400px] md:h-[420px] rounded-[1.8rem] overflow-hidden shadow-2xl group z-10">
            <!-- Carousel Images -->
            <div id="hero-carousel" class="relative w-full h-full bg-gray-200">
                <img src="{{ asset('images/akomodasi/carousel/a.png') }}" alt="Slide 1" class="absolute inset-0 w-full h-full object-cover object-bottom transition-opacity duration-1000 opacity-100 slide-item">
                <img src="{{ asset('images/akomodasi/carousel/b.png') }}" alt="Slide 3" class="absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 opacity-0 slide-item">
                <img src="{{ asset('images/akomodasi/carousel/c.png') }}" alt="Slide 4" class="absolute inset-0 w-full h-full object-cover object-bottom transition-opacity duration-1000 opacity-0 slide-item">
            </div>

            <!-- Overlay for text readability -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>

            <!-- Text Content -->
            <div class="absolute bottom-20 md:bottom-24 left-0 w-full px-6 md:px-14 text-white">
                <h1 class="text-3xl md:text-[2.8rem] font-bold mb-3 md:mb-4 max-w-4xl leading-tight">Bangun pagi ditemani suara sungai dan udara pegunungan yang sejuk</h1>
                <p class="text-base md:text-xl text-gray-100 font-medium tracking-wide">Cari akomodasi yang nyaman & tenang di Landeuh Village Riverside</p>
            </div>
        </div>

        <!-- Search Panel -->
        <div class="w-[95%] lg:w-[95%] max-w-[94%] z-20 -mt-10 md:-mt-16 relative">
            <!-- Container: Flex gap on mobile for individual rounded boxes, unified bar on desktop -->
            <div class="flex flex-col md:flex-row items-stretch justify-between gap-3 md:gap-2 md:bg-white/80 md:backdrop-blur-xl md:rounded-[1.5rem] md:shadow-xl md:p-3 md:border md:border-white/50">
                
                <!-- Jenis Akomodasi -->
                <div class="flex-1 w-full px-5 py-4 bg-white md:bg-transparent rounded-2xl md:rounded-none shadow-md md:shadow-none border border-gray-100 md:border-0 md:border-r md:border-gray-300 relative" id="akomodasiPickerContainer">
                    <label class="block text-xs md:text-sm font-semibold text-gray-800 mb-1">Jenis Akomodasi</label>
                    <div class="relative cursor-pointer" id="akomodasiPickerTrigger">
                        <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                        </div>
                        <div class="w-full pl-8 pr-8 py-1 md:py-2 text-sm md:text-base text-gray-600 select-none truncate" id="akomodasiPickerLabel">
                            Semua Akomodasi
                        </div>
                        <div class="absolute inset-y-0 right-0 flex items-center pointer-events-none text-gray-400 transition-transform duration-300" id="akomodasiPickerChevron">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </div>
                    </div>

                    <!-- Custom Dropdown Menu -->
                    <div class="absolute top-[calc(100%+0.5rem)] left-0 w-full lg:min-w-[220px] bg-white rounded-2xl shadow-[0_15px_40px_-10px_rgba(0,0,0,0.2)] border border-gray-100 py-2 opacity-0 invisible translate-y-[-10px] transition-all duration-300 ease-out z-50" id="akomodasiPickerDropdown">
                        <div class="flex flex-col">
                            <button class="akomodasi-opt w-full text-left px-5 py-3 hover:bg-blue-600 hover:text-white transition-colors text-gray-700 text-sm md:text-base font-medium" data-value="Semua Akomodasi">Semua Akomodasi</button>
                            <button class="akomodasi-opt w-full text-left px-5 py-3 hover:bg-blue-600 hover:text-white transition-colors text-gray-700 text-sm md:text-base font-medium" data-value="Cabin">Cabin</button>
                            <button class="akomodasi-opt w-full text-left px-5 py-3 hover:bg-blue-600 hover:text-white transition-colors text-gray-700 text-sm md:text-base font-medium" data-value="Rumah Industrial">Rumah Industrial</button>
                            <button class="akomodasi-opt w-full text-left px-5 py-3 hover:bg-blue-600 hover:text-white transition-colors text-gray-700 text-sm md:text-base font-medium" data-value="Glamping">Glamping</button>
                        </div>
                    </div>
                    <input type="hidden" name="jenis_akomodasi" id="jenisAkomodasiInput" value="Semua Akomodasi">
                </div>

                <!-- Tanggal Check-in & Check-out -->
                <div class="flex-[1.5] w-full px-5 py-4 bg-white md:bg-transparent rounded-2xl md:rounded-none shadow-md md:shadow-none border border-gray-100 md:border-0 md:border-r md:border-gray-300">
                    <label class="block text-xs md:text-sm font-semibold text-gray-800 mb-1">Tanggal Check-in & Check-out</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
                        </div>
                        <input type="text" id="dateRangePicker" class="w-full pl-8 pr-4 py-1 md:py-2 bg-transparent text-sm md:text-base text-gray-600 outline-none cursor-pointer placeholder-gray-500" placeholder="Pilih tanggal">
                    </div>
                </div>

                <!-- Tamu dan Kamar -->
                <div class="flex-1 w-full px-5 py-4 bg-white md:bg-transparent rounded-2xl md:rounded-none shadow-md md:shadow-none border border-gray-100 md:border-0 relative" id="guestPickerContainer">
                    <label class="block text-xs md:text-sm font-semibold text-gray-800 mb-1">Tamu dan Kamar</label>
                    <div class="relative cursor-pointer" id="guestPickerTrigger">
                        <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                        </div>
                        <div class="w-full pl-8 pr-8 py-1 md:py-2 text-sm md:text-base text-gray-600 select-none" id="guestPickerLabel">
                            2 Dewasa, 1 Kamar
                        </div>
                    </div>

                    <!-- Guest Picker Dropdown -->
                    <div class="absolute top-[calc(100%+0.5rem)] left-0 md:right-0 mt-2 w-[calc(100vw-2rem)] max-w-[320px] bg-white rounded-2xl shadow-[0_15px_40px_-10px_rgba(0,0,0,0.2)] border border-gray-100 p-5 opacity-0 invisible translate-y-[-10px] transition-all duration-300 ease-out z-50 transform md:left-auto" id="guestPickerDropdown">
                        <!-- Dewasa -->
                        <div class="flex items-center justify-between mb-5">
                            <div class="flex items-center gap-3 text-gray-800 font-semibold text-md">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                                Dewasa
                            </div>
                            <div class="flex items-center gap-4">
                                <button type="button" class="w-10 h-10 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center hover:bg-blue-100 disabled:opacity-40 disabled:cursor-not-allowed transition" id="btnDecDewasa">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" /></svg>
                                </button>
                                <span class="w-5 text-center font-bold text-gray-800 text-md" id="valDewasa">2</span>
                                <button type="button" class="w-10 h-10 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center hover:bg-blue-100 transition" id="btnIncDewasa">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                                </button>
                            </div>
                        </div>
                        <!-- Kamar -->
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-3 text-gray-800 font-semibold text-md">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5v15M21 12v7.5M3 16.5h18M7.5 12V9a1.5 1.5 0 0 1 1.5-1.5h3a1.5 1.5 0 0 1 1.5 1.5v3M13.5 12h5.25a2.25 2.25 0 0 1 2.25 2.25v2.25" />
                                </svg>
                                Kamar
                            </div>
                            <div class="flex items-center gap-4">
                                <button type="button" class="w-10 h-10 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center hover:bg-blue-100 disabled:opacity-40 disabled:cursor-not-allowed transition" id="btnDecKamar">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" /></svg>
                                </button>
                                <span class="w-5 text-center font-bold text-gray-800 text-md" id="valKamar">1</span>
                                <button type="button" class="w-10 h-10 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center hover:bg-blue-100 transition" id="btnIncKamar">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                                </button>
                            </div>
                        </div>
                        
                        <div class="flex justify-end pt-5 border-t border-gray-100 mt-4">
                            <button type="button" class="text-blue-500 font-bold text-md hover:text-blue-600 transition tracking-wide" id="btnSelesaiGuest">Selesai</button>
                        </div>
                    </div>
                </div>

                <!-- Tombol Cari -->
                <div class="w-full md:w-auto mt-2 md:mt-5 md:mr-4">
                    <button type="button" id="btnCariHero" class="w-full md:w-auto bg-[#3a523a] hover:bg-[#2c402c] text-white font-bold px-10 py-4 md:py-3.5 rounded-2xl md:rounded-xl flex items-center justify-center gap-2 transition shadow-lg text-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                        Cari
                    </button>
                </div>
                
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnCariHero = document.getElementById('btnCariHero');
        if (btnCariHero) {
            btnCariHero.addEventListener('click', function(e) {
                e.preventDefault();
                const jenisInput = document.getElementById('jenisAkomodasiInput');
                const tglInput = document.getElementById('dateRangePicker');
                const dewasaVal = document.getElementById('valDewasa');
                const kamarVal = document.getElementById('valKamar');

                const jenis = jenisInput ? jenisInput.value : 'Semua Akomodasi';
                const tgl = tglInput ? tglInput.value : '';
                const dewasa = dewasaVal ? dewasaVal.innerText : '2';
                const kamar = kamarVal ? kamarVal.innerText : '1';
                
                const url = `/akomodasi?jenis=${encodeURIComponent(jenis)}&tgl=${encodeURIComponent(tgl)}&dewasa=${encodeURIComponent(dewasa)}&kamar=${encodeURIComponent(kamar)}`;
                window.location.href = url;
            });
        }
    });
</script>
@endpush

@push('scripts')
<!-- Scripts are bundled in app.js -->
@endpush

