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
.cp-btn-reschedule{border:1px solid #e6a645;color:#b8860b}
.cp-btn-reschedule:hover{background:rgba(230,166,69,0.15)}
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
                            <p>Pemesanan hanya dapat dijadwalkan ulang (reschedule) dan tidak dapat dibatalkan.</p>
                            <p>Pembayaran yang telah dilakukan tidak dapat dikembalikan (non-refundable).</p>
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
                                 src="{{ asset('images/akomodasi/cabin1/a.webp') }}"
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
            <button class="cp-btn cp-btn-reschedule" id="btnAjukanReschedule" onclick="ajukanReschedule()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="2" stroke="currentColor" width="16" height="16">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Ajukan Re-schedule
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

{{-- Modal Reschedule (Datepicker) --}}
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
                <span id="reschedRulesText">
                • Tanggal yang dipilih harus tersedia (tidak ada booking lain, dan harus sesuai kawasan waktu check-in anda)<br>
                • Kawasan waktu check-in anda adalah <strong id="reschedRateType" style="text-transform:capitalize">...</strong>
                </span>
            </div>
        </div>

        <div style="margin-bottom:.75rem; position:relative;">
            <label style="font-size:.82rem;font-weight:700;color:#444;display:block;margin-bottom:.4rem">Tanggal Check-in Baru <span style="color:#e53e3e">*</span></label>
            <input type="text" id="reschedDatepicker" placeholder="Pilih tanggal…"
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

{{-- Modal Reschedule Success --}}
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
        <button class="modal-btn-wa" onclick="window.open('https://wa.me/6281234567890?text=Halo%20Admin%2C%20saya%20ingin%20mengonfirmasi%20pengajuan%20reschedule%20pesanan%20saya.%20No.%20Pemesanan%3A%20' + encodeURIComponent(document.getElementById('dynBookingNo').textContent), '_blank')">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            Hubungi Admin via WhatsApp
        </button>
        <button class="modal-btn-close" onclick="closeModalRescheduleSuccess()">Tutup</button>
    </div>
</div>

{{-- Modal Reschedule Error (H-3) --}}
<div class="modal-overlay" id="modalRescheduleError">
    <div class="modal-box">
        <div class="modal-icon" style="background:#e6a645; animation: scaleInBounce .6s cubic-bezier(.4,0,.2,1) both;">
            <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M22 12V24" stroke="#fff" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                <circle cx="22" cy="33" r="3.5" fill="#fff"/>
            </svg>
        </div>
        <h3 class="modal-title">Reschedule Tidak Tersedia</h3>
        <p class="modal-desc">
            Pengajuan reschedule hanya dapat dilakukan minimal <strong>H-3</strong> sebelum tanggal check-in awal pesanan Anda.
        </p>
        <button class="modal-btn-close" onclick="closeModalRescheduleError()" style="background:#e2e8f0;color:#475569;font-weight:bold;padding:.6rem 1.5rem;border-radius:.5rem;border:none;cursor:pointer;margin-top:1rem;transition:.2s;">Tutup</button>
    </div>
</div>

<style>
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
.flatpickr-day.booked-date {
    background-color: #f3f4f6 !important;
    color: #9ca3af !important;
    text-decoration: line-through !important;
    border-color: transparent !important;
}
</style>

@push('scripts')
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script src="{{ asset('js/akomodasi-data.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script>
(function () {
    @if(isset($booking))
        @php
            $isCorporate = !is_null($booking->corporate_package_id);
            $unit = $isCorporate ? $booking->corporatePackage : $booking->accommodation;
            $maxOrang = $unit ? $unit->max_orang : 0;
            $formattedTotal = number_format($booking->total, 0, ',', '.');
        @endphp
        // Populate sessionStorage with the database booking data
        sessionStorage.setItem('res_booking_no', '{{ $booking->no_pesanan }}');
        sessionStorage.setItem('res_nama', '{{ $booking->pemesan_nama }}');
        sessionStorage.setItem('res_hp', '{{ $booking->pemesan_telp }}');
        sessionStorage.setItem('res_email', '{{ $booking->pemesan_email }}');
        sessionStorage.setItem('res_tamu', '{{ $booking->nama_tamu }}');
        sessionStorage.setItem('res_guest', '{{ $maxOrang }} Dewasa');
        sessionStorage.setItem('res_total', '{{ $formattedTotal }}');
        sessionStorage.setItem('res_akoId', '{{ $isCorporate ? $booking->corporate_package_id : ($booking->accommodation_id ?? 0) }}');
        sessionStorage.setItem('res_corporate_package_id', '{{ $isCorporate ? $booking->corporate_package_id : 0 }}');
        sessionStorage.setItem('res_is_corporate', '{{ $isCorporate ? "1" : "0" }}');
        sessionStorage.setItem('res_payment_status', '{{ $booking->status }}');
        sessionStorage.setItem('res_payment_method', '{{ $booking->metode_pembayaran }}');
        sessionStorage.setItem('res_malam', '{{ $booking->malam }}');
        sessionStorage.setItem('res_booking_id', '{{ $booking->id }}');
        sessionStorage.setItem('res_checkin_raw', '{{ $booking->check_in_date }}');
        @if($isCorporate && $booking->corporatePackage)
        // Corporate package data
        sessionStorage.setItem('res_corp_judul', '{{ addslashes($booking->corporatePackage->judul) }}');
        sessionStorage.setItem('res_corp_fasilitas', JSON.stringify({!! json_encode($booking->corporatePackage->fasilitas ?? []) !!}));
        sessionStorage.setItem('res_corp_makanan', JSON.stringify({!! json_encode($booking->corporatePackage->makanan ?? []) !!}));
        sessionStorage.setItem('res_corp_gambar', '{{ addslashes(is_array($booking->corporatePackage->gambar) && count($booking->corporatePackage->gambar) > 0 ? $booking->corporatePackage->gambar[0] : "") }}');
        @endif
    @endif

    // ── Baca sessionStorage ───────────────────────────────────────────────
    const status   = sessionStorage.getItem('res_payment_status') || 'success';
    const dNama    = sessionStorage.getItem('res_nama')    || 'Ari Rahman';
    const dHp      = sessionStorage.getItem('res_hp')      || '081512345678';
    const dEmail   = sessionStorage.getItem('res_email')   || 'arirahman@gmail.com';
    const dTamu    = sessionStorage.getItem('res_tamu')    || 'M. Akbar R.';
    const dGuest   = sessionStorage.getItem('res_guest')   || '4 Dewasa + 1 Anak + 2 Dewasa';
    const dTotal   = sessionStorage.getItem('res_total')   || '1.475.000';
    const dBooking = sessionStorage.getItem('res_booking_no') || 'XXXXXXXXXX';
    const akoId    = parseInt(sessionStorage.getItem('res_akoId')) || 1;
    const dMalam   = parseInt(sessionStorage.getItem('res_malam')) || 1;
    
    // Parse URL query parameters to check if accessed from My Bookings history page
    const urlParams = new URLSearchParams(window.location.search);
    const fromPesanan = urlParams.get('from') === 'pesanan';

    // Kirim update status ke database MySQL secara real-time
    const selectedMethod = sessionStorage.getItem('res_va') 
                        || sessionStorage.getItem('res_payment_method') 
                        || sessionStorage.getItem('res_minimarket') 
                        || 'Virtual Account';

    if (dBooking && dBooking !== 'XXXXXXXXXX' && !fromPesanan) {
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

    // Statuses that mean payment was successful (booking is valid)
    const successLikeStatuses = ['success', 'reschedule_pending', 'rescheduled', 'reschedule_rejected'];
    const isSuccessLike = successLikeStatuses.includes(status);

    if (isSuccessLike) {
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
        
        bannerText.innerHTML = `Pembayaran berhasil! Invoice telah dikirim ke email (<strong><span id="dynEmailInBanner">${dEmail}</span></strong>) dan WhatsApp Anda.`;

        // Show/hide reschedule button based on sub-status
        const btnResched = document.getElementById('btnAjukanReschedule');
        if (btnResched) {
            if (status === 'reschedule_pending') {
                btnResched.disabled = true;
                btnResched.style.opacity = '0.5';
                btnResched.style.cursor = 'not-allowed';
                btnResched.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg> Menunggu Konfirmasi`;
                bannerText.innerHTML = `Pemesanan ini sedang dalam pengajuan reschedule. Silakan tunggu konfirmasi admin.`;
            } else if (status === 'rescheduled') {
                btnResched.style.display = 'none'; // Or disable it depending on logic, but hiding might be okay if they already got it rescheduled
                bannerText.innerHTML = `Jadwal baru Anda telah disetujui oleh admin.`;
            } else if (status === 'reschedule_rejected') {
                btnResched.style.display = 'flex';
                bannerText.innerHTML = `Pengajuan reschedule Anda ditolak. Anda dapat mengajukan ulang.`;
            } else {
                btnResched.style.display = 'flex';
            }
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
        
        // Hide reschedule button
        const btnResched = document.getElementById('btnAjukanReschedule');
        if (btnResched) btnResched.style.display = 'none';
    }

    // ── Accommodation / Corporate Package data ────────────────────────────
    const isCorporate = sessionStorage.getItem('res_is_corporate') === '1';

    if (isCorporate) {
        // Corporate package display
        const corpJudul    = sessionStorage.getItem('res_corp_judul') || 'Paket Corporate';
        const corpFasilitas = JSON.parse(sessionStorage.getItem('res_corp_fasilitas') || '[]');
        const corpMakanan  = JSON.parse(sessionStorage.getItem('res_corp_makanan') || '[]');
        const corpGambar   = sessionStorage.getItem('res_corp_gambar') || '';

        document.getElementById('dynRoomName').textContent = corpJudul;

        // Hide kasur/smoking for corporate
        const bedEl = document.getElementById('dynBed');
        const smokEl = document.getElementById('dynSmoking');
        if (bedEl) bedEl.closest('.cp-room-meta')?.setAttribute('style', 'display:none');
        if (smokEl) smokEl.parentElement?.setAttribute('style', 'display:none');

        // Fasilitas
        const half = Math.ceil(corpFasilitas.length / 2);
        document.getElementById('dynFasilitas1').innerHTML =
            corpFasilitas.slice(0, half).map(f => `<li>${f}</li>`).join('');
        document.getElementById('dynFasilitas2').innerHTML =
            corpFasilitas.slice(half).map(f => `<li>${f}</li>`).join('');

        document.getElementById('dynMakanan').innerHTML =
            corpMakanan.map(m => `<li>${m}</li>`).join('');

        // Photo
        if (corpGambar) {
            document.getElementById('dynRoomImg').src = corpGambar.startsWith('http') || corpGambar.startsWith('/') ? corpGambar : '/' + corpGambar;
        }
    } else {
        // Regular accommodation
        const akoItem = (typeof AKOMODASI_DATA !== 'undefined')
            ? AKOMODASI_DATA.find(d => d.id === akoId)
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

            // Room photo
            if (akoItem.gambar) {
                document.getElementById('dynRoomImg').src =
                    '/images/akomodasi/' + akoItem.gambar + '/a.webp';
            }
        }
    }

    // ── Check-in / Check-out ──────────────────────────────────────────────
    const dCheckin  = sessionStorage.getItem('res_checkin');
    const dCheckout = sessionStorage.getItem('res_checkout');
    const dNights   = sessionStorage.getItem('res_malam');
    if (dCheckin)  document.getElementById('dynCheckin').textContent  = dCheckin;
    if (dCheckout) document.getElementById('dynCheckout').textContent = dCheckout;
    if (dNights)   document.getElementById('dynNights').textContent   = dNights + ' malam';

    // Update durasi di modal reschedule
    const reschedDurasi = document.getElementById('reschedDurasi');
    if (reschedDurasi) reschedDurasi.textContent = dMalam + ' malam';
})();

// ── Actions ─────────────────────────────────────────────────────────────────────

function unduhPdf() {
    const btn = document.getElementById('btnUnduhPdf');
    const origHTML = btn.innerHTML;
    btn.innerHTML = '<svg class="animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="16" height="16"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" opacity=".3"/><path fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"/></svg> Menyiapkan…';
    btn.disabled = true;

    const bookNo = document.getElementById('dynBookingNo').textContent;
    if (!bookNo || bookNo === 'XXXXXXXXXX') {
        alert('Gagal mendapatkan nomor pesanan.');
        btn.innerHTML = origHTML;
        btn.disabled = false;
        return;
    }

    setTimeout(() => {
        window.open('/invoice/' + bookNo + '/download', '_blank');
        btn.innerHTML = origHTML;
        btn.disabled = false;
    }, 500);
}

// ── Reschedule Logic ────────────────────────────────────────────────────────────
let reschedFlatpickr = null;
let selectedNewCheckin = null;

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

function ajukanReschedule() {
    const bookingNo = document.getElementById('dynBookingNo').textContent;
    if (!bookingNo || bookingNo === 'XXXXXXXXXX') {
        alert('Gagal mendapatkan nomor pesanan.');
        return;
    }

    // Check H-3 validation BEFORE opening modal
    const checkinRaw = sessionStorage.getItem('res_checkin_raw');
    let isEligible = true;
    let originalCheckinDateObj = null;
    
    if (checkinRaw) {
        const checkinParts = checkinRaw.split('T')[0].split(' ')[0].split('-');
        if (checkinParts.length === 3) {
            const ciDate = new Date(parseInt(checkinParts[0]), parseInt(checkinParts[1]) - 1, parseInt(checkinParts[2]));
            originalCheckinDateObj = ciDate;
            const today = new Date();
            today.setHours(0,0,0,0);
            if (Math.ceil((ciDate - today) / (1000 * 60 * 60 * 24)) < 3) isEligible = false;
        }
    } else {
        const checkinText = document.getElementById('dynCheckin').textContent;
        const parts = checkinText.split(', ');
        if (parts.length === 2) {
            const dateStr = parts[1];
            const months = {'Januari':0,'Februari':1,'Maret':2,'April':3,'Mei':4,'Juni':5,'Juli':6,'Agustus':7,'September':8,'Oktober':9,'November':10,'Desember':11};
            const dParts = dateStr.split(' ');
            if (dParts.length === 3) {
                const ciDate = new Date(parseInt(dParts[2]), months[dParts[1]], parseInt(dParts[0]));
                originalCheckinDateObj = ciDate;
                const today = new Date();
                today.setHours(0,0,0,0);
                if (Math.ceil((ciDate - today) / (1000 * 60 * 60 * 24)) < 3) isEligible = false;
            }
        }
    }

    if (!isEligible) {
        document.getElementById('modalRescheduleError').classList.add('active');
        return;
    }

    const malam = parseInt(sessionStorage.getItem('res_malam')) || 1;
    const isCorp = sessionStorage.getItem('res_is_corporate') === '1';
    const akoId = parseInt(sessionStorage.getItem('res_akoId')) || 1;
    const bookingId = sessionStorage.getItem('res_booking_id') || '';

    // Reset state
    selectedNewCheckin = null;
    const submitBtn = document.getElementById('btnSubmitReschedule');
    submitBtn.disabled = true;
    submitBtn.style.cursor = 'not-allowed';
    submitBtn.style.opacity = '.5';
    document.getElementById('reschedPreview').style.display = 'none';
    document.getElementById('reschedDatepicker').value = '';

    // Destroy existing flatpickr
    if (reschedFlatpickr) {
        reschedFlatpickr.destroy();
        reschedFlatpickr = null;
    }

    // Show modal first
    const modal = document.getElementById('modalReschedule');
    modal.classList.add('active');

    const dateInput = document.getElementById('reschedDatepicker');
    const loadingIcon = document.getElementById('reschedLoading');
    dateInput.placeholder = 'Memuat kalender...';
    dateInput.disabled = true;
    if (loadingIcon) loadingIcon.style.display = 'block';

    // Fetch booked dates then init flatpickr
    fetch(`/reservasi/booked-dates/${akoId}?exclude_booking_id=${bookingId}&is_corporate=${isCorp ? 1 : 0}`)
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
            
            if (data.is_same_price) {
                document.getElementById('reschedRulesText').innerHTML = '• Tanggal yang dipilih harus tersedia (tidak ada booking lain).<br>• Karena harga tipe akomodasi/paket ini di setiap waktu sama, Anda bebas memilih tanggal mana saja (bebas lintas tipe hari).';
            } else {
                document.getElementById('reschedRulesText').innerHTML = '• Tanggal yang dipilih harus tersedia (tidak ada booking lain, dan harus sesuai kawasan waktu check-in anda)<br>• Kawasan waktu check-in anda adalah <strong id="reschedRateType" style="text-transform:capitalize">' + originalType + '</strong>';
            }

            reschedFlatpickr = flatpickr('#reschedDatepicker', {
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
                        if (!data.is_same_price && currentType !== originalType) return true;

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
                        if (!data.is_same_price && currentType !== originalType) {
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
            const dateInput = document.getElementById('reschedDatepicker');
            const loadingIcon = document.getElementById('reschedLoading');
            dateInput.placeholder = 'Gagal memuat kalender';
            dateInput.disabled = true;
            if (loadingIcon) loadingIcon.style.display = 'none';
            console.error('Failed to fetch booked dates:', err);
            alert('Gagal memuat ketersediaan tanggal.');
        });
}

function submitReschedule() {
    if (!selectedNewCheckin) return;

    const bookingNo = document.getElementById('dynBookingNo').textContent;
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
            no_pesanan: bookingNo,
            new_check_in: ciStr
        })
    })
    .then(res => res.json())
    .then(data => {
        closeModalReschedule();
        if (data.success) {
            sessionStorage.setItem('res_payment_status', 'reschedule_pending');
            const successModal = document.getElementById('modalRescheduleSuccess');
            successModal.classList.add('active');
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

    // Update UI inline instead of reloading (reload would show wrong status)
    const btnResched = document.getElementById('btnAjukanReschedule');
    if (btnResched) {
        btnResched.disabled = true;
        btnResched.style.opacity = '0.5';
        btnResched.style.cursor = 'not-allowed';
        btnResched.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg> Menunggu Konfirmasi`;
    }

    const bannerText = document.getElementById('dynEmailBannerText');
    if (bannerText) bannerText.innerHTML = `Pemesanan ini sedang dalam pengajuan reschedule. Silakan tunggu konfirmasi admin.`;
}

function closeModalRescheduleError() {
    document.getElementById('modalRescheduleError').classList.remove('active');
}

// Close modals on overlay click
document.getElementById('modalReschedule')?.addEventListener('click', function(e) {
    if (e.target === this) closeModalReschedule();
});
document.getElementById('modalRescheduleSuccess')?.addEventListener('click', function(e) {
    if (e.target === this) closeModalRescheduleSuccess();
});
document.getElementById('modalRescheduleError')?.addEventListener('click', function(e) {
    if (e.target === this) closeModalRescheduleError();
});
</script>
@endpush
@endsection

