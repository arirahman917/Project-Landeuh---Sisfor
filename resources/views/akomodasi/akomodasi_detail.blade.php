@extends('layouts.app')
@section('title', 'Akomodasi - Landeuh Village Riverside')

{{-- Hide footer on this page --}}
@section('hide_footer', true)

@section('content')
{{-- Search Bar Fixed --}}
<div id="searchBarFixed" class="sticky top-0 z-40">
    <div class="max-w-6xl mx-auto px-4">
        <div class="grid grid-cols-2 md:flex md:flex-row items-stretch gap-2 md:gap-3 backdrop-blur-md bg-white/40 rounded-b-2xl px-4 md:px-6 py-4 border-x border-b border-gray-200 shadow-sm transition-all duration-300">
            <div class="col-span-1 order-1 md:order-1 flex-1 bg-gray-50 rounded-xl px-3 md:px-4 py-2.5 border border-gray-200 relative cursor-pointer" id="akomodasiPickerContainer">
                <div class="flex items-center gap-2 h-full" id="akomodasiPickerTrigger">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
                    <div class="flex-1 text-sm text-gray-700 select-none truncate" id="akomodasiPickerLabel">Semua Akomodasi</div>
                    <div class="flex items-center text-gray-400 transition-transform duration-300" id="akomodasiPickerChevron">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                </div>
                <div class="absolute top-[calc(100%+0.5rem)] left-0 w-full min-w-[200px] bg-white rounded-2xl shadow-[0_15px_40px_-10px_rgba(0,0,0,0.2)] border border-gray-100 py-2 hidden z-50" id="akomodasiPickerDropdown">
                    <div class="flex flex-col">
                        <button class="akomodasi-opt w-full text-left px-5 py-3 hover:bg-blue-600 hover:text-white transition-colors text-gray-700 text-sm font-medium" data-value="Semua Akomodasi">Semua Akomodasi</button>
                        <button class="akomodasi-opt w-full text-left px-5 py-3 hover:bg-blue-600 hover:text-white transition-colors text-gray-700 text-sm font-medium" data-value="Cabin">Cabin</button>
                        <button class="akomodasi-opt w-full text-left px-5 py-3 hover:bg-blue-600 hover:text-white transition-colors text-gray-700 text-sm font-medium" data-value="Rumah Industrial">Rumah Industrial</button>
                        <button class="akomodasi-opt w-full text-left px-5 py-3 hover:bg-blue-600 hover:text-white transition-colors text-gray-700 text-sm font-medium" data-value="Glamping">Glamping</button>
                    </div>
                </div>
                <input type="hidden" id="filterJenis" value="Semua Akomodasi">
            </div>
            <div class="col-span-2 order-3 md:order-2 flex-[1.4] flex items-center gap-2 bg-gray-50 rounded-xl px-4 py-2.5 border border-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                <input type="text" id="dateRangePicker" class="bg-transparent text-sm text-gray-700 outline-none flex-1" placeholder="Pilih Tanggal">
            </div>
            
            <div class="col-span-1 order-2 md:order-3 flex-1 bg-gray-50 rounded-xl px-3 md:px-4 py-2.5 border border-gray-200 relative" id="guestPickerContainer">
                <div class="flex items-center gap-2 cursor-pointer h-full" id="guestPickerTrigger">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                    <span class="text-sm text-gray-700" id="guestPickerLabel">2 Tamu</span>
                </div>
                <!-- Dropdown -->
                <div class="absolute top-[calc(100%+0.5rem)] right-0 mt-2 w-[calc(100vw-2rem)] md:w-72 bg-white rounded-2xl shadow-[0_15px_40px_-10px_rgba(0,0,0,0.2)] border border-gray-100 p-5 hidden z-50 transform" id="guestPickerDropdown">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center gap-3 text-gray-800 font-semibold text-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                            Tamu
                        </div>
                        <div class="flex items-center gap-4">
                            <button type="button" class="w-8 h-8 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center hover:bg-blue-100" id="btnDecDewasa">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" /></svg>
                            </button>
                            <span class="w-5 text-center font-bold text-gray-800" id="valDewasa">2</span>
                            <button type="button" class="w-8 h-8 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center hover:bg-blue-100" id="btnIncDewasa">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                            </button>
                        </div>
                    </div>
                    <div class="flex justify-end pt-5 border-t border-gray-100 mt-4">
                        <button type="button" class="text-blue-500 font-bold text-md hover:text-blue-600 transition" id="btnSelesaiGuest">Selesai</button>
                    </div>
                </div>
            </div>

            <button id="btnCari" class="col-span-2 order-4 md:order-4 w-full md:w-auto bg-[#3a523a] hover:bg-[#2c402c] text-white font-bold px-8 py-3 rounded-xl flex items-center justify-center gap-2 transition shadow-lg text-sm whitespace-nowrap">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                Cari
            </button>
        </div>
    </div>
</div>

