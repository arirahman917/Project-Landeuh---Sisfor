@extends('layouts.admin')
@section('content')

{{-- ============================================================
     DATA AJUAN PENGEMBALIAN — Daftar Pengajuan Pembatalan
     ============================================================ --}}

{{-- ── TAB NAVIGATION ─────────────────────────────────────────── --}}
<div class="flex items-center gap-2 mb-5">
    <a href="/admin/pesanan"
       class="flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-sm transition-all
              bg-white/80 text-stone-600 border border-stone-200 hover:bg-amber-50 hover:border-amber-300">
        <iconify-icon icon="lucide:clipboard-list" class="text-base"></iconify-icon>
        Data Pesanan
    </a>
    <a href="/admin/pengembalian"
       class="flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-sm transition-all
              bg-[#3a523a] text-white shadow-md">
        <iconify-icon icon="lucide:undo-2" class="text-base"></iconify-icon>
        Data Ajuan Pengembalian
    </a>
</div>

{{-- ── STAT CARD ──────────────────────────────────────────────── --}}
<div class="bg-[#fdf6e3]/80 backdrop-blur-sm rounded-2xl border border-amber-200/60 shadow-sm p-5 flex items-center justify-between mb-6">
    <div class="flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-red-500/10 flex items-center justify-center shrink-0">
            <iconify-icon icon="lucide:undo-2" class="text-2xl text-red-600"></iconify-icon>
        </div>
        <div>
            <p class="text-xs font-semibold text-stone-500 tracking-wider uppercase">Total Ajuan Pengembalian</p>
        </div>
    </div>
    <p class="text-3xl font-extrabold text-stone-800" id="statAjuan">—</p>
</div>

{{-- ── TOOLBAR ────────────────────────────────────────────────── --}}
<div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mb-5">
    <div class="relative flex-1 max-w-xs">
        <span class="absolute inset-y-0 left-3.5 flex items-center text-stone-400 pointer-events-none">
            <iconify-icon icon="lucide:search" class="text-base"></iconify-icon>
        </span>
        <input type="text" id="searchAjuan" placeholder="Cari ajuan…"
            class="w-full pl-9 pr-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm
                   placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
    </div>
    <div class="flex items-center gap-2">
        <button id="filterAll"
            class="px-4 py-2 rounded-lg text-xs font-bold transition-all bg-[#3a523a] text-white shadow"
            onclick="filterAjuan('all')">Semua</button>
        <button id="filterPending"
            class="px-4 py-2 rounded-lg text-xs font-bold transition-all bg-white text-stone-600 border border-stone-200 hover:bg-amber-50"
            onclick="filterAjuan('pending')">Menunggu</button>
        <button id="filterAccepted"
            class="px-4 py-2 rounded-lg text-xs font-bold transition-all bg-white text-stone-600 border border-stone-200 hover:bg-amber-50"
            onclick="filterAjuan('accepted')">Diterima</button>
        <button id="filterRejected"
            class="px-4 py-2 rounded-lg text-xs font-bold transition-all bg-white text-stone-600 border border-stone-200 hover:bg-amber-50"
            onclick="filterAjuan('rejected')">Ditolak</button>
    </div>
</div>

{{-- ── TABLE ──────────────────────────────────────────────────── --}}
<div class="bg-[#fdf6e3]/80 backdrop-blur-sm rounded-2xl border border-amber-200/60 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm min-w-[1000px]">
            <thead>
                <tr class="border-b-2 border-amber-300/60">
                    <th class="px-3 py-3.5 text-left font-bold text-stone-700 text-xs uppercase tracking-wider w-[40px]">No.</th>
                    <th class="px-3 py-3.5 text-left font-bold text-stone-700 text-xs uppercase tracking-wider">No. Pesanan</th>
                    <th class="px-3 py-3.5 text-left font-bold text-stone-700 text-xs uppercase tracking-wider">Identitas Pemesan</th>
                    <th class="px-3 py-3.5 text-left font-bold text-stone-700 text-xs uppercase tracking-wider">Nama Tamu</th>
                    <th class="px-3 py-3.5 text-left font-bold text-stone-700 text-xs uppercase tracking-wider">Akomodasi</th>
                    <th class="px-3 py-3.5 text-center font-bold text-stone-700 text-xs uppercase tracking-wider">Malam</th>
                    <th class="px-3 py-3.5 text-left font-bold text-stone-700 text-xs uppercase tracking-wider">Check-in / Check-out</th>
                    <th class="px-3 py-3.5 text-right font-bold text-stone-700 text-xs uppercase tracking-wider">Total Bayar</th>
                    <th class="px-3 py-3.5 text-center font-bold text-stone-700 text-xs uppercase tracking-wider">Status</th>
                    <th class="px-3 py-3.5 text-center font-bold text-stone-700 text-xs uppercase tracking-wider w-[140px]">Aksi</th>
                </tr>
            </thead>
            <tbody id="ajuanBody"></tbody>
        </table>
    </div>

    {{-- Pagination footer --}}
    <div class="flex items-center justify-between px-5 py-4 border-t border-amber-200/40">
        <div id="btnKembaliAjuan"></div>
        <div class="flex-1 flex items-center justify-center">
            <span class="text-xs text-stone-500 mr-3" id="ajuanInfo"></span>
            <div class="flex items-center gap-1" id="ajuanPagination"></div>
        </div>
        <div id="btnNextAjuan"></div>
    </div>
</div>

{{-- ── MODAL DETAIL ───────────────────────────────────────────── --}}
<div id="modalDetailAjuan" class="fixed inset-0 z-[9999] bg-black/40 backdrop-blur-sm flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
    <div class="bg-white rounded-2xl max-w-md w-[90%] p-6 shadow-2xl transform scale-90 transition-transform duration-300" id="modalDetailBox">
        <h3 class="text-lg font-extrabold text-stone-800 mb-4 flex items-center gap-2">
            <iconify-icon icon="lucide:info" class="text-xl text-amber-500"></iconify-icon>
            Detail Ajuan Pembatalan
        </h3>
        <div id="modalDetailContent" class="text-sm text-stone-600 space-y-2"></div>
        <div class="mt-5 flex justify-end">
            <button onclick="closeDetailModal()" class="px-4 py-2 rounded-lg text-sm font-bold bg-stone-100 text-stone-600 hover:bg-stone-200 transition">Tutup</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
(function(){
    // ── Dummy Data ─────────────────────────────────────────────
    const AJUAN_DATA = [];
    const akomNames = ['Cabin 1','Cabin 2','Cabin 3','Rumah Industrial 1','Glamping VIP'];
    const akomCap   = ['(4 pax)','(4 pax)','(6 pax)','(4 pax)','(2 pax)'];
    const tamNames  = ['M. Akbar R.','Budi S.','Citra D.','Dian P.','Eka W.'];
    const statuses  = ['pending','pending','accepted','rejected','pending'];
    const payMethods= ['Virtual Account BCA','Virtual Account Mandiri','QRIS','Minimarket','ATM Transfer'];

    for (let i = 0; i < 12; i++) {
        const checkin  = new Date(2026, 3, 29 + (i % 5));
        const nights   = 1 + (i % 3);
        const checkout = new Date(checkin.getTime() + nights * 86400000);
        const fmtDate  = (d) => d.toLocaleDateString('id-ID',{weekday:'short',day:'numeric',month:'short',year:'numeric'});
        const aIdx     = i % akomNames.length;

        AJUAN_DATA.push({
            id           : i + 1,
            noPesanan    : 'LDH-' + String(Date.now()).slice(-6) + String(i).padStart(3,'0'),
            pemesanNama  : 'Ari Rahman',
            pemesanTelp  : '081234567890',
            pemesanEmail : 'arirahman@gmail.com',
            namaTamu     : tamNames[i % tamNames.length],
            akomodasi    : akomNames[aIdx],
            akomodasiCap : akomCap[aIdx],
            malam        : nights,
            checkin      : fmtDate(checkin),
            checkout     : fmtDate(checkout),
            total        : 1200000,
            metode       : payMethods[i % payMethods.length],
            status       : statuses[i % statuses.length],
            tanggalAjuan : new Date(2026, 4, 10 + i).toLocaleDateString('id-ID',{day:'numeric',month:'short',year:'numeric'}),
        });
    }

    const PER_PAGE = 10;
    let currentPage = 1;
    let filteredData = [...AJUAN_DATA];
    let activeFilter = 'all';

    function fmt(n) { return Number(n).toLocaleString('id-ID'); }

    function statusBadge(s) {
        if (s === 'accepted') return '<span class="inline-block px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-700">Diterima</span>';
        if (s === 'rejected') return '<span class="inline-block px-2.5 py-1 rounded-full text-[11px] font-bold bg-red-100 text-red-600">Ditolak</span>';
        return '<span class="inline-block px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-100 text-amber-700">Menunggu</span>';
    }

    function actionBtns(idx, status) {
        if (status !== 'pending') return '<span class="text-[11px] text-stone-400 italic">Sudah diproses</span>';
        return `<div class="flex items-center justify-center gap-1.5">
            <button onclick="acceptAjuan(${idx})" class="px-3 py-1.5 rounded-lg text-[11px] font-bold bg-emerald-500 text-white hover:bg-emerald-600 transition shadow-sm" title="Terima">
                <iconify-icon icon="lucide:check" class="text-sm"></iconify-icon>
            </button>
            <button onclick="rejectAjuan(${idx})" class="px-3 py-1.5 rounded-lg text-[11px] font-bold bg-red-500 text-white hover:bg-red-600 transition shadow-sm" title="Tolak">
                <iconify-icon icon="lucide:x" class="text-sm"></iconify-icon>
            </button>
        </div>`;
    }

    // ── Render ─────────────────────────────────────────────────
    function render() {
        const start = (currentPage - 1) * PER_PAGE;
        const page  = filteredData.slice(start, start + PER_PAGE);
        const tbody = document.getElementById('ajuanBody');

        tbody.innerHTML = page.map((p, i) => `
            <tr class="border-b border-stone-100 hover:bg-amber-50/40 transition align-top cursor-pointer" ondblclick="showDetail(${AJUAN_DATA.indexOf(p)})">
                <td class="px-3 py-3 text-stone-600 font-semibold">${start + i + 1}</td>
                <td class="px-3 py-3 text-stone-800 font-mono text-xs">${p.noPesanan}</td>
                <td class="px-3 py-3 text-stone-700 text-xs leading-relaxed">
                    ${p.pemesanNama},<br>${p.pemesanTelp},<br>${p.pemesanEmail}
                </td>
                <td class="px-3 py-3 text-stone-800 font-medium text-xs">${p.namaTamu}</td>
                <td class="px-3 py-3 text-stone-700 text-xs">${p.akomodasi}<br><span class="text-stone-400">${p.akomodasiCap}</span></td>
                <td class="px-3 py-3 text-center text-stone-800 font-semibold text-xs">${p.malam} mlm</td>
                <td class="px-3 py-3 text-stone-700 text-xs leading-relaxed">
                    ${p.checkin} —<br>${p.checkout}
                </td>
                <td class="px-3 py-3 text-right text-stone-800 font-semibold text-xs whitespace-nowrap">
                    ${fmt(p.total)}<br><span class="text-stone-400 font-normal">(${p.metode})</span>
                </td>
                <td class="px-3 py-3 text-center">${statusBadge(p.status)}</td>
                <td class="px-3 py-3 text-center">${actionBtns(AJUAN_DATA.indexOf(p), p.status)}</td>
            </tr>
        `).join('');

        document.getElementById('statAjuan').textContent = AJUAN_DATA.length;
        document.getElementById('ajuanInfo').textContent = `Menampilkan ${filteredData.length} ajuan`;
        renderPagination();
    }

    // ── Pagination ─────────────────────────────────────────────
    function renderPagination() {
        const total      = filteredData.length;
        const totalPages = Math.ceil(total / PER_PAGE);
        const el         = document.getElementById('ajuanPagination');
        const kWrap      = document.getElementById('btnKembaliAjuan');
        const nWrap      = document.getElementById('btnNextAjuan');

        if (totalPages <= 1) { el.innerHTML = ''; kWrap.innerHTML = ''; nWrap.innerHTML = ''; return; }

        kWrap.innerHTML = currentPage === 1
            ? '<div style="width:90px"></div>'
            : `<button onclick="ajuanNav(${currentPage-1})" class="bg-[#3a523a] hover:bg-[#2c402c] text-white text-xs font-semibold px-4 py-2 rounded-full transition shadow">Kembali</button>`;

        let nums = `<button onclick="ajuanNav(${currentPage-1})" class="px-2 py-1 text-stone-500 hover:text-stone-800 transition text-lg" ${currentPage===1?'disabled style="opacity:0.3"':''}>‹</button>`;
        for (let i = 1; i <= totalPages; i++) {
            nums += `<button onclick="ajuanNav(${i})" class="w-8 h-8 rounded-lg text-sm font-bold transition ${i===currentPage?'bg-[#3a523a] text-white shadow':'text-stone-700 hover:bg-amber-100'}">${i}</button>`;
        }
        nums += `<button onclick="ajuanNav(${currentPage+1})" class="px-2 py-1 text-stone-500 hover:text-stone-800 transition text-lg" ${currentPage===totalPages?'disabled style="opacity:0.3"':''}>›</button>`;
        el.innerHTML = nums;

        nWrap.innerHTML = currentPage === totalPages
            ? '<div style="width:100px"></div>'
            : `<button onclick="ajuanNav(${currentPage+1})" class="bg-[#3a523a] hover:bg-[#2c402c] text-white text-xs font-semibold px-4 py-2 rounded-full transition shadow">Selanjutnya</button>`;
    }

    window.ajuanNav = function(page) {
        const totalPages = Math.ceil(filteredData.length / PER_PAGE);
        if (page < 1 || page > totalPages) return;
        currentPage = page;
        render();
    };

    // ── Search ─────────────────────────────────────────────────
    document.getElementById('searchAjuan').addEventListener('input', function() {
        const q = this.value.toLowerCase();
        applyFilters(q);
    });

    // ── Filter ─────────────────────────────────────────────────
    window.filterAjuan = function(status) {
        activeFilter = status;
        // Update button styles
        ['All','Pending','Accepted','Rejected'].forEach(s => {
            const btn = document.getElementById('filter' + s);
            if (!btn) return;
            if (s.toLowerCase() === status) {
                btn.className = 'px-4 py-2 rounded-lg text-xs font-bold transition-all bg-[#3a523a] text-white shadow';
            } else {
                btn.className = 'px-4 py-2 rounded-lg text-xs font-bold transition-all bg-white text-stone-600 border border-stone-200 hover:bg-amber-50';
            }
        });
        const q = document.getElementById('searchAjuan').value.toLowerCase();
        applyFilters(q);
    };

    function applyFilters(q) {
        filteredData = AJUAN_DATA.filter(p => {
            const matchSearch = !q || p.noPesanan.toLowerCase().includes(q) ||
                p.pemesanNama.toLowerCase().includes(q) || p.namaTamu.toLowerCase().includes(q);
            const matchStatus = activeFilter === 'all' || p.status === activeFilter;
            return matchSearch && matchStatus;
        });
        currentPage = 1;
        render();
    }

    // ── Accept / Reject ────────────────────────────────────────
    window.acceptAjuan = function(idx) {
        AJUAN_DATA[idx].status = 'accepted';
        const q = document.getElementById('searchAjuan').value.toLowerCase();
        applyFilters(q);
    };

    window.rejectAjuan = function(idx) {
        AJUAN_DATA[idx].status = 'rejected';
        const q = document.getElementById('searchAjuan').value.toLowerCase();
        applyFilters(q);
    };

    // ── Detail Modal ───────────────────────────────────────────
    window.showDetail = function(idx) {
        const p = AJUAN_DATA[idx];
        const el = document.getElementById('modalDetailContent');
        el.innerHTML = `
            <div class="grid grid-cols-2 gap-x-4 gap-y-2">
                <div><span class="text-stone-400 text-xs">No. Pesanan</span><br><strong>${p.noPesanan}</strong></div>
                <div><span class="text-stone-400 text-xs">Tanggal Ajuan</span><br><strong>${p.tanggalAjuan}</strong></div>
                <div><span class="text-stone-400 text-xs">Pemesan</span><br><strong>${p.pemesanNama}</strong><br>${p.pemesanTelp}<br>${p.pemesanEmail}</div>
                <div><span class="text-stone-400 text-xs">Nama Tamu</span><br><strong>${p.namaTamu}</strong></div>
                <div><span class="text-stone-400 text-xs">Akomodasi</span><br><strong>${p.akomodasi} ${p.akomodasiCap}</strong></div>
                <div><span class="text-stone-400 text-xs">Durasi</span><br><strong>${p.malam} malam</strong></div>
                <div><span class="text-stone-400 text-xs">Check-in</span><br><strong>${p.checkin}</strong></div>
                <div><span class="text-stone-400 text-xs">Check-out</span><br><strong>${p.checkout}</strong></div>
                <div><span class="text-stone-400 text-xs">Total Bayar</span><br><strong>IDR ${fmt(p.total)}</strong></div>
                <div><span class="text-stone-400 text-xs">Metode</span><br><strong>${p.metode}</strong></div>
                <div class="col-span-2"><span class="text-stone-400 text-xs">Status</span><br>${statusBadge(p.status)}</div>
            </div>
        `;
        const modal = document.getElementById('modalDetailAjuan');
        const box   = document.getElementById('modalDetailBox');
        modal.classList.remove('opacity-0','pointer-events-none');
        modal.classList.add('opacity-100');
        box.classList.remove('scale-90');
        box.classList.add('scale-100');
    };

    window.closeDetailModal = function() {
        const modal = document.getElementById('modalDetailAjuan');
        const box   = document.getElementById('modalDetailBox');
        modal.classList.add('opacity-0','pointer-events-none');
        modal.classList.remove('opacity-100');
        box.classList.add('scale-90');
        box.classList.remove('scale-100');
    };

    document.getElementById('modalDetailAjuan')?.addEventListener('click', function(e) {
        if (e.target === this) closeDetailModal();
    });

    render();
})();
</script>
@endpush
@endsection
