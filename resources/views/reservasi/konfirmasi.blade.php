@extends('layouts.booking')
@section('title', 'Status Pembayaran - Landeuh Village Riverside')
@section('content')

{{--
    ┌─────────────────────────────────────────────────────────────────────────┐
    │  NOTES UNTUK DEVELOPER                                                  │
    │                                                                         │
    │  1. STATUS (berhasil / gagal) diambil otomatis dari sessionStorage      │
    │     key: 'res_payment_status' → nilai: 'success' atau 'failed'         │
    │     Fallback default: 'success'                                         │
    │                                                                         │
    │  2. IKON STATUS:                                                        │
    │     - Berhasil : centang hijau (SVG inline, animasi draw-in)            │
    │     - Gagal    : silang merah  (SVG inline, animasi shake)              │
    │     → Tidak butuh file gambar eksternal                                 │
    │                                                                         │
    │  3. NOMINAL (IDR):                                                      │
    │     - Berhasil : warna biru  (#2980b9) — lihat .amount-success          │
    │     - Gagal    : warna merah (#c0392b) — lihat .amount-failed           │
    │     → Kelas ditambahkan dinamis oleh JS                                 │
    │                                                                         │
    │  4. LOGO LANDEUH: {{ asset('images/logo-landeuh.png') }}               │
    │                                                                         │
    │  5. FOTO KAMAR  : {{ asset('images/akomodasi/...') }}                  │
    │     path foto diambil dari AKOMODASI_DATA[id].foto (akomodasi-data.js) │
    │                                                                         │
    │  6. TOMBOL "Unduh PDF" hanya muncul saat status = success              │
    │     (implementasi PDF generation disesuaikan backend masing-masing)     │
    └─────────────────────────────────────────────────────────────────────────┘
--}}

<style>
/* ── Reset & Base ─────────────────────────────────────── */
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}

/* ── Page Shell ───────────────────────────────────────── */
.cp-page{
    background:#F8EDD8;
    min-height:100vh;
    font-family:'Segoe UI',system-ui,sans-serif;
    position:relative;
    overflow-x:hidden;
}

/* ── Decorative Batik Blobs ───────────────────────────── */
.cp-blob{
    position:fixed;pointer-events:none;z-index:0;opacity:.12;
}

/* ── Top Bar ──────────────────────────────────────────── */
.cp-topbar{
    background:transparent;
    padding:1.2rem 2rem;
    display:flex;align-items:center;justify-content:space-between;
    position:relative;z-index:50;
}
.cp-booking-no{font-size:1rem;font-weight:800;color:#333}
.cp-booking-no span{color:#3a523a;font-weight:800}

/* ── Email Banner ─────────────────────────────────────── */
.cp-email-banner{
    background:#e6a645;color:#fff;
    padding:.75rem 1.2rem;
    border-radius:.6rem;
    font-size:.875rem;
    display:flex;align-items:center;justify-content:space-between;gap:1rem;
    margin-bottom:2rem;
}
.cp-email-banner strong{font-weight:800}
.cp-pdf-btn{
    flex-shrink:0;
    background:#2980b9;color:#fff;border:none;
    padding:.5rem 1rem;border-radius:.5rem;
    font-size:.8rem;font-weight:700;cursor:pointer;
    display:flex;align-items:center;gap:.4rem;
    transition:background .2s;white-space:nowrap;
}
.cp-pdf-btn:hover{background:#1f6aa5}

/* ── Main Card ────────────────────────────────────────── */
.cp-card{
    background:#f1e5cc;
    border:1px solid #dfd4be;
    border-radius:1.25rem;
    padding:2.5rem 2rem;
    box-shadow:0 10px 40px rgba(0,0,0,.1), 0 2px 12px rgba(0,0,0,.06);
    position:relative;z-index:1;
}

/* ── Status Icon ──────────────────────────────────────── */
.cp-icon-wrap{
    width:96px;height:96px;border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    margin:0 auto 1.5rem;
    position:relative;
}
.cp-icon-wrap::before{
    content:'';position:absolute;inset:-10px;border-radius:50%;opacity:.25;
}
/* Success */
.cp-icon-success{background:#27ae60}
.cp-icon-success::before{background:#27ae60}
/* Failed */
.cp-icon-failed{background:#c0392b}
.cp-icon-failed::before{background:#c0392b}

/* ── Icon Animations ─────────────────────────────────── */
/* Success: scale-in bounce + continuous gentle pulse */
@keyframes scaleInBounce{
    0%{transform:scale(0);opacity:0}
    50%{transform:scale(1.15)}
    70%{transform:scale(.95)}
    100%{transform:scale(1);opacity:1}
}
@keyframes pulseGlow{
    0%,100%{box-shadow:0 0 0 0 rgba(39,174,96,.45)}
    50%{box-shadow:0 0 0 14px rgba(39,174,96,0)}
}
.cp-icon-success{
    animation:scaleInBounce .6s cubic-bezier(.4,0,.2,1) both;
}
.cp-icon-success.pulse{
    animation:scaleInBounce .6s cubic-bezier(.4,0,.2,1) both, pulseGlow 2s 1s ease-in-out infinite;
}

/* Checkmark draw */
@keyframes drawCheck{
    from{stroke-dashoffset:60}
    to{stroke-dashoffset:0}
}
.cp-check-path{
    stroke-dasharray:60;stroke-dashoffset:60;
    animation:drawCheck .55s .35s cubic-bezier(.4,0,.2,1) forwards;
}

/* Failed: scale-in + shake + continuous wobble */
@keyframes shakeIn{
    0%{transform:scale(0);opacity:0}
    40%{transform:scale(1.1);opacity:1}
    50%{transform:scale(1) rotate(-8deg)}
    60%{transform:rotate(8deg)}
    70%{transform:rotate(-5deg)}
    80%{transform:rotate(5deg)}
    90%{transform:rotate(-2deg)}
    100%{transform:rotate(0)}
}
@keyframes wobble{
    0%,100%{transform:rotate(0)}
    25%{transform:rotate(-3deg)}
    75%{transform:rotate(3deg)}
}
@keyframes pulseGlowRed{
    0%,100%{box-shadow:0 0 0 0 rgba(192,57,43,.45)}
    50%{box-shadow:0 0 0 14px rgba(192,57,43,0)}
}
.cp-icon-failed{
    animation:shakeIn .7s cubic-bezier(.4,0,.2,1) both;
}
.cp-icon-failed.pulse{
    animation:shakeIn .7s cubic-bezier(.4,0,.2,1) both, pulseGlowRed 2s 1.2s ease-in-out infinite;
}
.cp-icon-failed svg{
    animation:wobble 2.5s 1.5s ease-in-out infinite;
}

/* ── Status Heading ───────────────────────────────────── */
.cp-status-title{
    text-align:center;font-size:1.6rem;font-weight:800;
    color:#222;margin-bottom:.5rem;
}
.cp-status-amount{
    text-align:center;font-size:1.8rem;font-weight:900;
    margin-bottom:2rem;letter-spacing:-.5px;
}
.amount-success{color:#2980b9}
.amount-failed{color:#c0392b}

/* ── Two-column body ──────────────────────────────────── */
.cp-body{display:flex;gap:1.5rem;align-items:flex-start}
@media(max-width:768px){.cp-body{flex-direction:column}}

/* ── Left Column (Policy + Identity) ─────────────────── */
.cp-left{display:flex;flex-direction:column;gap:1rem;flex:1;min-width:0}

.cp-box{
    background:#f1e5cc;border-radius:.75rem;
    border:1px solid #dfd4be;padding:1.2rem 1.4rem;
}
.cp-box-title{font-size:.95rem;font-weight:800;color:#333;margin-bottom:.8rem}
.cp-policy p{font-size:.82rem;color:#555;line-height:1.6;padding-bottom:.6rem;margin-bottom:.6rem;border-bottom:1px solid #dfd4be}
.cp-policy p:last-child{border-bottom:none;margin-bottom:0;padding-bottom:0}

.cp-id-grid{display:grid;grid-template-columns:1fr 1fr;gap:.8rem}
.cp-id-group .cp-id-label{font-size:.72rem;color:#888;font-weight:600;margin-bottom:.25rem}
.cp-id-group .cp-id-val{font-size:.82rem;color:#333;font-weight:700;line-height:1.4}

/* ── Right Column (Room detail) ───────────────────────── */
.cp-right{flex:1.2;min-width:0}

.cp-room-card{
    background:#f1e5cc;border-radius:.75rem;
    border:1px solid #dfd4be;padding:1.4rem;
    display:flex;flex-direction:column;gap:1rem;
}
.cp-room-header{display:flex;justify-content:space-between;align-items:flex-start;gap:1rem}
.cp-room-header-info{flex:1}
.cp-room-name{font-size:1.1rem;font-weight:800;color:#222;margin-bottom:.5rem}
.cp-room-meta{display:flex;align-items:center;gap:.8rem;flex-wrap:wrap;font-size:.8rem;color:#555;font-weight:600}
.cp-room-meta span{display:flex;align-items:center;gap:.3rem}
.cp-room-meta .dot{width:4px;height:4px;border-radius:50%;background:#bbb}
.cp-room-img{
    width:120px;height:90px;border-radius:.6rem;
    object-fit:cover;flex-shrink:0;border:1.5px solid #dfd4be;
}
@media(max-width:480px){.cp-room-img{width:80px;height:60px}}

.cp-room-divider{border:none;border-top:1px solid #dfd4be}

/* Facilities grid */
.cp-fac-grid{display:grid;grid-template-columns:1fr 1fr 1fr;gap:.5rem;font-size:.78rem;color:#444}
.cp-fac-col-title{font-weight:700;color:#333;margin-bottom:.35rem;font-size:.8rem}
.cp-fac-col ul{list-style:disc;padding-left:1.1rem}
.cp-fac-col ul li{margin-bottom:.2rem}
@media(max-width:520px){.cp-fac-grid{grid-template-columns:1fr 1fr}}

/* Guest row */
.cp-guest-row{display:flex;align-items:center;gap:.5rem;font-size:.8rem;font-weight:600;color:#444}

/* Dates */
.cp-dates{
    display:flex;justify-content:space-between;align-items:center;
    background:rgba(255,255,255,.5);border-radius:.5rem;
    padding:.8rem 1rem;
}
.cp-date-label{font-size:.72rem;font-weight:700;margin-bottom:.15rem}
.cp-date-label.green{color:#27ae60}
.cp-date-label.red{color:#c0392b}
.cp-date-val{font-size:.9rem;font-weight:700;color:#222}
.cp-date-time{font-size:.65rem;color:#888;margin-top:.1rem}
.cp-date-center{text-align:center;color:#888}
.cp-nights{font-size:.7rem;font-weight:600}
.cp-arrow{font-size:1.3rem;line-height:1}

/* ── Bottom Actions ───────────────────────────────────── */
.cp-actions{
    display:flex;justify-content:space-between;align-items:center;
    margin-top:2.5rem;gap:1rem;flex-wrap:wrap;
}
.cp-btn{
    padding:.75rem 1.6rem;border-radius:.6rem;font-size:.95rem;
    font-weight:700;cursor:pointer;border:none;transition:all .2s;
    display:flex;align-items:center;gap:.5rem;
}
.cp-btn-cancel{border:1px solid rgba(250, 63, 70, 1);color:#fa3f46}
.cp-btn-cancel:hover{background:rgba(250, 63, 70, 0.2)}
.cp-btn-home{background:#3a523a;color:#fff}
.cp-btn-home:hover{background:#2c402c}

/* ── Modal Pembatalan ────────────────────────────────── */
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

/* ── Fade-up entrance ─────────────────────────────────── */
@keyframes fadeUp{
    from{opacity:0;transform:translateY(24px)}
    to{opacity:1;transform:translateY(0)}
}
.cp-card{animation:fadeUp .5s ease both}
.cp-email-banner{animation:fadeUp .5s .1s ease both}
.cp-actions{animation:fadeUp .5s .2s ease both}

/* ── Mobile Responsive ────────────────────────────────── */
@media(max-width:768px){
    .cp-topbar{padding:.8rem 1rem}
    .cp-booking-no{font-size:.85rem}
    .cp-topbar img{height:32px!important}

    .cp-email-banner{
        flex-direction:column;align-items:stretch;gap:.6rem;
        text-align:center;font-size:.8rem;padding:.7rem 1rem;
    }
    .cp-pdf-btn{justify-content:center;width:100%}

    .cp-card{padding:1.5rem 1rem;border-radius:1rem}
    .cp-icon-wrap{width:72px;height:72px}
    .cp-icon-wrap svg{width:36px!important;height:36px!important}
    .cp-status-title{font-size:1.25rem}
    .cp-status-amount{font-size:1.4rem;margin-bottom:1.5rem}

    .cp-body{flex-direction:column;gap:1rem}
    .cp-left,.cp-right{flex:1 1 100%!important;width:100%}

    .cp-box{padding:1rem}
    .cp-room-card{padding:1rem}

    .cp-fac-grid{grid-template-columns:1fr 1fr!important}
    .cp-room-meta{flex-direction:column;align-items:flex-start;gap:.3rem}
    .cp-room-meta .dot{display:none}

    .cp-dates{flex-direction:row;padding:.6rem .8rem}
    .cp-date-val{font-size:.8rem}
    .cp-date-time{font-size:.6rem}

    .cp-actions{flex-direction:column;gap:.8rem;margin-top:1.5rem}
    .cp-btn{width:100%;justify-content:center;padding:.7rem 1rem;font-size:.9rem}
}

@media(max-width:480px){
    .cp-topbar{padding:.6rem .8rem}
    .cp-booking-no{font-size:.78rem}
    .cp-card{padding:1.2rem .8rem}
    .cp-status-title{font-size:1.1rem}
    .cp-status-amount{font-size:1.2rem}
    .cp-id-grid{grid-template-columns:1fr}
    .cp-fac-grid{grid-template-columns:1fr!important}
    .cp-dates{gap:.3rem;padding:.5rem}
    .cp-date-val{font-size:.75rem}
    .cp-room-img{width:70px;height:55px}
}
</style>

<div class="cp-page">

    {{-- Decorative batik --}}
    <img src="{{ asset('images/assets_lain/batik.png') }}"
         class="cp-blob"
         style="top:60px;left:-24px;width:140px;transform:rotate(6deg)"
         alt="">
    <img src="{{ asset('images/assets_lain/batik.png') }}"
         class="cp-blob"
         style="top:45%;right:-30px;width:150px;transform:rotate(-12deg) scaleX(-1)"
         alt="">
    <img src="{{ asset('images/assets_lain/batik.png') }}"
         class="cp-blob"
         style="bottom:40px;left:40px;width:120px;transform:rotate(45deg)"
         alt="">

    {{-- ── Top Bar ── --}}
    <div class="cp-topbar">
        <div class="cp-booking-no">
            No. Pemesanan: <span id="dynBookingNo">XXXXXXXXXX</span>
        </div>
        <img src="{{ asset('images/logo-landeuh.png') }}" alt="Landeuh Village" style="height:42px">
    </div>

    {{-- ── Content ── --}}
    <div class="max-width:98% lg:max-width:96%"style="margin:0 auto;padding:1.5rem 2rem 3rem;position:relative;z-index:10">

        {{-- Email banner --}}
        <div class="cp-email-banner">
            <span id="dynEmailBannerText">
                Cek emailmu (<strong><span id="dynEmailInBanner">xxxxxx@gmail.com</span></strong>)
                sekarang untuk konfirmasi pembayaran.
            </span>
            {{-- Tombol PDF hanya tampil saat berhasil (ditampilkan via JS) --}}
            <button class="cp-pdf-btn" id="btnUnduhPdf" style="display:none" onclick="unduhPdf()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="2" stroke="currentColor" width="16" height="16">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                </svg>
                Unduh PDF
            </button>
        </div>

        {{-- Main card --}}
        <div class="cp-card">

            {{-- Status Icon --}}
            <div id="dynStatusIcon" class="cp-icon-wrap cp-icon-success">
                {{-- SVG injected by JS --}}
            </div>

            {{-- Status text --}}
            <h1 class="cp-status-title" id="dynStatusTitle">Pembayaran Berhasil</h1>
            <p class="cp-status-amount" id="dynAmount">IDR —</p>

            {{-- Body --}}
            <div class="cp-body">

                {{-- LEFT: Kebijakan + Identitas --}}
                <div class="cp-left">

                    {{-- Kebijakan --}}
                    <div class="cp-box">
                        <div class="cp-box-title">Kebijakan</div>
                        <div class="cp-policy">
                            <p>Pemesanan ini tidak dapat diubah</p>
                            <p>Pemesanan tidak ada refund jika Anda membatalkannya</p>
                        </div>
                    </div>

                    {{-- Identitas --}}
                    <div class="cp-box">
                        <div class="cp-id-grid">
                            <div class="cp-id-group">
                                <div class="cp-id-label">Pemesan:</div>
                                <div class="cp-id-val" id="dynNama">Memuat…</div>
                                <div class="cp-id-val" style="font-weight:500;margin-top:.15rem" id="dynHp">—</div>
                                <div class="cp-id-val" style="font-weight:500;font-size:.75rem;margin-top:.1rem" id="dynEmail">—</div>
                            </div>
                            <div class="cp-id-group">
                                <div class="cp-id-label">Nama Tamu:</div>
                                <div class="cp-id-val" id="dynTamu">Memuat…</div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- RIGHT: Kamar --}}
                <div class="cp-right">
                    <div class="cp-room-card">

                        {{-- Room header --}}
                        <div class="cp-room-header">
                            <div class="cp-room-header-info">
                                <div class="cp-room-name" id="dynRoomName">Cabin 1</div>
                                <div class="cp-room-meta">
                                    <span id="dynBed">
                                        {{-- bed icon + text via JS --}}
                                    </span>
                                    <span class="dot"></span>
                                    <span id="dynSmoking">
                                        {{-- smoking icon + text via JS --}}
                                    </span>
                                </div>
                            </div>
                            <img id="dynRoomImg"
                                 src="{{ asset('images/akomodasi/cabin1/a.png') }}"
                                 alt="Foto Kamar"
                                 class="cp-room-img">
                        </div>

                        <hr class="cp-room-divider">

                        {{-- Facilities --}}
                        <div class="cp-fac-grid">
                            <div class="cp-fac-col">
                                <div class="cp-fac-col-title">Fasilitas Kamar:</div>
                                <ul id="dynFasilitas1"></ul>
                            </div>
                            <div class="cp-fac-col" style="padding-top:1.25rem">
                                <ul id="dynFasilitas2"></ul>
                            </div>
                            <div class="cp-fac-col">
                                <div class="cp-fac-col-title">Makanan &amp; Minuman:</div>
                                <ul id="dynMakanan"></ul>
                            </div>
                        </div>

                        <hr class="cp-room-divider">

                        {{-- Guest count --}}
                        <div class="cp-guest-row">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="2" stroke="currentColor" width="16" height="16">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                            </svg>
                            <span id="dynGuestInfo">Memuat…</span>
                        </div>

                        {{-- Dates --}}
                        <div class="cp-dates">
                            <div>
                                <div class="cp-date-label green">Check-in</div>
                                <div class="cp-date-val" id="dynCheckin">Selasa, 28 April 2026</div>
                                <div class="cp-date-time">Dari 14.00 – 21.00</div>
                            </div>
                            <div class="cp-date-center">
                                <div class="cp-nights" id="dynNights">1 malam</div>
                                <div class="cp-arrow">→</div>
                            </div>
                            <div style="text-align:right">
                                <div class="cp-date-label red">Check-out</div>
                                <div class="cp-date-val" id="dynCheckout">Rabu, 29 April 2026</div>
                                <div class="cp-date-time">Hingga 12.00</div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>{{-- /cp-body --}}

        </div>{{-- /cp-card --}}

        {{-- Bottom actions --}}
        <div class="cp-actions">
            <button class="cp-btn cp-btn-cancel" onclick="ajukanPembatalan()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="2" stroke="currentColor" width="16" height="16">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>
                Ajukan Pembatalan
            </button>
            <button class="cp-btn cp-btn-home" onclick="window.location.href='/'">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="2" stroke="currentColor" width="16" height="16">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
                </svg>
                Kembali ke Beranda
            </button>
        </div>

    </div>
</div>

{{-- Modal Pembatalan --}}
<div class="modal-overlay" id="modalPembatalan">
    <div class="modal-box">
        <div class="modal-icon modal-icon-success">
            <svg width="36" height="36" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="cp-check-path" d="M12 25l9 9 15-18" stroke="#fff" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <h3 class="modal-title">Pengajuan Pembatalan Terkirim</h3>
        <p class="modal-desc">
            Permintaan pembatalan Anda telah dikirim ke admin Landeuh Village Riverside.<br>
            Silakan hubungi admin melalui WhatsApp untuk konfirmasi lebih lanjut.
        </p>
        <button class="modal-btn-wa" onclick="window.open('https://wa.me/6281234567890?text=Halo%20Admin%2C%20saya%20ingin%20mengonfirmasi%20pengajuan%20pembatalan%20pesanan%20saya.%20No.%20Pemesanan%3A%20' + encodeURIComponent(document.getElementById('dynBookingNo').textContent), '_blank')">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            Hubungi Admin via WhatsApp
        </button>
        <button class="modal-btn-close" onclick="closeModalPembatalan()">Tutup</button>
    </div>
</div>

@push('scripts')
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script src="{{ asset('js/akomodasi-data.js') }}"></script>
<script>
(function () {
    @if(isset($booking))
        // Populate sessionStorage with the database booking data
        sessionStorage.setItem('res_booking_no', '{{ $booking->no_pesanan }}');
        sessionStorage.setItem('res_nama', '{{ $booking->pemesan_nama }}');
        sessionStorage.setItem('res_hp', '{{ $booking->pemesan_telp }}');
        sessionStorage.setItem('res_email', '{{ $booking->pemesan_email }}');
        sessionStorage.setItem('res_tamu', '{{ $booking->nama_tamu }}');
        sessionStorage.setItem('res_guest', '{{ $booking->accommodation->max_orang }} Dewasa');
        
        @php
            $formattedTotal = number_format($booking->total, 0, ',', '.');
        @endphp
        
        sessionStorage.setItem('res_total', '{{ $formattedTotal }}');
        sessionStorage.setItem('res_akoId', '{{ $booking->accommodation_id }}');
        sessionStorage.setItem('res_payment_status', '{{ $booking->status }}');
        sessionStorage.setItem('res_payment_method', '{{ $booking->metode_pembayaran }}');
    @endif

    // ── Baca sessionStorage ───────────────────────────────────────────────
    const status   = sessionStorage.getItem('res_payment_status') || 'success'; // 'success' | 'failed'
    const dNama    = sessionStorage.getItem('res_nama')    || 'Ari Rahman';
    const dHp      = sessionStorage.getItem('res_hp')      || '081512345678';
    const dEmail   = sessionStorage.getItem('res_email')   || 'arirahman@gmail.com';
    const dTamu    = sessionStorage.getItem('res_tamu')    || 'M. Akbar R.';
    const dGuest   = sessionStorage.getItem('res_guest')   || '4 Dewasa + 1 Anak + 2 Dewasa';
    const dTotal   = sessionStorage.getItem('res_total')   || '1.475.000';
    const dBooking = sessionStorage.getItem('res_booking_no') || 'XXXXXXXXXX';
    const akoId    = parseInt(sessionStorage.getItem('res_akoId')) || 1;
    
    // Parse URL query parameters to check if accessed from My Bookings history page
    const urlParams = new URLSearchParams(window.location.search);
    const fromPesanan = urlParams.get('from') === 'pesanan';

    // Kirim update status ke database MySQL secara real-time
    const selectedMethod = sessionStorage.getItem('res_va') 
                        || sessionStorage.getItem('res_payment_method') 
                        || sessionStorage.getItem('res_minimarket') 
                        || 'Virtual Account';

    if (dBooking && dBooking !== 'XXXXXXXXXX') {
        fetch('/reservasi/update-status', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                no_pesanan: dBooking,
                status: status === 'success' ? 'success' : 'failed',
                metode_pembayaran: selectedMethod
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log('Status updated in MySQL:', data);
        })
        .catch(err => {
            console.error('Failed to update status in MySQL:', err);
        });
    }

    // ── Booking number ────────────────────────────────────────────────────
    document.getElementById('dynBookingNo').textContent = dBooking;

    // ── Identity ──────────────────────────────────────────────────────────
    document.getElementById('dynNama').textContent  = dNama;
    document.getElementById('dynHp').textContent    = dHp;
    document.getElementById('dynEmail').textContent = dEmail;
    document.getElementById('dynTamu').textContent  = dTamu;
    document.getElementById('dynGuestInfo').textContent = dGuest;
    document.getElementById('dynEmailInBanner').textContent = dEmail;

    // ── Amount ────────────────────────────────────────────────────────────
    const amt = dTotal.replace(/IDR\s?/i, '').trim();
    const amountEl = document.getElementById('dynAmount');
    amountEl.textContent = 'IDR ' + amt;

    // ── Status-dependent UI ───────────────────────────────────────────────
    const iconWrap   = document.getElementById('dynStatusIcon');
    const titleEl    = document.getElementById('dynStatusTitle');
    const bannerText = document.getElementById('dynEmailBannerText');

    if (status === 'success') {
        // Icon: green checkmark
        iconWrap.className = 'cp-icon-wrap cp-icon-success';
        iconWrap.innerHTML = `
            <svg width="48" height="48" viewBox="0 0 48 48" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path class="cp-check-path"
                      d="M12 25l9 9 15-18"
                      stroke="#fff" stroke-width="4.5"
                      stroke-linecap="round" stroke-linejoin="round"/>
            </svg>`;

        titleEl.textContent = 'Pembayaran Berhasil';
        amountEl.classList.add('amount-success');

        document.getElementById('btnUnduhPdf').style.display = 'flex';
        
        if (fromPesanan) {
            bannerText.innerHTML = `E-Ticket resmi Anda telah dikirimkan ke <strong><span id="dynEmailInBanner">${dEmail}</span></strong>.`;
        } else {
            bannerText.innerHTML = `Cek emailmu (<strong><span id="dynEmailInBanner">${dEmail}</span></strong>) sekarang untuk konfirmasi pembayaran.`;
        }

        // Activate continuous pulse after entrance finishes
        setTimeout(() => iconWrap.classList.add('pulse'), 700);

    } else {
        // Icon: red cross
        iconWrap.className = 'cp-icon-wrap cp-icon-failed';
        iconWrap.innerHTML = `
            <svg width="44" height="44" viewBox="0 0 44 44" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path d="M13 13l18 18M31 13L13 31"
                      stroke="#fff" stroke-width="4.5"
                      stroke-linecap="round"/>
            </svg>`;

        titleEl.textContent = 'Pembayaran Gagal';
        amountEl.classList.add('amount-failed');

        // Activate continuous pulse after entrance finishes
        setTimeout(() => iconWrap.classList.add('pulse'), 800);

        // Banner text untuk gagal
        if (fromPesanan) {
            bannerText.innerHTML = `Pemesanan ini berstatus gagal/dibatalkan.`;
        } else {
            bannerText.innerHTML = `Cek emailmu (<strong>${dEmail}</strong>) sekarang untuk detail cara bayar.`;
        }
    }

    // ── Accommodation data ────────────────────────────────────────────────
    const akoItem = (typeof AKOMODASI_DATA !== 'undefined')
        ? (AKOMODASI_DATA.find(d => d.id === akoId) || AKOMODASI_DATA[0])
        : null;

    if (akoItem) {
        document.getElementById('dynRoomName').textContent = akoItem.judul;

        document.getElementById('dynBed').innerHTML =
            `<iconify-icon icon="lucide:bed-double"></iconify-icon> ${akoItem.kasur}`;

        document.getElementById('dynSmoking').innerHTML = akoItem.merokok
            ? `<iconify-icon icon="lucide:cigarette"></iconify-icon> Boleh merokok di kamar`
            : `<iconify-icon icon="lucide:cigarette-off"></iconify-icon> Dilarang merokok`;

        // Fasilitas split half
        const half = Math.ceil(akoItem.fasilitas.length / 2);
        document.getElementById('dynFasilitas1').innerHTML =
            akoItem.fasilitas.slice(0, half).map(f => `<li>${f}</li>`).join('');
        document.getElementById('dynFasilitas2').innerHTML =
            akoItem.fasilitas.slice(half).map(f => `<li>${f}</li>`).join('');

        document.getElementById('dynMakanan').innerHTML =
            akoItem.makanan.map(m => `<li>${m}</li>`).join('');

        // Room photo — images are in /images/akomodasi/{gambar}/a.png
        if (akoItem.gambar) {
            document.getElementById('dynRoomImg').src =
                '/images/akomodasi/' + akoItem.gambar + '/a.png';
        }
    }

    // ── Check-in / Check-out (dari sessionStorage jika tersedia) ──────────
    const dCheckin  = sessionStorage.getItem('res_checkin');
    const dCheckout = sessionStorage.getItem('res_checkout');
    const dNights   = sessionStorage.getItem('res_malam');
    if (dCheckin)  document.getElementById('dynCheckin').textContent  = dCheckin;
    if (dCheckout) document.getElementById('dynCheckout').textContent = dCheckout;
    if (dNights)   document.getElementById('dynNights').textContent   = dNights + ' malam';
})();

// ── Actions ─────────────────────────────────────────────────────────────────────

function unduhPdf() {
    const btn = document.getElementById('btnUnduhPdf');
    const origHTML = btn.innerHTML;
    btn.innerHTML = '<svg class="animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="16" height="16"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" opacity=".3"/><path fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"/></svg> Menyiapkan…';
    btn.disabled = true;

    // Collect data
    const bookNo  = document.getElementById('dynBookingNo').textContent;
    const nama    = document.getElementById('dynNama').textContent;
    const hp      = document.getElementById('dynHp').textContent;
    const email   = document.getElementById('dynEmail').textContent;
    const tamu    = document.getElementById('dynTamu').textContent;
    const room    = document.getElementById('dynRoomName').textContent;
    const amount  = document.getElementById('dynAmount').textContent;
    const checkin = document.getElementById('dynCheckin').textContent;
    const checkout= document.getElementById('dynCheckout').textContent;
    const nights  = document.getElementById('dynNights').textContent;
    const guest   = document.getElementById('dynGuestInfo').textContent;
    const status  = document.getElementById('dynStatusTitle').textContent;
    const now     = new Date().toLocaleString('id-ID', {dateStyle:'long', timeStyle:'short'});

    // Build receipt HTML
    const receiptHTML = `
    <html><head><meta charset="utf-8"><title>Resi ${bookNo}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap');
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'Inter',sans-serif;background:#f9f3e8;padding:0}
        .receipt{max-width:520px;margin:2rem auto;background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,.08)}
        .receipt-header{background:#3a523a;color:#fff;padding:1.5rem;text-align:center}
        .receipt-header h1{font-size:1.1rem;font-weight:800;margin-bottom:.3rem}
        .receipt-header p{font-size:.75rem;opacity:.8}
        .receipt-logo{display:flex;align-items:center;justify-content:center;gap:.6rem;margin-bottom:.8rem}
        .receipt-logo img{height:36px}
        .receipt-status{text-align:center;padding:1.5rem 1rem .5rem}
        .badge{display:inline-block;padding:.35rem 1rem;border-radius:2rem;font-size:.8rem;font-weight:700}
        .badge-success{background:#d4edda;color:#155724}
        .badge-failed{background:#f8d7da;color:#721c24}
        .receipt-amount{text-align:center;font-size:1.6rem;font-weight:800;color:#222;padding:.5rem 0 1rem}
        .receipt-body{padding:0 1.5rem 1.5rem}
        .section{margin-bottom:1rem}
        .section-title{font-size:.7rem;font-weight:700;color:#888;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.5rem;padding-bottom:.3rem;border-bottom:1px solid #eee}
        .row{display:flex;justify-content:space-between;font-size:.82rem;padding:.25rem 0}
        .row .label{color:#666}
        .row .value{color:#222;font-weight:600;text-align:right}
        .receipt-footer{text-align:center;padding:1rem;background:#f1e5cc;font-size:.7rem;color:#666}
        .divider{border:none;border-top:1px dashed #ddd;margin:.8rem 0}
        @media print{body{background:#fff;padding:0} .receipt{box-shadow:none;margin:0;max-width:100%}}
        @media (max-width: 480px){
            .receipt{margin:1rem;border-radius:12px}
            .receipt-header{padding:1rem}
            .receipt-body{padding:0 1rem 1rem}
        }
    </style></head><body>
    <div class="receipt">
        <div class="receipt-header">
            <div class="receipt-logo">
                <img src="${window.location.origin}/images/logo-landeuh.png" alt="Landeuh" style="height:40px">
                <div><strong>Landeuh Village Riverside</strong><br><span style="font-size:.7rem;opacity:.7">Reservation Receipt</span></div>
            </div>
            <p>No. Pemesanan: <strong>${bookNo}</strong></p>
        </div>
        <div class="receipt-status">
            <span class="badge ${status.includes('Berhasil') ? 'badge-success' : 'badge-failed'}">${status}</span>
        </div>
        <div class="receipt-amount">${amount}</div>
        <div class="receipt-body">
            <div class="section">
                <div class="section-title">Detail Akomodasi</div>
                <div class="row"><span class="label">Akomodasi</span><span class="value">${room}</span></div>
                <div class="row"><span class="label">Check-in</span><span class="value">${checkin}</span></div>
                <div class="row"><span class="label">Check-out</span><span class="value">${checkout}</span></div>
                <div class="row"><span class="label">Durasi</span><span class="value">${nights}</span></div>
                <div class="row"><span class="label">Tamu</span><span class="value">${guest}</span></div>
            </div>
            <hr class="divider">
            <div class="section">
                <div class="section-title">Identitas Pemesan</div>
                <div class="row"><span class="label">Nama</span><span class="value">${nama}</span></div>
                <div class="row"><span class="label">Telepon</span><span class="value">${hp}</span></div>
                <div class="row"><span class="label">Email</span><span class="value">${email}</span></div>
                <div class="row"><span class="label">Nama Tamu</span><span class="value">${tamu}</span></div>
            </div>
            <hr class="divider">
            <div class="section">
                <div class="section-title">Kebijakan</div>
                <p style="font-size:.78rem;color:#555;line-height:1.5">• Pemesanan ini tidak dapat diubah<br>• Pemesanan tidak ada refund jika dibatalkan</p>
            </div>
        </div>
        <div class="receipt-footer">
            Dicetak pada ${now} &mdash; Landeuh Village Riverside<br>
            Dokumen ini merupakan bukti reservasi yang sah.
        </div>
    </div>
    </body></html>`;

    // Open print window
    const printWin = window.open('', '_blank', 'width=600,height=800');
    printWin.document.write(receiptHTML);
    printWin.document.close();
    printWin.onload = function() {
        setTimeout(() => {
            printWin.print();
            btn.innerHTML = origHTML;
            btn.disabled = false;
        }, 400);
    };
}

function ajukanPembatalan() {
    const modal = document.getElementById('modalPembatalan');
    modal.classList.add('active');
}

function closeModalPembatalan() {
    const modal = document.getElementById('modalPembatalan');
    modal.classList.remove('active');
}

// Close modal on overlay click
document.getElementById('modalPembatalan')?.addEventListener('click', function(e) {
    if (e.target === this) closeModalPembatalan();
});
</script>
@endpush
@endsection
