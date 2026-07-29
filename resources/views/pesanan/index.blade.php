@extends('layouts.app')
@section('title', 'Daftar Pesanan Saya — Landeuh Village')
@section('content')

{{-- Hero Section for Pesanan --}}
<section class="relative w-full pt-[120px] pb-12 overflow-hidden bg-[#F8EDD8]">
    <!-- Batik Accents -->
    <svg class="absolute top-0 right-0 w-64 h-64 opacity-20 pointer-events-none transform translate-x-1/4 -translate-y-1/4 text-[#d4a373]" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
        <path d="M10,40 Q20,20 40,30 T70,10 T90,30 T70,50 T40,40 T10,60" fill="none" stroke="currentColor" stroke-width="2"/>
        <path d="M20,50 Q30,30 50,40 T80,20" fill="none" stroke="currentColor" stroke-width="1.5"/>
    </svg>
    <svg class="absolute bottom-0 left-0 w-48 h-48 opacity-20 pointer-events-none transform -translate-x-1/4 translate-y-1/4 text-[#d4a373] rotate-180" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
        <path d="M10,40 Q20,20 40,30 T70,10 T90,30 T70,50 T40,40 T10,60" fill="none" stroke="currentColor" stroke-width="2"/>
        <path d="M20,50 Q30,30 50,40 T80,20" fill="none" stroke="currentColor" stroke-width="1.5"/>
    </svg>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-5xl font-extrabold text-[#3a523a] mb-4">Pesanan Saya</h1>
            <p class="text-gray-600 max-w-2xl mx-auto text-sm md:text-base">Lacak status pesanan akomodasi Anda di Landeuh Village Riverside. Pastikan untuk segera menyelesaikan pembayaran sebelum batas waktu berakhir.</p>
        </div>

        {{-- Content Area --}}
        <div id="pesananContent" class="min-h-[400px]">
            {{-- This content will be dynamically injected based on login state --}}
        </div>
    </div>
</section>

<!-- Reschedule Datepicker Modal -->
<div class="modal-overlay" id="modalReschedule">
    <div class="modal-box" style="max-width:480px;text-align:left">
        <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:1.2rem">
            <div style="width:48px;height:48px;border-radius:50%;background:#fff7ed;display:flex;align-items:center;justify-content:center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="#e6a645" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <div>
                <h4 class="modal-title" style="margin-bottom:0">Ajukan Re-schedule</h4>
                <p style="font-size:.75rem;color:#999;margin-top:.15rem">Pilih tanggal check-in baru</p>
            </div>
        </div>

        <div style="background:#fff7ed;border:1px solid #fde68a;border-radius:.6rem;padding:.75rem 1rem;margin-bottom:1rem;font-size:.78rem;color:#92400e;display:flex;align-items:flex-start;gap:.5rem">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="flex-shrink:0;margin-top:1px">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div>
                <strong>Ketentuan:</strong><br>
                • Minimal pengajuan H-3 sebelum tanggal check-in awal<br>
                • Durasi menginap tetap <strong id="reschedDurasi">1 malam</strong> (tidak bisa diubah)<br>
                • Tanggal yang dipilih harus tersedia (tidak ada booking lain, dan harus sesuai kawasan waktu check-in anda)<br>
                • Kawasan waktu check-in anda adalah <strong id="reschedRateType" style="text-transform:capitalize">...</strong>
            </div>
        </div>

        <div style="margin-bottom:.75rem; position:relative;">
            <label style="font-size:.82rem;font-weight:700;color:#444;display:block;margin-bottom:.4rem">Tanggal Check-in Baru <span style="color:#e53e3e">*</span></label>
            <input type="text" id="reschedDatepickerPesanan" placeholder="Pilih tanggal…"
                   style="width:100%;padding:.7rem .9rem;border:2px solid #ddd;border-radius:.6rem;font-size:.9rem;background:#fff;cursor:pointer" readonly>
            <div id="reschedLoading" style="display:none; position:absolute; bottom: 0.7rem; right: 1rem;">
                <svg class="animate-spin h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
        </div>

        <div id="reschedPreview" style="display:none;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:.6rem;padding:.75rem 1rem;margin-bottom:1rem">
            <div style="font-size:.78rem;font-weight:700;color:#166534;margin-bottom:.3rem">Preview Jadwal Baru:</div>
            <div style="font-size:.85rem;color:#333">
                Check-in: <strong id="reschedNewCI">-</strong><br>
                Check-out: <strong id="reschedNewCO">-</strong> (<span id="reschedNewMalam">1</span> malam)
            </div>
        </div>

        <div style="display:flex;gap:1rem;margin-bottom:1rem;font-size:0.75rem;justify-content:center;">
            <div style="display:flex;align-items:center;gap:0.3rem;"><span style="display:inline-block;width:12px;height:12px;border-radius:3px;background:#10b981;"></span> Weekday</div>
            <div style="display:flex;align-items:center;gap:0.3rem;"><span style="display:inline-block;width:12px;height:12px;border-radius:3px;background:#f59e0b;"></span> Weekend</div>
            <div style="display:flex;align-items:center;gap:0.3rem;"><span style="display:inline-block;width:12px;height:12px;border-radius:3px;background:#ef4444;"></span> Highseason</div>
        </div>

        <div style="display:flex;gap:.75rem;justify-content:flex-end;margin-top:1.2rem">
            <button style="background:#e2e8f0;color:#475569;font-weight:bold;padding:.6rem 1.5rem;border-radius:.5rem;border:none;cursor:pointer;transition:.2s;font-size:.88rem"
                    onmouseover="this.style.background='#cbd5e1'" onmouseout="this.style.background='#e2e8f0'"
                    onclick="closeModalReschedule()">Batal</button>
            <button id="btnSubmitReschedule" disabled
                    style="background:#e6a645;color:#fff;font-weight:bold;padding:.6rem 1.5rem;border-radius:.5rem;border:none;cursor:not-allowed;opacity:.5;transition:.2s;font-size:.88rem"
                    onclick="submitReschedule()">Kirim Pengajuan</button>
        </div>
    </div>
</div>

<!-- Modal Reschedule Success -->
<div class="modal-overlay" id="modalRescheduleSuccess">
    <div class="modal-box">
        <div class="modal-icon modal-icon-success">
            <svg width="36" height="36" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="cp-check-path" d="M12 25l9 9 15-18" stroke="#fff" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <h3 class="modal-title">Pengajuan Reschedule Terkirim</h3>
        <p class="modal-desc">
            Permintaan reschedule Anda telah dikirim ke admin Landeuh Village Riverside.<br>
            Silakan hubungi admin melalui WhatsApp untuk konfirmasi lebih lanjut.
        </p>
        <button class="modal-btn-wa" id="btnContactWa">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            Hubungi Admin via WhatsApp
        </button>
        <button class="modal-btn-close" onclick="closeModalRescheduleSuccess()">Tutup</button>
    </div>
</div>


@endsection
@push('scripts')
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
    const container = document.getElementById('pesananContent');
    const bookings = @json($bookings ?? []);

    if (!isLoggedIn) {
        renderNotLoggedIn(container);
    } else {
        if (bookings.length === 0) {
            renderEmptyState(container);
        } else {
            renderOrders(container, bookings);
        }
    }

    if (sessionStorage.getItem('forceScrollTop')) {
        sessionStorage.removeItem('forceScrollTop');
        setTimeout(() => window.scrollTo(0, 0), 100);
    }
});

