@extends('layouts.booking')
@section('title', 'Status Pembayaran - Landeuh Village Riverside')
@section('content')

<style>
/* ── Reset & Base ───────────────────────────────────────── */
*,*::before,*::after{box-sizing:border-box}

/* ── Page Shell ─────────────────────────────────────────── */
.kf-page{
    background:#F8EDD8;
    min-height:100vh;
    font-family:'Segoe UI',system-ui,-apple-system,sans-serif;
    color:#1c1917;
}

/* ── Topbar: Same bg as landing page (#F8EDD8) ──────────── */
.kf-topbar{
    background:#F8EDD8;
    border-bottom:1px solid #ebdcc4;
    padding:.75rem 0;
    position:sticky;top:0;z-index:100;
}
.kf-topbar-inner{
    max-width:80rem; /* max-w-7xl */
    margin:0 auto;
    padding:0 1rem;
    display:flex;align-items:center;justify-content:space-between;
}
@media(min-width:640px){.kf-topbar-inner{padding:0 1.5rem}}
@media(min-width:1024px){.kf-topbar-inner{padding:0 2rem}}

.kf-topbar-logo img{height:40px;width:auto;object-fit:contain}
.kf-topbar-bookno{text-align:right}
.kf-topbar-bookno .label{font-size:.68rem;color:#7a7265;font-weight:600;text-transform:uppercase;letter-spacing:.5px}
.kf-topbar-bookno .value{font-size:.95rem;font-weight:800;color:#1c1917;letter-spacing:.3px}

/* ── Body Layout: Match Landing max-w-7xl ───────────────── */
.kf-body{
    max-width:80rem; /* max-w-7xl */
    margin:0 auto;
    padding:2rem 1rem 3.5rem;
    display:grid;
    grid-template-columns:1fr 320px;
    gap:2.5rem;
    align-items:start;
}
@media(min-width:640px){.kf-body{padding:2rem 1.5rem 3.5rem}}
@media(min-width:1024px){.kf-body{padding:2.5rem 2rem 4rem;grid-template-columns:1fr 340px;gap:3.5rem}}
@media(max-width:1023px){.kf-body{grid-template-columns:1fr;gap:2rem;padding:1.5rem 1rem 3rem}}

/* ── Left Column ────────────────────────────────────────── */
.kf-left{display:flex;flex-direction:column;gap:1.75rem}

/* ── Status Header ──────────────────────────────────────── */
.kf-status-block{}
.kf-icon{
    width:48px;height:48px;border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    margin-bottom:.9rem;
    flex-shrink:0;
}
.kf-icon-success{background:#2e5a2e}
.kf-icon-failed{background:#c0392b}
.kf-icon-pending{background:#d97706}

/* Bounce & Pulse Animations */
@keyframes kfBounce{
    0%{transform:scale(0);opacity:0}
    55%{transform:scale(1.15)}
    75%{transform:scale(.95)}
    100%{transform:scale(1);opacity:1}
}
@keyframes kfPulseGreen{
    0%,100%{box-shadow:0 0 0 0 rgba(46,90,46,.35)}
    50%{box-shadow:0 0 0 10px rgba(46,90,46,0)}
}
@keyframes kfPulseRed{
    0%,100%{box-shadow:0 0 0 0 rgba(192,57,43,.35)}
    50%{box-shadow:0 0 0 10px rgba(192,57,43,0)}
}
@keyframes kfDrawCheck{from{stroke-dashoffset:60}to{stroke-dashoffset:0}}
.kf-icon{animation:kfBounce .5s cubic-bezier(.4,0,.2,1) both}
.kf-icon-success.pulse{animation:kfBounce .5s cubic-bezier(.4,0,.2,1) both,kfPulseGreen 2.2s 0.6s ease-in-out infinite}
.kf-icon-failed.pulse{animation:kfBounce .5s cubic-bezier(.4,0,.2,1) both,kfPulseRed 2.2s 0.6s ease-in-out infinite}
.kf-check-path{stroke-dasharray:60;stroke-dashoffset:60;animation:kfDrawCheck .45s .25s cubic-bezier(.4,0,.2,1) forwards}

.kf-status-title{
    font-size:2rem;font-weight:800;color:#1c1917;
    line-height:1.2;margin:0 0 .4rem;
}
@media(max-width:640px){.kf-status-title{font-size:1.6rem}}

.kf-amount-label{font-size:.8rem;color:#7a7265;font-weight:500;margin-bottom:.2rem}
.kf-amount{
    font-size:2.25rem;font-weight:900;line-height:1.1;margin-bottom:.85rem;
    letter-spacing:-.5px;
}
.kf-amount-success{color:#1c1917}
.kf-amount-failed{color:#c0392b}
.kf-amount-pending{color:#d97706}
@media(max-width:640px){.kf-amount{font-size:1.8rem}}

.kf-invoice-note{
    font-size:.86rem;color:#57534e;line-height:1.55;
    margin-bottom:1.1rem;max-width:480px;
}

/* ── Download Invoice Button ────────────────────────────── */
.kf-btn-invoice{
    display:inline-flex;align-items:center;gap:.5rem;
    border:1.5px solid #2e5a2e;color:#2e5a2e;background:transparent;
    padding:.55rem 1.15rem;border-radius:.45rem;
    font-size:.84rem;font-weight:700;cursor:pointer;
    transition:all .2s;
}
.kf-btn-invoice:hover{background:#2e5a2e;color:#fff}

/* ── Failed Alert Card ──────────────────────────────────── */
.kf-failed-card{
    background:#fef2f2;
    border:1px solid #fecaca;
    border-radius:.65rem;
    padding:1rem 1.15rem;
    margin-top:.85rem;
    max-width:560px;
}
.kf-failed-title{font-size:.88rem;font-weight:700;color:#991b1b;margin-bottom:.3rem}
.kf-failed-desc{font-size:.82rem;color:#7f1d1d;line-height:1.55}

/* ── Room Card ───────────────────────────────────────────── */
.kf-room{}
.kf-room-img{
    width:100%;
    aspect-ratio:16/9;
    object-fit:cover;
    border-radius:.85rem;
    display:block;
    margin-bottom:1.25rem;
    border:1px solid #e0d4c1;
    box-shadow:0 4px 14px rgba(0,0,0,0.04);
}
.kf-room-name{font-size:1.6rem;font-weight:800;color:#1c1917;margin-bottom:.35rem}
@media(max-width:640px){.kf-room-name{font-size:1.35rem}}

.kf-room-meta{
    display:flex;align-items:center;gap:.6rem;flex-wrap:wrap;
    font-size:.84rem;color:#57534e;font-weight:500;
    margin-bottom:1.5rem;
}
.kf-room-meta .dot{width:3.5px;height:3.5px;border-radius:50%;background:#a8a29e;flex-shrink:0}

/* ── Dates Block: Matches Attachment 4 Exactly With Side Spacing ── */
.kf-dates{
    display:grid;
    grid-template-columns:1fr auto 1fr;
    align-items:center;
    gap:.75rem;
    padding:1.15rem .85rem;
    border-top:1px solid #dfd4be;
    border-bottom:1px solid #dfd4be;
    margin:0 .25rem 1.75rem;
}
.kf-date-label{font-size:.65rem;font-weight:800;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.25rem}
.kf-date-label.in{color:#2e7d32}
.kf-date-label.out{color:#c0392b}
.kf-date-val{font-size:1.15rem;font-weight:800;color:#1c1917;line-height:1.2}
.kf-date-sub{font-size:.78rem;color:#7a7265;margin-top:.25rem;font-weight:500}
.kf-date-mid{text-align:center;flex-shrink:0;padding:0 .5rem}
.kf-date-nights{font-size:.75rem;color:#7a7265;font-weight:600;white-space:nowrap;display:block;margin-bottom:.2rem}
.kf-date-arrow{display:block;margin:0 auto}
@media(max-width:520px){
    .kf-dates{
        gap:.4rem;
        padding:.95rem .5rem;
        margin:0 0 1.5rem;
    }
    .kf-date-val{font-size:.92rem}
    .kf-date-sub{font-size:.7rem}
    .kf-date-mid{padding:0 .15rem}
    .kf-date-arrow{width:28px}
}

/* ── Fasilitas ───────────────────────────────────────────── */
.kf-fac-section{}
.kf-fac-heading{font-size:.68rem;font-weight:700;text-transform:uppercase;letter-spacing:.8px;color:#736b5e;margin-bottom:.85rem}
.kf-fac-group-title{font-size:.85rem;font-weight:700;color:#292524;margin-bottom:.4rem;min-height:1.25rem}

/* Desktop: 3 Kolom Sejajar (Kamar Col 1, Kamar Col 2, Makanan Col 3) */
.kf-fac-grid{
    display:grid;
    grid-template-columns:1fr 1fr 1fr;
    gap:1.5rem;
    align-items:start;
}
.kf-fac-spacer{display:block}

/* Mobile: Kamar 2 kolom berdampingan, Makanan & minuman di bawahnya */
@media(max-width:768px){
    .kf-fac-grid{
        grid-template-columns:1fr 1fr;
        gap:1rem;
    }
    .kf-fac-col-makanan{
        grid-column:1 / -1;
        margin-top:.4rem;
    }
}

.kf-fac-list{list-style:none;padding:0;margin:0}
.kf-fac-list li{
    font-size:.82rem;color:#44403c;padding:.2rem 0;
    display:flex;align-items:flex-start;gap:.45rem;
    word-break:break-word;
    overflow-wrap:break-word;
    line-height:1.45;
}
.kf-fac-list li::before{
    content:'';width:5px;height:5px;border-radius:50%;
    background:#2e5a2e;flex-shrink:0;margin-top:.45rem;
}

/* ── Right Sidebar: Matches Attachment 3 Exactly ────────── */
.kf-sidebar{
    display:flex;
    flex-direction:column;
}

/* Garis Pemisah Mobile di Atas Data Pemesan */
.kf-mobile-divider{
    display:none;
}
@media(max-width:1023px){
    .kf-mobile-divider{
        display:block;
        height:1px;
        background:#dfd4be;
        margin:0 0 1.5rem;
    }
}

.kf-sidebar-section{margin-bottom:0}
.kf-sidebar-heading{
    font-size:.72rem;font-weight:700;text-transform:uppercase;
    letter-spacing:.8px;color:#736b5e;margin-bottom:.9rem;
}

/* Data Pemesan */
.kf-info-group{display:flex;flex-direction:column;gap:.8rem}
.kf-info-row{display:flex;flex-direction:column;gap:.12rem}
.kf-info-label{font-size:.8rem;color:#7a7265;font-weight:400}
.kf-info-val{font-size:.95rem;font-weight:700;color:#1c1917;word-break:break-word;line-height:1.35}

/* Subtle Divider in Sidebar */
.kf-sidebar-divider{
    height:1px;
    background:#dfd4be;
    margin:1.4rem 0;
}

/* Kebijakan: Yellow/Amber Vertical Bar on the Left */
.kf-policy-box{
    border-left:3px solid #D99A26;
    padding-left:14px;
    display:flex;
    flex-direction:column;
    gap:.75rem;
}
.kf-policy-box p{
    font-size:.82rem;
    color:#44403c;
    line-height:1.55;
    margin:0;
}

/* ── Action Buttons ──────────────────────────────────────── */
.kf-actions{
    display:flex;
    flex-direction:column;
    gap:.75rem;
    margin-top:1.5rem;
}
.kf-btn-home{
    display:flex;align-items:center;justify-content:center;gap:.5rem;
    width:100%;padding:.85rem 1.25rem;
    background:#2e4c2e;color:#fff;border:none;border-radius:.55rem;
    font-size:.92rem;font-weight:700;cursor:pointer;
    transition:background .2s;
}
.kf-btn-home:hover{background:#233a23}

.kf-btn-reschedule{
    display:flex;align-items:center;justify-content:center;gap:.5rem;
    width:100%;padding:.8rem 1.25rem;
    background:transparent;border:1.5px solid #d4a040;color:#9c6d1a;
    border-radius:.55rem;font-size:.88rem;font-weight:700;cursor:pointer;
    transition:all .2s;
}
.kf-btn-reschedule:hover{background:#faeed9}
.kf-btn-reschedule:disabled{opacity:.45;cursor:not-allowed}

/* ── Fade entrance ───────────────────────────────────────── */
@keyframes kfFadeUp{from{opacity:0;transform:translateY(14px)}to{opacity:1;transform:translateY(0)}}
.kf-left{animation:kfFadeUp .4s ease both}
.kf-sidebar{animation:kfFadeUp .4s .08s ease both}

/* ── Flatpickr & Modal ───────────────────────────────────── */
.flatpickr-calendar.inline{margin:0 auto!important;width:100%!important;padding:12px 10px!important;box-sizing:border-box!important}
.flatpickr-days,.dayContainer{width:100%!important;min-width:0!important;max-width:100%!important}
.flatpickr-day{max-width:none!important;flex-basis:14.28%!important;height:38px!important;line-height:38px!important}
.flatpickr-weekdaycontainer{display:flex;width:100%;padding:0 10px!important;box-sizing:border-box!important}
.flatpickr-weekday{flex:1}
.flatpickr-day.h3-blocked{background:#f3f4f6!important;color:#9ca3af!important;border-color:transparent!important;cursor:not-allowed!important}
.flatpickr-day.booked-date{background:#f3f4f6!important;color:#9ca3af!important;text-decoration:line-through!important;border-color:transparent!important}
.flatpickr-day.date-weekday{background:#d1fae5!important;color:#065f46!important;border-color:#d1fae5!important}
.flatpickr-day.date-weekday.selected{background:#10b981!important;color:#fff!important;border-color:#10b981!important}
.flatpickr-day.date-weekend{background:#fef3c7!important;color:#92400e!important;border-color:#fef3c7!important}
.flatpickr-day.date-weekend.selected{background:#f59e0b!important;color:#fff!important;border-color:#f59e0b!important}
.flatpickr-day.date-highseason{background:#fee2e2!important;color:#b91c1c!important;border-color:#fee2e2!important}
.flatpickr-day.date-highseason.selected{background:#ef4444!important;color:#fff!important;border-color:#ef4444!important}
.flatpickr-day.date-mismatch{opacity:.5!important;cursor:not-allowed!important}
.flatpickr-day.prevMonthDay,.flatpickr-day.nextMonthDay{opacity:.3!important}

.modal-overlay{position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,.45);backdrop-filter:blur(6px);display:flex;align-items:center;justify-content:center;opacity:0;pointer-events:none;transition:opacity .3s}
.modal-overlay.active{opacity:1;pointer-events:auto}
.modal-box{background:#fff;border-radius:1.15rem;padding:2rem 1.75rem 1.75rem;max-width:440px;width:92%;box-shadow:0 20px 50px rgba(0,0,0,.18);transform:scale(.88) translateY(16px);transition:transform .35s cubic-bezier(.4,0,.2,1);max-height:90vh;overflow-y:auto}
.modal-overlay.active .modal-box{transform:scale(1) translateY(0)}
.modal-icon{width:60px;height:60px;border-radius:50%;margin:0 auto 1rem;display:flex;align-items:center;justify-content:center}
.modal-icon-success{background:#2e5a2e;animation:kfBounce .5s cubic-bezier(.4,0,.2,1) both}
.modal-title{font-size:1.15rem;font-weight:800;color:#1c1917;margin-bottom:.4rem;text-align:center}
.modal-desc{font-size:.84rem;color:#78716c;line-height:1.6;margin-bottom:1.4rem;text-align:center}
.modal-btn-wa{display:inline-flex;align-items:center;gap:.5rem;background:#25d366;color:#fff;border:none;padding:.7rem 1.4rem;border-radius:.55rem;font-size:.9rem;font-weight:700;cursor:pointer;transition:background .2s;margin-bottom:.5rem;width:100%;justify-content:center}
.modal-btn-wa:hover{background:#1ebe57}
.modal-btn-close{display:block;width:100%;margin:0;background:transparent;border:none;color:#a8a29e;font-size:.82rem;font-weight:600;cursor:pointer;padding:.35rem;text-align:center;transition:color .2s}
.modal-btn-close:hover{color:#57534e}
@media(max-width:480px){.modal-box{padding:1.5rem 1.1rem 1.25rem;width:96%}}
</style>

<div class="kf-page">

    {{-- ── Topbar (Background matches page: #F8EDD8) ── --}}
    <div class="kf-topbar">
        <div class="kf-topbar-inner">
            <a href="{{ url('/') }}" class="kf-topbar-logo">
                <img src="{{ asset('images/logo-landeuh.png') }}" alt="Landeuh Village Riverside">
            </a>
            <div class="kf-topbar-bookno">
                <div class="label">No. Pemesanan</div>
                <div class="value" id="dynBookingNo">XXXXXXXXXX</div>
            </div>
        </div>
    </div>

    {{-- ── Body (max-w-7xl matching landing page) ── --}}
    <div class="kf-body">

        {{-- ══ LEFT COLUMN ══ --}}
        <div class="kf-left">

            {{-- Status block --}}
            <div class="kf-status-block">
                <div id="dynStatusIcon" class="kf-icon kf-icon-success">
                    {{-- SVG injected by JS --}}
                </div>
                <h1 class="kf-status-title" id="dynStatusTitle">Pembayaran berhasil</h1>
                <div class="kf-amount-label" id="dynAmountLabel">Total dibayar</div>
                <div class="kf-amount kf-amount-success" id="dynAmount">IDR —</div>
                <p class="kf-invoice-note" id="dynInvoiceNote">
                    Invoice telah dikirim ke <strong id="dynEmailInNote">—</strong> dan WhatsApp Anda.
                </p>
                <button class="kf-btn-invoice" id="btnUnduhPdf" style="display:none" onclick="unduhPdf()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="15" height="15">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                    </svg>
                    Unduh invoice (PDF)
                </button>

                {{-- Failed Alert Card --}}
                <div class="kf-failed-card" id="dynFailedCard" style="display:none">
                    <div class="kf-failed-title">Pembayaran tidak berhasil diproses</div>
                    <div class="kf-failed-desc">Pemesanan Anda belum dikonfirmasi. Silakan periksa kembali metode pembayaran Anda atau hubungi admin jika dana telah terpotong.</div>
                </div>
            </div>

            {{-- Room detail --}}
            <div class="kf-room">
                <img id="dynRoomImg"
                     src="{{ asset('images/akomodasi/cabin1/a.webp') }}"
                     alt="Foto Akomodasi"
                     class="kf-room-img">

                <div class="kf-room-name" id="dynRoomName">—</div>
                <div class="kf-room-meta" id="dynRoomMeta">
                    <span id="dynBed"></span>
                    <span class="dot" id="dynMetaDot" style="display:none"></span>
                    <span id="dynGuestCount"></span>
                </div>

                {{-- Dates: Matches Attachment 4 Exactly With Left/Right Space ─────────── --}}
                <div class="kf-dates">
                    <div>
                        <div class="kf-date-label in">CHECK-IN</div>
                        <div class="kf-date-val" id="dynCheckinDate">—</div>
                        <div class="kf-date-sub" id="dynCheckinSub">—</div>
                    </div>
                    <div class="kf-date-mid">
                        <div class="kf-date-nights" id="dynNights">1 malam</div>
                        <svg class="kf-date-arrow" width="34" height="12" viewBox="0 0 34 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 6H32M32 6L26.5 1.5M32 6L26.5 10.5" stroke="#4a6b4a" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div style="text-align:right">
                        <div class="kf-date-label out">CHECK-OUT</div>
                        <div class="kf-date-val" id="dynCheckoutDate">—</div>
                        <div class="kf-date-sub" id="dynCheckoutSub">—</div>
                    </div>
                </div>

                {{-- Hidden anchors for fallback compatibility --}}
                <span id="dynCheckin" style="display:none"></span>
                <span id="dynCheckout" style="display:none"></span>

                {{-- Fasilitas: 3 Kolom di Desktop, 2 Kolom Kamar + Makanan di Bawah pada Mobile --}}
                <div class="kf-fac-section" id="dynFasilitasBlock">
                    <div class="kf-fac-heading">FASILITAS</div>
                    <div class="kf-fac-grid">
                        <!-- Col 1: Kamar Bagian 1 -->
                        <div class="kf-fac-col">
                            <div class="kf-fac-group-title">Kamar</div>
                            <ul class="kf-fac-list" id="dynFasilitas1"></ul>
                        </div>

                        <!-- Col 2: Kamar Bagian 2 (Kanan Kamar) -->
                        <div class="kf-fac-col kf-fac-col-kamar2">
                            <div class="kf-fac-group-title kf-fac-spacer" aria-hidden="true">&nbsp;</div>
                            <ul class="kf-fac-list" id="dynFasilitas2"></ul>
                        </div>

                        <!-- Col 3: Makanan & Minuman (Sejajar di Desktop) -->
                        <div class="kf-fac-col kf-fac-col-makanan" id="dynMakananGroup">
                            <div class="kf-fac-group-title">Makanan &amp; minuman</div>
                            <ul class="kf-fac-list" id="dynMakanan"></ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>{{-- /kf-left --}}

        {{-- ══ RIGHT SIDEBAR: Matches Attachment 3 Exactly ══ --}}
        <div class="kf-sidebar">

            {{-- Garis Pemisah Mobile di Atas Data Pemesan --}}
            <div class="kf-mobile-divider"></div>

            {{-- Data Pemesan --}}
            <div class="kf-sidebar-section">
                <div class="kf-sidebar-heading">DATA PEMESAN</div>
                <div class="kf-info-group">
                    <div class="kf-info-row">
                        <div class="kf-info-label">Pemesan</div>
                        <div class="kf-info-val" id="dynNama">—</div>
                    </div>
                    <div class="kf-info-row">
                        <div class="kf-info-label">Nama tamu</div>
                        <div class="kf-info-val" id="dynTamu">—</div>
                    </div>
                    <div class="kf-info-row">
                        <div class="kf-info-label">WhatsApp</div>
                        <div class="kf-info-val" id="dynHp">—</div>
                    </div>
                    <div class="kf-info-row">
                        <div class="kf-info-label">Email</div>
                        <div class="kf-info-val" id="dynEmail">—</div>
                    </div>
                </div>
            </div>

            {{-- Divider Line between Pemesan and Kebijakan --}}
            <div class="kf-sidebar-divider"></div>

            {{-- Kebijakan --}}
            <div class="kf-sidebar-section">
                <div class="kf-sidebar-heading">KEBIJAKAN</div>
                <div class="kf-policy-box">
                    <p>Pemesanan hanya dapat dijadwalkan ulang (reschedule) dan tidak dapat dibatalkan.</p>
                    <p>Pembayaran yang telah dilakukan tidak dapat dikembalikan (non-refundable).</p>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="kf-actions">
                <button class="kf-btn-home" onclick="window.location.href='/'">
                    Kembali ke Beranda
                </button>
                <button class="kf-btn-reschedule" id="btnAjukanReschedule" onclick="ajukanReschedule()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="15" height="15">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Ajukan Re-schedule
                </button>
            </div>

        </div>{{-- /kf-sidebar --}}

    </div>{{-- /kf-body --}}

</div>{{-- /kf-page --}}

{{-- ── Modal Reschedule (Datepicker) ── --}}
<div class="modal-overlay" id="modalReschedule">
    <div class="modal-box" style="max-width:480px;text-align:left">
        <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:1.2rem">
            <div style="width:44px;height:44px;border-radius:50%;background:#fff7ed;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#e6a645" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <div>
                <h4 class="modal-title" style="text-align:left;margin-bottom:0">Ajukan Re-schedule</h4>
                <p style="font-size:.72rem;color:#78716c;margin-top:.1rem">Pilih tanggal check-in baru</p>
            </div>
        </div>

        <div style="background:#fff7ed;border:1px solid #fde68a;border-radius:.55rem;padding:.7rem .9rem;margin-bottom:1rem;font-size:.77rem;color:#92400e;display:flex;align-items:flex-start;gap:.45rem">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="flex-shrink:0;margin-top:1px">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div>
                <strong>Ketentuan:</strong><br>
                • Minimal pengajuan H-3 sebelum tanggal check-in awal<br>
                • Durasi menginap tetap <strong id="reschedDurasi">1 malam</strong> (tidak bisa diubah)<br>
                <span id="reschedRulesText">
                • Tanggal yang dipilih harus tersedia (tidak ada booking lain)
                </span>
            </div>
        </div>

        <div style="margin-bottom:.75rem;position:relative">
            <label style="font-size:.8rem;font-weight:700;color:#444;display:block;margin-bottom:.4rem">Tanggal Check-in Baru <span style="color:#e53e3e">*</span></label>
            <input type="text" id="reschedDatepicker" placeholder="Pilih tanggal…"
                   style="width:100%;padding:.65rem .85rem;border:1.5px solid #ddd;border-radius:.5rem;font-size:.88rem;background:#fff;cursor:pointer" readonly>
            <div id="reschedLoading" style="display:none;position:absolute;bottom:.65rem;right:.9rem">
                <svg class="animate-spin h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
        </div>

        <div id="reschedPreview" style="display:none;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:.5rem;padding:.7rem .9rem;margin-bottom:1rem">
            <div style="font-size:.75rem;font-weight:700;color:#166534;margin-bottom:.25rem">Preview Jadwal Baru:</div>
            <div style="font-size:.82rem;color:#333">
                Check-in: <strong id="reschedNewCI">-</strong><br>
                Check-out: <strong id="reschedNewCO">-</strong> (<span id="reschedNewMalam">1</span> malam)
            </div>
        </div>

        <div style="display:flex;gap:.85rem;margin-bottom:.9rem;font-size:.72rem;justify-content:center">
            <div style="display:flex;align-items:center;gap:.3rem"><span style="width:10px;height:10px;border-radius:2px;background:#10b981;display:inline-block"></span> Weekday</div>
            <div style="display:flex;align-items:center;gap:.3rem"><span style="width:10px;height:10px;border-radius:2px;background:#f59e0b;display:inline-block"></span> Weekend</div>
            <div style="display:flex;align-items:center;gap:.3rem"><span style="width:10px;height:10px;border-radius:2px;background:#ef4444;display:inline-block"></span> Highseason</div>
        </div>

        <div style="display:flex;gap:.65rem;justify-content:flex-end;margin-top:1.1rem">
            <button style="background:#e8e8e8;color:#555;font-weight:700;padding:.58rem 1.3rem;border-radius:.45rem;border:none;cursor:pointer;font-size:.85rem;transition:.15s"
                    onmouseover="this.style.background='#d8d8d8'" onmouseout="this.style.background='#e8e8e8'"
                    onclick="closeModalReschedule()">Batal</button>
            <button id="btnSubmitReschedule" disabled
                    style="background:#d4a850;color:#fff;font-weight:700;padding:.58rem 1.3rem;border-radius:.45rem;border:none;cursor:not-allowed;opacity:.45;font-size:.85rem;transition:.15s"
                    onclick="submitReschedule()">Kirim Pengajuan</button>
        </div>
    </div>
</div>

{{-- Modal Reschedule Success --}}
<div class="modal-overlay" id="modalRescheduleSuccess">
    <div class="modal-box">
        <div class="modal-icon modal-icon-success">
            <svg width="30" height="30" viewBox="0 0 48 48" fill="none">
                <path class="kf-check-path" d="M12 25l9 9 15-18" stroke="#fff" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <h3 class="modal-title">Pengajuan Reschedule Terkirim</h3>
        <p class="modal-desc">Permintaan reschedule Anda telah dikirim ke admin Landeuh Village Riverside. Silakan hubungi admin untuk konfirmasi lebih lanjut.</p>
        <button class="modal-btn-wa" onclick="window.open('https://wa.me/6281234567890?text=Halo%20Admin%2C%20saya%20ingin%20mengonfirmasi%20pengajuan%20reschedule.%20No.%20Pesanan%3A%20' + encodeURIComponent(document.getElementById('dynBookingNo').textContent), '_blank')">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            Hubungi Admin via WhatsApp
        </button>
        <button class="modal-btn-close" onclick="closeModalRescheduleSuccess()">Tutup</button>
    </div>
</div>

{{-- Modal Reschedule Error (H-3) --}}
<div class="modal-overlay" id="modalRescheduleError">
    <div class="modal-box">
        <div class="modal-icon" style="background:#e6a645;animation:kfBounce .5s cubic-bezier(.4,0,.2,1) both">
            <svg width="34" height="34" viewBox="0 0 44 44" fill="none">
                <path d="M22 12V24" stroke="#fff" stroke-width="5" stroke-linecap="round"/>
                <circle cx="22" cy="33" r="3.5" fill="#fff"/>
            </svg>
        </div>
        <h3 class="modal-title">Reschedule Tidak Tersedia</h3>
        <p class="modal-desc">Pengajuan reschedule hanya dapat dilakukan minimal <strong>H-3</strong> sebelum tanggal check-in awal pesanan Anda.</p>
        <button class="modal-btn-close" onclick="closeModalRescheduleError()" style="background:#e8e8e8;color:#555;font-weight:700;padding:.58rem 1.3rem;border-radius:.45rem;border:none;cursor:pointer;font-size:.85rem;display:inline-block;width:auto">Tutup</button>
    </div>
</div>

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
            
            $days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            $mNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

            $ci = \Carbon\Carbon::parse($booking->check_in_date);
            $ciDay = $days[$ci->dayOfWeek] ?? 'Senin';
            $ciMonth = $mNames[$ci->month - 1] ?? 'Januari';
            $ciStr = "{$ciDay}, {$ci->day} {$ciMonth} {$ci->year}";

            $co = \Carbon\Carbon::parse($booking->check_out_date);
            $coDay = $days[$co->dayOfWeek] ?? 'Senin';
            $coMonth = $mNames[$co->month - 1] ?? 'Januari';
            $coStr = "{$coDay}, {$co->day} {$coMonth} {$co->year}";
        @endphp
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
        sessionStorage.setItem('res_checkin', '{{ $ciStr }}');
        sessionStorage.setItem('res_checkout', '{{ $coStr }}');
        @if($isCorporate && $booking->corporatePackage)
        sessionStorage.setItem('res_corp_judul', '{{ addslashes($booking->corporatePackage->judul) }}');
        sessionStorage.setItem('res_corp_fasilitas', JSON.stringify({!! json_encode($booking->corporatePackage->fasilitas ?? []) !!}));
        sessionStorage.setItem('res_corp_makanan', JSON.stringify({!! json_encode($booking->corporatePackage->makanan ?? []) !!}));
        sessionStorage.setItem('res_corp_gambar', '{{ addslashes(is_array($booking->corporatePackage->gambar) && count($booking->corporatePackage->gambar) > 0 ? $booking->corporatePackage->gambar[0] : "") }}');
        @endif
    @endif

    // ── Resolve status ─────────────────────────────────────────────────────
    const urlParams = new URLSearchParams(window.location.search);
    const urlStatus      = urlParams.get('status');
    const fromPesanan    = urlParams.get('from') === 'pesanan';
    const fromMidtrans   = urlParams.get('from') === 'midtrans';
    const midtransStatus = urlParams.get('transaction_status');

    let status = 'success';
    if (urlStatus) {
        status = urlStatus;
    } else if (midtransStatus) {
        status = (midtransStatus === 'settlement' || midtransStatus === 'capture') ? 'success'
               : (midtransStatus === 'pending' ? 'pending' : 'failed');
    } else {
        status = sessionStorage.getItem('res_payment_status') || 'success';
    }
    sessionStorage.setItem('res_payment_status', status);

    // ── Read session ────────────────────────────────────────────────────────
    const dNama    = sessionStorage.getItem('res_nama')       || '—';
    const dHp      = sessionStorage.getItem('res_hp')         || '—';
    const dEmail   = sessionStorage.getItem('res_email')      || '—';
    const dTamu    = sessionStorage.getItem('res_tamu')       || '—';
    const dTotal   = sessionStorage.getItem('res_total')      || '0';
    const dBooking = sessionStorage.getItem('res_booking_no') || 'XXXXXXXXXX';
    const akoId    = parseInt(sessionStorage.getItem('res_akoId')) || 1;
    const dMalam   = parseInt(sessionStorage.getItem('res_malam')) || 1;

    const selectedMethod = sessionStorage.getItem('res_va')
                        || sessionStorage.getItem('res_payment_method')
                        || sessionStorage.getItem('res_minimarket')
                        || 'Virtual Account';

    // ── Update DB status ────────────────────────────────────────────────────
    const doUpdateStatus = (dBooking && dBooking !== 'XXXXXXXXXX');
    if (doUpdateStatus && !fromPesanan && !fromMidtrans && !urlStatus) {
        fetch('/reservasi/update-status', {
            method:'POST',
            headers:{'Content-Type':'application/json','X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').getAttribute('content')},
            body: JSON.stringify({no_pesanan:dBooking, status: status === 'success' ? 'success' : (status === 'pending' ? 'pending' : 'failed'), metode_pembayaran:selectedMethod})
        }).then(r=>r.json()).then(d=>console.log('Status updated:',d)).catch(e=>console.error(e));
    }
    if (fromMidtrans && doUpdateStatus) {
        fetch('/reservasi/update-status', {
            method:'POST',
            headers:{'Content-Type':'application/json','X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').getAttribute('content')},
            body: JSON.stringify({no_pesanan:dBooking, status: status === 'success' ? 'success' : (status === 'pending' ? 'pending' : 'failed'), metode_pembayaran:selectedMethod})
        }).then(r=>r.json()).then(d=>console.log('Midtrans status updated:',d)).catch(e=>console.error(e));
    }

    // ── Topbar booking number ───────────────────────────────────────────────
    document.getElementById('dynBookingNo').textContent = dBooking;

    // ── Data Pemesan (Sidebar) ──────────────────────────────────────────────
    document.getElementById('dynNama').textContent  = dNama;
    document.getElementById('dynHp').textContent    = dHp;
    document.getElementById('dynEmail').textContent = dEmail;
    document.getElementById('dynTamu').textContent  = dTamu;
    document.getElementById('dynEmailInNote').textContent = dEmail;

    // ── Amount ──────────────────────────────────────────────────────────────
    const amt = dTotal.replace(/IDR\s?/i,'').trim();
    document.getElementById('dynAmount').textContent = 'IDR ' + amt;

    // ── Status-dependent UI ─────────────────────────────────────────────────
    const iconWrap   = document.getElementById('dynStatusIcon');
    const titleEl    = document.getElementById('dynStatusTitle');
    const amountEl   = document.getElementById('dynAmount');
    const amtLabelEl = document.getElementById('dynAmountLabel');
    const noteEl     = document.getElementById('dynInvoiceNote');
    const failedCard = document.getElementById('dynFailedCard');
    const btnResched = document.getElementById('btnAjukanReschedule');
    const btnInvoice = document.getElementById('btnUnduhPdf');

    const successLike = ['success','reschedule_pending','rescheduled','reschedule_rejected'];
    const isOk = successLike.includes(status);

    if (isOk) {
        // Success: Green Checkmark
        iconWrap.className = 'kf-icon kf-icon-success';
        iconWrap.innerHTML = `<svg width="24" height="24" viewBox="0 0 48 48" fill="none"><path class="kf-check-path" d="M12 25l9 9 15-18" stroke="#fff" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round"/></svg>`;
        setTimeout(() => iconWrap.classList.add('pulse'), 600);

        titleEl.textContent = 'Pembayaran berhasil';
        amtLabelEl.textContent = 'Total dibayar';
        amountEl.className  = 'kf-amount kf-amount-success';
        noteEl.innerHTML    = `Invoice telah dikirim ke <strong>${dEmail}</strong> dan WhatsApp Anda.`;
        noteEl.style.display = 'block';
        failedCard.style.display = 'none';
        btnInvoice.style.display = 'inline-flex';

        // Reschedule button states
        if (btnResched) {
            btnResched.style.display = 'flex';
            if (status === 'reschedule_pending') {
                btnResched.disabled = true;
                btnResched.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="15" height="15"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Menunggu Konfirmasi`;
                noteEl.innerHTML = `Pemesanan ini sedang dalam pengajuan reschedule. Silakan tunggu konfirmasi admin.`;
            } else if (status === 'rescheduled') {
                btnResched.style.display = 'none';
                noteEl.innerHTML = `Jadwal baru Anda telah disetujui oleh admin.`;
            } else if (status === 'reschedule_rejected') {
                noteEl.innerHTML = `Pengajuan reschedule Anda ditolak. Anda dapat mengajukan ulang.`;
            }
        }

    } else if (status === 'pending') {
        // Pending: Amber Clock
        iconWrap.className = 'kf-icon kf-icon-pending';
        iconWrap.innerHTML = `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round"><path d="M12 6v6h4.5"/><circle cx="12" cy="12" r="9.5"/></svg>`;
        setTimeout(() => iconWrap.classList.add('pulse'), 600);

        titleEl.textContent = 'Menunggu Pembayaran';
        amtLabelEl.textContent = 'Total tagihan';
        amountEl.className  = 'kf-amount kf-amount-pending';
        noteEl.innerHTML    = `Selesaikan pembayaran sebelum batas waktu. Konfirmasi otomatis akan dikirim ke <strong>${dEmail}</strong>.`;
        noteEl.style.display = 'block';
        failedCard.style.display = 'none';
        btnInvoice.style.display = 'none';
        if (btnResched) btnResched.style.display = 'none';

    } else {
        // Failed: Red Cross
        iconWrap.className = 'kf-icon kf-icon-failed';
        iconWrap.innerHTML = `<svg width="24" height="24" viewBox="0 0 44 44" fill="none"><path d="M13 13l18 18M31 13L13 31" stroke="#fff" stroke-width="4.5" stroke-linecap="round"/></svg>`;
        setTimeout(() => iconWrap.classList.add('pulse'), 700);

        titleEl.textContent = 'Pembayaran gagal';
        amtLabelEl.textContent = 'Total tagihan';
        amountEl.className  = 'kf-amount kf-amount-failed';
        noteEl.style.display = 'none';
        failedCard.style.display = 'block';
        btnInvoice.style.display = 'none';
        if (btnResched) btnResched.style.display = 'none';
    }

    // ── Room / Package Data ─────────────────────────────────────────────────
    const isCorporate = sessionStorage.getItem('res_is_corporate') === '1';

    if (isCorporate) {
        const corpJudul    = sessionStorage.getItem('res_corp_judul') || 'Paket Corporate';
        const corpFasilitas = JSON.parse(sessionStorage.getItem('res_corp_fasilitas') || '[]');
        const corpMakanan  = JSON.parse(sessionStorage.getItem('res_corp_makanan') || '[]');
        const corpGambar   = sessionStorage.getItem('res_corp_gambar') || '';

        document.getElementById('dynRoomName').textContent = corpJudul;
        document.getElementById('dynRoomMeta').style.display = 'none';

        const half = Math.ceil(corpFasilitas.length / 2);
        document.getElementById('dynFasilitas1').innerHTML = corpFasilitas.slice(0,half).map(f=>`<li>${f}</li>`).join('');
        document.getElementById('dynFasilitas2').innerHTML = corpFasilitas.slice(half).map(f=>`<li>${f}</li>`).join('');
        document.getElementById('dynMakanan').innerHTML    = corpMakanan.map(m=>`<li>${m}</li>`).join('');

        if (corpGambar) {
            document.getElementById('dynRoomImg').src = corpGambar.startsWith('http') || corpGambar.startsWith('/') ? corpGambar : '/' + corpGambar;
        }
    } else {
        const akoItem = (typeof AKOMODASI_DATA !== 'undefined')
            ? AKOMODASI_DATA.find(d => d.id === akoId)
            : null;

        if (akoItem) {
            document.getElementById('dynRoomName').textContent = akoItem.judul;
            document.getElementById('dynBed').innerHTML = `<iconify-icon icon="lucide:bed-double"></iconify-icon> ${akoItem.kasur}`;

            const dGuestVal = sessionStorage.getItem('res_guest');
            const guestText = akoItem.max_orang ? `${akoItem.max_orang} Dewasa` : (dGuestVal || '');
            if (guestText) {
                document.getElementById('dynMetaDot').style.display = 'inline-block';
                document.getElementById('dynGuestCount').innerHTML = `<iconify-icon icon="lucide:users"></iconify-icon> ${guestText}`;
            } else {
                document.getElementById('dynMetaDot').style.display = 'none';
            }

            const half = Math.ceil(akoItem.fasilitas.length / 2);
            document.getElementById('dynFasilitas1').innerHTML = akoItem.fasilitas.slice(0,half).map(f=>`<li>${f}</li>`).join('');
            document.getElementById('dynFasilitas2').innerHTML = akoItem.fasilitas.slice(half).map(f=>`<li>${f}</li>`).join('');
            document.getElementById('dynMakanan').innerHTML    = akoItem.makanan.map(m=>`<li>${m}</li>`).join('');

            if (akoItem.gambar) {
                document.getElementById('dynRoomImg').src = '/images/akomodasi/' + akoItem.gambar + '/a.webp';
            }
        }
    }

    // ── Dates: Parse to exact Attachment 4 Format ───────────────────────────
    function parseDateToAttachmentFormat(dateStr, isCheckin) {
        if (!dateStr) return { date: '—', sub: isCheckin ? 'Jumat, 14.00 – 21.00' : 'Sabtu, hingga 12.00' };

        // If string contains comma, e.g. "Jumat, 27 November 2026"
        if (dateStr.includes(',')) {
            const parts = dateStr.split(', ');
            const dayName = parts[0].trim();
            const dateMain = parts.slice(1).join(', ').trim();
            return {
                date: dateMain,
                sub: isCheckin ? `${dayName}, 14.00 – 21.00` : `${dayName}, hingga 12.00`
            };
        }

        // If string is ISO / Y-m-d format "2026-11-27"
        const p = dateStr.split('T')[0].split(' ')[0].split('-');
        if (p.length === 3) {
            const dObj = new Date(+p[0], +p[1] - 1, +p[2]);
            if (!isNaN(dObj.getTime())) {
                const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                const dayName = days[dObj.getDay()];
                const dateMain = `${dObj.getDate()} ${months[dObj.getMonth()]} ${dObj.getFullYear()}`;
                return {
                    date: dateMain,
                    sub: isCheckin ? `${dayName}, 14.00 – 21.00` : `${dayName}, hingga 12.00`
                };
            }
        }

        return { date: dateStr, sub: isCheckin ? '14.00 – 21.00' : 'hingga 12.00' };
    }

    const dCheckinRaw  = sessionStorage.getItem('res_checkin');
    const dCheckoutRaw = sessionStorage.getItem('res_checkout');
    const dNightsVal   = sessionStorage.getItem('res_malam');

    const ciFormatted = parseDateToAttachmentFormat(dCheckinRaw, true);
    const coFormatted = parseDateToAttachmentFormat(dCheckoutRaw, false);

    document.getElementById('dynCheckinDate').textContent  = ciFormatted.date;
    document.getElementById('dynCheckinSub').textContent   = ciFormatted.sub;
    document.getElementById('dynCheckoutDate').textContent = coFormatted.date;
    document.getElementById('dynCheckoutSub').textContent  = coFormatted.sub;

    if (dNightsVal) document.getElementById('dynNights').textContent = dNightsVal + ' malam';

    // Reschedule modal duration
    const reschedDurasi = document.getElementById('reschedDurasi');
    if (reschedDurasi) reschedDurasi.textContent = dMalam + ' malam';

})();

// ── unduhPdf ─────────────────────────────────────────────────────────────────
function unduhPdf() {
    const btn = document.getElementById('btnUnduhPdf');
    const orig = btn.innerHTML;
    btn.innerHTML = '<svg class="animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="14" height="14"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" opacity=".3"/><path fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"/></svg> Menyiapkan…';
    btn.disabled = true;
    const no = document.getElementById('dynBookingNo').textContent;
    if (!no || no === 'XXXXXXXXXX') { alert('Gagal mendapatkan nomor pesanan.'); btn.innerHTML = orig; btn.disabled = false; return; }
    setTimeout(() => { window.open('/invoice/' + no + '/download', '_blank'); btn.innerHTML = orig; btn.disabled = false; }, 500);
}

// ── Reschedule Logic ──────────────────────────────────────────────────────────
let reschedFlatpickr = null, selectedNewCheckin = null;

function getDateTypeFrontend(dateObj, settings) {
    const y = dateObj.getFullYear(), m = String(dateObj.getMonth()+1).padStart(2,'0'), d = String(dateObj.getDate()).padStart(2,'0');
    const str = `${y}-${m}-${d}`;
    const daysIndo = ['Minggu','Senin','Selasa','Rabu','Kamis',"Jum'at",'Sabtu'];
    const dayName = daysIndo[dateObj.getDay()];
    for (let hs of settings.filter(s=>s.type==='highseason')) { if (hs.dates?.includes(str)) return 'highseason'; }
    const we = settings.find(s=>s.type==='weekend');
    if (we?.dates && (we.dates.includes(str) || we.dates.includes(dayName))) return 'weekend';
    return 'weekday';
}

function ajukanReschedule() {
    const bookingNo = document.getElementById('dynBookingNo').textContent;
    if (!bookingNo || bookingNo === 'XXXXXXXXXX') { alert('Gagal mendapatkan nomor pesanan.'); return; }

    const checkinRaw = sessionStorage.getItem('res_checkin_raw');
    let isEligible = true, originalCheckinDateObj = null;
    if (checkinRaw) {
        const p = checkinRaw.split('T')[0].split(' ')[0].split('-');
        if (p.length === 3) {
            const ciDate = new Date(+p[0], +p[1]-1, +p[2]);
            originalCheckinDateObj = ciDate;
            const today = new Date(); today.setHours(0,0,0,0);
            if (Math.ceil((ciDate - today)/(864e5)) < 3) isEligible = false;
        }
    }
    if (!isEligible) { document.getElementById('modalRescheduleError').classList.add('active'); return; }

    const malam = parseInt(sessionStorage.getItem('res_malam')) || 1;
    const isCorp = sessionStorage.getItem('res_is_corporate') === '1';
    const akoId = parseInt(sessionStorage.getItem('res_akoId')) || 1;
    const bookingId = sessionStorage.getItem('res_booking_id') || '';

    selectedNewCheckin = null;
    const submitBtn = document.getElementById('btnSubmitReschedule');
    submitBtn.disabled = true; submitBtn.style.cursor = 'not-allowed'; submitBtn.style.opacity = '.45';
    document.getElementById('reschedPreview').style.display = 'none';
    document.getElementById('reschedDatepicker').value = '';
    if (reschedFlatpickr) { reschedFlatpickr.destroy(); reschedFlatpickr = null; }

    document.getElementById('modalReschedule').classList.add('active');
    const dateInput = document.getElementById('reschedDatepicker');
    const loadingIcon = document.getElementById('reschedLoading');
    dateInput.placeholder = 'Memuat kalender...'; dateInput.disabled = true;
    if (loadingIcon) loadingIcon.style.display = 'block';

    fetch(`/reservasi/booked-dates/${akoId}?exclude_booking_id=${bookingId}&is_corporate=${isCorp?1:0}`)
        .then(r=>r.json())
        .then(data => {
            dateInput.placeholder = 'Pilih tanggal...'; dateInput.disabled = false;
            if (loadingIcon) loadingIcon.style.display = 'none';
            const bookedDates = data.booked_dates || [];
            const dateSettings = data.date_settings || [];
            let originalType = 'weekday';
            if (originalCheckinDateObj) originalType = getDateTypeFrontend(originalCheckinDateObj, dateSettings);

            document.getElementById('reschedRulesText').innerHTML = data.is_same_price
                ? '• Tanggal yang dipilih harus tersedia. Karena harga semua hari sama, bebas pilih tanggal manapun.'
                : '• Tanggal yang dipilih harus tersedia dan sesuai kawasan waktu check-in Anda (<strong style="text-transform:capitalize">' + originalType + '</strong>).';

            reschedFlatpickr = flatpickr('#reschedDatepicker', {
                locale:'id', dateFormat:'Y-m-d', minDate:'today',
                disable:[function(date){
                    const today = new Date(); today.setHours(0,0,0,0);
                    const h3 = new Date(today); h3.setDate(today.getDate()+3);
                    if (date >= today && date < h3) return true;
                    const type = getDateTypeFrontend(date, dateSettings);
                    if (!data.is_same_price && type !== originalType) return true;
                    for (let i=0; i<malam; i++) {
                        const d=new Date(date); d.setDate(d.getDate()+i);
                        const str=d.getFullYear()+'-'+String(d.getMonth()+1).padStart(2,'0')+'-'+String(d.getDate()).padStart(2,'0');
                        if (bookedDates.includes(str)) return true;
                    }
                    return false;
                }],
                onDayCreate:function(dObj, dStr, fp, dayElem){
                    const date=dayElem.dateObj;
                    const today=new Date(); today.setHours(0,0,0,0);
                    const h3=new Date(today); h3.setDate(today.getDate()+3);
                    if (date<today) return;
                    const type=getDateTypeFrontend(date, dateSettings);
                    dayElem.classList.add('date-'+type);
                    if (date>=today && date<h3) {
                        dayElem.classList.add('h3-blocked');
                        dayElem.innerHTML=`<span style="text-decoration:line-through;font-size:.72em;font-weight:700;line-height:2.7">H-3</span>`;
                    } else if (!data.is_same_price && type!==originalType) {
                        dayElem.classList.add('date-mismatch');
                    } else {
                        let booked=false;
                        for(let i=0;i<malam;i++){const d=new Date(date);d.setDate(d.getDate()+i);const s=d.getFullYear()+'-'+String(d.getMonth()+1).padStart(2,'0')+'-'+String(d.getDate()).padStart(2,'0');if(bookedDates.includes(s)){booked=true;break;}}
                        if(booked) dayElem.classList.add('booked-date');
                    }
                },
                onChange:function(sel){
                    if(sel.length>0){
                        selectedNewCheckin=sel[0];
                        const co=new Date(selectedNewCheckin); co.setDate(co.getDate()+malam);
                        const days=['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
                        const months=['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                        const fmt=d=>`${days[d.getDay()]}, ${d.getDate()} ${months[d.getMonth()]} ${d.getFullYear()}`;
                        document.getElementById('reschedNewCI').textContent=fmt(selectedNewCheckin);
                        document.getElementById('reschedNewCO').textContent=fmt(co);
                        document.getElementById('reschedNewMalam').textContent=malam;
                        document.getElementById('reschedPreview').style.display='block';
                        submitBtn.disabled=false; submitBtn.style.cursor='pointer'; submitBtn.style.opacity='1';
                    }
                },
                inline:true
            });
        })
        .catch(err => {
            dateInput.placeholder='Gagal memuat kalender'; dateInput.disabled=true;
            if (loadingIcon) loadingIcon.style.display='none';
            console.error(err); alert('Gagal memuat ketersediaan tanggal.');
        });
}

function submitReschedule() {
    if (!selectedNewCheckin) return;
    const bookingNo = document.getElementById('dynBookingNo').textContent;
    const submitBtn = document.getElementById('btnSubmitReschedule');
    const origText = submitBtn.textContent;
    submitBtn.textContent='Memproses...'; submitBtn.disabled=true; submitBtn.style.opacity='.5';
    const ci = selectedNewCheckin.getFullYear()+'-'+String(selectedNewCheckin.getMonth()+1).padStart(2,'0')+'-'+String(selectedNewCheckin.getDate()).padStart(2,'0');
    fetch('/reservasi/reschedule',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').getAttribute('content')},body:JSON.stringify({no_pesanan:bookingNo,new_check_in:ci})})
        .then(r=>r.json()).then(data=>{
            closeModalReschedule();
            if(data.success){sessionStorage.setItem('res_payment_status','reschedule_pending');document.getElementById('modalRescheduleSuccess').classList.add('active');}
            else alert('Gagal mengajukan reschedule: '+data.message);
        }).catch(err=>{console.error(err);alert('Terjadi kesalahan koneksi.');submitBtn.textContent=origText;submitBtn.disabled=false;submitBtn.style.opacity='1';});
}

function closeModalReschedule(){document.getElementById('modalReschedule').classList.remove('active')}
function closeModalRescheduleSuccess(){
    document.getElementById('modalRescheduleSuccess').classList.remove('active');
    const btn=document.getElementById('btnAjukanReschedule');
    if(btn){btn.disabled=true;btn.innerHTML=`<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="15" height="15"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Menunggu Konfirmasi`;}
    const note=document.getElementById('dynInvoiceNote');
    if(note) note.innerHTML='Pemesanan ini sedang dalam pengajuan reschedule. Silakan tunggu konfirmasi admin.';
}
function closeModalRescheduleError(){document.getElementById('modalRescheduleError').classList.remove('active')}

document.getElementById('modalReschedule')?.addEventListener('click',function(e){if(e.target===this)closeModalReschedule()});
document.getElementById('modalRescheduleSuccess')?.addEventListener('click',function(e){if(e.target===this)closeModalRescheduleSuccess()});
document.getElementById('modalRescheduleError')?.addEventListener('click',function(e){if(e.target===this)closeModalRescheduleError()});
</script>
@endpush
@endsection
