@extends('layouts.booking')
@section('title', 'Pembayaran Minimarket - Landeuh Village Riverside')
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
/* Card utama mirip va-card */
.mm-card{background:#f1e5cc;border-radius:0.75rem;border:1px solid #dfd4be;margin-bottom:1rem;overflow:hidden}
.mm-card-inner{padding:1.5rem}
.mm-card-confirm{background:#f1e5cc;border-radius:0.75rem;border:1px solid #dfd4be;margin-bottom:1rem;padding:1.5rem}
/* Header kartu minimarket (nama minimarket + logo bank) */
.mm-card-header{display:flex;justify-content:space-between;align-items:center;padding:1rem 1.5rem;border-bottom:1px solid #dfd4be}
.mm-card-header .mm-name{font-size:1.15rem;font-weight:700;color:#333}
/* Kode bayar besar di tengah */
.mm-code-section{text-align:center;padding:1.2rem 1.5rem 0.5rem}
.mm-code-label{font-size:0.8rem;font-weight:600;color:#666;margin-bottom:0.5rem}
.mm-code-value{font-size:2rem;font-weight:800;color:#c0392b;letter-spacing:0.15em;font-family:monospace;margin-bottom:0.2rem}
.mm-copy-row{display:flex;justify-content:center;margin-top:0.5rem;margin-bottom:1rem}
.mm-copy-btn{display:flex;align-items:center;gap:0.4rem;background:transparent;border:1.5px solid #3a523a;color:#3a523a;padding:0.35rem 1rem;border-radius:0.4rem;font-size:0.8rem;font-weight:700;cursor:pointer;transition:0.2s}
.mm-copy-btn:hover{background:#3a523a;color:#fff}
/* Cara bayar list */
.mm-howto{padding:1.2rem 1.5rem}
.mm-howto-title{font-size:0.9rem;font-weight:800;color:#333;margin-bottom:0.75rem}
.mm-howto ol{padding-left:1.2rem;margin:0}
.mm-howto ol li{font-size:0.85rem;color:#444;line-height:1.6;margin-bottom:0.35rem}
/* Divider dalam kartu */
.mm-divider{height:1px;background:#dfd4be;margin:0}
/* Harga sebelum admin */
.mm-price-row{display:flex;justify-content:space-between;align-items:center;padding:0.9rem 1.5rem;font-size:0.9rem;color:#444}
.mm-price-row .price-label{color:#555}
.mm-price-row .price-val{font-weight:700;color:#333;font-size:1.2rem}
/* Tab minimarket */
.mm-tabs{display:flex;border-bottom:1px solid #dfd4be;background:#fff}
.mm-tab-btn{flex:1;background:none;border:none;border-bottom:3px solid transparent;padding:0.75rem 1rem;font-size:0.9rem;font-weight:600;color:#888;cursor:pointer;transition:0.2s}
.mm-tab-btn.active{border-bottom-color:#3a523a;color:#3a523a;font-weight:800}
.mm-tab-content{display:none}
.mm-tab-content.active{display:block}
/* Konfirmasi */
.va-btn-outline{width:100%;background:#3a523a;color:#fff;border:none;padding:0.85rem;border-radius:0.5rem;font-size:1rem;font-weight:700;cursor:pointer;transition:0.2s}
.va-btn-outline:hover{background:#2c402c}
/* Sidebar (identik dengan VA) */
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

                {{-- Judul section --}}
                <h3 style="font-size:1.15rem;font-weight:800;color:#333;margin-bottom:0.8rem;" id="dynSectionTitle">
                    Tunjukkan Kode Bayar di Kasir Alfamart
                </h3>

                {{-- Kartu kode bayar (single, dynamic) --}}
                <div class="mm-card">

                    <div class="mm-card-header">
                        <span class="mm-name" id="dynMmName">Memuat...</span>
                        <img id="dynMmLogo" src="" alt="" style="height:28px;object-fit:contain;display:none;">
                    </div>

                    <div class="mm-code-section">
                        <div class="mm-code-label" id="dynMmCodeLabel">Kode Pembayaran</div>
                        <div class="mm-code-value" id="dynMmCode">XXXXXX</div>
                    </div>
                    <div class="mm-copy-row">
                        <button class="mm-copy-btn" onclick="copyCode('dynMmCode', this)">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="15" height="15"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75"/></svg>
                            Salin Kode
                        </button>
                    </div>

                    <div class="mm-divider"></div>

                    <div class="mm-howto">
                        <div class="mm-howto-title" id="dynMmHowtoTitle">Cara Bayar</div>
                        <ol id="dynMmSteps"></ol>
                    </div>

                    <div class="mm-divider"></div>

                    <div class="mm-price-row">
                        <span class="price-label">Harga sebelum biaya admin</span>
                        <span class="price-val" id="dynMmHarga">IDR 1.475.000</span>
                    </div>

                </div>

                {{-- Sudah selesai bayar --}}
                <h3 style="font-size:1.15rem;font-weight:800;color:#333;margin-bottom:0.8rem;margin-top:2rem;">
                    Sudah selesai bayar?
                </h3>
                <div class="mm-card-confirm">
                    <p style="font-size:0.9rem;color:#555;margin-bottom:1.5rem;">
                        Setelah pembayaran berhasil terverifikasi, e-ticket dan bukti pembayaran akan kami kirimkan ke email Anda.
                    </p>
                    <button class="va-btn-outline" onclick="goToKonfirmasi('success')">
                        Cek Status Pembayaran
                    </button>
                </div>

            </div>

            {{-- RIGHT: Rincian Reservasi (identik dengan VA) --}}
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
                            <div id="dynMalam" style="font-size:0.7rem;font-weight:600">1 malam</div>
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
                            <div class="col-title">Makanan & Minuman:</div>
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

/* ── Salin kode ── */
function copyCode(elId, btn) {
    const text = document.getElementById(elId).textContent.trim();
    navigator.clipboard.writeText(text).then(() => {
        const orig = btn.innerHTML;
        btn.textContent = '✓ Tersalin!';
        setTimeout(() => { btn.innerHTML = orig; }, 2000);
    });
}

/* ── Data minimarket ── */
const MM_DATA = {
    alfamart: {
        name: 'Alfamart / Alfamidi',
        logo: '{{ asset("images/partner-pembayaran/alfamart.png") }}',
        codeLabel: 'Kode Pembayaran di Alfamart',
        howtoTitle: 'Cara Bayar di Alfamart',
        sectionTitle: 'Tunjukkan Kode Bayar di Kasir Alfamart',
        steps: [
            'Sampaikan pada kasir Alfamart bahwa Anda hendak membayar transaksi <strong>Landeuh Village</strong>.',
            'Tunjukkan <strong>Kode Pembayaran</strong> Anda (bukan No. Pesanan) ke kasir.',
            'Biaya tambahan sebesar <strong>Rp2.500/transaksi</strong> di luar harga total, akan dikenakan oleh pihak Alfamart.'
        ]
    },
    indomaret: {
        name: 'Indomaret',
        logo: '{{ asset("images/partner-pembayaran/indomaret.png") }}',
        codeLabel: 'Kode Pembayaran di Indomaret',
        howtoTitle: 'Cara Bayar di Indomaret',
        sectionTitle: 'Tunjukkan Kode Bayar di Kasir Indomaret',
        steps: [
            'Sampaikan pada kasir Indomaret bahwa Anda hendak membayar transaksi <strong>Landeuh Village</strong>.',
            'Tunjukkan <strong>Kode Pembayaran</strong> Anda (bukan No. Pesanan) ke kasir.',
            'Biaya tambahan sebesar <strong>Rp2.500/transaksi</strong> di luar harga total, akan dikenakan oleh pihak Indomaret.'
        ]
    }
};

(function () {

    /* Tentukan minimarket dari sessionStorage */
    const selectedMm = sessionStorage.getItem('res_minimarket') || '';
    const isIndomaret = selectedMm.toLowerCase().includes('indomaret');
    const mm = isIndomaret ? MM_DATA.indomaret : MM_DATA.alfamart;

    /* Populate card */
    document.getElementById('dynSectionTitle').textContent = mm.sectionTitle;
    document.getElementById('dynMmName').textContent = mm.name;
    const logoEl = document.getElementById('dynMmLogo');
    logoEl.src = mm.logo;
    logoEl.alt = mm.name;
    logoEl.style.display = 'inline-block';
    logoEl.onerror = function(){ this.style.display='none'; };
    document.getElementById('dynMmCodeLabel').textContent = mm.codeLabel;
    document.getElementById('dynMmHowtoTitle').textContent = mm.howtoTitle;
    document.getElementById('dynMmSteps').innerHTML = mm.steps.map(s => `<li>${s}</li>`).join('');

    /* Countdown */
    const stored = sessionStorage.getItem('res_timer');
    let seconds = stored ? parseInt(stored) : 30 * 60;
    const el = document.getElementById('countdownTimer');
    const iv = setInterval(() => {
        if (seconds <= 0) { clearInterval(iv); el.textContent = '00:00:00'; return; }
        seconds--;
        sessionStorage.setItem('res_timer', seconds);
        const m = String(Math.floor(seconds / 60)).padStart(2, '0');
        const s = String(seconds % 60).padStart(2, '0');
        el.textContent = '00:' + m + ':' + s;
    }, 1000);

    /* Data pemesan */
    const dNama  = sessionStorage.getItem('res_nama')  || 'Ari Rahman';
    const dHp    = sessionStorage.getItem('res_hp')    || '081512345678';
    const dEmail = sessionStorage.getItem('res_email') || 'arirahman@gmail.com';
    const dTamu  = sessionStorage.getItem('res_tamu')  || 'M. Akbar R.';
    const dGuest = sessionStorage.getItem('res_guest') || '4 Dewasa + 1 Anak + 2 Dewasa';
    const dTotal = sessionStorage.getItem('res_total') || 'IDR 1.475.000';
    const dMalam = sessionStorage.getItem('res_malam');
    const dJudul = sessionStorage.getItem('res_judul');
    const dCheckin = sessionStorage.getItem('res_checkin');
    const dCheckout = sessionStorage.getItem('res_checkout');

    document.getElementById('dynNama').textContent  = dNama;
    document.getElementById('dynHp').textContent    = dHp;
    document.getElementById('dynEmail').textContent = dEmail;
    document.getElementById('userEmailSpan').textContent = dEmail;
    document.getElementById('dynTamu').textContent  = dTamu;
    document.getElementById('dynGuestInfo').textContent = dGuest;

    /* Harga */
    const totalFormatted = dTotal.startsWith('IDR') ? dTotal : 'IDR ' + dTotal;
    document.getElementById('dynMmHarga').textContent = totalFormatted;
    
    if(dMalam) {
        const dynMalamEl = document.getElementById('dynMalam');
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

    /* Kode pembayaran dummy */
    const storedCode = sessionStorage.getItem('res_mm_code') || String(Math.floor(100000 + Math.random() * 900000));
    sessionStorage.setItem('res_mm_code', storedCode);
    document.getElementById('dynMmCode').textContent = storedCode;

    /* Akomodasi */
    const akoId   = parseInt(sessionStorage.getItem('res_akoId')) || 1;
    const akoItem = (typeof AKOMODASI_DATA !== 'undefined')
                  ? (AKOMODASI_DATA.find(d => d.id === akoId) || AKOMODASI_DATA[0])
                  : null;

    if (akoItem) {
        document.getElementById('headerAkoJudul').textContent = akoItem.judul;
        document.getElementById('dynBed').innerHTML =
            `<iconify-icon icon="lucide:bed-double" class="text-lg"></iconify-icon> ${akoItem.kasur}`;
        document.getElementById('dynSmoking').innerHTML =
            `<iconify-icon icon="${akoItem.merokok ? 'lucide:cigarette' : 'lucide:cigarette-off'}" class="text-lg"></iconify-icon>
             ${akoItem.merokok ? 'Boleh merokok di kamar' : 'Dilarang merokok'}`;

        const fasLen = Math.ceil(akoItem.fasilitas.length / 2);
        document.getElementById('dynFasilitas1').innerHTML =
            akoItem.fasilitas.slice(0, fasLen).map(f => `<li>${f}</li>`).join('');
        document.getElementById('dynFasilitas2').innerHTML =
            akoItem.fasilitas.slice(fasLen).map(f => `<li>${f}</li>`).join('');
        document.getElementById('dynMakanan').innerHTML =
            akoItem.makanan.map(m => `<li>${m}</li>`).join('');
    } else {
        document.getElementById('headerAkoJudul').textContent = 'Kamar Keluarga Deluks dengan Pemandangan Sungai';
    }

})();

function goToKonfirmasi(status) {
    sessionStorage.setItem('res_payment_status', status);
    const bookingNo = sessionStorage.getItem('res_booking_no');
    const method = sessionStorage.getItem('res_payment_method') || sessionStorage.getItem('res_minimarket') || 'Minimarket';

    if (bookingNo) {
        fetch('/reservasi/update-status', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                no_pesanan: bookingNo,
                status: 'success',
                metode_pembayaran: method
            })
        }).finally(() => {
            window.location.href = '/reservasi/konfirmasi';
        });
    } else {
        window.location.href = '/reservasi/konfirmasi';
    }
}

</script>
@endpush
@endsection