function unduhPdf(bookNo, btn) {
    const origHTML = btn.innerHTML;
    btn.innerHTML = '<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-blue-600 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" opacity=".3"/><path fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"/></svg> Menyiapkan…';
    btn.disabled = true;
    btn.style.opacity = '0.7';

    if (!bookNo || bookNo === 'XXXXXXXXXX') {
        alert('Gagal mendapatkan nomor pesanan.');
        btn.innerHTML = origHTML;
        btn.disabled = false;
        btn.style.opacity = '1';
        return;
    }

    setTimeout(() => {
        window.open('/invoice/' + bookNo + '/download', '_blank');
        btn.innerHTML = origHTML;
        btn.disabled = false;
        btn.style.opacity = '1';
    }, 500);
}

function formatDateFriendly(dateStr) {
    if (!dateStr) return '';
    // Safely parse date parts to avoid timezone shifting
    const parts = dateStr.split('T')[0].split('-');
    if (parts.length !== 3) return dateStr;
    const year = parts[0];
    const monthIndex = parseInt(parts[1]) - 1;
    const day = parseInt(parts[2]);
    
    const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    return `${day} ${monthNames[monthIndex]} ${year}`;
}

function formatPrice(amount) {
    return 'IDR ' + parseFloat(amount).toLocaleString('id-ID');
}

function renderNotLoggedIn(container) {
    container.innerHTML = `
        <div class="bg-white/60 backdrop-blur-md rounded-2xl border border-white/50 shadow-xl p-10 max-w-lg mx-auto text-center mt-10">
            <div class="w-20 h-20 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-3">Anda Belum Log In</h3>
            <p class="text-gray-600 mb-8">Silakan masuk ke akun Anda terlebih dahulu untuk melihat riwayat pesanan.</p>
            <button onclick="if(typeof openLoginModal==='function'){openLoginModal();}else{alert('Silakan log in melalui tombol masuk di menu atas.');}" class="bg-[#3a523a] hover:bg-[#2c402c] text-white font-bold py-3 px-8 rounded-full transition shadow-md w-full sm:w-auto">
                Masuk / Daftar Sekarang
            </button>
        </div>
    `;
}

function renderEmptyState(container) {
    container.innerHTML = `
        <div class="bg-white/60 backdrop-blur-md rounded-2xl border border-white/50 shadow-xl p-10 max-w-lg mx-auto text-center mt-10">
            <div class="w-20 h-20 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-3">Belum Ada Pesanan</h3>
            <p class="text-gray-600 mb-8">Anda belum melakukan pesanan akomodasi apapun. Yuk mulai eksplorasi akomodasi kami!</p>
            <a href="/akomodasi" class="inline-block bg-[#3a523a] hover:bg-[#2c402c] text-white font-bold py-3 px-8 rounded-full transition shadow-md w-full sm:w-auto text-center">
                Cari Akomodasi
            </a>
        </div>
    `;
}

