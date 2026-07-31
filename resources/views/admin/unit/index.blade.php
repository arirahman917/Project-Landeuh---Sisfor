@extends('layouts.admin')
@section('content')

{{-- ============================================================
     ADMIN UNIT / DATA KAMAR — index.blade.php
     Letakkan di: resources/views/admin/unit/index.blade.php
     Pastikan layouts/admin.blade.php sudah @include sidebar & topbar
     ============================================================ --}}

@include('admin.unit._modal-tambah')
@include('admin.unit._modal-edit')
@include('admin.unit._modal-delete')
@include('admin.unit._modal-libur')

{{-- ── STAT CARDS ────────────────────────────────────────────── --}}
<div class="grid grid-cols-2 gap-4 mb-6">
    <div class="bg-[#fdf6e3]/80 backdrop-blur-sm rounded-2xl border border-amber-200/60 shadow-sm p-5 flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-[#3a523a]/10 flex items-center justify-center shrink-0">
            <iconify-icon icon="lucide:hotel" class="text-2xl text-[#3a523a]"></iconify-icon>
        </div>
        <div>
            <p class="text-xs font-semibold text-stone-500 tracking-wider uppercase">Jumlah Unit</p>
            <p class="text-3xl font-extrabold text-stone-800 leading-tight" id="statJumlahUnit">—</p>
        </div>
    </div>
    <div class="bg-[#fdf6e3]/80 backdrop-blur-sm rounded-2xl border border-amber-200/60 shadow-sm p-5 flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-amber-400/15 flex items-center justify-center shrink-0">
            <iconify-icon icon="lucide:layout-grid" class="text-2xl text-amber-600"></iconify-icon>
        </div>
        <div>
            <p class="text-xs font-semibold text-stone-500 tracking-wider uppercase">Jumlah Tersedia Malam Ini</p>
            <p class="text-3xl font-extrabold text-stone-800 leading-tight" id="statTersedia">—</p>
        </div>
    </div>
</div>

{{-- ── TOOLBAR ───────────────────────────────────────────────── --}}
<div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mb-5">

    {{-- Search --}}
    <div class="relative flex-1 max-w-xs">
        <span class="absolute inset-y-0 left-3.5 flex items-center text-stone-400 pointer-events-none">
            <iconify-icon icon="lucide:search" class="text-base"></iconify-icon>
        </span>
        <input type="text" id="searchInput" placeholder="Cari nama kamar…"
            class="w-full pl-9 pr-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm
                   placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
    </div>

    {{-- Filter Jenis Custom Dropdown --}}
    <div class="relative select-none" id="customFilterJenis">
        <div id="filterJenisDisplay"
            class="flex items-center min-w-[170px] pl-4 pr-9 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-700 text-sm font-medium
                   hover:bg-amber-50 hover:border-amber-300 transition cursor-pointer">
            Semua Jenis
        </div>
        <span class="absolute inset-y-0 right-3 flex items-center text-stone-400 pointer-events-none">
            <iconify-icon icon="lucide:chevron-down" class="text-sm"></iconify-icon>
        </span>
        <div id="filterJenisOptions"
            class="custom-dropdown-options absolute z-50 mt-2 w-full min-w-[180px] bg-white rounded-2xl shadow-[0_10px_40px_-10px_rgba(0,0,0,0.15)] border border-stone-100 hidden opacity-0 transition-opacity duration-200 overflow-hidden">
            <div class="py-2 flex flex-col">
                <div class="px-4 py-2.5 text-sm font-medium text-stone-600 hover:bg-amber-50 hover:text-amber-700 cursor-pointer transition-colors" data-value="">Semua Jenis</div>
                <div class="px-4 py-2.5 text-sm font-medium text-stone-600 hover:bg-amber-50 hover:text-amber-700 cursor-pointer transition-colors" data-value="Cabin">Cabin</div>
                <div class="px-4 py-2.5 text-sm font-medium text-stone-600 hover:bg-amber-50 hover:text-amber-700 cursor-pointer transition-colors" data-value="Rumah Industrial">Rumah Industrial</div>
                <div class="px-4 py-2.5 text-sm font-medium text-stone-600 hover:bg-amber-50 hover:text-amber-700 cursor-pointer transition-colors" data-value="Glamping">Glamping</div>
            </div>
        </div>
        <input type="hidden" id="filterJenisAdmin" value="">
    </div>

    {{-- Sort Custom Dropdown --}}
    <div class="relative select-none" id="customSort">
        <div id="sortDisplay"
            class="flex items-center min-w-[180px] pl-9 pr-8 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-700 text-sm font-medium
                   hover:bg-amber-50 hover:border-amber-300 transition cursor-pointer">
            Nama A → Z
        </div>
        <span class="absolute inset-y-0 left-3 flex items-center text-stone-400 pointer-events-none">
            <iconify-icon icon="lucide:arrow-up-down" class="text-sm"></iconify-icon>
        </span>
        <span class="absolute inset-y-0 right-3 flex items-center text-stone-400 pointer-events-none">
            <iconify-icon icon="lucide:chevron-down" class="text-sm"></iconify-icon>
        </span>
        <div id="sortOptions"
            class="custom-dropdown-options absolute z-50 mt-2 w-full min-w-[190px] right-0 bg-white rounded-2xl shadow-[0_10px_40px_-10px_rgba(0,0,0,0.15)] border border-stone-100 hidden opacity-0 transition-opacity duration-200 overflow-hidden">
            <div class="py-2 flex flex-col">
                <div class="px-4 py-2.5 text-sm font-medium text-stone-600 hover:bg-amber-50 hover:text-amber-700 cursor-pointer transition-colors" data-value="terbaru">Terbaru</div>
                <div class="px-4 py-2.5 text-sm font-medium text-stone-600 hover:bg-amber-50 hover:text-amber-700 cursor-pointer transition-colors" data-value="nama-az">Nama A → Z</div>
                <div class="px-4 py-2.5 text-sm font-medium text-stone-600 hover:bg-amber-50 hover:text-amber-700 cursor-pointer transition-colors" data-value="nama-za">Nama Z → A</div>
                <div class="px-4 py-2.5 text-sm font-medium text-stone-600 hover:bg-amber-50 hover:text-amber-700 cursor-pointer transition-colors" data-value="harga-asc">Harga Terendah</div>
                <div class="px-4 py-2.5 text-sm font-medium text-stone-600 hover:bg-amber-50 hover:text-amber-700 cursor-pointer transition-colors" data-value="harga-desc">Harga Tertinggi</div>
            </div>
        </div>
        <input type="hidden" id="sortSelect" value="nama-az">
    </div>

    {{-- Spacer --}}
    <div class="flex-1 hidden sm:block"></div>

    {{-- Liburkan Kamar --}}
    <button onclick="openModalLiburkanKamar()"
        class="flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-sm text-red-700 bg-red-50 border border-red-200 hover:bg-red-100 transition-all active:scale-[0.98] whitespace-nowrap shadow-sm mr-2">
        <iconify-icon icon="lucide:calendar-off" class="text-base text-red-500"></iconify-icon>
        Liburkan Kamar
    </button>

    {{-- Tambah Kamar --}}
    <button onclick="openModalTambah()"
        class="flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-sm text-[#fdf6e3]
               bg-gradient-to-r from-[#2d4a2d] to-[#3d6b3d]
               hover:from-[#3d6b3d] hover:to-[#4a824a]
               shadow-lg shadow-green-900/20 transition-all active:scale-[0.98] whitespace-nowrap">
        <iconify-icon icon="lucide:plus" class="text-base"></iconify-icon>
        Tambah Kamar
    </button>
</div>

{{-- ── UNIT LIST ──────────────────────────────────────────────── --}}
<div id="unitList" class="flex flex-col gap-5 relative z-10"></div>

{{-- ── PAGINATION ─────────────────────────────────────────────── --}}
<div id="paginationWrapper" class="flex items-center justify-between mt-8 mb-4 hidden">
    <div id="btnKembaliWrap"></div>
    <div id="paginationControls" class="flex items-center gap-1 flex-1 justify-center"></div>
    <div id="btnNextWrap" class="min-w-[110px] text-right"></div>
</div>

{{-- ── TOAST ──────────────────────────────────────────────────── --}}
<div id="adminToast"
    class="fixed bottom-6 right-6 z-[200] flex items-center gap-3 px-5 py-3.5 rounded-2xl shadow-xl
           bg-[#1e2d1e] text-white text-sm font-medium opacity-0 pointer-events-none transition-all duration-300"
>
    <iconify-icon icon="lucide:check-circle" class="text-green-400 text-lg shrink-0"></iconify-icon>
    <span id="adminToastMsg">Berhasil!</span>
</div>

{{-- ── MODAL KALENDER TRACKING ────────────────────────────────── --}}
<div id="modalKalender" class="fixed inset-0 z-[9999] bg-black/30 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
    {{-- Inline flatpickr calendar --}}
    <div id="kalenderInline" class="flex justify-center scale-90 transition-transform duration-300"></div>
</div>

{{-- Template Keterangan / Legend (Akan disuntikkan ke dalam kalender) --}}
<template id="kalenderLegendTemplate">
    <div class="mt-2 pt-3 border-t border-stone-200 w-full px-4 pb-3">
        <div class="flex flex-col items-center gap-2">
            <div class="flex flex-wrap items-center justify-center gap-x-6 gap-y-2">
                <div class="flex items-center gap-1.5">
                    <div class="w-4 h-4 rounded-full bg-[#e5e7eb] shrink-0 relative flex items-center justify-center">
                        <div class="w-full h-px bg-[#9ca3af] absolute"></div>
                    </div>
                    <span class="text-[11px] text-stone-600 font-medium leading-tight">Pesanan Reguler</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <div class="w-4 h-4 rounded-full bg-indigo-100 shrink-0 relative flex items-center justify-center">
                        <div class="w-full h-px bg-indigo-700 absolute"></div>
                    </div>
                    <span class="text-[11px] text-stone-600 font-medium leading-tight">Paket Corporate</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <div class="w-4 h-4 rounded-full bg-red-100 shrink-0 relative flex items-center justify-center">
                        <div class="w-full h-px bg-red-500 absolute"></div>
                    </div>
                    <span class="text-[11px] text-stone-600 font-medium leading-tight">Libur / Diblokir</span>
                </div>
            </div>
            <div class="text-[10px] text-stone-400 italic">
                * Unit tidak tersedia untuk dipesan pada tanggal yang ditandai
            </div>
        </div>
    </div>
</template>

<style>
.unit-card {
    background: rgba(253,246,227,0.65);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.45);
    border-radius: 1rem;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    transition: transform 0.2s, box-shadow 0.2s;
}
.unit-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(0,0,0,0.1);
}
.unit-img-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-template-rows: 5fr 3fr;
    gap: 2px;
    width: 260px;
    min-width: 260px;
    align-self: stretch;
    overflow: hidden;
    cursor: pointer;
}
.unit-img-grid .img-main  { grid-column: span 3; overflow: hidden; position: relative; }
.unit-img-grid .img-thumb { overflow: hidden; position: relative; }
.unit-img-grid img {
    position: absolute; inset: 0; width: 100%; height: 100%;
    object-fit: cover; transition: transform 0.3s;
}
.unit-img-grid img:hover { transform: scale(1.06); }
.unit-img-grid .overlay-label {
    position: absolute; inset: 0;
    background: rgba(0,0,0,0.42);
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 0.72rem; font-weight: 600;
}
.booked-badge {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 2px 10px; border-radius: 8px;
    background: #fef2f2; color: #dc2626;
    font-size: 11px; font-weight: 600;
    border: 1px solid #fecaca;
}
.available-badge {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 2px 10px; border-radius: 8px;
    background: #f0fdf4; color: #16a34a;
    font-size: 11px; font-weight: 600;
    border: 1px solid #bbf7d0;
}
/* Flatpickr booked-date styling for admin calendar tracking */
.flatpickr-day.flatpickr-disabled.booked-date {
    background-color: #e5e7eb !important;
    border-color: transparent !important;
    color: #9ca3af !important;
    border-radius: 50% !important;
    text-decoration: line-through;
}
.flatpickr-day.flatpickr-disabled.corporate-booked-date {
    background-color: #e0e7ff !important; /* indigo-100 */
    color: #4338ca !important; /* indigo-700 */
}
.flatpickr-day.flatpickr-disabled.holiday-booked-date {
    background-color: #fee2e2 !important; /* red-100 */
    color: #ef4444 !important; /* red-500 */
}
#kalenderInline .flatpickr-calendar {
    box-shadow: none !important;
    border: 1px solid #e7e5e4 !important;
    border-radius: 0.75rem !important;
}
/* Read-only: no selection styling, no active state, hover only */
#kalenderInline .flatpickr-day:not(.flatpickr-disabled) {
    cursor: default !important;
}
#kalenderInline .flatpickr-day.today {
    background: transparent !important;
    border-color: transparent !important;
    color: #44403c !important;
}
#kalenderInline .flatpickr-day:not(.flatpickr-disabled):hover,
#kalenderInline .flatpickr-day.today:not(.flatpickr-disabled):hover {
    background: #f3f4f6 !important;
    border-color: #e5e7eb !important;
    color: #374151 !important;
}
#kalenderInline .flatpickr-day.selected,
#kalenderInline .flatpickr-day.startRange,
#kalenderInline .flatpickr-day.endRange,
#kalenderInline .flatpickr-day.selected:hover,
#kalenderInline .flatpickr-day.startRange:hover,
#kalenderInline .flatpickr-day.endRange:hover {
    background: transparent !important;
    color: #44403c !important;
    border-color: transparent !important;
    box-shadow: none !important;
}
#kalenderInline .flatpickr-day:active {
    background: #e5e7eb !important;
    box-shadow: none !important;
}
@media (max-width: 768px) {
    .unit-img-grid { width: 100%; min-width: unset; height: 200px; border-radius: 0.75rem 0.75rem 0 0; }
}
</style>

