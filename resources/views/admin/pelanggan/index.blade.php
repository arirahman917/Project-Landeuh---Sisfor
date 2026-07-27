@extends('layouts.admin')
@section('content')

{{-- ============================================================
     DATA PELANGGAN — Tabel + Search + Sort + PDF
     ============================================================ --}}

@include('admin.pelanggan._modal-edit')

{{-- ── STAT CARD ──────────────────────────────────────────────── --}}
<div class="bg-[#fdf6e3]/80 backdrop-blur-sm rounded-2xl border border-amber-200/60 shadow-sm p-5 flex items-center justify-between mb-6">
    <div class="flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-[#3a523a]/10 flex items-center justify-center shrink-0">
            <iconify-icon icon="lucide:users" class="text-2xl text-[#3a523a]"></iconify-icon>
        </div>
        <div>
            <p class="text-xs font-semibold text-stone-500 tracking-wider uppercase">Jumlah Data Pelanggan</p>
        </div>
    </div>
    <p class="text-3xl font-extrabold text-stone-800" id="statPelanggan">—</p>
</div>

{{-- ── TOOLBAR ────────────────────────────────────────────────── --}}
<div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mb-5">
    <div class="relative flex-1 max-w-xs">
        <span class="absolute inset-y-0 left-3.5 flex items-center text-stone-400 pointer-events-none">
            <iconify-icon icon="lucide:search" class="text-base"></iconify-icon>
        </span>
        <input type="text" id="searchPelanggan" placeholder="Cari pelanggan"
            class="w-full pl-9 pr-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm
                   placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
    </div>
    <button id="btnSortNama"
        class="flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-sm text-[#fdf6e3]
               bg-gradient-to-r from-[#2d4a2d] to-[#3d6b3d] hover:from-[#3d6b3d] hover:to-[#4a824a]
               shadow-md transition-all active:scale-[0.98]">
        Nama <iconify-icon icon="lucide:arrow-up-down" class="text-sm"></iconify-icon>
    </button>
    <div class="flex-1 hidden sm:block"></div>
    <button onclick="openModalCetakPdfPelanggan()"
        class="flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-sm text-[#fdf6e3]
               bg-gradient-to-r from-[#2d4a2d] to-[#3d6b3d] hover:from-[#3d6b3d] hover:to-[#4a824a]
               shadow-lg shadow-green-900/20 transition-all active:scale-[0.98]">
        <iconify-icon icon="lucide:printer" class="text-base"></iconify-icon> Cetak Laporan PDF
    </button>
</div>

{{-- ── TABLE ──────────────────────────────────────────────────── --}}
<div class="bg-[#fdf6e3]/80 backdrop-blur-sm rounded-2xl border border-amber-200/60 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b-2 border-amber-300/60">
                    <th class="px-4 py-3.5 text-left font-bold text-stone-700 text-xs uppercase tracking-wider w-[50px]">No.</th>
                    <th class="px-4 py-3.5 text-left font-bold text-stone-700 text-xs uppercase tracking-wider">Nama Lengkap</th>
                    <th class="px-4 py-3.5 text-left font-bold text-stone-700 text-xs uppercase tracking-wider">Email</th>
                    <th class="px-4 py-3.5 text-left font-bold text-stone-700 text-xs uppercase tracking-wider">No. Telepon</th>
                    <th class="px-4 py-3.5 text-left font-bold text-stone-700 text-xs uppercase tracking-wider">Tanggal Daftar</th>
                    <th class="px-4 py-3.5 text-center font-bold text-stone-700 text-xs uppercase tracking-wider w-[140px]">Tindakan</th>
                </tr>
            </thead>
            <tbody id="pelangganBody"></tbody>
        </table>
    </div>

    {{-- Pagination footer --}}
    <div class="flex items-center justify-between px-5 py-4 border-t border-amber-200/40">
        <div class="text-xs text-stone-500" id="pelangganInfo"></div>
        <div class="flex items-center gap-1" id="pelangganPagination"></div>
    </div>
</div>

{{-- ── TOAST ──────────────────────────────────────────────────── --}}
<div id="adminToast"
    class="fixed bottom-6 right-6 z-[200] flex items-center gap-3 px-5 py-3.5 rounded-2xl shadow-xl
           bg-[#1e2d1e] text-white text-sm font-medium opacity-0 pointer-events-none transition-all duration-300">
    <iconify-icon icon="lucide:check-circle" class="text-green-400 text-lg shrink-0"></iconify-icon>
    <span id="adminToastMsg">Berhasil!</span>
</div>

{{-- ── MODAL CETAK PDF ────────────────────────────────────────── --}}
<div id="modalCetakPdfPelanggan" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 backdrop-blur-sm hidden" onclick="if(event.target===this) closeModalCetakPdfPelanggan()">
    <div class="bg-[#fdf6e3] rounded-3xl shadow-2xl border border-amber-200/60 p-6 w-full max-w-sm animate-[modalIn_0.25s_ease-out_forwards]">
        <h3 class="text-lg font-bold text-stone-800 mb-4">Cetak Laporan PDF</h3>
        <div class="space-y-4 mb-6">
            <div>
                <label class="block text-xs font-semibold text-stone-600 mb-1.5 uppercase">Bulan</label>
                <select id="filterBulanPelanggan" class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-sm">
                    <option value="semua">Semua Bulan</option>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-stone-600 mb-1.5 uppercase">Tahun</label>
                <select id="filterTahunPelanggan" class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-sm">
                    <option value="semua">Semua Tahun</option>
                    <!-- JavaScript will populate years here -->
                </select>
            </div>
        </div>
        <div class="flex justify-end gap-3">
            <button onclick="closeModalCetakPdfPelanggan()" class="px-5 py-2 rounded-xl text-sm font-semibold text-stone-600 bg-stone-200 hover:bg-stone-300">Batal</button>
            <button onclick="prosesCetakPdfPelanggan()" class="px-5 py-2 rounded-xl text-sm font-bold text-white bg-green-700 hover:bg-green-800">Cetak</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
(function(){
    // ── Real Database Data ─────────────────────────────────────
    const PELANGGAN_DATA = @json($pelanggans);

    const PER_PAGE = 18;
    let currentPage = 1;
    let filteredData = [...PELANGGAN_DATA];
    let sortAsc = true;

    // ── Render Table ───────────────────────────────────────────
    function render() {
        const start = (currentPage - 1) * PER_PAGE;
        const page  = filteredData.slice(start, start + PER_PAGE);
        const tbody = document.getElementById('pelangganBody');

        tbody.innerHTML = page.map((p, i) => `
            <tr class="border-b border-stone-100 hover:bg-amber-50/40 transition">
                <td class="px-4 py-3 text-stone-600 font-semibold">${start + i + 1}</td>
                <td class="px-4 py-3 text-stone-800 font-medium">${p.nama}</td>
                <td class="px-4 py-3 text-stone-600">${p.email}</td>
                <td class="px-4 py-3 text-stone-600">${p.telp}</td>
                <td class="px-4 py-3 text-stone-600 whitespace-nowrap">${p.tanggal_daftar}</td>
                <td class="px-4 py-3 text-center">
                    <div class="flex items-center justify-center gap-2">
                        <button onclick="openModalEditPelanggan(${p.id})"
                            class="w-9 h-9 rounded-lg bg-amber-400 hover:bg-amber-500 text-white flex items-center justify-center transition shadow-sm active:scale-95">
                            <iconify-icon icon="lucide:pencil" class="text-base"></iconify-icon>
                        </button>
                        <button onclick="hapusPelanggan(${p.id})"
                            class="w-9 h-9 rounded-lg bg-red-500 hover:bg-red-600 text-white flex items-center justify-center transition shadow-sm active:scale-95">
                            <iconify-icon icon="lucide:trash-2" class="text-base"></iconify-icon>
                        </button>
                    </div>
                </td>
            </tr>
        `).join('');

        document.getElementById('statPelanggan').textContent = PELANGGAN_DATA.length;
        document.getElementById('pelangganInfo').textContent = `Terdiri dari ${filteredData.length} pelanggan`;
        renderPagination();
    }

    // ── Pagination ─────────────────────────────────────────────
    function renderPagination() {
        const total      = filteredData.length;
        const totalPages = Math.ceil(total / PER_PAGE);
        const el         = document.getElementById('pelangganPagination');
        if (totalPages <= 1) { el.innerHTML = ''; return; }

        let html = `<button onclick="plgNav(${currentPage-1})" class="px-2 py-1 text-stone-500 hover:text-stone-800 transition text-lg" ${currentPage===1?'disabled style="opacity:0.3"':''}>‹</button>`;
        for (let i = 1; i <= totalPages; i++) {
            html += `<button onclick="plgNav(${i})" class="w-8 h-8 rounded-lg text-sm font-bold transition ${i===currentPage?'bg-[#3a523a] text-white shadow':'text-stone-700 hover:bg-amber-100'}">${i}</button>`;
        }
        html += `<button onclick="plgNav(${currentPage+1})" class="px-2 py-1 text-stone-500 hover:text-stone-800 transition text-lg" ${currentPage===totalPages?'disabled style="opacity:0.3"':''}>›</button>`;
        el.innerHTML = html;
    }

    window.plgNav = function(page) {
        const totalPages = Math.ceil(filteredData.length / PER_PAGE);
        if (page < 1 || page > totalPages) return;
        currentPage = page;
        render();
    };

    // ── Search ─────────────────────────────────────────────────
    document.getElementById('searchPelanggan').addEventListener('input', function() {
        const q = this.value.toLowerCase();
        filteredData = PELANGGAN_DATA.filter(p =>
            p.nama.toLowerCase().includes(q) || p.email.toLowerCase().includes(q) || p.telp.includes(q)
        );
        currentPage = 1;
        render();
    });

    // ── Sort ───────────────────────────────────────────────────
    document.getElementById('btnSortNama').addEventListener('click', function() {
        sortAsc = !sortAsc;
        filteredData.sort((a, b) => sortAsc ? a.nama.localeCompare(b.nama) : b.nama.localeCompare(a.nama));
        render();
    });

    // ── Hapus (AJAX Backend) ───────────────────────────────────
    window.hapusPelanggan = function(id) {
        if (!confirm('Yakin ingin menghapus pelanggan ini dari sistem?')) return;
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
        
        fetch(`/admin/pelanggan/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const idx = PELANGGAN_DATA.findIndex(p => p.id === id);
                if (idx !== -1) PELANGGAN_DATA.splice(idx, 1);
                filteredData = filteredData.filter(p => p.id !== id);
                render();
                showToast('Pelanggan berhasil dihapus.', 'lucide:trash-2', 'text-red-400');
            } else {
                alert('Gagal menghapus pelanggan: ' + (data.message || 'Terjadi kesalahan'));
            }
        })
        .catch(err => {
            console.error('Error:', err);
            alert('Terjadi kesalahan koneksi saat menghapus pelanggan.');
        });
    };

    // ── Toast ──────────────────────────────────────────────────
    window.showToast = function(msg, icon = 'lucide:check-circle', color = 'text-green-400') {
        const t = document.getElementById('adminToast');
        const m = document.getElementById('adminToastMsg');
        m.textContent = msg;
        t.style.opacity = '1';
        setTimeout(() => { t.style.opacity = '0'; }, 2500);
    };

    // ── Expose data for modal ──────────────────────────────────
    window.PELANGGAN_DATA = PELANGGAN_DATA;
    window.renderPelangganTable = render;

    // ── PDF ────────────────────────────────────────────────────
    window.openModalCetakPdfPelanggan = function() {
        const modal = document.getElementById('modalCetakPdfPelanggan');
        const tahunSelect = document.getElementById('filterTahunPelanggan');
        
        // Populate years dynamically based on data
        let years = new Set();
        PELANGGAN_DATA.forEach(p => {
            if (p.raw_date) {
                years.add(p.raw_date.substring(0, 4));
            }
        });
        years = Array.from(years).sort((a,b) => b - a);
        
        let yearHtml = '<option value="semua">Semua Tahun</option>';
        years.forEach(y => {
            yearHtml += `<option value="${y}">${y}</option>`;
        });
        tahunSelect.innerHTML = yearHtml;
        
        modal.classList.remove('hidden');
    };

    window.closeModalCetakPdfPelanggan = function() {
        document.getElementById('modalCetakPdfPelanggan').classList.add('hidden');
    };

    window.prosesCetakPdfPelanggan = function() {
        const bulan = document.getElementById('filterBulanPelanggan').value;
        const tahun = document.getElementById('filterTahunPelanggan').value;
        
        let dataToPrint = PELANGGAN_DATA;
        let titleSuffix = '';
        
        const monthNames = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        
        let periodeString = 'Semua Periode';
        if (bulan !== 'semua' && tahun !== 'semua') {
            periodeString = `${monthNames[parseInt(bulan)]} ${tahun}`;
        } else if (bulan === 'semua' && tahun !== 'semua') {
            periodeString = `Semua Bulan Tahun ${tahun}`;
        } else if (bulan !== 'semua' && tahun === 'semua') {
            periodeString = `Bulan ${monthNames[parseInt(bulan)]} (Semua Tahun)`;
        }

        const now = new Date();
        const dicetak = `${now.getDate()} ${monthNames[now.getMonth()+1]} ${now.getFullYear()} ${now.getHours().toString().padStart(2, '0')}.${now.getMinutes().toString().padStart(2, '0')} WIB`;

        if (bulan !== 'semua' || tahun !== 'semua') {
            dataToPrint = PELANGGAN_DATA.filter(p => {
                if (!p.raw_date) return false;
                const pTahun = p.raw_date.substring(0, 4);
                const pBulan = p.raw_date.substring(5, 7);
                
                let match = true;
                if (tahun !== 'semua' && pTahun !== tahun) match = false;
                if (bulan !== 'semua' && pBulan !== bulan) match = false;
                
                return match;
            });
        }
        
        if (dataToPrint.length === 0) {
            alert('Tidak ada data pada periode tersebut.');
            return;
        }

        const rows = dataToPrint.map((p,i) =>
            `<tr><td>${i+1}</td><td>${p.nama}</td><td>${p.email}</td><td>${p.telp}</td><td>${p.tanggal_daftar}</td></tr>`
        ).join('');
        const w = window.open('','_blank');
        w.document.write(`<html><head><title>Laporan Pelanggan</title>
        <style>*{margin:0;padding:0;box-sizing:border-box}body{font-family:Arial,sans-serif;padding:2rem}
        .header-container{display:flex;align-items:center;margin-bottom:1.5rem;border-bottom:2px solid #3a523a;padding-bottom:1rem}
        .logo{width:80px;height:auto;margin-right:1.5rem}
        .header-text h2{font-size:1.3rem;color:#1a1a1a;margin-bottom:0.25rem;text-transform:uppercase;letter-spacing:0.5px}
        .header-text h3{font-size:1.1rem;color:#3a523a;margin-bottom:0.75rem;font-weight:600}
        .header-text p{font-size:0.85rem;color:#444;margin-bottom:0.15rem}
        table{width:100%;border-collapse:collapse;font-size:0.85rem}
        th,td{border:1px solid #ccc;padding:6px 10px;text-align:left}
        th{background:#3a523a;color:#fff}tr:nth-child(even){background:#f9f3e8}
        @media print{body{padding:0.5rem}}</style></head>
        <body>
        <div class="header-container">
            <img src="${window.location.origin}/images/logo-landeuh.png" class="logo" alt="Logo" onload="window.print()" onerror="window.print()">
            <div class="header-text">
                <h2>LAPORAN DATA PELANGGAN</h2>
                <h3>Landeuh Riverside Camp</h3>
                <p>Periode : ${periodeString || 'Semua Periode'}</p>
                <p>Dicetak : ${typeof dicetak !== 'undefined' ? dicetak : ''}</p>
            </div>
        </div>
        <table><thead><tr><th>No</th><th>Nama</th><th>Email</th><th>Telepon</th><th>Tanggal Daftar</th></tr></thead>
        <tbody>${rows}</tbody></table></body></html>`);
        w.document.close();
        
        closeModalCetakPdfPelanggan();
    };

    render();
})();
</script>
@endpush
@endsection