function renderOrders(container, bookings) {
    const pendingBookings = bookings.filter(b => b.status === 'pending');
    const successBookings = bookings.filter(b => b.status === 'success' || b.status === 'reschedule_pending' || b.status === 'reschedule_rejected' || b.status === 'rescheduled');
    const cancelledBookings = bookings.filter(b => b.status === 'failed' || b.status === 'cancelled' || b.status === 'canceled' || b.status === 'refunded');

    let html = `
        <div class="flex flex-wrap gap-2 md:gap-4 border-b border-gray-300 pb-2 mb-8" id="pesananTabs">
            <button class="tab-btn active px-4 py-2 font-bold text-sm md:text-base border-b-2 border-[#3a523a] text-[#3a523a] transition" data-target="belumbayar">Belum Dibayar (${pendingBookings.length})</button>
            <button class="tab-btn px-4 py-2 font-bold text-sm md:text-base border-b-2 border-transparent text-gray-500 hover:text-gray-800 transition" data-target="lunas">Selesai/Lunas (${successBookings.length})</button>
        </div>
    `;

    // 1. Tab content: Belum Dibayar
    html += `<div id="tabContent_belumbayar" class="tab-pane flex flex-col gap-4">`;
    if (pendingBookings.length === 0) {
        html += `
            <div class="bg-white/40 border border-gray-200 rounded-2xl p-8 text-center text-gray-500">
                Tidak ada pesanan menunggu pembayaran.
            </div>
        `;
    } else {
        pendingBookings.forEach(b => {
            const isCorp = !!b.corporate_package_id;
            const unit = isCorp ? (b.corporate_package || b.corporatePackage || {}) : (b.accommodation || {});
            let rawImg = unit.gambar;
            if (Array.isArray(rawImg) && rawImg.length > 0) rawImg = rawImg[0];
            const imgPath = rawImg ? (rawImg.startsWith('http') || rawImg.startsWith('data:') ? rawImg : '/' + rawImg) : '/images/akomodasi/cabin1/a.webp';
            const dateStr = `${formatDateFriendly(b.check_in_date)} - ${formatDateFriendly(b.check_out_date)}`;
            const paxText = isCorp && b.jumlah_pax ? ` (${b.jumlah_pax} pax)` : '';
            const itemTitle = (unit.judul || 'Akomodasi') + paxText;
            
            html += `
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-4 md:p-6 border-b border-gray-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-3 bg-red-50/50">
                        <div>
                            <div class="text-xs font-bold text-red-600 uppercase tracking-wider mb-1">Menunggu Pembayaran</div>
                            <div class="text-sm font-semibold text-gray-800">No. Pesanan: ${b.no_pesanan}</div>
                        </div>
                        <div class="bg-red-100 text-red-700 px-3 py-1.5 rounded-lg text-sm font-bold flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span class="countdown-timer" data-created="${b.created_at}" id="countdown_${b.no_pesanan}">--:--:--</span>
                        </div>
                    </div>
                    <div class="p-4 md:p-6 flex flex-col md:flex-row gap-6">
                        <img src="${imgPath}" alt="${itemTitle}" class="w-full md:w-48 h-32 object-cover rounded-xl shrink-0">
                        <div class="flex-1">
                            <h4 class="text-xl font-bold text-gray-800 mb-2">${itemTitle}</h4>
                            <div class="text-sm text-gray-500 space-y-1 mb-4">
                                <div class="flex gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> ${dateStr} (${b.malam} Malam)</div>
                                <div class="flex gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg> ${b.nama_tamu}</div>
                            </div>
                            <div class="text-lg font-extrabold text-[#e53e3e]">${formatPrice(b.total)}</div>
                        </div>
                        <div class="flex items-center">
                            <a href="/reservasi/metode-pembayaran/${b.accommodation_id}?booking_no=${b.no_pesanan}" class="w-full md:w-auto text-center bg-[#3a523a] hover:bg-[#2c402c] text-white font-bold py-2.5 px-6 rounded-lg transition shadow">Lanjutkan Pembayaran</a>
                        </div>
                    </div>
                </div>
            `;
        });
    }
    html += `</div>`;

    // 2. Tab content: Selesai/Lunas
    html += `<div id="tabContent_lunas" class="tab-pane flex flex-col gap-4 hidden">`;
    if (successBookings.length === 0) {
        html += `
            <div class="bg-white/40 border border-gray-200 rounded-2xl p-8 text-center text-gray-500">
                Belum ada pesanan lunas.
            </div>
        `;
    } else {
        successBookings.forEach(b => {
            const isCorp = !!b.corporate_package_id;
            const unit = isCorp ? (b.corporate_package || b.corporatePackage || {}) : (b.accommodation || {});
            let rawImg = unit.gambar;
            if (Array.isArray(rawImg) && rawImg.length > 0) rawImg = rawImg[0];
            const imgPath = rawImg ? (rawImg.startsWith('http') || rawImg.startsWith('data:') ? rawImg : '/' + rawImg) : '/images/akomodasi/cabin1/a.webp';
            const dateStr = `${formatDateFriendly(b.check_in_date)} - ${formatDateFriendly(b.check_out_date)}`;
            const paxText = isCorp && b.jumlah_pax ? ` (${b.jumlah_pax} pax)` : '';
            const itemTitle = (unit.judul || 'Akomodasi') + paxText;

            const isReschedulePending = b.status === 'reschedule_pending';
            const isRescheduleRejected = b.status === 'reschedule_rejected';
            const isRescheduled = b.status === 'rescheduled';
            
            // Check if check-in date is in the past
            let isPast = false;
            if (b.check_in_date) {
                const checkinParts = b.check_in_date.split('T')[0].split('-');
                if (checkinParts.length === 3) {
                    const checkinVal = new Date(parseInt(checkinParts[0]), parseInt(checkinParts[1]) - 1, parseInt(checkinParts[2]));
                    const todayVal = new Date();
                    todayVal.setHours(0,0,0,0);
                    isPast = checkinVal < todayVal;
                }
            }

            // Check H-3 eligibility for reschedule
            let canReschedule = false;
            if (b.check_in_date && !isPast) {
                const checkinParts = b.check_in_date.split('T')[0].split('-');
                if (checkinParts.length === 3) {
                    const checkinVal = new Date(parseInt(checkinParts[0]), parseInt(checkinParts[1]) - 1, parseInt(checkinParts[2]));
                    const todayVal = new Date();
                    todayVal.setHours(0,0,0,0);
                    const diffDays = Math.ceil((checkinVal - todayVal) / (1000 * 60 * 60 * 24));
                    canReschedule = diffDays >= 3;
                }
            }

            let headerBg = 'bg-green-50/50';
            let headerBadgeText = 'Berhasil & Lunas';
            let headerBadgeColor = 'text-green-600';
            let priceColor = 'text-[#3a523a]';
            
            if (isReschedulePending) {
                headerBg = 'bg-amber-50/50';
                headerBadgeText = 'Menunggu Persetujuan Reschedule';
                headerBadgeColor = 'text-amber-600';
                priceColor = 'text-amber-600';
            } else if (isRescheduled) {
                headerBg = 'bg-purple-50/50';
                headerBadgeText = 'Reschedule Disetujui';
                headerBadgeColor = 'text-purple-600';
                priceColor = 'text-[#3a523a]';
            } else if (isRescheduleRejected) {
                headerBg = 'bg-red-50/50';
                headerBadgeText = 'Reschedule Ditolak';
                headerBadgeColor = 'text-red-600';
                priceColor = 'text-[#3a523a]';
            } else if (isPast) {
                headerBg = 'bg-stone-50/50';
                headerBadgeText = 'Selesai Menginap';
                headerBadgeColor = 'text-stone-600';
                priceColor = 'text-stone-600';
            }
            
            let actionHtml = `<button onclick="unduhPdf('${b.no_pesanan}', this)" class="bg-blue-50 text-blue-600 hover:bg-blue-100 font-bold py-2 px-5 rounded-lg transition text-sm shadow-sm border border-blue-100 text-center flex items-center justify-center min-w-[140px]">Cetak Invoice</button>`;
            
            if (isReschedulePending) {
                actionHtml += `<div class="text-xs text-amber-700 font-bold bg-amber-50 border border-amber-200 rounded-lg px-4 py-2 text-center leading-relaxed">Ajuan reschedule sedang ditinjau admin. Silakan konfirmasi via WA.</div>`;
            } else if (isRescheduled) {
                actionHtml += `<div class="text-xs text-purple-700 font-bold bg-purple-50 border border-purple-200 rounded-lg px-4 py-2 text-center leading-relaxed">Jadwal baru Anda telah disetujui dan pesanan Anda sudah diperbarui.</div>`;
            } else if (isRescheduleRejected) {
                actionHtml += `<div class="text-xs text-red-700 font-bold bg-red-50 border border-red-200 rounded-lg px-4 py-2 text-center leading-relaxed">Pengajuan reschedule Anda ditolak oleh Admin. Pesanan Anda tetap aktif & valid.</div>`;
            } else if (isPast) {
                actionHtml += `<div class="text-xs text-stone-600 font-bold bg-stone-50 border border-stone-200 rounded-lg px-4 py-2 text-center leading-relaxed">Masa Sewa Berakhir</div>`;
            } else {
                if (canReschedule) {
                    const targetId = isCorp ? b.corporate_package_id : b.accommodation_id;
                    actionHtml += `<button onclick="ajukanReschedule('${b.no_pesanan}', ${targetId}, ${b.id}, ${b.malam}, '${b.check_in_date}', ${isCorp})" class="bg-white text-amber-600 hover:bg-amber-50 border border-amber-300 font-bold py-2 px-5 rounded-lg transition text-sm text-center flex items-center justify-center gap-1.5"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg> Ajukan Re-schedule</button>`;
                } else {
                    actionHtml += `<div class="text-xs text-stone-500 font-semibold bg-stone-50 border border-stone-200 rounded-lg px-4 py-2 text-center leading-relaxed">Reschedule sudah tidak tersedia (minimal H-3)</div>`;
                }
            }

            html += `
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-4 md:p-6 border-b border-gray-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-3 ${headerBg}">
                        <div>
                            <div class="text-xs font-bold ${headerBadgeColor} uppercase tracking-wider mb-1">${headerBadgeText}</div>
                            <div class="text-sm font-semibold text-gray-800">No. Pesanan: ${b.no_pesanan}</div>
                        </div>
                    </div>
                    <div class="p-4 md:p-6 flex flex-col md:flex-row gap-6">
                        <img src="${imgPath}" alt="${itemTitle}" class="w-full md:w-48 h-32 object-cover rounded-xl shrink-0">
                        <div class="flex-1">
                            <h4 class="text-xl font-bold text-gray-800 mb-2">${itemTitle}</h4>
                            <div class="text-sm text-gray-500 space-y-1 mb-4">
                                <div class="flex gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> ${dateStr} (${b.malam} Malam)</div>
                                <div class="flex gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg> ${b.nama_tamu}</div>
                                <div class="flex gap-2 font-semibold text-gray-600"><iconify-icon icon="lucide:credit-card" class="mt-0.5"></iconify-icon> Metode: ${b.metode_pembayaran}</div>
                            </div>
                            <div class="text-lg font-extrabold ${priceColor}">${formatPrice(b.total)}</div>
                        </div>
                        <div class="flex flex-col gap-2 justify-center shrink-0 w-full md:w-auto">
                            ${actionHtml}
                        </div>
                    </div>
                </div>
            `;
        });
    }
    html += `</div>`;

    container.innerHTML = html;

    // Setup Tabs Logic
    const tabs = container.querySelectorAll('.tab-btn');
    const panes = container.querySelectorAll('.tab-pane');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => {
                t.classList.remove('active', 'border-[#3a523a]', 'text-[#3a523a]');
                t.classList.add('border-transparent', 'text-gray-500');
            });
            panes.forEach(p => p.classList.add('hidden'));

            tab.classList.add('active', 'border-[#3a523a]', 'text-[#3a523a]');
            tab.classList.remove('border-transparent', 'text-gray-500');
            
            const target = tab.getAttribute('data-target');
            document.getElementById('tabContent_' + target).classList.remove('hidden');

            sessionStorage.setItem('activePesananTab', target);
        });
    });

    // Restore active tab
    const savedTab = sessionStorage.getItem('activePesananTab');
    if (savedTab) {
        const tabBtn = Array.from(tabs).find(t => t.getAttribute('data-target') === savedTab);
        if (tabBtn) tabBtn.click();
    }

    // Start countdown timers
    initCountdownTimers();
}