@push('scripts')
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script>
    const AKOMODASI_DATA = @json($accommodations);
    const DATE_SETTINGS = @json($dateSettings ?? []);
</script>
<script>
(function () {
    const PER_PAGE  = 5;
    let hashPage    = parseInt(window.location.hash.replace('#page=', ''));
    let currentPage = hashPage ? hashPage : 1;
    let filteredData = [];
    let sortMode     = sessionStorage.getItem('adminSortMode') || 'nama-az';
    const basePath   = "{{ asset('images/akomodasi') }}";
    const imgs       = ['a.png','b.png','c.png','d.png'];

    // ── Format Rupiah ──────────────────────────────────────────
    function fmt(n) {
        return 'IDR ' + Number(n).toLocaleString('id-ID');
    }

    // ── Format Image URL ───────────────────────────────────────
    function formatImgUrl(url) {
        if (!url) return '';
        if (typeof url !== 'string') {
            try {
                if (Array.isArray(url) && url.length > 0) return formatImgUrl(url[0]);
                url = String(url);
            } catch(e) {
                return '';
            }
        }
        
        url = url.replace(/\\/g, '');
        url = url.replace(/"/g, '');
        url = url.replace(/'/g, '');
        url = url.replace(/\[/g, '');
        url = url.replace(/\]/g, '');

        if (url.includes(',')) {
            url = url.split(',')[0].trim();
        }

        if (url.startsWith('http') || url.startsWith('data:')) return url;
        return url.startsWith('/') ? url : '/' + url;
    }
    window.formatImgUrl = formatImgUrl;

    // Helper to parse date strictly in local time (00:00:00) to prevent timezone/hour shifting bugs
    function parseToLocalDate(dateInput) {
        if (!dateInput) return null;
        let str = "";
        if (typeof dateInput === 'string') {
            str = dateInput.split(/[T ]/)[0]; // Ambil bagian tanggal saja, misal "2026-05-29"
        } else {
            const d = new Date(dateInput);
            const y = d.getFullYear();
            const m = String(d.getMonth() + 1).padStart(2, '0');
            const r = String(d.getDate()).padStart(2, '0');
            str = `${y}-${m}-${r}`;
        }
        const [year, month, day] = str.split('-').map(Number);
        return new Date(year, month - 1, day, 0, 0, 0, 0);
    }

    // ── Toast ──────────────────────────────────────────────────
    function showToast(msg, icon = 'lucide:check-circle', color = 'text-green-400') {
        const t = document.getElementById('adminToast');
        const m = document.getElementById('adminToastMsg');
        const i = t.querySelector('iconify-icon');
        m.textContent = msg;
        i.setAttribute('icon', icon);
        i.className = `${color} text-lg shrink-0`;
        t.style.opacity = '1';
        t.style.transform = 'translateY(0)';
        setTimeout(() => { t.style.opacity = '0'; }, 2500);
    }
    window.showToast = showToast;

    function renderCard(item, no) {
        const today = parseToLocalDate(new Date());
        const todayTime = today.getTime();

        const activeBookingsToday = (item.bookings || []).filter(b => {
            if (b.status === 'failed' || b.status === 'refunded') return false;
            const bIn = parseToLocalDate(b.check_in_date);
            const bOut = parseToLocalDate(b.check_out_date);
            return todayTime >= bIn.getTime() && todayTime < bOut.getTime();
        });

        const countBookedToday = activeBookingsToday.length;
        const countTersediaToday = Math.max(0, item.slot - countBookedToday);

        // Filter booked dates to show only active current & future bookings (check_out > today)
        const currentAndFutureBookings = (item.bookings || []).filter(b => {
            if (b.status === 'failed' || b.status === 'refunded') return false;
            const bOut = parseToLocalDate(b.check_out_date);
            return bOut.getTime() > todayTime;
        });

        const slotLabel = item.jenis === 'Glamping'
            ? `Sisa ${item.slot} Unit Tenda`
            : `Sisa ${item.slot} Unit`;

        // ── Month color palette (matching reference) ──────────────
        const MONTH_COLORS = [
            { name: 'Januari',   bg: '#FFE0E0', text: '#CC3333', border: '#FFBBBB' },
            { name: 'Februari',  bg: '#DDEAFF', text: '#335599', border: '#B8D0FF' },
            { name: 'Maret',     bg: '#DDFCE0', text: '#1E8C30', border: '#B0E8B8' },
            { name: 'April',     bg: '#FFF6DD', text: '#BB7711', border: '#FFE8AA' },
            { name: 'Mei',       bg: '#E6FFDD', text: '#3D9900', border: '#C0F0A0' },
            { name: 'Juni',      bg: '#EEDDFF', text: '#7733BB', border: '#DDBBFF' },
            { name: 'Juli',      bg: '#DDF0FF', text: '#2266AA', border: '#AADDFF' },
            { name: 'Agustus',   bg: '#FFE5EE', text: '#CC2266', border: '#FFBBCC' },
            { name: 'September', bg: '#FFF0DD', text: '#CC6600', border: '#FFDDAA' },
            { name: 'Oktober',   bg: '#FCFCE0', text: '#7A7A00', border: '#EEE8A0' },
            { name: 'November',  bg: '#FFDDF5', text: '#BB2288', border: '#FFBBDD' },
            { name: 'Desember',  bg: '#DEE0FF', text: '#4444CC', border: '#C0C8FF' },
        ];
        const MONTH_SHORT = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agt','Sep','Okt','Nov','Des'];

        // Booked date badges — grouped by check-in month, color-coded (Accordion Style)
        let bookedBadgesHtml = '';
        if (currentAndFutureBookings.length > 0) {
            // Sort bookings by check-in date ascending
            const sorted = [...currentAndFutureBookings].sort((a, b) => {
                return parseToLocalDate(a.check_in_date).getTime() - parseToLocalDate(b.check_in_date).getTime();
            });

            const fmtDate = (d) => {
                const dd = String(d.getDate()).padStart(2, '0');
                const mm = String(d.getMonth() + 1).padStart(2, '0');
                const yyyy = d.getFullYear();
                return `${dd}-${mm}-${yyyy}`;
            };

            const groups = {};
            sorted.forEach(b => {
                const bIn = parseToLocalDate(b.check_in_date);
                const key = `${bIn.getFullYear()}-${String(bIn.getMonth()).padStart(2,'0')}`;
                if (!groups[key]) groups[key] = { month: bIn.getMonth(), year: bIn.getFullYear(), bookings: [] };
                groups[key].bookings.push(b);
            });

            const currentMonthKey = `${today.getFullYear()}-${String(today.getMonth()).padStart(2,'0')}`;
            let isFirstGroup = true;

            const accordionsHtml = Object.keys(groups).sort().map(key => {
                const g = groups[key];
                const c = MONTH_COLORS[g.month];
                const monthLabel = `${MONTH_SHORT[g.month]} ${g.year}`;
                
                // Open if it's the current month, OR if it's the first group and current month isn't here
                const isOpen = (key === currentMonthKey) || (isFirstGroup && !groups[currentMonthKey]);
                isFirstGroup = false;

                const badges = g.bookings.map(b => {
                    const bIn = parseToLocalDate(b.check_in_date);
                    const bOut = parseToLocalDate(b.check_out_date);
                    
                    if (b.is_corporate) {
                        const displayStr = `${fmtDate(bIn)} &rarr; ${fmtDate(bOut)} ▪ Paket Corp. ${b.corporate_label} (${b.pemesan_nama || 'Tamu'})`;
                        return `<span class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg shadow-sm text-[10px] font-semibold bg-indigo-50 text-indigo-700 border border-indigo-300 border-dashed">
                            <iconify-icon icon="lucide:building-2" class="text-[11px]"></iconify-icon>${displayStr}
                        </span>`;
                    } else {
                        const displayStr = `${fmtDate(bIn)} &rarr; ${fmtDate(bOut)} (${b.pemesan_nama || 'Tamu'})`;
                        return `<span style="background:${c.bg}; color:${c.text}; border:1px solid ${c.border};"
                            class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg shadow-sm text-[10px] font-semibold whitespace-nowrap">
                            ${displayStr}
                        </span>`;
                    }
                }).join('');

                return `
                <div class="border border-stone-200/60 rounded-xl overflow-hidden bg-white/40 shadow-sm">
                    <div class="px-3 py-2 bg-stone-50/80 cursor-pointer flex justify-between items-center hover:bg-stone-100 transition" 
                         onclick="this.nextElementSibling.classList.toggle('hidden'); this.querySelector('.chevron').classList.toggle('rotate-180')">
                        <div class="flex items-center gap-2">
                            <span style="background:${c.text}; color:#fff;" class="inline-flex items-center gap-1 px-2 py-1 rounded-md text-[9px] font-bold tracking-wide whitespace-nowrap shadow-sm">
                                <iconify-icon icon="lucide:calendar-days" class="text-[10px]"></iconify-icon>${monthLabel}
                            </span>
                            <span class="text-[11px] font-bold text-stone-600">${g.bookings.length} booking</span>
                        </div>
                        <iconify-icon icon="lucide:chevron-down" class="chevron text-stone-400 transition-transform duration-200 ${isOpen ? 'rotate-180' : ''}"></iconify-icon>
                    </div>
                    <div class="${isOpen ? '' : 'hidden'} border-t border-stone-100 p-2.5 flex flex-col gap-1.5">
                        ${badges}
                    </div>
                </div>`;
            }).join('');

            bookedBadgesHtml = `<div class="flex flex-col gap-2 mt-1">${accordionsHtml}</div>`;
        }

        // Table rows
        const tableRows = [
            ['Jenis Akomodasi',    item.jenis],
            ['Jenis Kasur',        item.kasur],
            ['Boleh merokok di kamar', item.merokok
                ? '<span style="color:#16a34a;font-weight:600">Ya</span>'
                : '<span style="color:#dc2626;font-weight:600">Tidak</span>'],
            ['Fasilitas Kamar',    item.fasilitas.join(', ')],
            ['Makanan & Minuman',  item.makanan.join(', ')],
            ['Untuk berapa orang', `Maks ${item.max_orang} Dewasa`],
            ['Slot',               item.slot],
            ['Harga Weekday',      `[${fmt(item.harga_weekday)}, "Tanpa Breakfast"]`],
            ['Harga Weekend',      `[${fmt(item.harga_weekend)}, "Free Breakfast ${item.max_orang} pax"]`],
            ['Harga Highseason',   `[${fmt(item.harga_highseason)}, "Free Breakfast ${item.max_orang} pax"]`],
            ['Catatan Khusus',     Array.isArray(item.catatan) && item.catatan.length > 0 ? item.catatan.join(', ') : '-'],
        ].map(([label, val]) => `
            <tr class="border-b border-stone-100 last:border-0">
                <td class="py-2 pr-3 text-xs font-semibold text-stone-600 whitespace-nowrap align-top">${label}</td>
                <td class="py-2 text-xs text-stone-800">${val}</td>
            </tr>`
        ).join('');

        return `
        <div class="unit-card flex flex-col md:flex-row" data-id="${item.id}">
            {{-- Number badge --}}
            <div class="hidden md:flex items-center justify-center w-10 shrink-0 font-bold text-stone-400 text-base self-center">
                ${no}
            </div>

            {{-- Image grid --}}
            <div class="unit-img-grid" onclick="openLightbox(${item.id})">
                <div class="img-main"><img src="${formatImgUrl(Array.isArray(item.gambar) && item.gambar.length > 0 ? item.gambar[0] : item.gambar)}" alt="${item.judul}" loading="lazy"></div>
                <div class="img-thumb"><img src="${formatImgUrl(Array.isArray(item.gambar) && item.gambar.length > 1 ? item.gambar[1] : (Array.isArray(item.gambar) && item.gambar.length > 0 ? item.gambar[0] : item.gambar))}" alt="" loading="lazy"></div>
                <div class="img-thumb"><img src="${formatImgUrl(Array.isArray(item.gambar) && item.gambar.length > 2 ? item.gambar[2] : (Array.isArray(item.gambar) && item.gambar.length > 0 ? item.gambar[0] : item.gambar))}" alt="" loading="lazy"></div>
                <div class="img-thumb" style="position:relative">
                    <img src="${formatImgUrl(Array.isArray(item.gambar) && item.gambar.length > 3 ? item.gambar[3] : (Array.isArray(item.gambar) && item.gambar.length > 0 ? item.gambar[0] : item.gambar))}" alt="" loading="lazy">
                    <div class="overlay-label"><span>Lihat foto</span></div>
                </div>
            </div>

            {{-- Content --}}
            <div class="flex-1 p-4 md:p-5 flex flex-col gap-3 min-w-0">
                <div class="flex items-start justify-between gap-2">
                    <h3 class="text-base font-bold text-stone-900">${item.judul}</h3>
                    <div class="flex items-center gap-1.5 shrink-0">
                        ${hasBlockedPeriods(item) ? `
                        <button onclick="openModalListLibur(${item.id})"
                            class="inline-flex items-center gap-1 text-[10px] font-bold px-2.5 py-1 rounded-lg bg-red-50 hover:bg-red-100 text-red-700 border border-red-200 shadow-sm whitespace-nowrap transition cursor-pointer active:scale-95">
                            <iconify-icon icon="lucide:calendar-off" class="text-xs"></iconify-icon> Tanggal Libur/Blokir
                        </button>
                        ` : ''}
                        <span class="text-[11px] font-semibold px-2.5 py-1 rounded-lg
                            ${item.jenis === 'Cabin'
                                ? 'bg-blue-50 text-blue-700'
                                : item.jenis === 'Glamping'
                                ? 'bg-emerald-50 text-emerald-700'
                                : 'bg-orange-50 text-orange-700'}">
                            ${item.jenis}
                        </span>
                        ${checkIsCurrentlyLibur(item) ? `
                            <span class="inline-flex items-center gap-1 text-[10px] font-bold px-2.5 py-1 rounded-lg bg-red-50 text-red-700 border border-red-200 shadow-sm whitespace-nowrap">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span>Sedang Libur
                            </span>
                        ` : ''}
                    </div>
                </div>

                {{-- Availability badges --}}
                <div class="flex flex-col gap-2">
                    <div class="flex flex-wrap items-center gap-2">
                        <div class="available-badge">
                            <iconify-icon icon="lucide:check-circle" class="text-xs"></iconify-icon>
                            Tersedia Malam Ini : ${countTersediaToday}
                        </div>
                        <div class="booked-badge">
                            <iconify-icon icon="lucide:calendar-x" class="text-xs"></iconify-icon>
                            Terisi Malam Ini : ${countBookedToday}
                        </div>
                    </div>
                    ${currentAndFutureBookings.length > 0 ? `<div class="flex flex-col gap-2">${bookedBadgesHtml}</div>` : ''}
                </div>

                {{-- Detail table --}}
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[280px]">${tableRows}</table>
                </div>

                {{-- Actions --}}
                <div class="flex items-center gap-2 pt-1">
                    <button onclick="openKalenderModal(${item.id})"
                        class="flex items-center gap-1.5 px-4 py-2 rounded-lg text-xs font-bold
                               text-white bg-[#3a523a] hover:bg-[#2c402c] transition shadow-sm active:scale-[0.97]">
                        <iconify-icon icon="lucide:calendar-search" class="text-sm"></iconify-icon>
                        Lihat Kalender
                    </button>
                    <button onclick="openModalEdit(${item.id})"
                        class="flex items-center gap-1.5 px-4 py-2 rounded-lg text-xs font-bold
                               text-white bg-amber-500 hover:bg-amber-600 transition shadow-sm active:scale-[0.97]">
                        <iconify-icon icon="lucide:pencil" class="text-sm"></iconify-icon>
                        Edit Info
                    </button>
                    <button onclick="openDeleteModal(${item.id}, '${item.judul.replace(/'/g, "\\'")}')"
                        class="flex items-center gap-1.5 px-4 py-2 rounded-lg text-xs font-bold
                               text-white bg-red-500 hover:bg-red-600 transition shadow-sm active:scale-[0.97]">
                        <iconify-icon icon="lucide:trash-2" class="text-sm"></iconify-icon>
                        Hapus Kamar
                    </button>
                </div>
            </div>
        </div>`;
    }

    // ── Hapus unit ─────────────────────────────────────────────
    window.performDelete = function(id) {
        // Tampilkan toast loading
        showToast('Sedang menghapus, mohon tunggu...', 'lucide:loader', 'text-amber-400');

        fetch(`/admin/unit/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                window.location.href = window.location.pathname + '#page=' + currentPage;
                window.location.reload();
            } else {
                alert('Terjadi kesalahan saat menghapus data.');
            }
        })
        .catch(err => {
            console.error(err);
            alert('Terjadi kesalahan jaringan.');
        });
    };

    // ── Render halaman ─────────────────────────────────────────
    window.renderUnitTable = function() {
        const start    = (currentPage - 1) * PER_PAGE;
        const pageData = filteredData.slice(start, start + PER_PAGE);
        document.getElementById('unitList').innerHTML =
            pageData.length
                ? pageData.map((item, i) => renderCard(item, start + i + 1)).join('')
                : '<div class="text-center py-20 text-stone-400"><iconify-icon icon="lucide:search-x" class="text-5xl mb-3"></iconify-icon><p class="text-sm">Tidak ada unit yang ditemukan.</p></div>';

        // Stats
        let totalSlots = 0;
        let totalTersediaToday = 0;

        AKOMODASI_DATA.forEach(item => {
            totalSlots += parseInt(item.slot || 0);

            const today = parseToLocalDate(new Date());
            const todayTime = today.getTime();

            const activeBookingsToday = (item.bookings || []).filter(b => {
                if (b.status === 'failed' || b.status === 'refunded') return false;
                const bIn = parseToLocalDate(b.check_in_date);
                const bOut = parseToLocalDate(b.check_out_date);
                return todayTime >= bIn.getTime() && todayTime < bOut.getTime();
            });

            const countBookedToday = activeBookingsToday.length;
            totalTersediaToday += Math.max(0, item.slot - countBookedToday);
        });

        document.getElementById('statJumlahUnit').textContent = totalSlots;
        document.getElementById('statTersedia').textContent   = totalTersediaToday;

        renderPagination();
    };

    // ── Pagination ─────────────────────────────────────────────
    function renderPagination() {
        const total      = filteredData.length;
        const totalPages = Math.ceil(total / PER_PAGE);
        const wrap       = document.getElementById('paginationWrapper');
        const el         = document.getElementById('paginationControls');
        const kWrap      = document.getElementById('btnKembaliWrap');
        const nWrap      = document.getElementById('btnNextWrap');

        if (total <= PER_PAGE) { wrap.classList.add('hidden'); return; }
        wrap.classList.remove('hidden');

        kWrap.innerHTML = currentPage === 1
            ? '<div style="width:90px"></div>'
            : `<button onclick="unitNav(${currentPage-1})" class="bg-[#3a523a] hover:bg-[#2c402c] text-white text-sm font-semibold px-5 py-2.5 rounded-full transition shadow">Kembali</button>`;

        let nums = `<button onclick="unitNav(${currentPage-1})" class="px-2 py-1 text-stone-500 hover:text-stone-800 transition text-lg" ${currentPage===1?'disabled style="opacity:0.3"':''}>‹</button>`;
        for (let i = 1; i <= totalPages; i++) {
            nums += `<button onclick="unitNav(${i})" class="w-8 h-8 rounded-lg text-sm font-bold transition ${i===currentPage?'bg-[#3a523a] text-white shadow':'text-stone-700 hover:bg-amber-100'}">${i}</button>`;
        }
        nums += `<button onclick="unitNav(${currentPage+1})" class="px-2 py-1 text-stone-500 hover:text-stone-800 transition text-lg" ${currentPage===totalPages?'disabled style="opacity:0.3"':''}>›</button>`;
        el.innerHTML = nums;

        nWrap.innerHTML = currentPage === totalPages
            ? '<div style="width:100px"></div>'
            : `<button onclick="unitNav(${currentPage+1})" class="bg-[#3a523a] hover:bg-[#2c402c] text-white text-sm font-semibold px-5 py-2.5 rounded-full transition shadow">Selanjutnya</button>`;
    }

    window.toggleBookings = function(id) {
        const div = document.getElementById('hidden-bookings-' + id);
        const btn = document.getElementById('btn-toggle-' + id);
        if (!div || !btn) return;
        
        if (div.classList.contains('hidden')) {
            div.classList.remove('hidden');
            div.classList.add('flex');
            btn.innerHTML = '<iconify-icon icon="lucide:chevron-up"></iconify-icon> Sembunyikan';
        } else {
            div.classList.add('hidden');
            div.classList.remove('flex');
            // We need to restore original text with count, but we don't have count easily accessible here.
            // A simple trick: count child elements or store it in dataset.
            // Let's store the count in a data attribute on the button when generating HTML.
            // Actually, we can just grab it from btn.dataset.count if we added it, but I didn't.
            // Let's just say "Tampilkan lainnya".
            btn.innerHTML = '<iconify-icon icon="lucide:chevron-down"></iconify-icon> Tampilkan lainnya';
        }
    };

    window.unitNav = function(page) {
        const totalPages = Math.ceil(filteredData.length / PER_PAGE);
        if (page < 1 || page > totalPages) return;
        currentPage = page;
        window.location.hash = 'page=' + currentPage;
        renderUnitTable();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };

    // ── Filter + Search ────────────────────────────────────────
    window.applyFilter = function(keepPage) {
        const search = document.getElementById('searchInput').value.toLowerCase();
        const jenis  = document.getElementById('filterJenisAdmin').value;

        filteredData = AKOMODASI_DATA.filter(d => {
            const textToSearch = [
                d.judul,
                d.jenis,
                d.kasur,
                d.fasilitas,
                d.makanan,
                d.harga_weekday,
                d.harga_weekend,
                d.harga_highseason,
                d.max_orang + ' orang',
                d.max_orang + ' pax',
                d.slot + ' kamar',
                d.slot + ' tenda'
            ].join(' ').toLowerCase();
            
            const matchSearch = textToSearch.includes(search);
            const matchJenis  = !jenis || d.jenis === jenis;
            return matchSearch && matchJenis;
        });

        // Sort
        switch(sortMode) {
            case 'terbaru':
                filteredData.sort((a, b) => b.id - a.id);
                break;
            case 'nama-az':
                filteredData.sort((a, b) => a.judul.localeCompare(b.judul));
                break;
            case 'nama-za':
                filteredData.sort((a, b) => b.judul.localeCompare(a.judul));
                break;
            case 'harga-asc':
                filteredData.sort((a, b) => a.harga_weekday - b.harga_weekday);
                break;
            case 'harga-desc':
                filteredData.sort((a, b) => b.harga_weekday - a.harga_weekday);
                break;
        }

        if (!keepPage) currentPage = 1;
        renderUnitTable();
    };

    // ── Sort dropdown ──────────────────────────────────────────
    document.getElementById('sortSelect').addEventListener('change', function() {
        sortMode = this.value;
        sessionStorage.setItem('adminSortMode', sortMode);
        applyFilter();
    });

    document.getElementById('searchInput').addEventListener('input', applyFilter);
    document.getElementById('filterJenisAdmin').addEventListener('change', function() {
        sessionStorage.setItem('adminFilterJenis', this.value);
        applyFilter();
    });

    // ── Lightbox ───────────────────────────────────────────────
    let lbImages = [], lbIdx = 0;
    window.openLightbox = function(id) {
        const item = AKOMODASI_DATA.find(d => d.id === id);
        const images = Array.isArray(item.gambar) ? item.gambar : (item.gambar ? [item.gambar] : []);
        lbImages = images.map(g => formatImgUrl(g));
        if (lbImages.length === 0) lbImages = ['/images/akomodasi/cabin1/a.webp'];
        lbIdx = 0; showLbImg();
        const lb = document.getElementById('lightbox');
        lb.classList.remove('hidden'); lb.classList.add('flex');
    };
    window.closeLightbox = function(e) {
        if (e && e.target !== document.getElementById('lightbox')) return;
        const lb = document.getElementById('lightbox');
        lb.classList.add('hidden'); lb.classList.remove('flex');
    };
    window.lbPrev = function() { if(lbIdx>0){lbIdx--; showLbImg();} };
    window.lbNext = function() { if(lbIdx<lbImages.length-1){lbIdx++; showLbImg();} };
    function showLbImg() { 
        document.getElementById('lbImg').src = lbImages[lbIdx]; 
        document.getElementById('lbBtnPrev').style.display=lbIdx===0?'none':'';
        document.getElementById('lbBtnNext').style.display=lbIdx>=lbImages.length-1?'none':'';
    }

    // ── Custom Dropdown Initialization ─────────────────────────
    function setupCustomDropdown(containerId, displayId, optionsId, inputId) {
        const container = document.getElementById(containerId);
        const display = document.getElementById(displayId);
        const optionsDiv = document.getElementById(optionsId);
        const input = document.getElementById(inputId);
        const options = optionsDiv.querySelectorAll('div[data-value]');

        display.addEventListener('click', (e) => {
            e.stopPropagation();
            const isHidden = optionsDiv.classList.contains('hidden');
            // Close all other dropdowns
            document.querySelectorAll('.custom-dropdown-options').forEach(el => {
                el.classList.add('hidden');
                el.classList.remove('opacity-100');
            });
            if (isHidden) {
                optionsDiv.classList.remove('hidden');
                setTimeout(() => optionsDiv.classList.add('opacity-100'), 10);
            }
        });

        options.forEach(opt => {
            opt.addEventListener('click', () => {
                const val = opt.getAttribute('data-value');
                const text = opt.innerText;
                input.value = val;
                // Only update display text if it's sort (filter uses icon or text)
                if(inputId === 'sortSelect') {
                    display.innerText = text;
                } else if(inputId === 'filterJenisAdmin') {
                    display.innerText = val ? text : 'Semua Jenis';
                }
                
                optionsDiv.classList.remove('opacity-100');
                setTimeout(() => optionsDiv.classList.add('hidden'), 200);
                
                // Trigger change event
                input.dispatchEvent(new Event('change'));
            });
        });

        document.addEventListener('click', (e) => {
            if (!container.contains(e.target)) {
                optionsDiv.classList.remove('opacity-100');
                setTimeout(() => optionsDiv.classList.add('hidden'), 200);
            }
        });
    }

    setupCustomDropdown('customFilterJenis', 'filterJenisDisplay', 'filterJenisOptions', 'filterJenisAdmin');
    setupCustomDropdown('customSort', 'sortDisplay', 'sortOptions', 'sortSelect');

    // ── Init ───────────────────────────────────────────────────
    // Restore select states from sessionStorage
    const savedFilter = sessionStorage.getItem('adminFilterJenis');
    if (savedFilter) {
        document.getElementById('filterJenisAdmin').value = savedFilter;
        const opt = document.querySelector(`#filterJenisOptions div[data-value="${savedFilter}"]`);
        if (opt) document.getElementById('filterJenisDisplay').innerText = opt.innerText;
    }

    if (sortMode) {
        document.getElementById('sortSelect').value = sortMode;
        const opt = document.querySelector(`#sortOptions div[data-value="${sortMode}"]`);
        if (opt) document.getElementById('sortDisplay').innerText = opt.innerText;
    }

    // ── Calendar Tracking Modal ──────────────────────────────────
    let kalenderFp = null;

    window.openKalenderModal = function(id) {
        const item = AKOMODASI_DATA.find(d => d.id === id);
        if (!item) return;

        // Destroy previous instance
        if (kalenderFp) {
            kalenderFp.destroy();
            kalenderFp = null;
        }
        document.getElementById('kalenderInline').innerHTML = '';

        // Helper: check if a date is fully booked for this accommodation
        function getBookingStatusForDate(dateObj) {
            const y = dateObj.getFullYear();
            const m = String(dateObj.getMonth() + 1).padStart(2, '0');
            const r = String(dateObj.getDate()).padStart(2, '0');
            const dStr = `${y}-${m}-${r}`;

            let isHoliday = false;
            const globalLibur = (DATE_SETTINGS || []).filter(d => d.type === 'libur_landeuh');
            for (let gl of globalLibur) {
                if (gl.dates) {
                    const datesArr = typeof gl.dates === 'string' ? gl.dates.split(',').map(d => d.trim()) : (Array.isArray(gl.dates) ? gl.dates : []);
                    if (datesArr.includes(dStr)) { isHoliday = true; break; }
                }
            }
            if (!isHoliday) {
                const specificBlocked = item.blocked_dates || [];
                for (let sb of specificBlocked) {
                    if (sb.dates) {
                        const datesArr = typeof sb.dates === 'string' ? sb.dates.split(',').map(d => d.trim()) : (Array.isArray(sb.dates) ? sb.dates : []);
                        if (datesArr.includes(dStr)) { isHoliday = true; break; }
                    }
                }
            }
            if (isHoliday) {
                return { booked: true, corporate: false, holiday: true };
            }

            if (!item.bookings || item.bookings.length === 0) return { booked: false, corporate: false, holiday: false };
            let checkTime = new Date(dateObj);
            checkTime.setHours(12, 0, 0, 0);
            checkTime = checkTime.getTime();

            let count = 0;
            let hasCorporate = false;
            item.bookings.forEach(b => {
                if (b.status !== 'failed' && b.status !== 'refunded') {
                    let bIn = new Date(b.check_in_date);
                    bIn.setHours(12, 0, 0, 0);
                    let bOut = new Date(b.check_out_date);
                    bOut.setHours(12, 0, 0, 0);
                    if (checkTime >= bIn.getTime() && checkTime < bOut.getTime()) {
                        count++;
                        if (b.is_corporate) hasCorporate = true;
                    }
                }
            });
            return {
                booked: count >= item.slot,
                corporate: hasCorporate,
                holiday: false
            };
        }

        // Create inline flatpickr (read-only, no onChange to avoid lag)
        kalenderFp = flatpickr(document.getElementById('kalenderInline'), {
            inline: true,
            showMonths: window.innerWidth > 500 ? 2 : 1,
            locale: 'id',
            minDate: 'today',
            clickOpens: false,
            disable: [
                function(date) {
                    return getBookingStatusForDate(date).booked;
                }
            ],
            onDayCreate: function(dObj, dStr, fp, dayElem) {
                const todayLocal = new Date();
                todayLocal.setHours(0, 0, 0, 0);
                if (dayElem.dateObj >= todayLocal) {
                    const status = getBookingStatusForDate(dayElem.dateObj);
                    if (status.booked) {
                        dayElem.classList.add('booked-date');
                        if (status.holiday) {
                            dayElem.classList.add('holiday-booked-date');
                        } else if (status.corporate) {
                            dayElem.classList.add('corporate-booked-date');
                        }
                    }
                }
            },
            onChange: function(selectedDates, dateStr, instance) {
                if (selectedDates.length > 0) {
                    instance.clear();
                }
            },
            onReady: function(selectedDates, dateStr, instance) {
                // Clone template legend dan masukkan ke dalam box putih kalender
                const template = document.getElementById('kalenderLegendTemplate');
                if (template) {
                    const clone = template.content.cloneNode(true);
                    instance.calendarContainer.appendChild(clone);
                }
            }
        });

        // Force jump to current month
        kalenderFp.jumpToDate(new Date());

        // Open modal
        const modal = document.getElementById('modalKalender');
        const box = document.getElementById('kalenderInline');
        modal.classList.remove('opacity-0', 'pointer-events-none');
        modal.classList.add('opacity-100');
        if(box) {
            box.classList.remove('scale-90');
            box.classList.add('scale-100');
        }
    };

    window.closeKalenderModal = function() {
        const modal = document.getElementById('modalKalender');
        const box = document.getElementById('kalenderInline');
        modal.classList.add('opacity-0', 'pointer-events-none');
        modal.classList.remove('opacity-100');
        if(box) {
            box.classList.add('scale-90');
            box.classList.remove('scale-100');
        }
    };

    document.getElementById('modalKalender')?.addEventListener('click', function(e) {
        if (e.target === this) closeKalenderModal();
    });

    // ── Blocked/Libur Kamar Logic ──────────────────────────────
    let liburKamarFp = null;
    let pendingLiburKamarCallback = null;
    window.currentLiburKamarDates = null;
    window.currentLiburKamarAccomIds = null;

    window.checkIsCurrentlyLibur = function(item) {
        const today = parseToLocalDate(new Date());
        const y = today.getFullYear();
        const m = String(today.getMonth() + 1).padStart(2, '0');
        const r = String(today.getDate()).padStart(2, '0');
        const todayStr = `${y}-${m}-${r}`;

        const globalLibur = (DATE_SETTINGS || []).filter(d => d.type === 'libur_landeuh');
        for (let gl of globalLibur) {
            if (gl.dates) {
                const datesArr = typeof gl.dates === 'string' ? gl.dates.split(',').map(d => d.trim()) : (Array.isArray(gl.dates) ? gl.dates : []);
                if (datesArr.includes(todayStr)) return true;
            }
        }

        const specificBlocked = item.blocked_dates || [];
        for (let sb of specificBlocked) {
            if (sb.dates) {
                const datesArr = typeof sb.dates === 'string' ? sb.dates.split(',').map(d => d.trim()) : (Array.isArray(sb.dates) ? sb.dates : []);
                if (datesArr.includes(todayStr)) return true;
            }
        }

        return false;
    };

    window.hasBlockedPeriods = function(item) {
        const globalLibur = (DATE_SETTINGS || []).filter(d => d.type === 'libur_landeuh');
        const specificLibur = item.blocked_dates || [];
        return globalLibur.length > 0 || specificLibur.length > 0;
    };

    window.openModalListLibur = function(id) {
        const item = AKOMODASI_DATA.find(d => d.id === id);
        if (!item) return;
        const html = renderBlockedPeriodsHtml(item);
        document.getElementById('modalListLiburTitle').innerText = `Tanggal Libur/Blokir: ${item.judul}`;
        document.getElementById('modalListLiburContent').innerHTML = html || '<p class="text-sm text-stone-500">Tidak ada jadwal libur/blokir.</p>';
        document.getElementById('modalListLibur').classList.remove('hidden');
    };

    window.closeModalListLibur = function() {
        document.getElementById('modalListLibur').classList.add('hidden');
    };

    window.renderBlockedPeriodsHtml = function(item) {
        const globalLibur = (DATE_SETTINGS || []).filter(d => d.type === 'libur_landeuh');
        const specificLibur = item.blocked_dates || [];

        const allLibur = [];
        globalLibur.forEach(gl => {
            let datesVal = '';
            if (typeof gl.dates === 'string') {
                datesVal = gl.dates;
            } else if (Array.isArray(gl.dates)) {
                datesVal = gl.dates.join(', ');
            }
            allLibur.push({
                id: gl.id,
                name: gl.name || 'Libur Landeuh (Global)',
                dates: datesVal,
                is_global: true
            });
        });
        specificLibur.forEach(sl => {
            let datesVal = '';
            if (typeof sl.dates === 'string') {
                datesVal = sl.dates;
            } else if (Array.isArray(sl.dates)) {
                datesVal = sl.dates.join(', ');
            }
            allLibur.push({
                id: sl.id,
                name: sl.name,
                dates: datesVal,
                is_from_package: sl.is_from_package || false,
                package_id: sl.package_id
            });
        });

        if (allLibur.length === 0) return '';

        const groups = {};
        allLibur.forEach(lib => {
            if (!lib.dates) return;
            const datesStr = typeof lib.dates === 'string' ? lib.dates : (Array.isArray(lib.dates) ? lib.dates.join(', ') : '');
            const dateList = datesStr.split(',').map(d => d.trim()).filter(Boolean).sort();
            if (dateList.length === 0) return;
            
            const firstDate = parseToLocalDate(dateList[0]);
            const key = `${firstDate.getFullYear()}-${String(firstDate.getMonth()).padStart(2, '0')}`;
            if (!groups[key]) {
                groups[key] = {
                    month: firstDate.getMonth(),
                    year: firstDate.getFullYear(),
                    items: []
                };
            }
            
            let rangeLabel = '';
            if (dateList.length === 1) {
                rangeLabel = formatDateStr(dateList[0]);
            } else {
                rangeLabel = `${formatDateStr(dateList[0])} s.d ${formatDateStr(dateList[dateList.length - 1])}`;
            }

            groups[key].items.push({
                ...lib,
                rangeLabel: rangeLabel,
                firstDateObj: firstDate
            });
        });

        function formatDateStr(dateStr) {
            const p = dateStr.split('-');
            return p.length === 3 ? `${p[2]}-${p[1]}-${p[0]}` : dateStr;
        }

        const MONTH_COLORS = [
            { name: 'Januari',   bg: '#FFE0E0', text: '#CC3333', border: '#FFBBBB' },
            { name: 'Februari',  bg: '#DDEAFF', text: '#335599', border: '#B8D0FF' },
            { name: 'Maret',     bg: '#DDFCE0', text: '#1E8C30', border: '#B0E8B8' },
            { name: 'April',     bg: '#FFF6DD', text: '#BB7711', border: '#FFE8AA' },
            { name: 'Mei',       bg: '#E6FFDD', text: '#3D9900', border: '#C0F0A0' },
            { name: 'Juni',      bg: '#EEDDFF', text: '#7733BB', border: '#DDBBFF' },
            { name: 'Juli',      bg: '#DDF0FF', text: '#2266AA', border: '#AADDFF' },
            { name: 'Agustus',   bg: '#FFE5EE', text: '#CC2266', border: '#FFBBCC' },
            { name: 'September', bg: '#FFF0DD', text: '#CC6600', border: '#FFDDAA' },
            { name: 'Oktober',   bg: '#FCFCE0', text: '#7A7A00', border: '#EEE8A0' },
            { name: 'November',  bg: '#FFDDF5', text: '#BB2288', border: '#FFBBDD' },
            { name: 'Desember',  bg: '#DEE0FF', text: '#4444CC', border: '#C0C8FF' },
        ];
        const MONTH_SHORT = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agt','Sep','Okt','Nov','Des'];

        const accordionsHtml = Object.keys(groups).sort().map(key => {
            const g = groups[key];
            const c = MONTH_COLORS[g.month];
            const monthLabel = `${MONTH_SHORT[g.month]} ${g.year}`;
            
            // Collapsed (hidden) by default!
            const isOpen = false;

            const itemsHtml = g.items.map(lib => {
                let deleteBtn = '';
                if (lib.is_global) {
                    return `
                        <div class="flex items-center justify-between gap-2 p-2 rounded-xl bg-amber-50 border border-amber-200 text-amber-700 text-[10px] font-semibold w-full">
                            <span>🌍 Libur Global: <strong>${lib.name}</strong> (${lib.rangeLabel})</span>
                        </div>
                    `;
                } else if (lib.is_from_package) {
                    return `
                        <div class="flex items-center justify-between gap-2 p-2 rounded-xl bg-indigo-50 border border-indigo-200 text-indigo-700 text-[10px] font-semibold w-full">
                            <span>📦 ${lib.name} (${lib.rangeLabel})</span>
                            <span class="text-[9px] bg-indigo-100 px-1 py-0.5 rounded text-indigo-800">Dari Paket</span>
                        </div>
                    `;
                } else {
                    deleteBtn = `
                        <button onclick="deleteBlockedPeriod(${item.id}, '${lib.id}')" 
                                class="w-6 h-6 rounded-lg bg-red-100 hover:bg-red-200 text-red-600 flex items-center justify-center transition shrink-0">
                            <iconify-icon icon="lucide:trash" class="text-xs"></iconify-icon>
                        </button>
                    `;
                    return `
                        <div class="flex items-center justify-between gap-2 p-2 rounded-xl bg-red-50 border border-red-150 text-red-700 text-[10px] font-semibold w-full">
                            <span>🚫 Libur Unit: <strong>${lib.name}</strong> (${lib.rangeLabel})</span>
                            ${deleteBtn}
                        </div>
                    `;
                }
            }).join('');

            return `
            <div class="border border-stone-200/60 rounded-xl overflow-hidden bg-white/40 shadow-sm mt-1.5">
                <div class="px-3 py-2 bg-stone-50/80 cursor-pointer flex justify-between items-center hover:bg-stone-100 transition" 
                     onclick="this.nextElementSibling.classList.toggle('hidden'); this.querySelector('.chevron').classList.toggle('rotate-180')">
                    <div class="flex items-center gap-2">
                        <span style="background:${c.text}; color:#fff;" class="inline-flex items-center gap-1 px-2 py-1 rounded-md text-[9px] font-bold tracking-wide whitespace-nowrap shadow-sm">
                            <iconify-icon icon="lucide:calendar-clock" class="text-[10px]"></iconify-icon>${monthLabel}
                        </span>
                        <span class="text-[11px] font-bold text-red-600">${g.items.length} libur/blokir</span>
                    </div>
                    <iconify-icon icon="lucide:chevron-down" class="chevron text-stone-400 transition-transform duration-200 ${isOpen ? 'rotate-180' : ''}"></iconify-icon>
                </div>
                <div class="${isOpen ? '' : 'hidden'} border-t border-stone-100 p-2 flex flex-col gap-1.5">
                    ${itemsHtml}
                </div>
            </div>`;
        }).join('');

        return `<div class="flex flex-col gap-1 mt-1">${accordionsHtml}</div>`;
    };

    window.openModalLiburkanKamar = function() {
        const checkboxes = document.getElementById('liburKamarCheckboxes');
        checkboxes.innerHTML = AKOMODASI_DATA.map(accom => `
            <label class="flex items-center gap-2 cursor-pointer text-stone-700 hover:text-[#3a523a] text-xs font-semibold">
                <input type="checkbox" name="libur_accom_ids[]" value="${accom.id}" class="rounded border-stone-300 text-red-600 focus:ring-red-500 w-4 h-4 cursor-pointer">
                <span>${accom.judul}</span>
            </label>
        `).join('');

        document.getElementById('liburKamar_name').value = '';
        document.getElementById('liburKamar_dates').value = '';
        document.getElementById('btnOpenKalenderLibur').innerHTML = `<iconify-icon icon="lucide:calendar-plus" class="text-xl"></iconify-icon> Pilih Tanggal Blokir`;

        if (liburKamarFp) liburKamarFp.destroy();
        liburKamarFp = flatpickr("#btnOpenKalenderLibur", {
            mode: "multiple",
            minDate: "today",
            onChange: function(selectedDates, dateStr) {
                document.getElementById('liburKamar_dates').value = dateStr;
                document.getElementById('btnOpenKalenderLibur').innerHTML = `<iconify-icon icon="lucide:calendar" class="text-xl"></iconify-icon> ${dateStr}`;
            }
        });

        document.getElementById('liburKamarFormWrap').classList.remove('hidden');
        document.getElementById('liburKamarConflictWrap').classList.add('hidden');
        document.getElementById('btnSaveLiburKamar').classList.remove('hidden');
        document.getElementById('btnSaveAfterLiburKamarConflictsCleared').classList.add('hidden');

        document.getElementById('modalLiburkanKamar').classList.remove('hidden');
    };

    window.closeLiburKamarModal = function() {
        if (liburKamarFp) { liburKamarFp.close(); liburKamarFp.destroy(); liburKamarFp = null; }
        document.getElementById('modalLiburkanKamar').classList.add('hidden');
        pendingLiburKamarCallback = null;
    };

    window.submitLiburKamar = function() {
        const checkedBoxes = document.querySelectorAll('input[name="libur_accom_ids[]"]:checked');
        const accommodationIds = Array.from(checkedBoxes).map(cb => parseInt(cb.value));
        const name = document.getElementById('liburKamar_name').value.trim();
        const dates = document.getElementById('liburKamar_dates').value.trim();

        if (accommodationIds.length === 0) {
            alert('Pilih minimal satu kamar yang ingin diliburkan.');
            return;
        }
        if (!name) {
            alert('Masukkan nama periode atau alasan libur.');
            return;
        }
        if (!dates) {
            alert('Pilih tanggal libur.');
            return;
        }

        const proceedSave = () => {
            const btn = document.getElementById('btnSaveLiburKamar');
            btn.disabled = true;
            btn.innerHTML = '<iconify-icon icon="lucide:loader-2" class="animate-spin"></iconify-icon> Memproses...';

            fetch('/admin/unit/blocked-dates', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    action: 'create',
                    accommodation_ids: accommodationIds,
                    name: name,
                    dates: dates
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                } else {
                    alert('Gagal menyimpan: ' + data.message);
                    btn.disabled = false;
                    btn.innerHTML = '<iconify-icon icon="lucide:check"></iconify-icon> Terapkan Libur';
                }
            })
            .catch(err => {
                console.error(err);
                alert('Terjadi kesalahan jaringan.');
                btn.disabled = false;
                btn.innerHTML = '<iconify-icon icon="lucide:check"></iconify-icon> Terapkan Libur';
            });
        };

        if (pendingLiburKamarCallback) {
            proceedSave();
            return;
        }

        fetch('/admin/tanggal/check-conflicts', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                dates: dates,
                accommodation_ids: accommodationIds
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.conflicts && data.conflicts.length > 0) {
                showLiburKamarConflict(data.conflicts, dates, accommodationIds, proceedSave);
            } else {
                proceedSave();
            }
        })
        .catch(err => {
            console.error(err);
            alert('Gagal memeriksa konflik pesanan.');
        });
    };

    function showLiburKamarConflict(conflicts, datesStr, accommodationIds, onClearCallback) {
        pendingLiburKamarCallback = onClearCallback;
        window.currentLiburKamarDates = datesStr;
        window.currentLiburKamarAccomIds = accommodationIds;

        renderLiburKamarConflictsList(conflicts);

        document.getElementById('liburKamarFormWrap').classList.add('hidden');
        document.getElementById('liburKamarConflictWrap').classList.remove('hidden');
        document.getElementById('btnSaveLiburKamar').classList.add('hidden');
        document.getElementById('btnSaveAfterLiburKamarConflictsCleared').classList.remove('hidden');
        document.getElementById('btnSaveAfterLiburKamarConflictsCleared').disabled = true;
    }

    function fmtDate(d) { if (!d) return d; const p = d.split('-'); return p.length === 3 ? `${p[2]}-${p[1]}-${p[0]}` : d; }

    function renderLiburKamarConflictsList(conflicts) {
        const container = document.getElementById('liburKamarConflictList');
        const saveBtn = document.getElementById('btnSaveAfterLiburKamarConflictsCleared');

        if (conflicts.length === 0) {
            container.innerHTML = `
                <div class="text-center py-4 text-green-600 bg-green-50 rounded-xl border border-green-200">
                    <iconify-icon icon="lucide:check-circle" class="text-2xl mb-1"></iconify-icon>
                    <p class="text-xs font-bold">Semua konflik telah terselesaikan!</p>
                </div>
            `;
            saveBtn.disabled = false;
            saveBtn.className = 'w-full py-3 rounded-xl font-bold text-xs text-white bg-green-600 hover:bg-green-700 transition shadow-sm';
            return;
        }

        saveBtn.disabled = true;
        saveBtn.className = 'w-full py-3 rounded-xl font-bold text-xs text-stone-400 bg-stone-100 cursor-not-allowed';

        container.innerHTML = conflicts.map(p => {
            const cleanPhone = p.pemesanTelp.replace(/^0/, '62').replace(/[-+\s]/g, '');
            const waMsg = encodeURIComponent(`Halo Kak ${p.pemesanNama}, kami dari Landeuh Village. Mengenai pemesanan Kakak dengan nomor #${p.noPesanan} untuk akomodasi ${p.akomodasi} pada tanggal ${fmtDate(p.checkin)} s.d ${fmtDate(p.checkout)}, kami ingin menginfokan bahwa kamar tersebut sedang dalam perawatan/diliburkan. Apakah boleh kami bantu untuk reschedule ke tanggal alternatif? Terima kasih.`);
            const waUrl = `https://wa.me/${cleanPhone}?text=${waMsg}`;

            return `
                <div class="p-3 rounded-xl border border-stone-200 bg-stone-50 flex flex-col gap-2">
                    <div class="flex justify-between items-start gap-2">
                        <div>
                            <span class="text-[10px] font-bold text-white bg-red-500 px-2 py-0.5 rounded shadow-sm uppercase">${p.noPesanan}</span>
                            <h4 class="text-xs font-bold text-stone-800 mt-1">${p.pemesanNama} <span class="font-normal text-[10px] text-stone-500">(${p.pemesanTelp})</span></h4>
                            <p class="text-[10px] text-stone-600">Akomodasi: <strong>${p.akomodasi}</strong> · Tanggal: <strong>${fmtDate(p.checkin)} &rarr; ${fmtDate(p.checkout)}</strong></p>
                        </div>
                        <div class="flex gap-1">
                            <a href="${waUrl}" target="_blank" class="px-2 py-1 rounded-lg bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-[10px] flex items-center gap-0.5 transition shadow-sm">
                                <iconify-icon icon="lucide:message-square"></iconify-icon> WA
                            </a>
                            <button onclick="initLiburReschedule(${p.id}, '${p.checkin}', '${p.checkout}', ${p.accommodation_id || 'null'}, ${p.corporate_package_id || 'null'}, ${p.is_corporate ? 1 : 0})" class="px-2 py-1 rounded-lg bg-amber-500 hover:bg-amber-600 text-white font-bold text-[10px] flex items-center gap-0.5 transition shadow-sm">
                                <iconify-icon icon="lucide:calendar-range"></iconify-icon> Reschedule
                            </button>
                        </div>
                    </div>
                    
                    <div id="libur-resched-form-${p.id}" class="hidden p-2 rounded-lg bg-white border border-stone-200 mt-1 flex flex-col gap-2">
                        <div class="flex items-center gap-1.5">
                            <span class="text-[10px] font-bold text-stone-600">Pilih Tanggal:</span>
                            <input type="text" id="libur-resched-input-${p.id}" class="hidden">
                            <button type="button" id="btn-libur-resched-picker-${p.id}" class="px-2 py-1 border border-stone-300 rounded text-[10px] font-semibold text-stone-700 bg-stone-50 hover:bg-stone-100 flex items-center gap-1 transition">
                                <iconify-icon icon="lucide:calendar"></iconify-icon> Pilih Check-in & Check-out
                            </button>
                        </div>
                        <div class="flex justify-end gap-1.5">
                            <button onclick="document.getElementById('libur-resched-form-${p.id}').classList.add('hidden')" class="px-2 py-1 rounded text-[10px] font-bold bg-stone-100 text-stone-600">Batal</button>
                            <button id="btn-libur-resched-save-${p.id}" disabled onclick="saveLiburReschedule(${p.id})" class="px-2 py-1 rounded text-[10px] font-bold bg-stone-300 text-stone-500 cursor-not-allowed">Simpan</button>
                        </div>
                    </div>
                </div>
            `;
        }).join('');
    }

    window.initLiburReschedule = function(bookingId, checkin, checkout, accomId, pkgId, isCorp) {
        const startOrig = new Date(checkin);
        const endOrig = new Date(checkout);
        const origNights = Math.round((endOrig - startOrig) / (1000 * 60 * 60 * 24));
        window[`origNights_${bookingId}`] = origNights;

        const form = document.getElementById(`libur-resched-form-${bookingId}`);
        form.classList.toggle('hidden');
        if (form.classList.contains('hidden')) return;

        const input = document.getElementById(`libur-resched-input-${bookingId}`);
        const btn = document.getElementById(`btn-libur-resched-picker-${bookingId}`);
        const saveBtn = document.getElementById(`btn-libur-resched-save-${bookingId}`);

        const targetId = isCorp ? pkgId : accomId;

        fetch(`/reservasi/booked-dates/${targetId}?exclude_booking_id=${bookingId}&is_corporate=${isCorp ? 1 : 0}`)
        .then(res => res.json())
        .then(data => {
            const disabledDates = data.booked_dates || [];

            if (window[`fp_libur_resched_${bookingId}`]) window[`fp_libur_resched_${bookingId}`].destroy();

            window[`fp_libur_resched_${bookingId}`] = flatpickr(input, {
                mode: 'range',
                minDate: 'today',
                positionElement: btn,
                disable: [
                    function(date) {
                        let y = date.getFullYear();
                        let m = String(date.getMonth() + 1).padStart(2, '0');
                        let d = String(date.getDate()).padStart(2, '0');
                        let dateStr = `${y}-${m}-${d}`;

                        const fpInstance = window[`fp_libur_resched_${bookingId}`];
                        const selected = (fpInstance && fpInstance.selectedDates) ? fpInstance.selectedDates : [];

                        if (selected && selected.length === 1) {
                            const start = new Date(selected[0]);
                            start.setHours(0, 0, 0, 0);
                            const cur = new Date(date);
                            cur.setHours(0, 0, 0, 0);

                            if (cur <= start) return true;

                            for (let dt = new Date(start); dt < cur; dt.setDate(dt.getDate() + 1)) {
                                let sy = dt.getFullYear();
                                let sm = String(dt.getMonth() + 1).padStart(2, '0');
                                let sd = String(dt.getDate()).padStart(2, '0');
                                let sStr = `${sy}-${sm}-${sd}`;
                                if (disabledDates.includes(sStr)) return true;
                            }
                            return false;
                        }
                        return disabledDates.includes(dateStr);
                    }
                ],
                onDayCreate: function(dObj, dStr, fp, dayElem) {
                    let y = dayElem.dateObj.getFullYear();
                    let m = String(dayElem.dateObj.getMonth() + 1).padStart(2, '0');
                    let d = String(dayElem.dateObj.getDate()).padStart(2, '0');
                    let dateStr = `${y}-${m}-${d}`;
                    if (disabledDates.includes(dateStr)) {
                        dayElem.classList.add('booked-date');
                    }
                },
                onChange: function(selectedDates, dateStr, instance) {
                    btn.innerHTML = `<iconify-icon icon="lucide:calendar"></iconify-icon> ${dateStr}`;
                    if (selectedDates.length === 2) {
                        let start = new Date(selectedDates[0]);
                        start.setHours(12,0,0,0);
                        let end = new Date(selectedDates[1]);
                        end.setHours(12,0,0,0);
                        
                        let hasBlockedDate = false;
                        for (let dt = new Date(start); dt < end; dt.setDate(dt.getDate() + 1)) {
                            let sy = dt.getFullYear();
                            let sm = String(dt.getMonth() + 1).padStart(2, '0');
                            let sd = String(dt.getDate()).padStart(2, '0');
                            let sStr = `${sy}-${sm}-${sd}`;
                            if (disabledDates.includes(sStr)) {
                                hasBlockedDate = true;
                                break;
                            }
                        }

                        if (hasBlockedDate) {
                            alert('Beberapa tanggal di dalam rentang yang Anda pilih sudah terisi. Silakan pilih rentang tanggal lain.');
                            saveBtn.disabled = true;
                            saveBtn.className = 'px-2 py-1 rounded text-[10px] font-bold bg-stone-300 text-stone-500 cursor-not-allowed';
                        } else {
                            saveBtn.disabled = false;
                            saveBtn.className = 'px-2 py-1 rounded text-[10px] font-bold bg-green-600 text-white hover:bg-green-700 transition shadow-sm';
                        }
                    } else {
                        saveBtn.disabled = true;
                        saveBtn.className = 'px-2 py-1 rounded text-[10px] font-bold bg-stone-300 text-stone-500 cursor-not-allowed';
                    }
                }
            });

            window[`fp_libur_resched_${bookingId}`].jumpToDate(checkin);

            btn.onclick = function(e) {
                e.stopPropagation();
                window[`fp_libur_resched_${bookingId}`].toggle();
            };

            setTimeout(() => {
                window[`fp_libur_resched_${bookingId}`].open();
            }, 50);
        })
        .catch(err => {
            console.error(err);
            alert('Gagal mengambil tanggal ketersediaan.');
        });
    };

    window.saveLiburReschedule = function(bookingId) {
        const input = document.getElementById(`libur-resched-input-${bookingId}`);
        const dates = input.value.split(' to ');
        if (dates.length !== 2) {
            alert('Pilih tanggal check-in dan check-out yang valid.');
            return;
        }

        const start = new Date(dates[0]);
        const end = new Date(dates[1]);
        const selectedNights = Math.round((end - start) / (1000 * 60 * 60 * 24));
        const origNights = window[`origNights_${bookingId}`];

        if (selectedNights !== origNights) {
            alert(`Durasi menginap harus sama dengan pesanan awal yaitu ${origNights} malam. Saat ini Anda memilih ${selectedNights} malam.`);
            return;
        }

        const saveBtn = document.getElementById(`btn-libur-resched-save-${bookingId}`);
        saveBtn.disabled = true;
        saveBtn.innerHTML = '<iconify-icon icon="lucide:loader-2" class="animate-spin text-[10px]"></iconify-icon>';

        fetch('/admin/pesanan/force-reschedule', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                booking_id: bookingId,
                check_in_date: dates[0],
                check_out_date: dates[1]
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                recheckLiburKamarConflicts();
            } else {
                alert('Gagal memindahkan jadwal: ' + data.message);
                saveBtn.disabled = false;
                saveBtn.innerHTML = 'Simpan';
            }
        })
        .catch(err => {
            console.error(err);
            alert('Terjadi kesalahan jaringan.');
            saveBtn.disabled = false;
            saveBtn.innerHTML = 'Simpan';
        });
    };

    function recheckLiburKamarConflicts() {
        const dates = window.currentLiburKamarDates;
        const accommodationIds = window.currentLiburKamarAccomIds;

        fetch('/admin/tanggal/check-conflicts', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                dates: dates,
                accommodation_ids: accommodationIds
            })
        })
        .then(res => res.json())
        .then(data => {
            renderLiburKamarConflictsList(data.conflicts);
        })
        .catch(err => {
            console.error(err);
            alert('Gagal menyegarkan daftar bentrokan.');
        });
    }

    window.deleteBlockedPeriod = function(accommodationId, blockId) {
        if (!confirm('Apakah Anda yakin ingin membuka kembali kamar pada periode libur ini?')) return;

        fetch('/admin/unit/blocked-dates', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                action: 'delete',
                accommodation_id: accommodationId,
                block_id: blockId
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            } else {
                alert('Gagal menghapus: ' + data.message);
            }
        })
        .catch(err => {
            console.error(err);
            alert('Kesalahan jaringan.');
        });
    };

    applyFilter(true); // true = keep page from URL hash on first load
})();
</script>