{{-- Akomodasi List --}}
<div class="relative max-w-7xl mx-auto px-4 py-6 min-h-screen">
    <img src="{{ asset('images/assets_lain/batik.png') }}" class="absolute -top-4 -right-8 w-32 opacity-30 pointer-events-none rotate-12 scale-x-[-1] z-0" alt="">
    <img src="{{ asset('images/assets_lain/batik.png') }}" class="absolute bottom-20 right-280 w-100 opacity-30 pointer-events-none -rotate-6 z-0" alt="">
    <img src="{{ asset('images/assets_lain/batik.png') }}" class="absolute top-1/2 -right-12 w-44 opacity-40 pointer-events-none rotate-45 z-0" alt="">

    <div id="akomodasiList" class="relative z-10 flex flex-col gap-5"></div>

    {{-- Pagination --}}
    <div id="paginationWrapper" class="relative z-10 flex items-center justify-between mt-8 mb-4">
        <div id="btnKembaliWrap"><button onclick="akomodasiNav('+(currentPage-1)+')" class="bg-[#3a523a] hover:bg-[#2c402c] text-white text-sm font-semibold px-5 py-2.5 rounded-full transition shadow">Kembali</button></div>
        <div id="paginationControls" class="flex items-center gap-1 flex-1 justify-center"></div>
        <div id="btnNextWrap" class="min-w-[100px] text-right"></div>
    </div>
</div>

{{-- Lightbox --}}
<div id="lightbox" class="fixed inset-0 z-[200] bg-black/80 hidden items-center justify-center" onclick="closeLightbox(event)">
    <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white text-3xl font-bold z-10 hover:text-gray-300 transition">&times;</button>
    <button onclick="lbPrev()" class="absolute left-4 top-1/2 -translate-y-1/2 text-white text-4xl font-bold z-10 hover:text-gray-300 transition">‹</button>
    <button onclick="lbNext()" class="absolute right-4 top-1/2 -translate-y-1/2 text-white text-4xl font-bold z-10 hover:text-gray-300 transition">›</button>
    <img id="lbImg" src="" class="max-w-[90vw] max-h-[85vh] object-contain rounded-xl shadow-2xl transition-opacity duration-300" alt="">
</div>

