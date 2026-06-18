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
    <div id="kalenderInline" class="flex justify-center"></div>
</div>

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
#kalenderInline .flatpickr-calendar {
    box-shadow: none !important;
    border: 1px solid #e7e5e4 !important;
    border-radius: 0.75rem !important;
}
/* Read-only: no selection styling, no active state, hover only */
#kalenderInline .flatpickr-day:not(.flatpickr-disabled) {
    cursor: default !important;
}
#kalenderInline .flatpickr-day:not(.flatpickr-disabled):hover {
    background: #fef3c7 !important;
    border-color: #fbbf24 !important;
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
    background: transparent !important;
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
        if (url.startsWith('http') || url.startsWith('data:')) return url;
        if (url.startsWith('[') && url.endsWith(']')) {
            try {
                const parsed = JSON.parse(url);
                if (Array.isArray(parsed) && parsed.length > 0) return formatImgUrl(parsed[0]);
            } catch(e) {}
        }
        return url.startsWith('/') ? url : '/' + url;
    }

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

        // Booked date badges showing date range and guest name
        let bookedBadgesHtml = '';
        if (currentAndFutureBookings.length > 0) {
            bookedBadgesHtml = currentAndFutureBookings.map(b => {
                const bIn = parseToLocalDate(b.check_in_date);
                const bOut = parseToLocalDate(b.check_out_date);
                
                const fmtDate = (d) => {
                    const dd = String(d.getDate()).padStart(2, '0');
                    const mm = String(d.getMonth() + 1).padStart(2, '0');
                    const yyyy = d.getFullYear();
                    return `${dd}-${mm}-${yyyy}`;
                };
                
                const displayStr = `${fmtDate(bIn)} &rarr; ${fmtDate(bOut)} (${b.pemesan_nama || 'Tamu'})`;
                return `<span class="booked-badge bg-[#fff1f2] border border-red-200 text-red-500 font-semibold px-2 py-1 rounded-lg shadow-sm text-[10px] whitespace-nowrap">${displayStr}</span>`;
            }).join('');
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
                    <span class="text-[11px] font-semibold px-2.5 py-1 rounded-lg shrink-0
                        ${item.jenis === 'Cabin'
                            ? 'bg-blue-50 text-blue-700'
                            : item.jenis === 'Glamping'
                            ? 'bg-emerald-50 text-emerald-700'
                            : 'bg-orange-50 text-orange-700'}">
                        ${item.jenis}
                    </span>
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
                    ${currentAndFutureBookings.length > 0 ? `<div class="flex flex-wrap gap-1.5">${bookedBadgesHtml}</div>` : ''}
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
        function isDateBooked(dateObj) {
            if (!item.bookings || item.bookings.length === 0) return false;
            let checkTime = new Date(dateObj);
            checkTime.setHours(12, 0, 0, 0);
            checkTime = checkTime.getTime();

            let count = 0;
            item.bookings.forEach(b => {
                if (b.status !== 'failed' && b.status !== 'refunded') {
                    let bIn = new Date(b.check_in_date);
                    bIn.setHours(12, 0, 0, 0);
                    let bOut = new Date(b.check_out_date);
                    bOut.setHours(12, 0, 0, 0);
                    if (checkTime >= bIn.getTime() && checkTime < bOut.getTime()) {
                        count++;
                    }
                }
            });
            return count >= item.slot;
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
                    return isDateBooked(date);
                }
            ],
            onDayCreate: function(dObj, dStr, fp, dayElem) {
                const todayLocal = new Date();
                todayLocal.setHours(0, 0, 0, 0);
                if (dayElem.dateObj >= todayLocal && isDateBooked(dayElem.dateObj)) {
                    dayElem.classList.add('booked-date');
                }
            }
        });

        // Open modal
        const modal = document.getElementById('modalKalender');
        const box = document.getElementById('modalKalenderBox');
        modal.classList.remove('opacity-0', 'pointer-events-none');
        modal.classList.add('opacity-100');
        box.classList.remove('scale-90');
        box.classList.add('scale-100');
    };

    window.closeKalenderModal = function() {
        const modal = document.getElementById('modalKalender');
        const box = document.getElementById('modalKalenderBox');
        modal.classList.add('opacity-0', 'pointer-events-none');
        modal.classList.remove('opacity-100');
        box.classList.add('scale-90');
        box.classList.remove('scale-100');
    };

    document.getElementById('modalKalender')?.addEventListener('click', function(e) {
        if (e.target === this) closeKalenderModal();
    });

    applyFilter(true); // true = keep page from URL hash on first load
})();
</script>

{{-- Lightbox --}}
<div id="lightbox" class="fixed inset-0 z-[200] bg-black/80 hidden items-center justify-center" onclick="closeLightbox(event)">
    <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white text-3xl font-bold z-10 hover:text-gray-300 transition">&times;</button>
    <button onclick="lbPrev()" id="lbBtnPrev" class="absolute left-4 top-1/2 -translate-y-1/2 text-white text-4xl font-bold z-10 hover:text-gray-300 transition">‹</button>
    <button onclick="lbNext()" id="lbBtnNext" class="absolute right-4 top-1/2 -translate-y-1/2 text-white text-4xl font-bold z-10 hover:text-gray-300 transition">›</button>
    <img id="lbImg" src="" class="max-w-[90vw] max-h-[85vh] object-contain rounded-xl shadow-2xl" alt="">
</div>

@endpush
@endsection