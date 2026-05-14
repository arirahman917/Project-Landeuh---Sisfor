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
    <a href="/admin/pengembalian"
       class="flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-sm transition-all
              bg-white/80 text-stone-600 border border-stone-200 hover:bg-amber-50 hover:border-amber-300">
        <iconify-icon icon="lucide:undo-2" class="text-base"></iconify-icon>
        Data Ajuan Pengembalian
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
                    <th class="px-3 py-3.5 text-left font-bold text-stone-700 text-xs uppercase tracking-wider">Check-in dan Check-out</th>
                    <th class="px-3 py-3.5 text-left font-bold text-stone-700 text-xs uppercase tracking-wider">Tambahan Orang</th>
                    <th class="px-3 py-3.5 text-right font-bold text-stone-700 text-xs uppercase tracking-wider">Pembayaran</th>
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

@push('scripts')
<script>
(function(){
    // ── Dummy Data ─────────────────────────────────────────────
    const PESANAN_DATA = [];
    const akomNames = ['Cabin 1','Cabin 2','Cabin 3','Rumah Industrial 1','Glamping VIP'];
    const akomCap   = ['(4 pax)','(4 pax)','(6 pax)','(4 pax)','(2 pax)'];
    const tamNames  = ['M. Akbar R.','Budi S.','Citra D.','Dian P.','Eka W.'];
    const payMethods= ['Virtual Account BCA','Virtual Account Mandiri','QRIS','Minimarket','ATM Transfer'];

    for (let i = 0; i < 100; i++) {
        const checkin  = new Date(2026, 3, 29 + (i % 5));
        const nights   = 1 + (i % 3);
        const checkout = new Date(checkin.getTime() + nights * 86400000);
        const fmtDate  = (d) => d.toLocaleDateString('id-ID',{weekday:'short',day:'numeric',month:'short',year:'numeric'});
        const aIdx     = i % akomNames.length;

        PESANAN_DATA.push({
            id           : i + 1,
            noPesanan    : 'X'.repeat(12),
            pemesanNama  : 'Ari Rahman',
            pemesanTelp  : '081234567890',
            pemesanEmail : 'arirahman@gmail.com',
            namaTamu     : tamNames[i % tamNames.length],
            akomodasi    : akomNames[aIdx],
            akomodasiCap : akomCap[aIdx],
            malam        : nights,
            checkin      : fmtDate(checkin),
            checkout     : fmtDate(checkout),
            tambahanAnak : 2,
            tambahanAnakUsia: 'di atas 5 tahun',
            tambahanDewasa: 1,
            tambahanDewasaUsia: 'di atas 17 tahun',
            total        : 1200000,
            metode       : payMethods[i % payMethods.length],
        });
    }

    const PER_PAGE = 10;
    let currentPage = 1;
    let filteredData = [...PESANAN_DATA];
    let sortAsc = true;

    function fmt(n) { return Number(n).toLocaleString('id-ID'); }

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
                <td class="px-3 py-3 text-stone-700 text-xs leading-relaxed">
                    ${p.tambahanAnak} Anak Kecil (di atas 5 tahun), ${p.tambahanDewasa} Dewasa (di atas 17 tahun)
                </td>
                <td class="px-3 py-3 text-right text-stone-800 font-semibold text-xs whitespace-nowrap">
                    ${fmt(p.total)}<br><span class="text-stone-400 font-normal">(${p.metode})</span>
                </td>
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
        const rows = PESANAN_DATA.map((p,i) =>
            `<tr>
                <td>${i+1}</td><td>${p.noPesanan}</td>
                <td>${p.pemesanNama}<br>${p.pemesanTelp}</td>
                <td>${p.namaTamu}</td><td>${p.akomodasi}</td>
                <td>${p.malam} mlm</td><td>${p.checkin} — ${p.checkout}</td>
                <td>${fmt(p.total)}</td><td>${p.metode}</td>
            </tr>`
        ).join('');
        const w = window.open('','_blank');
        w.document.write(`<html><head><title>Laporan Pesanan</title>
        <style>*{margin:0;padding:0;box-sizing:border-box}body{font-family:Arial,sans-serif;padding:1.5rem}
        h1{font-size:1.1rem;margin-bottom:1rem;text-align:center}
        table{width:100%;border-collapse:collapse;font-size:0.7rem}
        th,td{border:1px solid #ccc;padding:4px 6px;text-align:left}
        th{background:#3a523a;color:#fff}tr:nth-child(even){background:#f9f3e8}
        @media print{body{padding:0.5rem}}</style></head>
        <body><h1>Laporan Data Pesanan — Landeuh Village</h1>
        <table><thead><tr><th>No</th><th>No. Pesanan</th><th>Pemesan</th><th>Tamu</th><th>Akomodasi</th><th>Malam</th><th>Tanggal</th><th>Total</th><th>Metode</th></tr></thead>
        <tbody>${rows}</tbody></table></body></html>`);
        w.document.close();
        w.print();
    };

    render();
})();
</script>
@endpush
@endsection