function initCountdownTimers() {
    const timers = document.querySelectorAll('.countdown-timer');
    if (timers.length === 0) return;

    const interval = setInterval(() => {
        let activeTimers = 0;

        timers.forEach(el => {
            const createdStr = el.getAttribute('data-created');
            const bookingNo = el.id.replace('countdown_', '');
            if (!createdStr) return;
            
            // createdStr is typically in MySQL format "YYYY-MM-DD HH:MM:SS" or ISO format.
            let createdTime;
            if (createdStr.includes('T')) {
                createdTime = new Date(createdStr).getTime();
            } else {
                createdTime = new Date(createdStr.replace(/-/g, '/')).getTime();
            }
            const expireTime = createdTime + 30 * 60 * 1000; // 30 minutes expiration
            const now = new Date().getTime();
            const remaining = expireTime - now;

            if (remaining <= 0) {
                el.textContent = 'Kedaluwarsa';
                const pill = el.closest('.bg-red-100');
                if (pill) {
                    pill.classList.remove('bg-red-100', 'text-red-700');
                    pill.classList.add('bg-gray-100', 'text-gray-500');
                }

                // Automatically mark as failed in the database upon expiration
                if (el.getAttribute('data-expired-triggered') !== 'true') {
                    el.setAttribute('data-expired-triggered', 'true');
                    
                    fetch('/reservasi/update-status', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            no_pesanan: bookingNo,
                            status: 'failed'
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Booking automatically cancelled due to timeout:', data);
                        window.location.reload();
                    })
                    .catch(err => console.error('Failed to auto-cancel:', err));
                }
            } else {
                activeTimers++;
                const mins = String(Math.floor(remaining / (1000 * 60))).padStart(2, '0');
                const secs = String(Math.floor((remaining % (1000 * 60)) / 1000)).padStart(2, '0');
                el.textContent = `00:${mins}:${secs}`;
            }
        });

        if (activeTimers === 0) {
            clearInterval(interval);
        }
    }, 1000);
}

