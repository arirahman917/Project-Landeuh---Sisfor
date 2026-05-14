@extends('layouts.booking')
@section('title', 'Pembayaran QRIS - Landeuh Village Riverside')
@section('content')
<style>
.va-page{background:#F8EDD8;min-height:100vh;position:relative}
.pay-header{background:rgba(255,255,255,0.7);backdrop-filter:blur(10px);border-bottom:1px solid rgba(0,0,0,0.08);padding:0.75rem 1.5rem;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:50}
.pay-logo{display:flex;align-items:center;gap:1rem}
.pay-logo img{height:40px}
.pay-logo .divider{width:1px;height:30px;background:#ccc}
.pay-logo h2{font-size:0.95rem;font-weight:700;color:#333}
.pay-steps{display:flex;align-items:center;gap:0.5rem;font-size:0.85rem;font-weight:600}
.pay-steps .num{width:24px;height:24px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.75rem;font-weight:700;color:#fff}
.pay-steps .num.done{background:#3a523a}
.pay-steps .num.active{background:#3a523a}
.pay-steps .line{width:40px;height:2px;background:#3a523a}
.pay-back{display:flex;align-items:center;gap:0.5rem;font-weight:700;font-size:0.95rem;cursor:pointer;color:#333;margin:1.5rem 0 1rem}
.pay-timer-bar{background:#3a523a;color:#fff;padding:0.6rem 1.2rem;border-radius:0.75rem;font-size:0.85rem;margin-bottom:1.5rem;display:flex;align-items:center;gap:0.5rem}
.pay-timer-bar .timer{background:#c0392b;padding:0.2rem 0.6rem;border-radius:0.4rem;font-weight:700;font-family:monospace;font-size:0.95rem}
.va-card{background:#f1e5cc;border-radius:0.75rem;border:1px solid #dfd4be;margin-bottom:1rem;padding-right:1.5rem;padding-left:1.5rem;padding-top:1.5rem;padding-bottom:0.3rem}
.va-card-confirm{background:#f1e5cc;border-radius:0.75rem;border:1px solid #dfd4be;margin-bottom:1rem;padding:1.5rem}
.va-title{font-size:1.15rem;font-weight:700;color:#333;display:flex;justify-content:space-between;align-items:center;border-bottom:1px solid #dfd4be;padding:0.8rem 1.5rem;margin:-1.5rem -1.5rem 1.5rem -1.5rem}
.va-btn-outline{width:100%;background:#3a523a;color:#fff;border:none;padding:0.85rem;border-radius:0.5rem;font-size:1rem;font-weight:700;cursor:pointer;transition:0.2s}
.va-btn-outline:hover{background:#2c402c}

/* QRIS-specific */
.qris-wrapper{display:flex;flex-direction:column;align-items:center;padding:1.2rem 0 0.5rem}
.qris-img-frame{background:#fff;border-radius:0.75rem;border:1.5px solid #dfd4be;padding:1rem;display:inline-flex;align-items:center;justify-content:center;margin-bottom:1rem;box-shadow:0 2px 12px rgba(0,0,0,0.06)}
.qris-img-frame img{width:200px;height:200px;object-fit:contain;display:block}
.qris-download-btn{background:transparent;border:none;color:#3a523a;font-weight:700;font-size:0.9rem;cursor:pointer;display:flex;align-items:center;gap:0.4rem;text-decoration:underline;text-underline-offset:3px;margin-bottom:1.2rem}
.qris-download-btn:hover{color:#2c402c}
.qris-amount-row{width:100%;display:flex;justify-content:space-between;align-items:center;border-top:1px solid #dfd4be;padding-top:1rem;margin-top:0.5rem}
.qris-amount-label{color:#333}
.qris-amount-value{font-size:1.15rem;color:#333;font-weight:800}

.how-to-box{background:#fff8ee;border-radius:0.5rem;border:1px solid #e8d9bc;padding:1rem 1.2rem;margin-bottom:0}
.how-to-box strong{font-size:0.88rem;font-weight:800;color:#333;display:block;margin-bottom:0.6rem}
.how-to-box ol{padding-left:1.2rem;margin:0;font-size:0.83rem;color:#444;line-height:1.7}
.how-to-box ol li{margin-bottom:0.2rem}

/* Sidebar — identical to VA page */
.sidebar-card-cream{background:#f1e5cc;border-radius:1rem;border:1px solid #dfd4be;padding:1.5rem;margin-bottom:1rem;box-shadow:0 10px 25px rgba(0,0,0,0.05);overflow:hidden}
.sidebar-card-cream h3{font-size:1.15rem;font-weight:800;display:flex;align-items:center;gap:0.5rem;margin-bottom:1.2rem;color:#222}
.sb-checkin{display:flex;justify-content:space-between;align-items:center;background:rgba(255,255,255,0.4);backdrop-filter:blur(5px);margin:0 -1.5rem 1rem -1.5rem;padding:1rem 1.5rem;border-bottom:1px solid #dfd4be;border-top:1px solid #dfd4be}
.sb-checkin .label{font-size:0.75rem;font-weight:700;margin-bottom:0.2rem}
.sb-checkin .label.green{color:#27ae60}
.sb-checkin .label.red{color:#c0392b}
.sb-checkin .date{font-weight:700;font-size:0.9rem;color:#333}
.sb-checkin .time{color:#888;font-size:0.65rem;margin-top:0.2rem}
.sb-bed{display:flex;align-items:center;gap:0.8rem;font-size:0.8rem;color:#444;border-bottom:1px solid #dfd4be;padding-bottom:1rem;margin-bottom:1rem;font-weight:600}
.sb-bed .divider{width:1px;height:16px;background:#c2b59b}
.sb-bed div{display:flex;align-items:center;gap:0.4rem}
.sb-fasilitas{display:grid;grid-template-columns:1fr 1fr 1fr;gap:0.5rem;font-size:0.75rem;color:#444;margin-bottom:1rem}
.sb-fasilitas .col-title{font-weight:700;color:#333;margin-bottom:0.4rem}
.sb-fasilitas ul{list-style-type:disc;margin-left:1rem}
.sb-fasilitas ul li{margin-bottom:0.2rem}
.sb-guest{display:flex;align-items:center;gap:0.5rem;font-size:0.8rem;font-weight:600;color:#444;border-bottom:1px solid #dfd4be;padding-bottom:1rem;margin-bottom:1rem}
.sb-identity{display:flex;justify-content:space-between;font-size:0.8rem;color:#333}
.sb-identity .title{font-size:0.75rem;color:#666;margin-bottom:0.5rem}
.sb-identity .row{display:flex;align-items:flex-start;gap:0.5rem;font-weight:500}
.sb-identity .details{display:flex;flex-direction:column;gap:0.15rem}
@media(max-width:768px){.pay-grid{flex-direction:column!important}}
</style>

<div class="va-page">
    <img src="{{ asset('images/assets_lain/batik.png') }}" class="absolute top-16 -left-6 w-36 opacity-20 pointer-events-none rotate-6 z-0" alt="">
    <img src="{{ asset('images/assets_lain/batik.png') }}" class="absolute top-1/2 -right-8 w-40 opacity-15 pointer-events-none -rotate-12 scale-x-[-1] z-0" alt="">
    <img src="{{ asset('images/assets_lain/batik.png') }}" class="absolute bottom-8 left-10 w-32 opacity-10 pointer-events-none rotate-45 z-0" alt="">

    {{-- HEADER --}}
    <div class="pay-header">
        <div class="pay-logo">
            <img src="{{ asset('images/logo-landeuh.png') }}" alt="Logo">
            <div class="divider"></div>
            <h2 id="headerAkoJudul">Memuat informasi...</h2>
        </div>
        <div class="pay-steps">
            <div style="display:flex;align-items:center;gap:0.35rem"><div class="num done">1</div> Review</div>
            <div class="line"></div>
            <div style="display:flex;align-items:center;gap:0.35rem"><div class="num active">2</div> Bayar</div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-2 relative z-10">
        <div class="pay-back" onclick="window.history.back()">← Kembali</div>

        <div class="pay-grid" style="display:flex;gap:1.5rem;align-items:flex-start">

            {{-- LEFT --}}
            <div style="flex:1.4;">

                <div class="pay-timer-bar">
                    Harga sudah kami amankan. Selesaikan pembayaran dalam
                    <span class="timer" id="countdownTimer">00:30:00</span>
                </div>

                <div style="background:#e6a645;color:#fff;padding:0.8rem 1.2rem;border-radius:0.5rem;font-size:0.85rem;margin-bottom:1.5rem;">
                    Cek emailmu (<strong><span id="userEmailSpan">...</span></strong>) sekarang untuk detail cara bayar.
                </div>

                <h3 style="font-size:1.15rem;font-weight:800;color:#333;margin-bottom:0.8rem;">Scan atau unduh QR code</h3>

                <div class="va-card">
                    <div class="va-title">
                        <span>QRIS</span>
                        <img src="{{ asset('images/partner-pembayaran/qris.png') }}" alt="QRIS" style="height:42px;object-fit:contain;">
                    </div>

                    <div class="qris-wrapper">
                        <div class="qris-img-frame">
                            <img id="dynQrisImage" src="{{ asset('images/partner-pembayaran/qris-code.png') }}" alt="QR Code QRIS">
                        </div>

                        <button class="qris-download-btn" onclick="downloadQris()">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                            Unduh QR Code
                        </button>

                        <div class="how-to-box" style="width:100%">
                            <strong>Cara Bayar QRIS</strong>
                            <ol>
                                <li>Buka aplikasi e-Money di handphone (Gojek, LinkAja, OVO, BCA Mobile, Shopee, &amp; DANA).</li>
                                <li>Klik ikon bayar lalu scan kode QR.</li>
                                <li>Pastikan jumlah pembayaran sesuai, lalu klik bayar.</li>
                                <li>Masukkan PIN untuk melanjutkan pembayaran.</li>
                                <li>Setelah pembayaran selesai, halaman akan pindah secara otomatis ke status pembayaran.</li>
                            </ol>
                        </div>

                        <div class="qris-amount-row">
                            <span class="qris-amount-label mb-2">Jumlah transfer</span>
                            <span class="qris-amount-value" id="dynTransferAmount">IDR —</span>
                        </div>
                    </div>
                </div>

                <h3 style="font-size:1.15rem;font-weight:800;color:#333;margin-bottom:0.8rem;margin-top:1.5rem;">Sudah selesai bayar?</h3>
                <div class="va-card-confirm">
                    <p style="font-size:0.9rem;color:#555;margin-bottom:1.5rem;">Setelah pembayaran berhasil terverifikasi, e-ticket dan bukti pembayaran akan kami kirimkan ke email Anda.</p>
                    <button class="va-btn-outline" onclick="goToKonfirmasi('success')">Cek Status Pembayaran</button>
                </div>

            </div>

            {{-- RIGHT: Rincian Reservasi --}}
            <div style="flex:0.8;min-width:300px;position:sticky;top:80px">
                <div class="sidebar-card-cream">
                    <h3>
                        <iconify-icon icon="lucide:clipboard-list" class="text-xl"></iconify-icon> Rincian Reservasi
                    </h3>

                    <div class="sb-checkin">
                        <div>
                            <div class="label green">Check-in</div>
                            <div class="date" id="dynCheckin">Selasa, 28 April 2026</div>
                            <div class="time">Dari 14.00</div>
                        </div>
                        <div style="text-align:center;color:#888">
                            <div style="font-size:0.7rem;font-weight:600" id="dynNights">1 malam</div>
                            <div style="font-size:1.2rem;margin-top:-4px">→</div>
                        </div>
                        <div style="text-align:right">
                            <div class="label red">Check-out</div>
                            <div class="date" id="dynCheckout">Rabu, 29 April 2026</div>
                            <div class="time">Hingga 12.00</div>
                        </div>
                    </div>

                    <div class="sb-bed">
                        <div id="dynBed"><iconify-icon icon="lucide:bed-double" class="text-lg"></iconify-icon> Memuat...</div>
                        <div class="divider"></div>
                        <div id="dynSmoking"><iconify-icon icon="lucide:cigarette" class="text-lg"></iconify-icon> Memuat...</div>
                    </div>

                    <div class="sb-fasilitas">
                        <div>
                            <div class="col-title">Fasilitas Kamar:</div>
                            <ul id="dynFasilitas1"></ul>
                        </div>
                        <div style="padding-top:1.4rem">
                            <ul id="dynFasilitas2"></ul>
                        </div>
                        <div>
                            <div class="col-title">Makanan &amp; Minuman:</div>
                            <ul id="dynMakanan"></ul>
                        </div>
                    </div>

                    <div class="sb-guest">
                        <iconify-icon icon="lucide:user" class="text-lg"></iconify-icon>
                        <span id="dynGuestInfo">Memuat...</span>
                    </div>

                    <div class="sb-identity">
                        <div>
                            <div class="title">Identitas Pemesan:</div>
                            <div class="row">
                                <iconify-icon icon="lucide:user-check" class="text-base mt-1"></iconify-icon>
                                <div class="details">
                                    <div id="dynNama">Memuat...</div>
                                    <div id="dynHp">Memuat...</div>
                                    <div id="dynEmail">Memuat...</div>
                                </div>
                            </div>
                        </div>
                        <div style="text-align:right">
                            <div class="title">Nama Tamu:</div>
                            <div class="row" style="justify-content:flex-end">
                                <iconify-icon icon="lucide:book-user" class="text-base mt-0.5"></iconify-icon>
                                <div class="details">
                                    <div id="dynTamu">Memuat...</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script src="{{ asset('js/akomodasi-data.js') }}"></script>
<script>
// ─── Countdown ───────────────────────────────────────────────
(function () {
    let seconds = 30 * 60;
    const el = document.getElementById('countdownTimer');
    const interval = setInterval(() => {
        if (seconds <= 0) {
            clearInterval(interval);
            el.textContent = '00:00:00';
            return;
        }
        seconds--;
        const m = String(Math.floor(seconds / 60)).padStart(2, '0');
        const s = String(seconds % 60).padStart(2, '0');
        el.textContent = '00:' + m + ':' + s;
    }, 1000);
})();

// ─── Populate dynamic data ────────────────────────────────────
(function () {
    const dNama   = sessionStorage.getItem('res_nama')   || 'Ari Rahman';
    const dHp     = sessionStorage.getItem('res_hp')     || '081512345678';
    const dEmail  = sessionStorage.getItem('res_email')  || 'arirahman@gmail.com';
    const dTamu   = sessionStorage.getItem('res_tamu')   || 'M. Akbar R.';
    const dGuest  = sessionStorage.getItem('res_guest')  || '4 Dewasa + 1 Anak + 2 Dewasa';
    const dTotal  = sessionStorage.getItem('res_total')  || '921.609';
    const dMalam  = sessionStorage.getItem('res_malam');
    const dJudul  = sessionStorage.getItem('res_judul');
    const dCheckin = sessionStorage.getItem('res_checkin');
    const dCheckout = sessionStorage.getItem('res_checkout');

    document.getElementById('dynNama').textContent      = dNama;
    document.getElementById('dynHp').textContent        = dHp;
    document.getElementById('dynEmail').textContent     = dEmail;
    document.getElementById('userEmailSpan').textContent = dEmail;
    document.getElementById('dynTamu').textContent      = dTamu;
    document.getElementById('dynGuestInfo').textContent = dGuest;

    // Amount display — prefix IDR if not already present
    const amt = dTotal.replace(/IDR\s?/i, '').trim();
    document.getElementById('dynTransferAmount').textContent = 'IDR ' + amt;

    if(dMalam) {
        const dynMalamEl = document.getElementById('dynNights');
        if(dynMalamEl) dynMalamEl.textContent = `${dMalam} malam`;
    }
    if(dJudul) {
        document.getElementById('headerAkoJudul').textContent = dJudul;
    }
    if(dCheckin) {
        const ciEl = document.getElementById('dynCheckin');
        if(ciEl) ciEl.textContent = dCheckin;
    }
    if(dCheckout) {
        const coEl = document.getElementById('dynCheckout');
        if(coEl) coEl.textContent = dCheckout;
    }

    // Accommodation data
    const akoId   = parseInt(sessionStorage.getItem('res_akoId')) || 1;
    const akoItem = (typeof AKOMODASI_DATA !== 'undefined')
        ? (AKOMODASI_DATA.find(d => d.id === akoId) || AKOMODASI_DATA[0])
        : null;

    if (akoItem) {
        document.getElementById('headerAkoJudul').textContent = akoItem.judul;

        document.getElementById('dynBed').innerHTML =
            `<iconify-icon icon="lucide:bed-double" class="text-lg"></iconify-icon> ${akoItem.kasur}`;

        document.getElementById('dynSmoking').innerHTML = akoItem.merokok
            ? `<iconify-icon icon="lucide:cigarette" class="text-lg"></iconify-icon> Boleh merokok di kamar`
            : `<iconify-icon icon="lucide:cigarette-off" class="text-lg"></iconify-icon> Dilarang merokok`;

        const fasLen = Math.ceil(akoItem.fasilitas.length / 2);
        document.getElementById('dynFasilitas1').innerHTML =
            akoItem.fasilitas.slice(0, fasLen).map(f => `<li>${f}</li>`).join('');
        document.getElementById('dynFasilitas2').innerHTML =
            akoItem.fasilitas.slice(fasLen).map(f => `<li>${f}</li>`).join('');
        document.getElementById('dynMakanan').innerHTML =
            akoItem.makanan.map(m => `<li>${m}</li>`).join('');
    }
})();

// ─── Download QR Code ─────────────────────────────────────────
function downloadQris() {
    const img = document.getElementById('dynQrisImage');
    const link = document.createElement('a');
    link.href = img.src;
    link.download = 'QRIS-Landeuh-Village.png';
    link.click();
}

// ─── Go to Konfirmasi ─────────────────────────────────────────
function goToKonfirmasi(status) {
    sessionStorage.setItem('res_payment_status', status);
    if (!sessionStorage.getItem('res_booking_no')) {
        sessionStorage.setItem('res_booking_no', 'LDH-' + Date.now().toString(36).toUpperCase() + Math.random().toString(36).substring(2,6).toUpperCase());
    }
    window.location.href = '/reservasi/konfirmasi';
}
</script>
@endpush
@endsection
