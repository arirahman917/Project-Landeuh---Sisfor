@extends('layouts.app')
@section('title', 'Akomodasi - Landeuh Village Riverside')

{{-- Hide footer on this page --}}
@section('hide_footer', true)

@section('content')
{{-- Search Bar Fixed --}}
<div id="searchBarFixed" class="sticky top-0 z-40">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex flex-row items-stretch gap-2 md:gap-3 backdrop-blur-md bg-white/40 rounded-b-2xl px-4 md:px-6 py-4 border-x border-b border-gray-200 shadow-sm transition-all duration-300">
            <div class="flex-1 bg-gray-50 rounded-xl px-3 md:px-4 py-2.5 border border-gray-200 relative cursor-pointer" id="akomodasiPickerContainer">
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
            
            <div class="flex-1 bg-gray-50 rounded-xl px-3 md:px-4 py-2.5 border border-gray-200 relative" id="guestPickerContainer">
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
    <button onclick="lbPrev()" id="lbBtnPrev" class="absolute left-4 top-1/2 -translate-y-1/2 text-white text-4xl font-bold z-10 hover:text-gray-300 transition">‹</button>
    <button onclick="lbNext()" id="lbBtnNext" class="absolute right-4 top-1/2 -translate-y-1/2 text-white text-4xl font-bold z-10 hover:text-gray-300 transition">›</button>
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
<style>
    .flatpickr-day.flatpickr-disabled.booked-date {
        background-color: #e5e7eb !important; /* bg-gray-200 */
        border-color: transparent !important;
        color: #9ca3af !important; /* text-gray-400 */
        border-radius: 50% !important;
        text-decoration: line-through; /* Optional styling to emphasize disabled state */
    }