// Helper to determine date type in frontend
function getDateTypeFrontend(dateObj, settings) {
    const year = dateObj.getFullYear();
    const month = String(dateObj.getMonth() + 1).padStart(2, '0');
    const day = String(dateObj.getDate()).padStart(2, '0');
    const dateString = `${year}-${month}-${day}`;
    
    const daysIndo = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', "Jum'at", 'Sabtu'];
    const dayName = daysIndo[dateObj.getDay()];

    // 1. Check Highseason
    const hsSettings = settings.filter(d => d.type === 'highseason');
    for (let hs of hsSettings) {
        if (hs.dates && hs.dates.includes(dateString)) return 'highseason';
    }

    // 2. Check Weekend
    const weSetting = settings.find(d => d.type === 'weekend');
    if (weSetting && weSetting.dates) {
        if (weSetting.dates.includes(dateString) || weSetting.dates.includes(dayName)) return 'weekend';
    }

    return 'weekday';
}

function ajukanReschedule(bookingNo, accommodationId, bookingId, malam, checkInDateStr, isCorporate) {
    // Reset state
    selectedNewCheckin = null;
    currentReschedBookingNo = bookingNo;
    currentReschedMalam = malam;
    
    // Parse checkInDateStr to originalCheckinDateObj
    let originalCheckinDateObj = null;
    if (checkInDateStr) {
        // format is YYYY-MM-DD
        const parts = checkInDateStr.split('T')[0].split('-');
        if (parts.length === 3) {
            originalCheckinDateObj = new Date(parseInt(parts[0]), parseInt(parts[1]) - 1, parseInt(parts[2]));
        }
    }

    const submitBtn = document.getElementById('btnSubmitReschedule');
    submitBtn.disabled = true;
    submitBtn.style.cursor = 'not-allowed';
    submitBtn.style.opacity = '.5';
    document.getElementById('reschedPreview').style.display = 'none';
    document.getElementById('reschedDatepickerPesanan').value = '';
    document.getElementById('reschedDurasi').textContent = malam + ' malam';

    // Destroy existing flatpickr
    if (reschedFlatpickr) {
        reschedFlatpickr.destroy();
        reschedFlatpickr = null;
    }

    // Show modal first
    const modal = document.getElementById('modalReschedule');
    modal.classList.add('active');

    const dateInput = document.getElementById('reschedDatepickerPesanan');
    const loadingIcon = document.getElementById('reschedLoading');
    dateInput.placeholder = 'Memuat kalender...';
    dateInput.disabled = true;
    if (loadingIcon) loadingIcon.style.display = 'block';

    // Fetch booked dates
    fetch(`/reservasi/booked-dates/${accommodationId}?exclude_booking_id=${bookingId}&is_corporate=${isCorporate ? 1 : 0}`)
        .then(r => r.json())
        .then(data => {
            dateInput.placeholder = 'Pilih tanggal...';
            dateInput.disabled = false;
            if (loadingIcon) loadingIcon.style.display = 'none';

            const bookedDates = data.booked_dates || [];
            const dateSettings = data.date_settings || [];
            
            // Determine the rate type of the original checkin
            let originalType = 'weekday';
            if (originalCheckinDateObj) {
                originalType = getDateTypeFrontend(originalCheckinDateObj, dateSettings);
            }
            document.getElementById('reschedRateType').textContent = originalType;

            reschedFlatpickr = flatpickr('#reschedDatepickerPesanan', {
                locale: 'id',
                dateFormat: 'Y-m-d',
                minDate: 'today',
                disable: [
                    function(date) {
                        const today = new Date();
                        today.setHours(0,0,0,0);
                        const h3Date = new Date(today);
                        h3Date.setDate(today.getDate() + 3);
                        
                        if (date >= today && date < h3Date) return true;
                        
                        // Check if the date type matches the original booking's date type
                        const currentType = getDateTypeFrontend(date, dateSettings);
                        if (currentType !== originalType) return true;

                        // Check if ALL nights from this check-in date are available
                        for (let i = 0; i < malam; i++) {
                            const d = new Date(date);
                            d.setDate(d.getDate() + i);
                            const str = d.getFullYear() + '-' + String(d.getMonth()+1).padStart(2,'0') + '-' + String(d.getDate()).padStart(2,'0');
                            if (bookedDates.includes(str)) return true;
                        }
                        return false;
                    }
                ],
                onDayCreate: function(dObj, dStr, fp, dayElem) {
                    const date = dayElem.dateObj;
                    const today = new Date();
                    today.setHours(0, 0, 0, 0);
                    const h3Date = new Date(today);
                    h3Date.setDate(today.getDate() + 3);
                    
                    const currentType = getDateTypeFrontend(date, dateSettings);
                    
                    if (date < today) return; // Skip styling for past dates (keeps default flatpickr disabled style)

                    // Add background color for date types
                    dayElem.classList.add('date-' + currentType);

                    if (date >= today && date < h3Date) {
                        dayElem.classList.add('h3-blocked');
                        dayElem.innerHTML = `<span style="text-decoration: line-through; font-size: 0.75em; font-weight: bold; line-height: 2.6;">H-3</span>`;
                    } else if (date >= today) {
                        // Check if mismatch type
                        if (currentType !== originalType) {
                            dayElem.classList.add('date-mismatch');
                            return;
                        }

                        // Check if it's booked
                        let isBooked = false;
                        for (let i = 0; i < malam; i++) {
                            const d = new Date(date);
                            d.setDate(d.getDate() + i);
                            const str = d.getFullYear() + '-' + String(d.getMonth()+1).padStart(2,'0') + '-' + String(d.getDate()).padStart(2,'0');
                            if (bookedDates.includes(str)) {
                                isBooked = true;
                                break;
                            }
                        }
                        if (isBooked) {
                            dayElem.classList.add('booked-date');
                        }
                    }
                },
                onChange: function(selectedDates) {
                    if (selectedDates.length > 0) {
                        selectedNewCheckin = selectedDates[0];
                        const co = new Date(selectedNewCheckin);
                        co.setDate(co.getDate() + malam);

                        const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
                        const months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                        const fmtDate = (d) => `${days[d.getDay()]}, ${d.getDate()} ${months[d.getMonth()]} ${d.getFullYear()}`;

                        document.getElementById('reschedNewCI').textContent = fmtDate(selectedNewCheckin);
                        document.getElementById('reschedNewCO').textContent = fmtDate(co);
                        document.getElementById('reschedNewMalam').textContent = malam;
                        document.getElementById('reschedPreview').style.display = 'block';

                        submitBtn.disabled = false;
                        submitBtn.style.cursor = 'pointer';
                        submitBtn.style.opacity = '1';
                    }
                },
                inline: true
            });
        })
        .catch(err => {
            const dateInput = document.getElementById('reschedDatepickerPesanan');
            const loadingIcon = document.getElementById('reschedLoading');
            dateInput.placeholder = 'Gagal memuat kalender';
            dateInput.disabled = true;
            if (loadingIcon) loadingIcon.style.display = 'none';
            console.error('Failed to fetch booked dates:', err);
            alert('Gagal memuat ketersediaan tanggal.');
        });
}

