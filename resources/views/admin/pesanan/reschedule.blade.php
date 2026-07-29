@extends('layouts.admin')
@section('content')

{{-- ============================================================
     DATA AJUAN RESCHEDULE — Daftar Pengajuan Reschedule
     ============================================================ --}}

{{-- ── TAB NAVIGATION ─────────────────────────────────────────── --}}
<div class="flex items-center gap-2 mb-5">
    <a href="/admin/pesanan"
       class="flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-sm transition-all
              bg-white/80 text-stone-600 border border-stone-200 hover:bg-amber-50 hover:border-amber-300">
        <iconify-icon icon="lucide:clipboard-list" class="text-base"></iconify-icon>
        Data Pesanan
    </a>
    <a href="/admin/reschedule"
       class="flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-sm transition-all
              bg-[#3a523a] text-white shadow-md">
        <iconify-icon icon="lucide:calendar-clock" class="text-base"></iconify-icon>
        Data Ajuan Reschedule
    </a>
</div>

{{-- ── STAT CARD ──────────────────────────────────────────────── --}}
<div class="bg-[#fdf6e3]/80 backdrop-blur-sm rounded-2xl border border-amber-200/60 shadow-sm p-5 flex items-center justify-between mb-6">
    <div class="flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-amber-500/10 flex items-center justify-center shrink-0">
            <iconify-icon icon="lucide:calendar-clock" class="text-2xl text-amber-600"></iconify-icon>
        </div>
        <div>
            <p class="text-xs font-semibold text-stone-500 tracking-wider uppercase">Total Ajuan Reschedule</p>
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
                    <th class="px-3 py-3.5 text-left font-bold text-stone-700 text-xs uppercase tracking-wider min-w-[150px]">CI/CO Lama</th>
                    <th class="px-3 py-3.5 text-left font-bold text-stone-700 text-xs uppercase tracking-wider min-w-[150px]">CI/CO Ajuan</th>
                    <th class="px-3 py-3.5 text-left font-bold text-stone-700 text-xs uppercase tracking-wider min-w-[120px]">Tanggal Booking</th>
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
            Detail Ajuan Reschedule
        </h3>
        <div id="modalDetailContent" class="text-sm text-stone-600 space-y-2"></div>
        <div class="mt-5 flex justify-end">
            <button onclick="closeDetailModal()" class="px-4 py-2 rounded-lg text-sm font-bold bg-stone-100 text-stone-600 hover:bg-stone-200 transition">Tutup</button>
        </div>
    </div>
</div>

{{-- ── MODERN CONFIRM MODAL ───────────────────────────────────── --}}
<div id="modalConfirm" class="fixed inset-0 z-[10000] bg-black/40 backdrop-blur-sm flex items-center justify-center opacity-0 pointer-events-none transition-all duration-300">
    <div class="bg-white rounded-2xl max-w-sm w-[90%] p-6 shadow-2xl transform scale-90 transition-all duration-300" id="modalConfirmBox">
        <div class="flex items-center gap-3 mb-4">
            <div id="confirmIconWrap" class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0">
                <iconify-icon id="confirmIcon" class="text-xl"></iconify-icon>
            </div>
            <h3 class="text-base font-extrabold text-stone-800" id="confirmTitle">Konfirmasi</h3>
        </div>
        <p class="text-sm text-stone-600 leading-relaxed mb-6" id="confirmMessage">Apakah Anda yakin?</p>
        <div class="flex items-center justify-end gap-2">
            <button onclick="closeConfirmModal()" class="px-4 py-2.5 rounded-xl text-sm font-bold bg-stone-100 text-stone-600 hover:bg-stone-200 transition">Batal</button>
            <button id="confirmOkBtn" class="px-5 py-2.5 rounded-xl text-sm font-bold text-white transition shadow-sm">Ya, Lanjutkan</button>
        </div>
    </div>
</div>

{{-- ── MODERN RESULT MODAL (Success / Error feedback) ─────────── --}}
<div id="modalResult" class="fixed inset-0 z-[10001] bg-black/40 backdrop-blur-sm flex items-center justify-center opacity-0 pointer-events-none transition-all duration-300">
    <div class="bg-white rounded-2xl max-w-sm w-[90%] p-6 shadow-2xl transform scale-90 transition-all duration-300" id="modalResultBox">
        <div class="flex flex-col items-center text-center">
            <div id="resultIconWrap" class="w-14 h-14 rounded-full flex items-center justify-center mb-4">
                <iconify-icon id="resultIcon" class="text-2xl"></iconify-icon>
            </div>
            <h3 class="text-base font-extrabold text-stone-800 mb-2" id="resultTitle">Berhasil</h3>
            <p class="text-sm text-stone-500 leading-relaxed mb-5" id="resultMessage">Operasi berhasil.</p>
            <button onclick="closeResultModal()" class="px-5 py-2.5 rounded-xl text-sm font-bold bg-[#3a523a] text-white hover:bg-[#2c402c] transition shadow-sm">Mengerti</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
(function(){
    // ── Database Data ───────────────────────────────────────────
    const AJUAN_DATA = @json($formattedBookings);

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
            <tr class="border-b border-stone-100 cursor-pointer transition align-top ${p.isCorporate ? 'bg-blue-500/10' : 'hover:bg-amber-50/40'}" ondblclick="showDetail(${AJUAN_DATA.indexOf(p)})">
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
                <td class="px-3 py-3 text-amber-700 text-xs font-semibold leading-relaxed">
                    ${p.rescheduleCheckin} —<br>${p.rescheduleCheckout}
                </td>
                <td class="px-3 py-3 text-stone-800 font-semibold text-xs whitespace-nowrap">${p.tanggalDipesan}</td>
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

    // ══════════════════════════════════════════════════════════════
    // MODERN CONFIRM MODAL SYSTEM
    // ══════════════════════════════════════════════════════════════
    let _confirmResolve = null;

    function openConfirmModal(type, title, message) {
        return new Promise(resolve => {
            _confirmResolve = resolve;
            const modal = document.getElementById('modalConfirm');
            const box = document.getElementById('modalConfirmBox');
            const iconWrap = document.getElementById('confirmIconWrap');
            const icon = document.getElementById('confirmIcon');
            const okBtn = document.getElementById('confirmOkBtn');

            document.getElementById('confirmTitle').textContent = title;
            document.getElementById('confirmMessage').innerHTML = message;

            if (type === 'accept') {
                iconWrap.className = 'w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0 bg-emerald-100';
                icon.setAttribute('icon', 'lucide:check-circle');
                icon.className = 'text-xl text-emerald-600';
                okBtn.className = 'px-5 py-2.5 rounded-xl text-sm font-bold text-white transition shadow-sm bg-emerald-500 hover:bg-emerald-600';
                okBtn.textContent = 'Ya, Terima';
            } else {
                iconWrap.className = 'w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0 bg-red-100';
                icon.setAttribute('icon', 'lucide:x-circle');
                icon.className = 'text-xl text-red-500';
                okBtn.className = 'px-5 py-2.5 rounded-xl text-sm font-bold text-white transition shadow-sm bg-red-500 hover:bg-red-600';
                okBtn.textContent = 'Ya, Tolak';
            }

            okBtn.onclick = () => { closeConfirmModal(true); };

            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100');
            box.classList.remove('scale-90');
            box.classList.add('scale-100');
        });
    }

    window.closeConfirmModal = function(confirmed) {
        const modal = document.getElementById('modalConfirm');
        const box = document.getElementById('modalConfirmBox');
        modal.classList.add('opacity-0', 'pointer-events-none');
        modal.classList.remove('opacity-100');
        box.classList.add('scale-90');
        box.classList.remove('scale-100');
        if (_confirmResolve) { _confirmResolve(!!confirmed); _confirmResolve = null; }
    };

    document.getElementById('modalConfirm')?.addEventListener('click', function(e) {
        if (e.target === this) closeConfirmModal(false);
    });

    // ── Result Modal ──────────────────────────────────────────
    function showResultModal(type, title, message) {
        const modal = document.getElementById('modalResult');
        const box = document.getElementById('modalResultBox');
        const iconWrap = document.getElementById('resultIconWrap');
        const icon = document.getElementById('resultIcon');

        document.getElementById('resultTitle').textContent = title;
        document.getElementById('resultMessage').textContent = message;

        if (type === 'success') {
            iconWrap.className = 'w-14 h-14 rounded-full flex items-center justify-center mb-4 bg-emerald-100';
            icon.setAttribute('icon', 'lucide:check-circle-2');
            icon.className = 'text-2xl text-emerald-600';
        } else {
            iconWrap.className = 'w-14 h-14 rounded-full flex items-center justify-center mb-4 bg-red-100';
            icon.setAttribute('icon', 'lucide:alert-circle');
            icon.className = 'text-2xl text-red-500';
        }

        modal.classList.remove('opacity-0', 'pointer-events-none');
        modal.classList.add('opacity-100');
        box.classList.remove('scale-90');
        box.classList.add('scale-100');
    }

    window.closeResultModal = function() {
        const modal = document.getElementById('modalResult');
        const box = document.getElementById('modalResultBox');
        modal.classList.add('opacity-0', 'pointer-events-none');
        modal.classList.remove('opacity-100');
        box.classList.add('scale-90');
        box.classList.remove('scale-100');
        location.reload();
    };

    document.getElementById('modalResult')?.addEventListener('click', function(e) {
        if (e.target === this) closeResultModal();
    });

    // ── Accept / Reject ────────────────────────────────────────
    window.acceptAjuan = async function(idx) {
        const item = AJUAN_DATA[idx];
        const confirmed = await openConfirmModal(
            'accept',
            'Terima Reschedule',
            `Apakah Anda yakin ingin <strong>MENERIMA</strong> pengajuan reschedule untuk pesanan <strong>${item.noPesanan}</strong>?`
        );
        if (!confirmed) return;

        try {
            const res = await fetch('/reservasi/update-status', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ no_pesanan: item.noPesanan, status: 'rescheduled' })
            });
            const data = await res.json();
            if (data.success) {
                showResultModal('success', 'Reschedule Diterima', 'Pengajuan reschedule berhasil diterima. Tanggal check-in & check-out telah diperbarui.');
            } else {
                showResultModal('error', 'Gagal', 'Gagal memperbarui status: ' + data.message);
            }
        } catch (err) {
            console.error(err);
            showResultModal('error', 'Kesalahan Koneksi', 'Terjadi kesalahan saat menghubungi server.');
        }
    };

    window.rejectAjuan = async function(idx) {
        const item = AJUAN_DATA[idx];
        const confirmed = await openConfirmModal(
            'reject',
            'Tolak Reschedule',
            `Apakah Anda yakin ingin <strong>MENOLAK</strong> pengajuan reschedule untuk pesanan <strong>${item.noPesanan}</strong>?`
        );
        if (!confirmed) return;

        try {
            const res = await fetch('/reservasi/update-status', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ no_pesanan: item.noPesanan, status: 'reschedule_rejected' })
            });
            const data = await res.json();
            if (data.success) {
                showResultModal('success', 'Reschedule Ditolak', 'Pengajuan reschedule ditolak. Status pesanan kembali menjadi Lunas/Aktif pada tanggal semula.');
            } else {
                showResultModal('error', 'Gagal', 'Gagal memperbarui status: ' + data.message);
            }
        } catch (err) {
            console.error(err);
            showResultModal('error', 'Kesalahan Koneksi', 'Terjadi kesalahan saat menghubungi server.');
        }
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
                <div><span class="text-stone-400 text-xs">Tanggal Booking</span><br><strong>${p.tanggalDipesan}</strong></div>
                <div><span class="text-stone-400 text-xs">Durasi</span><br><strong>${p.malam} malam</strong></div>
                <div><span class="text-stone-400 text-xs">CI/CO Lama</span><br><strong>${p.checkin} — ${p.checkout}</strong></div>
                <div><span class="text-stone-400 text-xs">CI/CO Ajuan</span><br><strong class="text-amber-600">${p.rescheduleCheckin} — ${p.rescheduleCheckout}</strong></div>
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