</style>
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
        if (typeof url !== 'string') {
            try {
                if (Array.isArray(url) && url.length > 0) return resolveImgUrl(url[0]);
                url = String(url);
            } catch(e) {
                return '/images/placeholder.jpg';
            }
        }
        
        // Bersihkan escape characters jika ada (misal \/ atau \")
        url = url.replace(/\\/g, '');
        url = url.replace(/"/g, '');
        url = url.replace(/'/g, '');
        url = url.replace(/\[/g, '');
        url = url.replace(/\]/g, '');

        // Jika url berisi multiple url karena dipisahkan koma
        if (url.includes(',')) {
            url = url.split(',')[0].trim();
        }

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
    window.lbPrev=function(){if(lbIdx>0){lbIdx--;showLbImg();}};
    window.lbNext=function(){if(lbIdx<lbImages.length-1){lbIdx++;showLbImg();}};
    function showLbImg(){
        document.getElementById('lbImg').src=lbImages[lbIdx];
        document.getElementById('lbBtnPrev').style.display=lbIdx===0?'none':'';
        document.getElementById('lbBtnNext').style.display=lbIdx>=lbImages.length-1?'none':'';
    }

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
        const cardDates = window.akoDateState[item.id];
        if (cardDates && cardDates.length > 0) {
            startDate = new Date(cardDates[0]);
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
        const cardDates = window.akoDateState[item.id];
        if (cardDates && cardDates.length > 0) {
            startDate = new Date(cardDates[0]);
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

    // Global state for nights and dates
    window.akoMalamState = window.akoMalamState || {};
    window.akoDateState = window.akoDateState || {};

    window.isDateFullyBooked = function(akomodasi, dateObj) {
        if (!akomodasi.bookings || akomodasi.bookings.length === 0) return false;
        
        let checkTime = new Date(dateObj);
        checkTime.setHours(12, 0, 0, 0);
        checkTime = checkTime.getTime();

        let activeBookingsCount = 0;
        akomodasi.bookings.forEach(b => {
            if (b.status !== 'failed' && b.status !== 'refunded') {
                let bIn = new Date(b.check_in_date);
                bIn.setHours(12, 0, 0, 0);
                let bOut = new Date(b.check_out_date);
                bOut.setHours(12, 0, 0, 0);

                // Booking overlaps if check_in <= checkTime < check_out
                if (checkTime >= bIn.getTime() && checkTime < bOut.getTime()) {
                    activeBookingsCount++;
                }
            }
        });

        return activeBookingsCount >= akomodasi.slot;
    };

    window.toggleCollapse = function(id) {
        const content = document.getElementById('collapse-content-' + id);
        const fade = document.getElementById('collapse-fade-' + id);
        const btn = document.getElementById('btn-collapse-' + id);
        
        if (content.style.maxHeight === '2000px') {
            content.style.maxHeight = ''; // reset to class default (140px)
            fade.style.opacity = '1';
            btn.innerHTML = 'Lihat selengkapnya <iconify-icon icon="lucide:chevron-down"></iconify-icon>';
        } else {
            content.style.maxHeight = '2000px';
            fade.style.opacity = '0';
            btn.innerHTML = 'Sembunyikan <iconify-icon icon="lucide:chevron-up"></iconify-icon>';
        }
    };

    window.changeMalam = function(id, delta) {
        if (!window.akoMalamState[id]) window.akoMalamState[id] = 1;
        let n = window.akoMalamState[id] + delta;
        if (n < 1) n = 1;
        window.akoMalamState[id] = n;
        
        const lbl = document.getElementById(`lbl-malam-${id}`);
        if(lbl) lbl.innerText = `${n} Malam`;

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

        let fasHtml='<div class="columns-1 xl:columns-2 gap-x-6 space-y-1.5 text-xs text-gray-700">';
        safeFasilitas.forEach(f=>fasHtml+=`<div class="flex items-start gap-1.5 break-words leading-relaxed break-inside-avoid"><span class="flex-shrink-0">•</span><span class="flex-1">${f}</span></div>`);fasHtml+='</div>';

        let makHtml=`<div class="flex flex-col gap-1 text-xs text-gray-700" id="makanan-list-${item.id}">`;
        safeMakanan.forEach(m=>{
            const isSarapan = m.toLowerCase().includes('sarapan') || m.toLowerCase().includes('breakfast');
            makHtml+=`<div class="flex items-start gap-1.5 break-words leading-relaxed ${isSarapan ? 'makanan-sarapan' : ''}"><span class="flex-shrink-0">•</span><span class="flex-1">${m}</span></div>`;
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
                    <div class="relative overflow-hidden transition-[max-height] duration-500 ease-in-out max-h-[140px] md:max-h-none" id="collapse-content-${item.id}">
                        <div class="flex flex-col md:flex-row gap-6 mt-3">
                            <div class="w-full md:w-[60%] xl:w-[65%]"><p class="text-xs font-bold text-gray-800 mb-1.5">Fasilitas Kamar:</p>${fasHtml}</div>
                            <div class="w-full md:w-[40%] xl:w-[35%]"><p class="text-xs font-bold text-gray-800 mb-1.5">Makanan & Minuman:</p>${makHtml}</div>
                        </div>
                        <div class="mt-3 p-3 bg-gradient-to-r from-[#e3d1b3]/60 to-transparent rounded-lg">
                            <p class="text-xs font-bold text-gray-800 mb-2">Catatan:</p>
                            <div class="flex flex-col gap-1.5">${catHtml}</div>
                        </div>
                        <div class="absolute bottom-0 left-0 w-full h-20 bg-gradient-to-t from-[#fdf6e3]/95 via-[#fdf6e3]/80 to-transparent md:hidden pointer-events-none transition-opacity duration-300" id="collapse-fade-${item.id}"></div>
                    </div>
                    <button class="md:hidden flex items-center justify-center w-full gap-1 text-xs font-bold text-[#3a523a] mt-2 py-2 hover:bg-gray-50 rounded-lg transition-colors border border-gray-200" id="btn-collapse-${item.id}" onclick="toggleCollapse(${item.id})">Lihat selengkapnya <iconify-icon icon="lucide:chevron-down"></iconify-icon></button>
                </div>
                <div class="flex flex-col pt-3 mt-1 border-t border-gray-100">
                    <!-- Top Row: Info Unit & Malam -->
                    <div class="flex flex-wrap items-center gap-2 md:gap-4 text-xs text-gray-700 font-medium">
                        <span class="flex items-center gap-1.5 whitespace-nowrap"><iconify-icon icon="lucide:user-check" class="text-base"></iconify-icon> Maks ${item.maxOrang} Dewasa</span>
                        ${slotHtml}
                        <span class="flex items-center gap-1.5 whitespace-nowrap text-blue-700 bg-blue-50 px-2 py-0.5 rounded font-bold text-xs" id="date-display-${item.id}">
                            <iconify-icon icon="lucide:moon" class="text-base"></iconify-icon> 
                            <span id="date-text-${item.id}">Belum pilih tanggal</span>
                        </span>
                    </div>

                    <!-- Middle Row: Sesuaikan Tanggal (Left) & Harga (Right) -->
                    <div class="flex items-start justify-between w-full mt-4">
                        <!-- Kiri: Sesuaikan Tanggal -->
                        <div class="shrink-0 pt-0.5">
                            <div style="display:none"><input type="hidden" id="fp-input-${item.id}"></div>
                            <button type="button" id="btn-dates-${item.id}" class="bg-white hover:bg-gray-50 border border-gray-300 text-gray-700 text-xs font-bold px-3 py-2 rounded-lg transition shadow-sm flex items-center gap-1.5 whitespace-nowrap">
                                <iconify-icon icon="lucide:calendar-days" class="text-sm"></iconify-icon>
                                <span id="btn-dates-text-${item.id}">Sesuaikan Tanggal</span>
                            </button>
                        </div>

                        <!-- Kanan: Harga -->
                        <div class="flex flex-col items-end text-right">
                            <div class="mb-1 flex items-center gap-1">
                                ${getActiveRate(item).label !== 'Weekday' ? `<div id="breakfast-badge-${item.id}" class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded bg-amber-50 border border-amber-200/60"><span class="text-[9px]">🍳</span><span class="text-[9px] font-semibold text-amber-700">Free Breakfast</span></div>` : ''}
                                <span id="rate-badge-${item.id}" class="text-[9px] font-bold text-white px-1.5 py-0.5 rounded" style="background-color:${getActiveRate(item).color}">${getActiveRate(item).label}</span>
                            </div>
                            <div class="flex items-center gap-1.5 mt-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-gray-400 cursor-pointer hover:text-[#B5793A] transition" fill="currentColor" viewBox="0 0 24 24" onclick="openPriceInfoModal(${item.id})"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                                <div id="price-val-${item.id}" class="${item.hargaWeekday.toString().length >= 7 ? 'text-xl md:text-2xl' : 'text-2xl md:text-3xl'} font-extrabold text-[#e53e3e] leading-none">${fmt(calculateDynamicTotal(item, window.akoMalamState[item.id] || 1))}</div>
                            </div>
                            <div class="text-[9px] text-gray-400 italic mt-1">Total Harga</div>
                        </div>
                    </div>

                    <!-- Bottom Row: Pilih Kamar -->
                    <div class="w-full mt-3 flex justify-end" id="btn-pilih-wrap-${item.id}">
                        ${item._isBooked 
                            ? `<button disabled class="bg-gray-400 text-white text-sm font-bold w-full md:w-auto px-6 py-2.5 rounded-lg shadow cursor-not-allowed">Sudah Dibooking</button>`
                            : `<button onclick="handlePilihKamar(${item.id})" id="btn-pilih-${item.id}" class="bg-[#3a523a] hover:bg-[#2c402c] text-white text-sm font-bold w-full md:w-auto px-6 py-2.5 rounded-lg transition shadow cursor-pointer">Pilih Kamar</button>`
                        }
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

        // Initialize Flatpickr per card
        pageData.forEach(item => {
            const btn = document.getElementById(`btn-dates-${item.id}`);
            const input = document.getElementById(`fp-input-${item.id}`);
            if(!btn || !input) return;

            let preselected = window.akoDateState[item.id] || [];

            const fp = flatpickr(input, {
                mode: "range",
                minDate: "today",
                showMonths: window.innerWidth > 768 ? 2 : 1,
                defaultDate: preselected,
                positionElement: btn,
                position: window.innerWidth > 768 ? "top left" : "auto",
                disable: [
                    function(date) {
                        return window.isDateFullyBooked(item, date);
                    }
                ],
                onDayCreate: function(dObj, dStr, fp, dayElem) {
                    const today = new Date();
                    today.setHours(0, 0, 0, 0);
                    if (dayElem.dateObj >= today && window.isDateFullyBooked(item, dayElem.dateObj)) {
                        dayElem.classList.add('booked-date');
                    }
                },
                onReady: function(selectedDates, dateStr, instance) {
                    btn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        instance.toggle();
                    });
                },
                onChange: function(selectedDates, dateStr, instance) {
                    if (selectedDates.length === 2) {
                        window.akoDateState[item.id] = selectedDates;
                        const diffTime = Math.abs(selectedDates[1] - selectedDates[0]);
                        const diffNights = Math.max(1, Math.ceil(diffTime / (1000 * 60 * 60 * 24)));
                        
                        window.akoMalamState[item.id] = diffNights;

                        const fmtOptions = { day: 'numeric', month: 'short', year: '2-digit' };
                        const inStr = selectedDates[0].toLocaleDateString('id-ID', fmtOptions);
                        const outStr = selectedDates[1].toLocaleDateString('id-ID', fmtOptions);
                        
                        const disp = document.getElementById(`date-text-${item.id}`);
                        if(disp) disp.innerText = `${diffNights} Malam`;

                        const btnTxt = document.getElementById(`btn-dates-text-${item.id}`);
                        if(btnTxt) btnTxt.innerText = `${inStr} - ${outStr}`;

                        item._isBooked = false;
                        const btnPilihWrap = document.getElementById(`btn-pilih-wrap-${item.id}`);
                        if (btnPilihWrap) {
                            btnPilihWrap.innerHTML = `<button onclick="handlePilihKamar(${item.id})" id="btn-pilih-${item.id}" class="bg-[#3a523a] hover:bg-[#2c402c] text-white text-sm font-bold w-full md:w-auto px-6 py-2.5 rounded-lg transition shadow cursor-pointer">Pilih Kamar</button>`;
                        }

                        updateAllPrices();

                        setTimeout(() => { instance.close(); }, 300);
                    }
                }
            });

            // Initial label setup
            if (preselected.length === 2) {
                const diffTime = Math.abs(preselected[1] - preselected[0]);
                const diffNights = Math.max(1, Math.ceil(diffTime / (1000 * 60 * 60 * 24)));
                const fmtOptions = { day: 'numeric', month: 'short', year: '2-digit' };
                const inStr = preselected[0].toLocaleDateString('id-ID', fmtOptions);
                const outStr = preselected[1].toLocaleDateString('id-ID', fmtOptions);
                
                const disp = document.getElementById(`date-text-${item.id}`);
                if(disp) disp.innerText = `${diffNights} Malam`;

                const btnTxt = document.getElementById(`btn-dates-text-${item.id}`);
                if(btnTxt) btnTxt.innerText = `${inStr} - ${outStr}`;
            }
        });
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
        doFilter(); // Auto-filter on guest change
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
        if(valDewasa > 1) { valDewasa--; document.getElementById('valDewasa').innerText = valDewasa; updateGuestLabel(); doFilter(); }
    });
    document.getElementById('btnIncDewasa').addEventListener('click', () => {
        valDewasa++; document.getElementById('valDewasa').innerText = valDewasa; updateGuestLabel(); doFilter();
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

        filteredData = AKOMODASI_DATA.filter(d => {
            // Jenis
            let matchJenis = true;
            if (j && j !== 'Semua Akomodasi' && j !== 'Cabin / Glamping') {
                matchJenis = (d.jenis === j);
            }
            // Tamu (Kapasitas Akomodasi >= Jumlah Tamu)
            let matchTamu = (d.maxOrang >= targetDewasa);

            return matchJenis && matchTamu;
        });

        currentPage = 1;
        render();
    }


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
                doFilter(); // Auto-filter on selection
            });
        });

        document.addEventListener('click', (e) => {
            if(!document.getElementById('akomodasiPickerContainer').contains(e.target)) {
                akoDropdown.classList.add('hidden');
                if(akoChevron) akoChevron.classList.remove('rotate-180');
            }
        });
    }

    // Parse URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const paramJenis = urlParams.get('jenis');
    const paramDewasa = urlParams.get('dewasa');
    const paramKamar = urlParams.get('kamar');
    const paramTgl = urlParams.get('tgl');

    if (paramJenis) {
        if(akoInput) akoInput.value = paramJenis;
        if(akoLabel) akoLabel.innerText = paramJenis;
    }
    if (paramDewasa) {
        valDewasa = parseInt(paramDewasa) || 2;
        const valDewasaEl = document.getElementById('valDewasa');
        if (valDewasaEl) valDewasaEl.innerText = valDewasa;
    }
    updateGuestLabel();

    if (paramTgl) {
        const parts = paramTgl.split(' to ');
        if (parts.length === 2) {
            const inDate = new Date(parts[0]);
            const outDate = new Date(parts[1]);
            if (!isNaN(inDate) && !isNaN(outDate)) {
                AKOMODASI_DATA.forEach(d => {
                    const diffTime = Math.abs(outDate - inDate);
                    const diffNights = Math.max(1, Math.ceil(diffTime / (1000 * 60 * 60 * 24)));
                    
                    const isBookedStatus = isBooked(d, [inDate, outDate]);
                    d._isBooked = isBookedStatus;
                    
                    // Only pre-fill dates for available accommodations
                    if (!isBookedStatus) {
                        window.akoDateState[d.id] = [new Date(inDate), new Date(outDate)];
                        window.akoMalamState[d.id] = diffNights;
                    }
                });
            }
        }
    }
    
    // Initial Filter
    // Allow flatpickr to initialize if it's deferred
    setTimeout(doFilter, 100);

    // ── Pilih Kamar — auth gate ──────────────────────────────────
    window.handlePilihKamar = function(itemId) {
        const malam = window.akoMalamState[itemId] || 1;
        const selectedDates = window.akoDateState[itemId];
        const isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
        
        if (!selectedDates || selectedDates.length !== 2) {
            // Trigger flatpickr open as a hint, or just alert
            const fpInput = document.getElementById(`fp-input-${itemId}`);
            if (fpInput && fpInput._flatpickr) {
                fpInput._flatpickr.open();
            } else {
                alert('Silakan sesuaikan rentang tanggal (Check-in dan Check-out) terlebih dahulu.');
            }
            return;
        }
        
        const d = selectedDates[0];
        const year = d.getFullYear();
        const month = String(d.getMonth() + 1).padStart(2, '0');
        const day = String(d.getDate()).padStart(2, '0');
        const tglParam = `&checkin=${year}-${month}-${day}`;
        
        const targetUrl = '/reservasi/overview/' + itemId + '?malam=' + malam + tglParam;

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