let reschedFlatpickr = null;
let selectedNewCheckin = null;
let currentReschedBookingNo = '';
let currentReschedMalam = 1;

function submitReschedule() {
    if (!selectedNewCheckin) return;

    const submitBtn = document.getElementById('btnSubmitReschedule');
    const origText = submitBtn.textContent;
    submitBtn.textContent = 'Memproses...';
    submitBtn.disabled = true;
    submitBtn.style.opacity = '.6';

    const ciStr = selectedNewCheckin.getFullYear() + '-' + String(selectedNewCheckin.getMonth()+1).padStart(2,'0') + '-' + String(selectedNewCheckin.getDate()).padStart(2,'0');

    fetch('/reservasi/reschedule', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            no_pesanan: currentReschedBookingNo,
            new_check_in: ciStr
        })
    })
    .then(res => res.json())
    .then(data => {
        closeModalReschedule();
        if (data.success) {
            const modal = document.getElementById('modalRescheduleSuccess');
            const waBtn = document.getElementById('btnContactWa');
            if (waBtn) {
                waBtn.onclick = () => {
                    const text = `Halo Admin, saya ingin mengonfirmasi pengajuan reschedule pesanan saya. No. Pemesanan: ${currentReschedBookingNo}`;
                    window.open(`https://wa.me/6281234567890?text=${encodeURIComponent(text)}`, '_blank');
                };
            }
            modal.classList.add('active');
            
            const closeBtn = modal.querySelector('button[onclick="closeModalRescheduleSuccess()"]');
            if (closeBtn) {
                closeBtn.onclick = () => {
                    closeModalRescheduleSuccess();
                    sessionStorage.setItem('forceScrollTop', '1');
                    location.reload();
                };
            }
        } else {
            alert('Gagal mengajukan reschedule: ' + data.message);
        }
    })
    .catch(err => {
        console.error('Error:', err);
        alert('Terjadi kesalahan koneksi.');
        submitBtn.textContent = origText;
        submitBtn.disabled = false;
        submitBtn.style.opacity = '1';
    });
}