<style>
.ako-card{background:rgba(253,246,227,0.55);backdrop-filter:blur(12px);border:1px solid rgba(255,255,255,0.4);border-radius:1rem;box-shadow:0 2px 12px rgba(0,0,0,0.06);transition:transform 0.2s,box-shadow 0.2s;min-height:250px;position:relative}
.ako-card:hover{transform:translateY(-2px);box-shadow:0 6px 24px rgba(0,0,0,0.1)}
.img-grid{display:grid;grid-template-columns:repeat(3,1fr);grid-template-rows:5fr 3fr;gap:2px;width:300px;min-width:300px;align-self:stretch;overflow:hidden;border-radius:0.75rem 0 0 0.75rem;cursor:pointer}
.img-grid .img-main{grid-column:span 3;overflow:hidden;position:relative}
.img-grid .img-thumb{overflow:hidden;position:relative}
.img-grid img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;transition:transform 0.3s}
.img-grid img:hover{transform:scale(1.05)}
.img-grid .overlay-label{position:absolute;inset:0;background:rgba(0,0,0,0.4);display:flex;align-items:center;justify-content:center;color:#fff;font-size:0.75rem;font-weight:600}
@media(max-width:768px){.img-grid{width:100%;height:220px;border-radius:0.75rem 0.75rem 0 0}}
/* Price Info Modal */
.price-info-modal-overlay{position:fixed;inset:0;z-index:300;background:rgba(0,0,0,0.5);display:flex;align-items:center;justify-content:center;opacity:0;pointer-events:none;transition:opacity 0.25s ease}
.price-info-modal-overlay.active{opacity:1;pointer-events:auto}
.price-info-modal{background:#fff;border-radius:1.25rem;padding:1.5rem;box-shadow:0 20px 60px rgba(0,0,0,0.2);max-width:380px;width:90%;transform:scale(0.92);transition:transform 0.25s ease}
.price-info-modal-overlay.active .price-info-modal{transform:scale(1)}
.price-info-row{display:flex;align-items:center;gap:0.75rem;padding:0.65rem 0;border-bottom:1px solid #f3f0e8}
.price-info-row:last-child{border-bottom:none}
.price-info-dot{width:10px;height:10px;border-radius:50%;flex-shrink:0}
.price-info-label{font-weight:600;font-size:0.85rem;min-width:90px}
.price-info-price{font-weight:700;font-size:0.9rem;flex:1;text-align:right}
.price-info-breakfast{font-size:0.75rem;color:#888;margin-top:2px}
</style>

{{-- Price Info Modal --}}
<div id="priceInfoModalOverlay" class="price-info-modal-overlay" onclick="closePriceInfoModal(event)">
    <div class="price-info-modal" onclick="event.stopPropagation()">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-base font-bold text-gray-900">Detail Harga</h3>
            <button onclick="closePriceInfoModal()" class="w-7 h-7 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center text-gray-500 transition">&times;</button>
        </div>
        <div id="priceInfoModalContent"></div>
        <div class="text-[10px] text-gray-400 mt-3 text-right italic">/kamar/malam</div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script>
    const AKOMODASI_DATA = @json($accommodations);
    const DATE_SETTINGS = @json($dateSettings);
</script>
<script>
(function(){
    const PER_PAGE = 15;
    let currentPage = 1;
    let filteredData = [...AKOMODASI_DATA];
    const basePath = "{{ asset('images/akomodasi') }}";
    let lbImages=[], lbIdx=0;

    function resolveImgUrl(url) {
        if (!url) return '/images/placeholder.jpg';
        if (url.startsWith('http://') || url.startsWith('https://') || url.startsWith('data:')) {
            return url;
        }
        return url.startsWith('/') ? url : '/' + url;
    }

    // Lightbox
    window.openLightbox=function(id){
        const item = AKOMODASI_DATA.find(d => d.id === id);
        const images = Array.isArray(item.gambar) ? item.gambar : (item.gambar ? [item.gambar] : []);
        lbImages = images.map(g => resolveImgUrl(g));
        if(lbImages.length===0) lbImages=['/images/akomodasi/cabin1/a.webp'];
        lbIdx=0;
        showLbImg();
        document.getElementById('lightbox').classList.remove('hidden');
        document.getElementById('lightbox').classList.add('flex');
    };
    window.closeLightbox=function(e){
        if(e&&e.target!==document.getElementById('lightbox'))return;
        document.getElementById('lightbox').classList.add('hidden');
        document.getElementById('lightbox').classList.remove('flex');
    };
    window.lbPrev=function(){lbIdx=(lbIdx-1+lbImages.length)%lbImages.length;showLbImg();};
    window.lbNext=function(){lbIdx=(lbIdx+1)%lbImages.length;showLbImg();};
    function showLbImg(){document.getElementById('lbImg').src=lbImages[lbIdx];}

    function fmt(n){
        return 'IDR ' + Number(n).toLocaleString('id-ID', {minimumFractionDigits: 0, maximumFractionDigits: 0});
    }
    
    // Helper to get date type
    function getDateType(dateObj) {
        const year = dateObj.getFullYear();
        const month = String(dateObj.getMonth() + 1).padStart(2, '0');
        const day = String(dateObj.getDate()).padStart(2, '0');
        const dateString = `${year}-${month}-${day}`;
        
        const daysIndo = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', "Jum'at", 'Sabtu'];
        const dayName = daysIndo[dateObj.getDay()];

        // 1. Check Highseason
        const hsSettings = DATE_SETTINGS.filter(d => d.type === 'highseason');
        for (let hs of hsSettings) {
            if (hs.dates && hs.dates.includes(dateString)) return 'highseason';
        }

        // 2. Check Weekend
        const weSetting = DATE_SETTINGS.find(d => d.type === 'weekend');
        if (weSetting && weSetting.dates) {
            if (weSetting.dates.includes(dateString) || weSetting.dates.includes(dayName)) return 'weekend';
        }

        return 'weekday';
    }

    function calculateDynamicTotal(item, nights) {
        let startDate = new Date();
        const fp = document.getElementById('dateRangePicker')?._flatpickr;
        if (fp && fp.selectedDates && fp.selectedDates.length > 0) {
            startDate = new Date(fp.selectedDates[0]);
        }
        
        let total = 0;
        let currentDate = new Date(startDate);
        for (let i = 0; i < nights; i++) {
            const type = getDateType(currentDate);
            if (type === 'highseason') total += Number(item.hargaHighseason);
            else if (type === 'weekend') total += Number(item.hargaWeekend);
            else total += Number(item.hargaWeekday);
            
            currentDate.setDate(currentDate.getDate() + 1);
        }
        return total;
    }

    // Get the active rate for check-in date (for display purposes)
    function getActiveRate(item) {
        let startDate = new Date();
        const fp = document.getElementById('dateRangePicker')?._flatpickr;
        if (fp && fp.selectedDates && fp.selectedDates.length > 0) {
            startDate = new Date(fp.selectedDates[0]);
        }
        const type = getDateType(startDate);
        if (type === 'highseason') return { price: Number(item.hargaHighseason), label: 'Highseason', color: '#8b0000' };
        if (type === 'weekend') return { price: Number(item.hargaWeekend), label: 'Weekend', color: '#b8860b' };
        return { price: Number(item.hargaWeekday), label: 'Weekday', color: '#3a523a' };
    }

    // Update all visible price elements without full re-render
    function updateAllPrices() {
        filteredData.forEach(item => {
            const nights = window.akoMalamState[item.id] || 1;
            const priceEl = document.getElementById(`price-val-${item.id}`);
            const rateLabel = document.getElementById(`rate-label-${item.id}`);
            const rateBadge = document.getElementById(`rate-badge-${item.id}`);
            const breakfastBadge = document.getElementById(`breakfast-badge-${item.id}`);
            if (priceEl) {
                const total = calculateDynamicTotal(item, nights);
                priceEl.innerHTML = fmt(total);
            }
            if (rateLabel) {
                const rate = getActiveRate(item);
                rateLabel.innerHTML = `${fmt(rate.price)} <span class="text-[9px] font-normal text-gray-400">/malam</span>`;
            }
            if (rateBadge) {
                const rate = getActiveRate(item);
                rateBadge.textContent = rate.label;
                rateBadge.style.backgroundColor = rate.color;
            }
            // Update breakfast badge visibility
            const rate = getActiveRate(item);
            const breakfastContainer = document.getElementById(`breakfast-badge-${item.id}`);
            const makananSarapanItems = document.querySelectorAll(`#makanan-list-${item.id} .makanan-sarapan`);
            
            if (rate.label === 'Weekday') {
                // Remove breakfast badge if exists
                if (breakfastContainer) breakfastContainer.remove();
                // Hide sarapan from makanan & minuman list
                makananSarapanItems.forEach(el => el.style.display = 'none');
            } else {
                // Add breakfast badge if not exists
                const priceAreaDiv = document.getElementById(`price-val-${item.id}`)?.closest('.flex.flex-col.items-end');
                if (priceAreaDiv && !document.getElementById(`breakfast-badge-${item.id}`)) {
                    const badge = document.createElement('div');
                    badge.id = `breakfast-badge-${item.id}`;
                    badge.className = 'flex items-center gap-1 mt-1 px-2 py-0.5 rounded-md bg-amber-50 border border-amber-200/60';
                    badge.innerHTML = `<span class="text-[10px]">\ud83c\udf73</span><span class="text-[10px] font-semibold text-amber-700">Free Breakfast ${item.maxOrang} pax</span>`;
                    priceAreaDiv.appendChild(badge);
                }
                // Show sarapan from makanan & minuman list
                makananSarapanItems.forEach(el => el.style.display = 'block');
            }
        });
    }

    // Price Info Modal
    window.openPriceInfoModal = function(id) {
        const item = AKOMODASI_DATA.find(d => d.id === id);
        if (!item) return;
        const pax = item.maxOrang || item.max_orang || 4;
        const content = document.getElementById('priceInfoModalContent');
        content.innerHTML = `
            <div class="price-info-row">
                <div class="price-info-dot" style="background:#f97316"></div>
                <div>
                    <div class="price-info-label" style="color:#f97316">Weekday</div>
                    <div class="price-info-breakfast text-gray-400">Tanpa Breakfast</div>
                </div>
                <div class="price-info-price text-gray-600">${fmt(item.hargaWeekday)}</div>
            </div>
            <div class="price-info-row">
                <div class="price-info-dot" style="background:#3b82f6"></div>
                <div>
                    <div class="price-info-label" style="color:#3b82f6">Weekend</div>
                    <div class="price-info-breakfast text-gray-500">Free Breakfast ${pax} pax</div>
                </div>
                <div class="price-info-price text-gray-900">${fmt(item.hargaWeekend)}</div>
            </div>
            <div class="price-info-row">
                <div class="price-info-dot" style="background:#ef4444"></div>
                <div>
                    <div class="price-info-label" style="color:#ef4444">Highseason</div>
                    <div class="price-info-breakfast text-gray-500">Free Breakfast ${pax} pax</div>
                </div>
                <div class="price-info-price text-gray-900">${fmt(item.hargaHighseason)}</div>
            </div>
        `;
        document.getElementById('priceInfoModalOverlay').classList.add('active');
    };
    window.closePriceInfoModal = function(e) {
        if (e && e.target !== document.getElementById('priceInfoModalOverlay')) return;
        document.getElementById('priceInfoModalOverlay').classList.remove('active');
    };

    // Global state for nights
    window.akoMalamState = window.akoMalamState || {};

    window.changeMalam = function(id, delta) {
        if (!window.akoMalamState[id]) window.akoMalamState[id] = 1;
        let n = window.akoMalamState[id] + delta;
        if (n < 1) n = 1;
        window.akoMalamState[id] = n;
        
        const lbl = document.getElementById(`lbl-malam-${id}`);
        if(lbl) lbl.innerText = `${n} Malam`;

        const btn = document.getElementById(`btn-pilih-${id}`);
        if(btn) btn.href = `/reservasi/overview/${id}?malam=${n}`;

        const priceEl = document.getElementById(`price-val-${id}`);
        if(priceEl) {
            const item = AKOMODASI_DATA.find(d => d.id == id);
            if(item) {
                const total = calculateDynamicTotal(item, n);
                priceEl.innerHTML = fmt(total);
            }
        }
    };

    function renderCard(item){
        const safeFasilitas = Array.isArray(item.fasilitas) ? item.fasilitas : [];
        const safeMakanan = Array.isArray(item.makanan) ? item.makanan : [];
        const safeCatatan = Array.isArray(item.catatan) ? item.catatan : [];

        const slotHtml = item.slot > 1 ? `<span class="flex items-center gap-1.5 font-medium whitespace-nowrap"><iconify-icon icon="lucide:tent" class="text-lg"></iconify-icon> Sisa ${item.slot} Unit Tenda</span>` : '';

        let fasHtml='<div class="grid grid-cols-[auto_1fr] gap-x-8 gap-y-0.5 text-xs text-gray-700">';
        safeFasilitas.forEach(f=>fasHtml+=`<div>• ${f}</div>`);fasHtml+='</div>';

        let makHtml=`<div class="flex flex-col gap-0.5 text-xs text-gray-700" id="makanan-list-${item.id}">`;
        safeMakanan.forEach(m=>{
            const isSarapan = m.toLowerCase().includes('sarapan') || m.toLowerCase().includes('breakfast');
            makHtml+=`<div class="${isSarapan ? 'makanan-sarapan' : ''}">• ${m}</div>`;
        });
        makHtml+='</div>';

        let catHtml = safeCatatan.length > 0 ? safeCatatan.map(c => `<div class="flex items-start gap-2 text-[11.5px] text-gray-800 font-medium"><span class="mt-[1px]"><iconify-icon icon="ph:hand-pointing-bold" class="text-sm"></iconify-icon></span><span class="leading-snug">${c}</span></div>`).join('') : '<div class="text-xs text-gray-500 italic">Tidak ada catatan khusus</div>';

        return `
        <div class="ako-card flex flex-col md:flex-row" data-id="${item.id}">
            <div class="img-grid" onclick="openLightbox(${item.id})">
                <div class="img-main"><img src="${resolveImgUrl(Array.isArray(item.gambar) && item.gambar.length > 0 ? item.gambar[0] : item.gambar)}" alt="${item.judul}" loading="lazy"></div>
                <div class="img-thumb"><img src="${resolveImgUrl(Array.isArray(item.gambar) && item.gambar.length > 1 ? item.gambar[1] : (Array.isArray(item.gambar) && item.gambar.length > 0 ? item.gambar[0] : item.gambar))}" alt="" loading="lazy"></div>
                <div class="img-thumb"><img src="${resolveImgUrl(Array.isArray(item.gambar) && item.gambar.length > 2 ? item.gambar[2] : (Array.isArray(item.gambar) && item.gambar.length > 0 ? item.gambar[0] : item.gambar))}" alt="" loading="lazy"></div>
                <div class="img-thumb" style="position:relative">
                    <img src="${resolveImgUrl(Array.isArray(item.gambar) && item.gambar.length > 3 ? item.gambar[3] : (Array.isArray(item.gambar) && item.gambar.length > 0 ? item.gambar[0] : item.gambar))}" alt="" loading="lazy">
                    <div class="overlay-label"><span>Lihat foto</span></div>
                </div>
            </div>
            <div class="flex-1 p-4 md:p-5 flex flex-col justify-between gap-2">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">${item.judul}</h3>
                    <div class="flex items-center gap-3 text-xs text-gray-600 mt-2 flex-wrap font-medium pb-3 border-b border-gray-200">
                        <span class="flex items-center gap-1.5 px-2 py-0.5 rounded bg-blue-50 text-blue-700"><iconify-icon icon="lucide:bed-double" class="text-base"></iconify-icon> ${item.kasur}</span>
                        <div class="w-px h-3 bg-gray-300"></div>
                        <span class="flex items-center gap-1.5 px-2 py-0.5 rounded ${item.merokok?'bg-green-50 text-green-700':'bg-red-50 text-red-700'}">
                            ${item.merokok?'<iconify-icon icon="lucide:cigarette" class="text-base"></iconify-icon> Boleh merokok':'<iconify-icon icon="lucide:cigarette-off" class="text-base"></iconify-icon> Tidak boleh merokok'}
                        </span>
                    </div>
                    <div class="flex flex-col md:flex-row gap-4 mt-3">
                        <div class="flex-1"><p class="text-xs font-bold text-gray-800 mb-1">Fasilitas Kamar:</p>${fasHtml}</div>
                        <div class="flex-1"><p class="text-xs font-bold text-gray-800 mb-1">Makanan & Minuman:</p>${makHtml}</div>
                    </div>
                    <div class="mt-3 p-3 bg-gradient-to-r from-[#e3d1b3]/60 to-transparent rounded-lg">
                        <p class="text-xs font-bold text-gray-800 mb-2">Catatan:</p>
                        <div class="flex flex-col gap-1.5">${catHtml}</div>
                    </div>
                </div>
                <div class="flex items-start md:items-center justify-between pt-1">
                    <div class="flex flex-col md:flex-row items-start md:items-center gap-1.5 md:gap-4 text-xs text-gray-700 font-medium pt-2">
                        <span class="flex items-center gap-1.5 whitespace-nowrap"><iconify-icon icon="lucide:user-check" class="text-base"></iconify-icon> Maks ${item.maxOrang} Dewasa</span>
                        ${slotHtml}
                    </div>
                    <div class="flex flex-col items-end gap-2.5 mt-4 md:mt-0">
                        <!-- Malam Counter -->
                        <div class="flex items-center gap-2 bg-white/60 border border-gray-200 rounded-lg p-1 shadow-sm">
                            <button type="button" onclick="changeMalam(${item.id}, -1)" class="w-6 h-6 flex items-center justify-center bg-white rounded-md border border-gray-200 text-gray-600 hover:text-black hover:bg-gray-50 transition">-</button>
                            <span class="text-xs font-bold text-gray-800 w-16 text-center" id="lbl-malam-${item.id}">${window.akoMalamState[item.id] || 1} Malam</span>
                            <button type="button" onclick="changeMalam(${item.id}, 1)" class="w-6 h-6 flex items-center justify-center bg-white rounded-md border border-gray-200 text-gray-600 hover:text-black hover:bg-gray-50 transition">+</button>
                        </div>
                        
                        <div class="flex items-center gap-2 md:gap-4">
                            <div class="flex flex-col items-end">
                                <div class="flex items-center gap-1 md:gap-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 md:w-4 md:h-4 text-gray-400 cursor-pointer shrink-0 hover:text-[#B5793A] transition" fill="currentColor" viewBox="0 0 24 24" onclick="openPriceInfoModal(${item.id})"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                                    <div class="flex flex-col items-end">
                                        <div class="flex items-center gap-1.5 mb-0.5">
                                            <span id="rate-badge-${item.id}" class="text-[9px] font-bold text-white px-1.5 py-0.5 rounded" style="background-color:${getActiveRate(item).color}">${getActiveRate(item).label}</span>
                                        </div>
                                        <div id="price-val-${item.id}" class="${item.hargaWeekday.toString().length >= 7 ? 'text-base md:text-xl' : 'text-lg md:text-2xl'} font-extrabold text-[#e53e3e] whitespace-nowrap">${fmt(calculateDynamicTotal(item, window.akoMalamState[item.id] || 1))}</div>
                                    </div>
                                </div>
                                <div class="text-[9px] md:text-[10px] text-gray-400 italic">Total Harga</div>
                                ${getActiveRate(item).label !== 'Weekday' ? `<div id="breakfast-badge-${item.id}" class="flex items-center gap-1 mt-1 px-2 py-0.5 rounded-md bg-amber-50 border border-amber-200/60"><span class="text-[10px]">🍳</span><span class="text-[10px] font-semibold text-amber-700">Free Breakfast ${item.maxOrang} pax</span></div>` : ''}
                            </div>
                            ${item._isBooked 
                                ? `<button disabled class="bg-gray-400 text-white text-xs md:text-sm font-bold px-4 md:px-5 py-2 md:py-2.5 rounded-lg shadow whitespace-nowrap cursor-not-allowed">Telah Dibooking</button>`
                                : `<button onclick="handlePilihKamar(${item.id}, ${window.akoMalamState[item.id] || 1})" id="btn-pilih-${item.id}" class="bg-[#3a523a] hover:bg-[#2c402c] text-white text-xs md:text-sm font-bold px-4 md:px-5 py-2 md:py-2.5 rounded-lg transition shadow whitespace-nowrap cursor-pointer">Pilih Kamar</button>`
                            }
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
    }

    function render(){
        const start=(currentPage-1)*PER_PAGE;
        const pageData=filteredData.slice(start,start+PER_PAGE);
        document.getElementById('akomodasiList').innerHTML=pageData.map(renderCard).join('');
        renderPagination();
        updateAllPrices(); // Ensure dynamic logic runs on newly rendered cards
        window.scrollTo({top:0,behavior:'smooth'});
    }

    function renderPagination(){
        const total=filteredData.length;
        const totalPages=Math.ceil(total/PER_PAGE);
        const wrap=document.getElementById('paginationWrapper');
        const el=document.getElementById('paginationControls');
        const kembaliWrap=document.getElementById('btnKembaliWrap');
        const nextWrap=document.getElementById('btnNextWrap');

        // Hide entire pagination if total <= PER_PAGE
        if(total<=PER_PAGE){wrap.style.display='none';return;}
        wrap.style.display='flex';

        // Kembali button: hidden on page 1
        kembaliWrap.innerHTML = currentPage===1 ? '<div style="width:90px"></div>' :
            '<button onclick="akomodasiNav('+(currentPage-1)+')" class="bg-[#3a523a] hover:bg-[#2c402c] text-white text-sm font-semibold px-5 py-2.5 rounded-full transition shadow">Kembali</button>';

        // Page numbers (centered)
        let nums='<button onclick="akomodasiNav('+(currentPage-1)+')" class="px-2 py-1 text-gray-500 hover:text-gray-800 transition text-lg" '+(currentPage===1?'disabled style="opacity:0.3"':'')+'>‹</button>';
        for(let i=1;i<=totalPages;i++){
            nums+=`<button onclick="akomodasiNav(${i})" class="w-8 h-8 rounded-lg text-sm font-bold transition ${i===currentPage?'bg-[#3a523a] text-white shadow':'text-gray-700 hover:bg-gray-200'}">${i}</button>`;
        }
        nums+='<button onclick="akomodasiNav('+(currentPage+1)+')" class="px-2 py-1 text-gray-500 hover:text-gray-800 transition text-lg" '+(currentPage===totalPages?'disabled style="opacity:0.3"':'')+'>›</button>';
        el.innerHTML=nums;

        // Selanjutnya button
        nextWrap.innerHTML = currentPage===totalPages ?
            '<div style="width:100px"></div>' :
            '<button onclick="akomodasiNav('+(currentPage+1)+')" class="bg-[#3a523a] hover:bg-[#2c402c] text-white text-sm font-semibold px-5 py-2.5 rounded-full transition shadow">Selanjutnya</button>';
    }

    window.akomodasiNav=function(page){
        const totalPages=Math.ceil(filteredData.length/PER_PAGE);
        if(page<1||page>totalPages)return;
        currentPage=page;render();
    };

    // Guest Picker Logic
    const params = new URLSearchParams(window.location.search);
    let valDewasa = parseInt(params.get('dewasa')) || 2;

    const trigger = document.getElementById('guestPickerTrigger');
    const dropdown = document.getElementById('guestPickerDropdown');
    const label = document.getElementById('guestPickerLabel');

    // Sync UI value on load
    if (document.getElementById('valDewasa')) {
        document.getElementById('valDewasa').innerText = valDewasa;
    }

    trigger.addEventListener('click', (e) => {
        e.stopPropagation();
        dropdown.classList.toggle('hidden');
    });

    document.getElementById('btnSelesaiGuest').addEventListener('click', () => {
        dropdown.classList.add('hidden');
    });

    document.addEventListener('click', (e) => {
        if(!document.getElementById('guestPickerContainer').contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });

    function updateGuestLabel() {
        label.innerText = `${valDewasa} Tamu`;
    }

    document.getElementById('btnDecDewasa').addEventListener('click', () => {
        if(valDewasa > 1) { valDewasa--; document.getElementById('valDewasa').innerText = valDewasa; updateGuestLabel(); }
    });
    document.getElementById('btnIncDewasa').addEventListener('click', () => {
        valDewasa++; document.getElementById('valDewasa').innerText = valDewasa; updateGuestLabel();
    });

    // Call on load to initialize label
    updateGuestLabel();

    function isBooked(akomodasi, flatpickrDates, targetKamar = 1) {
        if (!flatpickrDates || flatpickrDates.length === 0) return false;

        let start = new Date(flatpickrDates[0]);
        // Set hours to 12:00 to avoid timezone shifts
        start.setHours(12, 0, 0, 0);

        let end;
        if (flatpickrDates.length > 1) {
            end = new Date(flatpickrDates[1]);
            end.setHours(12, 0, 0, 0);
        } else {
            end = new Date(start);
            end.setDate(end.getDate() + 1);
        }

        // If start equals end (same day), assume at least 1 night
        if (start.getTime() === end.getTime()) {
            end.setDate(end.getDate() + 1);
        }

        // Loop through each night of the stay (from check-in up to check-out - 1 day)
        for (let dt = new Date(start); dt < end; dt.setDate(dt.getDate() + 1)) {
            const checkTime = dt.getTime();

            // Count active bookings on this specific night
            let activeBookingsCount = 0;
            if (akomodasi.bookings && akomodasi.bookings.length > 0) {
                akomodasi.bookings.forEach(b => {
                    if (b.status !== 'failed' && b.status !== 'refunded') {
                        let bIn = new Date(b.check_in_date);
                        bIn.setHours(12, 0, 0, 0);
                        let bOut = new Date(b.check_out_date);
                        bOut.setHours(12, 0, 0, 0);

                        // A booking occupies the night if: check_in <= night < check_out
                        if (checkTime >= bIn.getTime() && checkTime < bOut.getTime()) {
                            activeBookingsCount++;
                        }
                    }
                });
            }

            // If active bookings on this night + requested rooms exceeds total slot capacity
            if (activeBookingsCount + targetKamar > akomodasi.slot) {
                return true; // Fully booked for this date range
            }
        }

        return false; // Available
    }

    function doFilter() {
        const j = document.getElementById('filterJenis').value;
        const targetDewasa = parseInt(document.getElementById('valDewasa').innerText);
        const targetKamar = 1; // Default to 1 room

        const datePickerEl = document.getElementById('dateRangePicker');
        let fpDates = null;
        let diffNights = null;
        if (datePickerEl && datePickerEl._flatpickr) {
            fpDates = datePickerEl._flatpickr.selectedDates;
            if (fpDates && fpDates.length === 2) {
                const diffTime = Math.abs(fpDates[1] - fpDates[0]);
                diffNights = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                if (diffNights < 1) diffNights = 1;
            }
        }

        // Auto-sync global night state if date range is selected
        if (diffNights !== null) {
            AKOMODASI_DATA.forEach(d => {
                window.akoMalamState[d.id] = diffNights;
            });
        }

        filteredData = AKOMODASI_DATA.filter(d => {
            // Jenis
            let matchJenis = true;
            if (j && j !== 'Semua Akomodasi' && j !== 'Cabin / Glamping') {
                matchJenis = (d.jenis === j);
            }
            // Tamu (Kapasitas Akomodasi >= Jumlah Tamu)
            let matchTamu = (d.maxOrang >= targetDewasa);
            
            // Tanggal (Hanya Tandai)
            d._isBooked = false;
            if (fpDates && fpDates.length > 0) {
                if (isBooked(d, fpDates, targetKamar)) {
                    d._isBooked = true;
                }
            }

            return matchJenis && matchTamu;
        });

        currentPage = 1;
        render();
    }

    document.getElementById('btnCari').addEventListener('click', doFilter);
    
    // Custom Dropdown Logic
    const akoTrigger = document.getElementById('akomodasiPickerTrigger');
    const akoDropdown = document.getElementById('akomodasiPickerDropdown');
    const akoLabel = document.getElementById('akomodasiPickerLabel');
    const akoInput = document.getElementById('filterJenis');
    const akoChevron = document.getElementById('akomodasiPickerChevron');

    if (akoTrigger && akoDropdown) {
        akoTrigger.addEventListener('click', (e) => {
            e.stopPropagation();
            akoDropdown.classList.toggle('hidden');
            if(akoChevron) akoChevron.classList.toggle('rotate-180');
        });

        document.querySelectorAll('.akomodasi-opt').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const val = e.target.getAttribute('data-value');
                akoLabel.innerText = val;
                akoInput.value = val;
                akoDropdown.classList.add('hidden');
                if(akoChevron) akoChevron.classList.remove('rotate-180');
            });
        });

        document.addEventListener('click', (e) => {
            if(!document.getElementById('akomodasiPickerContainer').contains(e.target)) {
                akoDropdown.classList.add('hidden');
                if(akoChevron) akoChevron.classList.remove('rotate-180');
            }
        });
    }

    // Initialize Flatpickr
    const dateRangeElement = document.getElementById("dateRangePicker");
    const fpInstance = dateRangeElement ? flatpickr(dateRangeElement, {
        mode: "range",
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "D, d M Y", // Match home page format (e.g., Kam, 28 Mei 2026)
        locale: "id",
        minDate: "today",
        showMonths: 2, // Show 2 months side-by-side
        closeOnSelect: false, // Smooth auto-close transition
        onChange: function(selectedDates, dateStr, instance) {
            // Auto-update prices immediately when dates change
            if (selectedDates.length >= 1) {
                // If range is complete (2 dates), sync nights
                if (selectedDates.length === 2) {
                    const diffTime = Math.abs(selectedDates[1] - selectedDates[0]);
                    const diffNights = Math.max(1, Math.ceil(diffTime / (1000 * 60 * 60 * 24)));
                    AKOMODASI_DATA.forEach(d => {
                        window.akoMalamState[d.id] = diffNights;
                        const lbl = document.getElementById(`lbl-malam-${d.id}`);
                        if (lbl) lbl.innerText = `${diffNights} Malam`;
                    });

                    // Smooth auto-close after 290ms
                    setTimeout(() => {
                        if (instance.selectedDates.length === 2 && instance.isOpen) {
                            instance.close();
                        }
                    }, 290);
                }
                updateAllPrices();
            }
        }
    }) : null;

    // Parse URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const paramJenis = urlParams.get('jenis');
    const paramTgl = urlParams.get('tgl');
    const paramDewasa = urlParams.get('dewasa');
    const paramKamar = urlParams.get('kamar');

    if (paramJenis) {
        if(akoInput) akoInput.value = paramJenis;
        if(akoLabel) akoLabel.innerText = paramJenis;
    }
    if (paramTgl && fpInstance && typeof fpInstance.setDate === 'function') {
        try {
            fpInstance.setDate(paramTgl.split(' to '), true);
        } catch (e) {
            console.error("Flatpickr setDate error:", e);
        }
    } else if (paramTgl && Array.isArray(fpInstance) && fpInstance.length > 0 && typeof fpInstance[0].setDate === 'function') {
        try {
            fpInstance[0].setDate(paramTgl.split(' to '), true);
        } catch (e) {
            console.error("Flatpickr setDate error:", e);
        }
    }
    if (paramDewasa) {
        valDewasa = parseInt(paramDewasa) || 2;
        const valDewasaEl = document.getElementById('valDewasa');
        if (valDewasaEl) valDewasaEl.innerText = valDewasa;
    }
    updateGuestLabel();
    
    // Initial Filter
    // Allow flatpickr to initialize if it's deferred
    setTimeout(doFilter, 100);

    // ── Pilih Kamar — auth gate ──────────────────────────────────
    window.handlePilihKamar = function(itemId, malam) {
        const isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
        
        const fp = document.getElementById('dateRangePicker')?._flatpickr;
        let tglParam = '';
        if (fp && fp.selectedDates && fp.selectedDates.length > 0) {
            const d = fp.selectedDates[0];
            const year = d.getFullYear();
            const month = String(d.getMonth() + 1).padStart(2, '0');
            const day = String(d.getDate()).padStart(2, '0');
            tglParam = `&checkin=${year}-${month}-${day}`;
        }
        
        const targetUrl = '/reservasi/overview/' + itemId + '?malam=' + (malam || 1) + tglParam;

        if (isLoggedIn) {
            window.location.href = targetUrl;
        } else {
            // Save target URL and open login modal
            sessionStorage.setItem('pending_redirect', targetUrl);
            if (typeof openLoginModal === 'function') {
                openLoginModal();
            } else {
                alert('Silakan log in terlebih dahulu.');
            }
        }
    };
})();
</script>
@endpush