{{-- MODAL LIST LIBUR --}}
<div id="modalListLibur" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 backdrop-blur-sm hidden" onclick="if(event.target===this) closeModalListLibur()">
    <div class="relative w-full max-w-lg mx-4 bg-[#fdf6e3] rounded-3xl shadow-2xl border border-amber-200/60 overflow-hidden animate-[modalIn_0.25s_ease-out_forwards]" style="font-family:'Georgia',serif;">
        <div class="h-1.5 w-full bg-gradient-to-r from-red-400 via-rose-500 to-red-600"></div>
        <div class="flex items-center justify-between px-6 pt-5 pb-0">
            <h2 class="text-lg font-bold text-stone-800 tracking-tight" id="modalListLiburTitle">Tanggal Libur/Blokir</h2>
            <button onclick="closeModalListLibur()" class="p-2 rounded-xl text-stone-400 hover:bg-stone-200/60 hover:text-stone-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="px-6 pt-2 pb-6 max-h-[60vh] overflow-y-auto" id="modalListLiburContent">
            <!-- Content injected here -->
        </div>
    </div>
</div>

{{-- Lightbox --}}
<div id="lightbox" class="fixed inset-0 z-[200] bg-black/80 hidden items-center justify-center" onclick="closeLightbox(event)">
    <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white text-3xl font-bold z-10 hover:text-gray-300 transition">&times;</button>
    <button onclick="lbPrev()" id="lbBtnPrev" class="absolute left-4 top-1/2 -translate-y-1/2 text-white text-4xl font-bold z-10 hover:text-gray-300 transition">‹</button>
    <button onclick="lbNext()" id="lbBtnNext" class="absolute right-4 top-1/2 -translate-y-1/2 text-white text-4xl font-bold z-10 hover:text-gray-300 transition">›</button>
    <img id="lbImg" src="" class="max-w-[90vw] max-h-[85vh] object-contain rounded-xl shadow-2xl" alt="">
</div>

@endpush
@endsection