function closeModalReschedule() {
    const modal = document.getElementById('modalReschedule');
    modal.classList.remove('active');
}

function closeModalRescheduleSuccess() {
    const modal = document.getElementById('modalRescheduleSuccess');
    modal.classList.remove('active');
}

// Close modal on overlay click
document.addEventListener('click', function(e) {
    const modal = document.getElementById('modalReschedule');
    if (modal && e.target === modal) {
        closeModalReschedule();
    }
    const successModal = document.getElementById('modalRescheduleSuccess');
    if (successModal && e.target === successModal) {
        closeModalRescheduleSuccess();
    }
});
</script>
@endpush

@push('styles')
<style>
.modal-overlay{
    position:fixed;inset:0;z-index:9999;
    background:rgba(0,0,0,.45);backdrop-filter:blur(6px);
    display:flex;align-items:center;justify-content:center;
    opacity:0;pointer-events:none;
    transition:opacity .35s ease;
}
.modal-overlay.active{opacity:1;pointer-events:auto}
.modal-box{
    background:#fff;border-radius:1.25rem;padding:2.5rem 2rem 2rem;
    max-width:420px;width:90%;text-align:center;
    box-shadow:0 25px 60px rgba(0,0,0,.2);
    transform:scale(.85) translateY(20px);
    transition:transform .4s cubic-bezier(.4,0,.2,1);
    max-height: 90vh;
    overflow-y: auto;
}
.modal-overlay.active .modal-box{transform:scale(1) translateY(0)}
.modal-icon{
    width:72px;height:72px;border-radius:50%;margin:0 auto 1.2rem;
    display:flex;align-items:center;justify-content:center;
}
.modal-icon-success{background:#27ae60;animation:scaleInBounce .6s cubic-bezier(.4,0,.2,1) both}
.modal-icon-success svg{animation:none}
.modal-title{font-size:1.25rem;font-weight:800;color:#222;margin-bottom:.5rem}
.modal-desc{font-size:.88rem;color:#666;line-height:1.6;margin-bottom:1.5rem}
.modal-btn-wa{
    display:inline-flex;align-items:center;gap:.5rem;
    background:#25d366;color:#fff;border:none;
    padding:.75rem 1.5rem;border-radius:.6rem;
    font-size:.95rem;font-weight:700;cursor:pointer;
    transition:background .2s;margin-bottom:.6rem;
}
.modal-btn-wa:hover{background:#1ebe57}
.modal-btn-close{
    display:block;margin:0 auto;
    background:transparent;border:none;color:#888;
    font-size:.85rem;font-weight:600;cursor:pointer;
    padding:.4rem 1rem;
    transition:color .2s;
}
.modal-btn-close:hover{color:#333}
@keyframes scaleInBounce{
    0%{transform:scale(0);opacity:0}
    50%{transform:scale(1.1);opacity:1}
    100%{transform:scale(1);opacity:1}
}
.cp-check-path{stroke-dasharray:45;stroke-dashoffset:45;animation:drawCheck .5s .2s forwards}
@keyframes drawCheck{to{stroke-dashoffset:0}}

@media(max-width:480px){
    /* Modal Reschedule Fix */
    .modal-box { padding: 1.5rem 1rem 1.5rem !important; width: 96% !important; }
}

/* Datepicker Custom Styles */
.flatpickr-calendar.inline {
    margin: 0 auto !important; /* Center the calendar to remove empty space */
    width: 100% !important; 
    padding: 12px 10px !important; 
    box-sizing: border-box !important;
}
.flatpickr-days, .dayContainer { width: 100% !important; min-width: 0 !important; max-width: 100% !important; }
.flatpickr-day { max-width: none !important; flex-basis: 14.28% !important; height: 38px !important; line-height: 38px !important; }
.flatpickr-weekdaycontainer { display: flex; width: 100%; padding: 0 10px !important; box-sizing: border-box !important; }
.flatpickr-weekday { flex: 1; }
.flatpickr-day.h3-blocked {
    background-color: #fee2e2 !important; /* Red background for H-3 */
    color: #ef4444 !important;
    border-color: transparent !important;
}
.flatpickr-day.booked-date {
    background-color: #f3f4f6 !important; /* Gray background */
    color: #9ca3af !important; /* Gray text */
    text-decoration: line-through !important;
    border-color: transparent !important;
}

/* Custom Flatpickr colors for date types */
.flatpickr-day.date-weekday {
    background-color: #d1fae5 !important;
    color: #065f46 !important;
    border-color: #d1fae5 !important;
}
.flatpickr-day.date-weekday.selected { background-color: #10b981 !important; color: #fff !important; border-color: #10b981 !important; }
.flatpickr-day.date-weekend {
    background-color: #fef3c7 !important;
    color: #92400e !important;
    border-color: #fef3c7 !important;
}
.flatpickr-day.date-weekend.selected { background-color: #f59e0b !important; color: #fff !important; border-color: #f59e0b !important; }
.flatpickr-day.date-highseason {
    background-color: #fee2e2 !important;
    color: #b91c1c !important;
    border-color: #fee2e2 !important;
}
.flatpickr-day.date-highseason.selected { background-color: #ef4444 !important; color: #fff !important; border-color: #ef4444 !important; }

/* Blocked mismatches */
.flatpickr-day.date-mismatch {
    opacity: 0.6 !important;
    cursor: not-allowed !important;
}

/* Adjacent month days */
.flatpickr-day.prevMonthDay, .flatpickr-day.nextMonthDay {
    opacity: 0.3 !important;
}

/* Original block */
.flatpickr-day.h3-blocked {
    background-color: #f3f4f6 !important;
    color: #9ca3af !important;
    border-color: transparent !important;
    cursor: not-allowed !important;
}
</style>
@endpush
