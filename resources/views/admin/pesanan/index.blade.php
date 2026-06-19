@extends('layouts.admin')
@section('content')

{{-- ============================================================
     DATA PESANAN — Tabel Reservasi + Search + Sort + PDF
     ============================================================ --}}

{{-- ── TAB NAVIGATION ─────────────────────────────────────────── --}}
<div class="flex items-center gap-2 mb-5">
    <a href="/admin/pesanan"
       class="flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-sm transition-all
              bg-[#3a523a] text-white shadow-md">
        <iconify-icon icon="lucide:clipboard-list" class="text-base"></iconify-icon>
        Data Pesanan
    </a>
    <a href="/admin/pembatalan"
       class="flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-sm transition-all
              bg-white/80 text-stone-600 border border-stone-200 hover:bg-amber-50 hover:border-amber-300">
        <iconify-icon icon="lucide:undo-2" class="text-base"></iconify-icon>
        Data Ajuan Pembatalan
    </a>
</div>

{{-- ── STAT CARD ──────────────────────────────────────────────── --}}
<div class="bg-[#fdf6e3]/80 backdrop-blur-sm rounded-2xl border border-amber-200/60 shadow-sm p-5 flex items-center justify-between mb-6">
    <div class="flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-[#3a523a]/10 flex items-center justify-center shrink-0">
            <iconify-icon icon="lucide:clipboard-list" class="text-2xl text-[#3a523a]"></iconify-icon>
        </div>
        <div>
            <p class="text-xs font-semibold text-stone-500 tracking-wider uppercase">Jumlah Pesanan</p>
        </div>
    </div>
    <p class="text-3xl font-extrabold text-stone-800" id="statPesanan">—</p>
</div>

{{-- ── TOOLBAR ────────────────────────────────────────────────── --}}
<div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mb-5">
    <div class="relative flex-1 max-w-xs">
        <span class="absolute inset-y-0 left-3.5 flex items-center text-stone-400 pointer-events-none">
            <iconify-icon icon="lucide:search" class="text-base"></iconify-icon>
        </span>
        <input type="text" id="searchPesanan" placeholder="Cari pesanan…"
            class="w-full pl-9 pr-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm
                   placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
    </div>
    <button id="btnSortMalam"
        class="flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-sm text-[#fdf6e3]
               bg-gradient-to-r from-[#2d4a2d] to-[#3d6b3d] hover:from-[#3d6b3d] hover:to-[#4a824a]
               shadow-md transition-all active:scale-[0.98]">
        Berapa Malam <iconify-icon icon="lucide:arrow-up-down" class="text-sm"></iconify-icon>
    </button>
    <div class="flex-1 hidden sm:block"></div>
    <button onclick="cetakLaporanPesanan()"
        class="flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-sm text-[#fdf6e3]
               bg-gradient-to-r from-[#2d4a2d] to-[#3d6b3d] hover:from-[#3d6b3d] hover:to-[#4a824a]
               shadow-lg shadow-green-900/20 transition-all active:scale-[0.98]">
        <iconify-icon icon="lucide:printer" class="text-base"></iconify-icon> Cetak Laporan PDF
    </button>
</div>

{{-- ── TABLE ──────────────────────────────────────────────────── --}}
<div class="bg-[#fdf6e3]/80 backdrop-blur-sm rounded-2xl border border-amber-200/60 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm min-w-[900px]">
            <thead>
                <tr class="border-b-2 border-amber-300/60">
                    <th class="px-3 py-3.5 text-left font-bold text-stone-700 text-xs uppercase tracking-wider w-[40px]">No.</th>
                    <th class="px-3 py-3.5 text-left font-bold text-stone-700 text-xs uppercase tracking-wider">Nomor Pesanan</th>
                    <th class="px-3 py-3.5 text-left font-bold text-stone-700 text-xs uppercase tracking-wider">Identitas Pemesan</th>
                    <th class="px-3 py-3.5 text-left font-bold text-stone-700 text-xs uppercase tracking-wider">Nama Tamu</th>
                    <th class="px-3 py-3.5 text-left font-bold text-stone-700 text-xs uppercase tracking-wider">Akomodasi</th>
                    <th class="px-3 py-3.5 text-center font-bold text-stone-700 text-xs uppercase tracking-wider">Berapa Malam</th>
                    <th class="px-3 py-3.5 text-left font-bold text-stone-700 text-xs uppercase tracking-wider min-w-[180px]">Check-in dan Check-out</th>
                    <th class="px-3 py-3.5 text-left font-bold text-stone-700 text-xs uppercase tracking-wider">
                        <div class="flex items-center gap-1">
                            <iconify-icon icon="lucide:info" class="text-stone-400 hover:text-amber-500 cursor-pointer text-sm transition-colors" onclick="showModalInfoTambahan()"></iconify-icon>
                            Tambahan Orang
                        </div>
                    </th>
                    <th class="px-3 py-3.5 text-left font-bold text-stone-700 text-xs uppercase tracking-wider min-w-[120px]">Tanggal Booking</th>
                    <th class="px-3 py-3.5 text-right font-bold text-stone-700 text-xs uppercase tracking-wider">Pembayaran</th>
                    <th class="px-3 py-3.5 text-center font-bold text-stone-700 text-xs uppercase tracking-wider w-[130px]">Status</th>
                </tr>
            </thead>
            <tbody id="pesananBody"></tbody>
        </table>
    </div>

    {{-- Pagination footer --}}
    <div class="flex items-center justify-between px-5 py-4 border-t border-amber-200/40">
        <div id="btnKembaliPsn"></div>
        <div class="flex-1 flex items-center justify-center">
            <span class="text-xs text-stone-500 mr-3" id="pesananInfo"></span>
            <div class="flex items-center gap-1" id="pesananPagination"></div>
        </div>
        <div id="btnNextPsn"></div>
    </div>
</div>

{{-- ── MODAL INFO TAMBAHAN ORANG ────────────────────────────────── --}}
<div id="modalInfoTambahan" class="fixed inset-0 z-[9999] bg-black/40 backdrop-blur-sm flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
    <div class="bg-white rounded-2xl max-w-sm w-[90%] p-6 shadow-2xl transform scale-90 transition-transform duration-300" id="modalInfoTambahanBox">
        <h3 class="text-base font-extrabold text-stone-800 mb-3 flex items-center gap-2">
            <iconify-icon icon="lucide:info" class="text-xl text-amber-500"></iconify-icon>
            Keterangan Tambahan Orang
        </h3>
        <p class="text-sm text-stone-600 mb-5 leading-relaxed">
            Data pada kolom ini menunjukkan jumlah tambahan tamu di luar kapasitas maksimal unit:
            <br><br>
            • <strong>Anak:</strong> Anak Kecil (di atas 5 tahun)<br>
            • <strong>Dewasa:</strong> Dewasa (di atas 17 tahun)
        </p>
        <div class="flex justify-end">
            <button onclick="closeModalInfoTambahan()" class="px-4 py-2 rounded-lg text-sm font-bold bg-stone-100 text-stone-600 hover:bg-stone-200 transition">Mengerti</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
(function(){
    // ── Data dari Database ─────────────────────────────────────
    const PESANAN_DATA = @json($formattedBookings);

    const PER_PAGE = 10;
    let currentPage = 1;
    let filteredData = [...PESANAN_DATA];
    let sortAsc = true;

    function fmt(n) { return Number(n).toLocaleString('id-ID'); }

    function statusBadge(s) {
        if (s === 'refunded') return '<span class="inline-block px-2.5 py-1 rounded-full text-[11px] font-bold bg-red-100 text-red-600">Dibatalkan</span>';
        if (s === 'refund_pending') return '<span class="inline-block px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-100 text-amber-700">Pembatalan Diajukan</span>';
        if (s === 'refund_rejected') {
            return `
                <div class="flex flex-col items-center gap-1.5">
                    <span class="inline-block px-2.5 py-1 rounded-full text-[11px] font-bold bg-green-100 text-green-700">Sukses / Lunas</span>
                    <span class="flex items-center gap-1 px-1.5 py-0.5 rounded text-[9px] font-semibold bg-amber-50 text-amber-600 border border-amber-200" title="Pernah mengajukan pembatalan namun ditolak">
                        <iconify-icon icon="lucide:info" class="text-[10px]"></iconify-icon> Ajuan Ditolak
                    </span>
                </div>
            `;
        }
        return '<span class="inline-block px-2.5 py-1 rounded-full text-[11px] font-bold bg-green-100 text-green-700">Sukses / Lunas</span>';
    }

    function formatTambahan(anak, dewasa) {
        let texts = [];
        if (anak > 0) texts.push(`${anak} Anak`);
        if (dewasa > 0) texts.push(`${dewasa} Dewasa`);
        return texts.length > 0 ? texts.join(', ') : '-';
    }

    window.showModalInfoTambahan = function() {
        const modal = document.getElementById('modalInfoTambahan');
        const box   = document.getElementById('modalInfoTambahanBox');
        modal.classList.remove('opacity-0','pointer-events-none');
        modal.classList.add('opacity-100');
        box.classList.remove('scale-90');
        box.classList.add('scale-100');
    };

    window.closeModalInfoTambahan = function() {
        const modal = document.getElementById('modalInfoTambahan');
        const box   = document.getElementById('modalInfoTambahanBox');
        modal.classList.add('opacity-0','pointer-events-none');
        modal.classList.remove('opacity-100');
        box.classList.add('scale-90');
        box.classList.remove('scale-100');
    };

    document.getElementById('modalInfoTambahan')?.addEventListener('click', function(e) {
        if (e.target === this) closeModalInfoTambahan();
    });

    // ── Render ─────────────────────────────────────────────────
    function render() {
        const start = (currentPage - 1) * PER_PAGE;
        const page  = filteredData.slice(start, start + PER_PAGE);
        const tbody = document.getElementById('pesananBody');

        tbody.innerHTML = page.map((p, i) => `
            <tr class="border-b border-stone-100 hover:bg-amber-50/40 transition align-top">
                <td class="px-3 py-3 text-stone-600 font-semibold">${start + i + 1}</td>
                <td class="px-3 py-3 text-stone-800 font-mono text-xs">${p.noPesanan}</td>
                <td class="px-3 py-3 text-stone-700 text-xs leading-relaxed">
                    ${p.pemesanNama},<br>${p.pemesanTelp},<br>${p.pemesanEmail}
                </td>
                <td class="px-3 py-3 text-stone-800 font-medium text-xs">${p.namaTamu}</td>
                <td class="px-3 py-3 text-stone-700 text-xs">${p.akomodasi}<br><span class="text-stone-400">${p.akomodasiCap}</span></td>
                <td class="px-3 py-3 text-center text-stone-800 font-semibold text-xs">${p.malam} malam</td>
                <td class="px-3 py-3 text-stone-700 text-xs leading-relaxed">
                    ${p.checkin} —<br>${p.checkout}
                </td>
                <td class="px-3 py-3 text-stone-700 text-xs leading-relaxed font-medium">
                    ${formatTambahan(p.tambahanAnak, p.tambahanDewasa)}
                </td>
                <td class="px-3 py-3 text-stone-800 font-semibold text-xs whitespace-nowrap">${p.tanggalDipesan}</td>
                <td class="px-3 py-3 text-right text-stone-800 font-semibold text-xs whitespace-nowrap">
                    ${fmt(p.total)}<br><span class="text-stone-400 font-normal">(${p.metode})</span>
                </td>
                <td class="px-3 py-3 text-center">${statusBadge(p.status)}</td>
            </tr>
        `).join('');

        document.getElementById('statPesanan').textContent = PESANAN_DATA.length;
        document.getElementById('pesananInfo').textContent = `Terdiri dari ${filteredData.length} pesanan`;
        renderPagination();
    }

    // ── Pagination ─────────────────────────────────────────────
    function renderPagination() {
        const total      = filteredData.length;
        const totalPages = Math.ceil(total / PER_PAGE);
        const el         = document.getElementById('pesananPagination');
        const kWrap      = document.getElementById('btnKembaliPsn');
        const nWrap      = document.getElementById('btnNextPsn');

        if (totalPages <= 1) { el.innerHTML = ''; kWrap.innerHTML = ''; nWrap.innerHTML = ''; return; }

        kWrap.innerHTML = currentPage === 1
            ? '<div style="width:90px"></div>'
            : `<button onclick="psnNav(${currentPage-1})" class="bg-[#3a523a] hover:bg-[#2c402c] text-white text-xs font-semibold px-4 py-2 rounded-full transition shadow">Kembali</button>`;

        let nums = `<button onclick="psnNav(${currentPage-1})" class="px-2 py-1 text-stone-500 hover:text-stone-800 transition text-lg" ${currentPage===1?'disabled style="opacity:0.3"':''}>‹</button>`;
        for (let i = 1; i <= totalPages; i++) {
            if (totalPages > 7 && i > 3 && i < totalPages - 1 && Math.abs(i - currentPage) > 1) {
                if (i === 4) nums += '<span class="px-1 text-stone-400">…</span>';
                continue;
            }
            nums += `<button onclick="psnNav(${i})" class="w-8 h-8 rounded-lg text-sm font-bold transition ${i===currentPage?'bg-[#3a523a] text-white shadow':'text-stone-700 hover:bg-amber-100'}">${i}</button>`;
        }
        nums += `<button onclick="psnNav(${currentPage+1})" class="px-2 py-1 text-stone-500 hover:text-stone-800 transition text-lg" ${currentPage===totalPages?'disabled style="opacity:0.3"':''}>›</button>`;
        el.innerHTML = nums;

        nWrap.innerHTML = currentPage === totalPages
            ? '<div style="width:100px"></div>'
            : `<button onclick="psnNav(${currentPage+1})" class="bg-[#3a523a] hover:bg-[#2c402c] text-white text-xs font-semibold px-4 py-2 rounded-full transition shadow">Selanjutnya</button>`;
    }

    window.psnNav = function(page) {
        const totalPages = Math.ceil(filteredData.length / PER_PAGE);
        if (page < 1 || page > totalPages) return;
        currentPage = page;
        render();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };

    // ── Search ─────────────────────────────────────────────────
    document.getElementById('searchPesanan').addEventListener('input', function() {
        const q = this.value.toLowerCase();
        filteredData = PESANAN_DATA.filter(p =>
            p.noPesanan.toLowerCase().includes(q) ||
            p.pemesanNama.toLowerCase().includes(q) ||
            p.namaTamu.toLowerCase().includes(q) ||
            p.akomodasi.toLowerCase().includes(q)
        );
        currentPage = 1;
        render();
    });

    // ── Sort by Malam ──────────────────────────────────────────
    document.getElementById('btnSortMalam').addEventListener('click', function() {
        sortAsc = !sortAsc;
        filteredData.sort((a, b) => sortAsc ? a.malam - b.malam : b.malam - a.malam);
        render();
    });

    // ── PDF ────────────────────────────────────────────────────
    window.cetakLaporanPesanan = function() {
        const rows = PESANAN_DATA.map((p,i) => {
            let displayStatus = 'Sukses / Lunas';
            if (p.status === 'refunded') displayStatus = 'Dibatalkan';
            if (p.status === 'refund_pending') displayStatus = 'Refund Pending';
            if (p.status === 'refund_rejected') displayStatus = 'Sukses / Lunas (Ajuan Ditolak)';
            
            return `<tr>
                <td>${i+1}</td><td>${p.noPesanan}</td>
                <td>${p.pemesanNama}<br>${p.pemesanTelp}</td>
                <td>${p.namaTamu}</td><td>${p.akomodasi}</td>
                <td>${p.malam} mlm</td><td>${p.checkin} — ${p.checkout}</td>
                <td>${fmt(p.total)}</td><td>${p.metode}</td>
                <td>${displayStatus}</td>
            </tr>`;
        }).join('');
        const w = window.open('','_blank');
        w.document.write(`<html><head><title>Laporan Pesanan</title>
        <style>*{margin:0;padding:0;box-sizing:border-box}body{font-family:Arial,sans-serif;padding:1.5rem}
        h1{font-size:1.1rem;margin-bottom:1rem;text-align:center}
        table{width:100%;border-collapse:collapse;font-size:0.7rem}
        th,td{border:1px solid #ccc;padding:4px 6px;text-align:left}
        th{background:#3a523a;color:#fff}tr:nth-child(even){background:#f9f3e8}
        @media print{body{padding:0.5rem}}</style></head>
        <body><h1>Laporan Data Pesanan — Landeuh Village</h1>
        <table><thead><tr><th>No</th><th>No. Pesanan</th><th>Pemesan</th><th>Tamu</th><th>Akomodasi</th><th>Malam</th><th>Tanggal</th><th>Total</th><th>Metode</th><th>Status</th></tr></thead>
        <tbody>${rows}</tbody></table></body></html>`);
        w.document.close();
        w.print();
    };

    render();
})();
</script>
@endpush
@endsection
