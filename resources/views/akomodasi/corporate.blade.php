@extends('layouts.app')
@section('title', 'Paket Corporate - Landeuh Village Riverside')
@section('hide_footer', true)
@section('content')

<style>
/* ── Page ──────────────────────────────────────────── */
.corp-page { background:#F8EDD8; min-height:100vh; padding-bottom:4rem; }

/* ── Hero ──────────────────────────────────────────── */
.corp-hero {
    background: linear-gradient(135deg,#2c3e2d 0%,#3a523a 60%,#4a6741 100%);
    padding: 3.5rem 1.5rem 5rem;
    text-align:center;
    position:relative;
    overflow:hidden;
}
.corp-hero::before {
    content:''; position:absolute; inset:0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/svg%3E");
}
.corp-badge {
    display:inline-flex; align-items:center; gap:.4rem;
    background:rgba(255,255,255,.15); border:1px solid rgba(255,255,255,.25);
    color:#fff; font-size:.7rem; font-weight:700; letter-spacing:.1em;
    text-transform:uppercase; padding:.35rem 1rem; border-radius:99px; margin-bottom:1rem;
}
.corp-hero h1 {
    font-size:clamp(1.8rem,5vw,3rem); font-weight:900; color:#fff;
    margin:0 0 .75rem; line-height:1.15;
}
.corp-hero p { color:rgba(255,255,255,.75); font-size:.95rem; max-width:520px; margin:0 auto; line-height:1.6; }
.corp-pills { display:flex; align-items:center; justify-content:center; gap:.6rem; flex-wrap:wrap; margin-top:1.5rem; }
.corp-pill {
    display:flex; align-items:center; gap:.4rem;
    background:rgba(255,255,255,.12); border:1px solid rgba(255,255,255,.2);
    color:rgba(255,255,255,.9); font-size:.75rem; font-weight:600;
    padding:.4rem .9rem; border-radius:99px;
}

/* ── Pax Bar ──────────────────────────────────────── */
.pax-bar { max-width:860px; margin:-2.25rem auto 0; padding:0 1rem; position:relative; z-index:20; }
.pax-card {
    background:#fff; border-radius:1.25rem;
    box-shadow:0 20px 60px -10px rgba(0,0,0,.2);
    padding:1.1rem 1.5rem;
    display:flex; align-items:center; gap:1.25rem; flex-wrap:wrap;
}
.pax-label-col { display:flex; flex-direction:column; }
.pax-label { font-size:.72rem; font-weight:800; color:#444; text-transform:uppercase; letter-spacing:.06em; }
.pax-hint { font-size:.66rem; color:#aaa; margin-top:.1rem; }
.pax-ctrl {
    display:flex; align-items:center; gap:.65rem;
    background:#f8f9fa; border:1.5px solid #e9ecef;
    border-radius:.75rem; padding:.45rem .75rem;
}
.pax-btn {
    width:30px; height:30px; border-radius:50%; border:none;
    font-size:1rem; font-weight:700; cursor:pointer;
    display:flex; align-items:center; justify-content:center; transition:.2s; flex-shrink:0;
}
.pax-btn.dec { background:#e9ecef; color:#555; }
.pax-btn.inc { background:#3a523a; color:#fff; }
.pax-btn.dec:hover { background:#dee2e6; }
.pax-btn.inc:hover { background:#2c402c; }
/* Typeable pax input */
.pax-val-input {
    font-size:1.5rem; font-weight:900; color:#3a523a;
    width:56px; text-align:center; border:none; background:transparent;
    outline:none; -moz-appearance:textfield;
}
.pax-val-input::-webkit-inner-spin-button,
.pax-val-input::-webkit-outer-spin-button { -webkit-appearance:none; margin:0; }
.pax-note { font-size:.72rem; color:#888; font-style:italic; margin-left:auto; }

/* ── Cards ────────────────────────────────────────── */
.corp-grid {
    max-width:860px; margin:2rem auto 0; padding:0 1rem;
    display:grid; grid-template-columns:1fr 1fr; gap:1.5rem;
}
@media(max-width:660px) { .corp-grid { grid-template-columns:1fr; } }

/* ── Card ─────────────────────────────────────────── */
.corp-card {
    background:#fff; border-radius:1.25rem; overflow:hidden;
    box-shadow:0 4px 24px rgba(0,0,0,.08);
    display:flex; flex-direction:column;
    transition:transform .25s,box-shadow .25s;
    border:2px solid transparent;
}
.corp-card:hover { transform:translateY(-4px); box-shadow:0 16px 48px rgba(0,0,0,.14); }

/* Photo */
.corp-photo { position:relative; width:100%; aspect-ratio:16/10; overflow:hidden; cursor:pointer; background:#eee; }
.corp-photo img { width:100%; height:100%; object-fit:cover; transition:transform .4s ease; display:block; }
.corp-card:hover .corp-photo img { transform:scale(1.05); }
.corp-photo-badge {
    position:absolute; top:.75rem; left:.75rem;
    background:linear-gradient(135deg,#3a523a,#4a6741);
    color:#fff; font-size:.62rem; font-weight:800;
    letter-spacing:.08em; text-transform:uppercase;
    padding:.28rem .65rem; border-radius:99px;
}
.corp-photo-overlay {
    position:absolute; bottom:0; left:0; right:0;
    background:linear-gradient(to top,rgba(0,0,0,.5),transparent);
    padding:.75rem; display:flex; justify-content:flex-end;
    opacity:0; transition:opacity .3s;
}
.corp-card:hover .corp-photo-overlay { opacity:1; }
.corp-gallery-btn {
    background:rgba(255,255,255,.9); border:none; border-radius:.5rem;
    font-size:.68rem; font-weight:700; color:#333; padding:.3rem .65rem; cursor:pointer;
}

/* Body */
.corp-body { padding:1.1rem; display:flex; flex-direction:column; gap:.8rem; flex:1; }
.corp-title { font-size:1.05rem; font-weight:900; color:#1a1a1a; line-height:1.2; }
.corp-sub { font-size:.68rem; color:#999; font-weight:600; margin-top:.1rem; }

/* Features */
.corp-feats { list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:.3rem; }
.corp-feats li { display:flex; align-items:flex-start; gap:.45rem; font-size:.72rem; color:#444; line-height:1.35; }
.corp-feats .chk { color:#3a523a; flex-shrink:0; margin-top:.1rem; }

/* Date btn — style mirip akomodasi */
.corp-date-row { display:flex; align-items:center; gap:.5rem; }
.corp-date-btn {
    flex:1; display:flex; align-items:center; gap:.5rem;
    background:#fff; border:1px solid #d1d5db;
    border-radius:.6rem; padding:.55rem .8rem;
    font-size:.72rem; font-weight:700; color:#555;
    cursor:pointer; transition:.2s;
    box-shadow:0 1px 3px rgba(0,0,0,.06);
}
.corp-date-btn:hover { border-color:#3a523a; background:#f0f4f0; color:#3a523a; box-shadow:0 2px 6px rgba(58,82,58,.12); }
.nights-badge {
    background:#e8f5e9; color:#3a523a;
    font-size:.68rem; font-weight:800;
    padding:.32rem .6rem; border-radius:.45rem; white-space:nowrap;
    display:flex; align-items:center; gap:.3rem;
}

/* Price */
.corp-price-box {
    background:linear-gradient(135deg,#f8fdf8,#eef6ee);
    border:1px solid #d4e8d4; border-radius:.75rem; padding:.8rem .9rem;
}
.corp-per-pax { font-size:.65rem; color:#888; font-weight:600; margin-bottom:.1rem; }
.corp-total-price { font-size:1.55rem; font-weight:900; color:#c0392b; line-height:1; }
.corp-est { font-size:.63rem; color:#aaa; margin-top:.2rem; }
.corp-formula {
    font-size:.65rem; color:#3a523a; font-weight:700;
    margin-top:.35rem; padding-top:.35rem; border-top:1px dashed #c8dfc8;
}

/* Notes */
.corp-notes { background:linear-gradient(to right,#fef9f0,transparent); border-radius:.5rem; padding:.55rem .7rem; }
.corp-notes p { font-size:.65rem; color:#777; margin:.12rem 0; display:flex; align-items:flex-start; gap:.3rem; }

/* Booked */
.booked-banner {
    background:#fef2f2; border:1px solid #fecaca; border-radius:.5rem;
    padding:.4rem .65rem; font-size:.68rem; color:#c0392b; font-weight:700; text-align:center;
}

/* CTA */
.corp-btn {
    width:100%; padding:.8rem; border-radius:.75rem; border:none;
    font-size:.88rem; font-weight:800; cursor:pointer; transition:.2s;
    display:flex; align-items:center; justify-content:center; gap:.45rem; margin-top:auto;
}
.corp-btn.green { background:linear-gradient(135deg,#3a523a,#4a6741); color:#fff; box-shadow:0 4px 16px rgba(58,82,58,.25); }
.corp-btn.green:hover { background:linear-gradient(135deg,#2c402c,#3a523a); box-shadow:0 6px 20px rgba(58,82,58,.35); transform:translateY(-1px); }
.corp-btn.dis { background:#e0e0e0; color:#aaa; cursor:not-allowed; }

/* Flatpickr selected check-in/check-out blue circle background & white text */
.flatpickr-day.selected,
.flatpickr-day.startRange,
.flatpickr-day.endRange,
.flatpickr-day.selected.startRange,
.flatpickr-day.selected.endRange {
    background: #2563eb !important;
    background-color: #2563eb !important;
    color: #ffffff !important;
    border-color: #2563eb !important;
    border-radius: 50% !important;
    font-weight: 700 !important;
}

.flatpickr-day.inRange {
    background: #dbeafe !important;
    box-shadow: -5px 0 0 #dbeafe, 5px 0 0 #dbeafe !important;
    color: #1e40af !important;
}

/* Flatpickr booked style */
.flatpickr-day.booked-date.flatpickr-disabled {
    background:#e5e7eb !important; color:#9ca3af !important;
    text-decoration:line-through; border-radius:50% !important;
}

/* ── Lightbox ──────────────────────────────────────── */
.corp-lb {
    position:fixed; inset:0; background:rgba(0,0,0,.9);
    z-index:9999; display:none; align-items:center; justify-content:center;
    flex-direction:column; gap:.75rem;
}
.corp-lb.show { display:flex; }
.corp-lb img { max-height:80vh; max-width:90vw; border-radius:.5rem; object-fit:contain; }
.lb-close {
    position:absolute; top:1rem; right:1rem; background:#fff; border:none;
    border-radius:50%; width:40px; height:40px; font-size:1.2rem; cursor:pointer;
    font-weight:900; display:flex; align-items:center; justify-content:center;
}
.lb-nav { display:flex; gap:1rem; margin-top:.5rem; }
.lb-nav button {
    background:rgba(255,255,255,.15); border:1px solid rgba(255,255,255,.3);
    color:#fff; padding:.4rem 1.2rem; border-radius:99px;
    font-weight:700; cursor:pointer; font-size:.85rem; transition:.2s;
}
.lb-nav button:hover { background:rgba(255,255,255,.3); }
.lb-counter { color:rgba(255,255,255,.6); font-size:.78rem; }
</style>

<div class="corp-page">

    {{-- Hero --}}
    <div class="corp-hero">
        <div class="corp-badge"><iconify-icon icon="lucide:star" style="font-size:.9rem"></iconify-icon> Corporate &amp; Event Package</div>
        <h1>Paket Corporate<br>Landeuh Village Riverside</h1>
        <p>Dirancang khusus untuk perusahaan, instansi, dan komunitas. Nikmati pengalaman alam eksklusif bersama seluruh tim.</p>
        <div class="corp-pills">
            <div class="corp-pill"><iconify-icon icon="lucide:users"></iconify-icon> 25 – 150 Peserta</div>
            <div class="corp-pill"><iconify-icon icon="lucide:tag"></iconify-icon> Harga per Pax</div>
            <div class="corp-pill"><iconify-icon icon="lucide:shield-check"></iconify-icon> Privat Seluruh Area</div>
            <div class="corp-pill"><iconify-icon icon="lucide:utensils"></iconify-icon> Makan 3× Sehari</div>
        </div>
    </div>

    {{-- Pax Bar --}}
    <div class="pax-bar">
        <div class="pax-card">
            <iconify-icon icon="lucide:users" style="font-size:1.6rem;color:#3a523a;flex-shrink:0"></iconify-icon>
            <div class="pax-label-col">
                <div class="pax-label">Jumlah Peserta</div>
                <div class="pax-hint">Min 25 pax · Maks 150 pax</div>
            </div>
            <div class="pax-ctrl">
                <button class="pax-btn dec" id="btnPaxDec"><iconify-icon icon="lucide:minus" style="font-size:.9rem"></iconify-icon></button>
                <input type="number" class="pax-val-input" id="paxVal" min="25" max="150" value="25">
                <button class="pax-btn inc" id="btnPaxInc"><iconify-icon icon="lucide:plus" style="font-size:.9rem"></iconify-icon></button>
            </div>
            <div class="pax-note">Pax mempengaruhi<br>estimasi total harga</div>
        </div>
    </div>

    {{-- Cards --}}
    <div class="corp-grid">
        @php
            $glamping = $accommodations->firstWhere('jenis', 'Corporate Glamping');
            $cabin    = $accommodations->firstWhere('jenis', 'Corporate Cabin');
        @endphp

        {{-- ─── GLAMPING CARD ─── --}}
        @if($glamping)
        @php
            $gImgs = is_array($glamping->gambar) ? $glamping->gambar : (json_decode($glamping->gambar ?? '[]', true) ?: []);
            $gFas  = is_array($glamping->fasilitas) ? $glamping->fasilitas : (json_decode($glamping->fasilitas ?? '[]', true) ?: []);
            $gMak  = is_array($glamping->makanan) ? $glamping->makanan : (json_decode($glamping->makanan ?? '[]', true) ?: []);
            $gCat  = is_array($glamping->catatan) ? $glamping->catatan : (json_decode($glamping->catatan ?? '[]', true) ?: []);
        @endphp
        <div class="corp-card">
            <div class="corp-photo" onclick="window.location.href='/akomodasi?jenis=Glamping'">
                <img src="{{ $gImgs[0] ?? 'https://placehold.co/600x400/3a523a/fff?text=Glamping' }}" alt="{{ $glamping->judul }}">
                <div class="corp-photo-badge">Glamping</div>
                <div class="corp-photo-overlay">
                    <button class="corp-gallery-btn"><iconify-icon icon="lucide:layout-list" style="font-size:.9rem"></iconify-icon> Lihat Detail Unit</button>
                </div>
            </div>
            <div class="corp-body">
                <div>
                    <div class="corp-title">{{ $glamping->judul }}</div>
                    <div class="corp-sub">Seluruh area Glamping VIP &amp; Reguler secara eksklusif</div>
                </div>
                <ul class="corp-feats">
                    @foreach(array_merge($gFas, $gMak) as $f)
                    <li><iconify-icon icon="lucide:check-circle-2" class="chk" style="font-size:.85rem"></iconify-icon> {{ $f }}</li>
                    @endforeach
                </ul>
                <div>
                    <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:.35rem;">
                        <div style="font-size:.67rem;font-weight:700;color:#555;">Pilih Tanggal</div>
                        <div id="avail-glamping" style="font-size:.6rem;font-weight:800;color:#2c7a2c;background:#e8f5e9;padding:.15rem .4rem;border-radius:.25rem;border:1px solid #c8dfc8;">Tersedia: 13 unit Glamping</div>
                    </div>
                    <div class="corp-date-row">
                        <div style="position:absolute;visibility:hidden;width:0;height:0;"><input type="text" id="fp-glamping"></div>
                        <button type="button" class="corp-date-btn" id="btn-date-glamping">
                            <iconify-icon icon="lucide:calendar-days" style="font-size:.95rem;flex-shrink:0"></iconify-icon>
                            <span id="date-text-glamping">Sesuaikan Tanggal</span>
                        </button>
                        <div class="nights-badge" id="nights-glamping"><iconify-icon icon="lucide:moon" style="font-size:.8rem"></iconify-icon> 1 Malam</div>
                    </div>
                    <!-- <div id="date-info-badge-glamping" style="display:none;margin-top:.4rem;font-size:.65rem;font-weight:700;color:#333;background:#f0fdf4;border:1px solid #bbf7d0;padding:.3rem .5rem;border-radius:.35rem;">
                        <div><span style="color:#15803d;font-weight:800;">Check-in:</span> <span id="checkin-txt-glamping">-</span></div>
                        <div><span style="color:#b45309;font-weight:800;">Check-out:</span> <span id="checkout-txt-glamping">-</span></div>
                    </div> -->
                </div>
                <div class="corp-price-box">
                    <div class="corp-per-pax">Rp {{ number_format($glamping->harga_weekday,0,',','.') }}/pax/malam</div>
                    <div class="corp-total-price" id="price-glamping">Rp 10.000.000</div>
                    <div class="corp-est">Estimasi total</div>
                    <div class="corp-formula" id="formula-glamping">25 pax × 1 malam × Rp 400.000</div>
                </div>
                @if(count($gCat))
                <div class="corp-notes">
                    @foreach($gCat as $c)
                    <p><iconify-icon icon="ph:hand-pointing-bold" style="font-size:.85rem;flex-shrink:0;margin-top:1px"></iconify-icon> {{ $c }}</p>
                    @endforeach
                </div>
                @endif
                <div id="booked-glamping" style="display:none" class="booked-banner"><iconify-icon icon="lucide:alert-circle"></iconify-icon> Tanggal ini sudah penuh — pilih tanggal lain</div>
                <!-- <a href="/akomodasi?jenis=Glamping" class="corp-btn" style="background:#f8fdf8;border:1.5px solid #3a523a;color:#3a523a;text-decoration:none;font-size:.82rem;" onmouseover="this.style.background='#e8f5e9'" onmouseout="this.style.background='#f8fdf8'">
                    <iconify-icon icon="lucide:layout-list" style="font-size:.95rem"></iconify-icon> Lihat Detail Unit Glamping
                </a> -->
                <button class="corp-btn green" id="btn-pilih-glamping" onclick="pilihPaket({{ $glamping->id }}, 'glamping')">
                    <iconify-icon icon="lucide:check-circle-2" style="font-size:1rem"></iconify-icon> Pilih Paket Glamping
                </button>
            </div>
        </div>
        @endif

        {{-- ─── CABIN CARD ─── --}}
        @if($cabin)
        @php
            $cImgs = is_array($cabin->gambar) ? $cabin->gambar : (json_decode($cabin->gambar ?? '[]', true) ?: []);
            $cFas  = is_array($cabin->fasilitas) ? $cabin->fasilitas : (json_decode($cabin->fasilitas ?? '[]', true) ?: []);
            $cMak  = is_array($cabin->makanan) ? $cabin->makanan : (json_decode($cabin->makanan ?? '[]', true) ?: []);
            $cCat  = is_array($cabin->catatan) ? $cabin->catatan : (json_decode($cabin->catatan ?? '[]', true) ?: []);
        @endphp
        <div class="corp-card">
            <div class="corp-photo" onclick="window.location.href='/akomodasi?jenis=Cabin'">
                <img src="{{ $cImgs[0] ?? 'https://placehold.co/600x400/3a523a/fff?text=Cabin' }}" alt="{{ $cabin->judul }}">
                <div class="corp-photo-badge">Cabin</div>
                <div class="corp-photo-overlay">
                    <button class="corp-gallery-btn"><iconify-icon icon="lucide:layout-list" style="font-size:.9rem"></iconify-icon> Lihat Detail Unit</button>
                </div>
            </div>
            <div class="corp-body">
                <div>
                    <div class="corp-title">{{ $cabin->judul }}</div>
                    <div class="corp-sub">Seluruh unit Cabin (1–8) secara eksklusif</div>
                </div>
                <ul class="corp-feats">
                    @foreach(array_merge($cFas, $cMak) as $f)
                    <li><iconify-icon icon="lucide:check-circle-2" class="chk" style="font-size:.85rem"></iconify-icon> {{ $f }}</li>
                    @endforeach
                </ul>
                <div>
                    <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:.35rem;">
                        <div style="font-size:.67rem;font-weight:700;color:#555;">Pilih Tanggal</div>
                        <div id="avail-cabin" style="font-size:.6rem;font-weight:800;color:#2c7a2c;background:#e8f5e9;padding:.15rem .4rem;border-radius:.25rem;border:1px solid #c8dfc8;">Tersedia: 8 unit Cabin</div>
                    </div>
                    <div class="corp-date-row">
                        <div style="position:absolute;visibility:hidden;width:0;height:0;"><input type="text" id="fp-cabin"></div>
                        <button type="button" class="corp-date-btn" id="btn-date-cabin">
                            <iconify-icon icon="lucide:calendar-days" style="font-size:.95rem;flex-shrink:0"></iconify-icon>
                            <span id="date-text-cabin">Sesuaikan Tanggal</span>
                        </button>
                        <div class="nights-badge" id="nights-cabin"><iconify-icon icon="lucide:moon" style="font-size:.8rem"></iconify-icon> 1 Malam</div>
                    </div>
                    <!-- <div id="date-info-badge-cabin" style="display:none;margin-top:.4rem;font-size:.65rem;font-weight:700;color:#333;background:#f0fdf4;border:1px solid #bbf7d0;padding:.3rem .5rem;border-radius:.35rem;">
                        <div><span style="color:#15803d;font-weight:800;">Check-in:</span> <span id="checkin-txt-cabin">-</span></div>
                        <div><span style="color:#b45309;font-weight:800;">Check-out:</span> <span id="checkout-txt-cabin">-</span></div>
                    </div> -->
                </div>
                <div class="corp-price-box">
                    <div class="corp-per-pax">Rp {{ number_format($cabin->harga_weekday,0,',','.') }}/pax/malam</div>
                    <div class="corp-total-price" id="price-cabin">Rp 12.500.000</div>
                    <div class="corp-est">Estimasi total</div>
                    <div class="corp-formula" id="formula-cabin">25 pax × 1 malam × Rp 500.000</div>
                </div>
                @if(count($cCat))
                <div class="corp-notes">
                    @foreach($cCat as $c)
                    <p><iconify-icon icon="ph:hand-pointing-bold" style="font-size:.85rem;flex-shrink:0;margin-top:1px"></iconify-icon> {{ $c }}</p>
                    @endforeach
                </div>
                @endif
                <div id="booked-cabin" style="display:none" class="booked-banner"><iconify-icon icon="lucide:alert-circle"></iconify-icon> Tanggal ini sudah penuh — pilih tanggal lain</div>
                <!-- <a href="/akomodasi?jenis=Cabin" class="corp-btn" style="background:#f8fdf8;border:1.5px solid #3a523a;color:#3a523a;text-decoration:none;font-size:.82rem;" onmouseover="this.style.background='#e8f5e9'" onmouseout="this.style.background='#f8fdf8'">
                    <iconify-icon icon="lucide:layout-list" style="font-size:.95rem"></iconify-icon> Lihat Detail Unit Cabin
                </a> -->
                <button class="corp-btn green" id="btn-pilih-cabin" onclick="pilihPaket({{ $cabin->id }}, 'cabin')">
                    <iconify-icon icon="lucide:check-circle-2" style="font-size:1rem"></iconify-icon> Pilih Paket Cabin
                </button>
            </div>
        </div>
        @endif

        @if(!$glamping && !$cabin)
        <div style="grid-column:1/-1;text-align:center;padding:4rem 2rem;color:#888;">
            <p style="font-size:.9rem;font-weight:600">Data paket corporate belum tersedia.</p>
            <p style="font-size:.78rem;margin-top:.4rem">Jalankan: <code>php artisan db:seed --class=CorporatePackageSeeder</code></p>
        </div>
        @endif
    </div>
</div>

{{-- Lightbox --}}
<div class="corp-lb" id="corpLb">
    <button class="lb-close" onclick="closeLb()"><iconify-icon icon="lucide:x" style="font-size:1rem"></iconify-icon></button>
    <img src="" id="lbImg" alt="">
    <div class="lb-counter" id="lbCount"></div>
    <div class="lb-nav">
        <button onclick="lbNav(-1)"><iconify-icon icon="lucide:chevron-left"></iconify-icon> Sebelumnya</button>
        <button onclick="lbNav(1)">Selanjutnya <iconify-icon icon="lucide:chevron-right"></iconify-icon></button>
    </div>
</div>

{{-- Custom Confirm & Alert Modal --}}
<div id="customConfirmModal" class="fixed inset-0 z-[99999] hidden items-center justify-center bg-black/60 backdrop-blur-sm p-4 transition-all duration-200">
    <div id="customConfirmBox" class="bg-white rounded-2xl shadow-2xl max-w-md w-full overflow-hidden transform scale-90 opacity-0 transition-all duration-200" style="font-family: inherit;">
        <!-- Banner Header -->
        <div class="p-6 text-center border-b border-gray-100 bg-amber-50/70" id="customConfirmHeader">
            <div id="customConfirmIconWrap" class="w-14 h-14 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center mx-auto mb-3 shadow-inner">
                <iconify-icon id="customConfirmIcon" icon="lucide:alert-triangle" style="font-size: 1.8rem;"></iconify-icon>
            </div>
            <h3 class="text-lg font-bold text-gray-900" id="customConfirmTitle">Konfirmasi Pemesanan</h3>
        </div>
        <!-- Body Content -->
        <div class="p-6 text-center space-y-3">
            <div id="customConfirmBadge" class="inline-block bg-amber-100 text-amber-800 text-xs font-extrabold px-3 py-1 rounded-full">
                Peringatan Ketersediaan Unit
            </div>
            <p id="customConfirmMessage" class="text-sm text-gray-700 font-medium leading-relaxed">
                Peringatan: Jumlah unit yang tersedia di tanggal ini terbatas.
            </p>
            <p id="customConfirmSubtext" class="text-xs text-gray-500 font-semibold pt-2 border-t border-gray-100">
                Apakah Anda yakin ingin tetap melanjutkan pemesanan Paket Corporate ini dengan harga yang sama?
            </p>
        </div>
        <!-- Action Buttons -->
        <div class="p-4 bg-gray-50 border-t border-gray-100 flex items-center justify-end gap-3" id="customConfirmFooter">
            <button type="button" id="btnCustomConfirmCancel" class="w-1/2 py-2.5 px-4 bg-white hover:bg-gray-100 text-gray-700 font-bold text-sm rounded-xl border border-gray-300 transition shadow-sm cursor-pointer">
                Batal
            </button>
            <button type="button" id="btnCustomConfirmOk" class="w-1/2 py-2.5 px-4 bg-[#3a523a] hover:bg-[#2c402c] text-white font-bold text-sm rounded-xl transition shadow cursor-pointer">
                Ya, Lanjutkan
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script>
(function(){
    /* ── Backend data ─────────────────────────────── */
    var CORP = {
        glamping: {
            id: {{ $glamping->id ?? 'null' }},
            harga: {{ $glamping->harga_weekday ?? 400000 }},
            slot: {{ $glamping->slot ?? 6 }},
            images: @json(isset($glamping) ? (is_array($glamping->gambar) ? $glamping->gambar : json_decode($glamping->gambar ?? '[]', true)) : []),
            bookings: @json(isset($glamping) ? $glamping->bookings->map(function($b){ return ['ci'=>(string)$b->check_in_date,'co'=>(string)$b->check_out_date,'st'=>$b->status]; }) : []),
            indBookings: @json(isset($glampingBookings) ? $glampingBookings->map(function($b){ return ['ci'=>(string)$b->check_in_date,'co'=>(string)$b->check_out_date,'st'=>$b->status]; }) : [])
        },
        cabin: {
            id: {{ $cabin->id ?? 'null' }},
            harga: {{ $cabin->harga_weekday ?? 500000 }},
            slot: {{ $cabin->slot ?? 8 }},
            images: @json(isset($cabin) ? (is_array($cabin->gambar) ? $cabin->gambar : json_decode($cabin->gambar ?? '[]', true)) : []),
            bookings: @json(isset($cabin) ? $cabin->bookings->map(function($b){ return ['ci'=>(string)$b->check_in_date,'co'=>(string)$b->check_out_date,'st'=>$b->status]; }) : []),
            indBookings: @json(isset($cabinBookings) ? $cabinBookings->map(function($b){ return ['ci'=>(string)$b->check_in_date,'co'=>(string)$b->check_out_date,'st'=>$b->status]; }) : [])
        }
    };

    /* ── State ────────────────────────────────────── */
    var pax = 25;
    var dateState  = { glamping:null, cabin:null };
    var nightState = { glamping:1,    cabin:1    };

    /* ── Utils ────────────────────────────────────── */
    function fmtRp(n){ return 'Rp '+Math.round(n).toLocaleString('id-ID'); }

    function updatePrice(t){
        var total = CORP[t].harga * pax * nightState[t];
        document.getElementById('price-'+t).textContent = fmtRp(total);
        document.getElementById('formula-'+t).textContent =
            pax+' pax \u00d7 '+nightState[t]+' malam \u00d7 '+fmtRp(CORP[t].harga);
    }

    function isBooked(t, dates){
        if(!dates||dates.length<2) return false;
        var s=new Date(dates[0]); s.setHours(12,0,0,0);
        var e=new Date(dates[1]); e.setHours(12,0,0,0);
        var bks=CORP[t].bookings||[];
        for(var dt=new Date(s); dt<e; dt.setDate(dt.getDate()+1)){
            var tp=dt.getTime();
            // Check direct corporate bookings
            for(var i=0;i<bks.length;i++){
                var b=bks[i];
                if(b.st==='failed'||b.st==='refunded') continue;
                var bi=new Date(b.ci); bi.setHours(12,0,0,0);
                var bo=new Date(b.co); bo.setHours(12,0,0,0);
                if(tp>=bi.getTime()&&tp<bo.getTime()) return true;
            }
            // Check individual bookings availability: block ONLY if ALL units of that type are booked
            var maxU = t === 'glamping' ? 13 : 8;
            var dayBooked = 0;
            var indBks = CORP[t].indBookings || [];
            for(var j=0; j<indBks.length; j++){
                var b2 = indBks[j];
                if(b2.st==='failed'||b2.st==='refunded') continue;
                var bi2 = new Date(b2.ci); bi2.setHours(12,0,0,0);
                var bo2 = new Date(b2.co); bo2.setHours(12,0,0,0);
                if(tp >= bi2.getTime() && tp < bo2.getTime()) dayBooked++;
            }
            if(dayBooked >= maxU) return true;
        }
        return false;
    }

    function getAvailableUnits(t, dates) {
        var maxU = t === 'glamping' ? 13 : 8;
        if(!dates || dates.length < 2) return maxU;
        var s=new Date(dates[0]); s.setHours(12,0,0,0);
        var e=new Date(dates[1]); e.setHours(12,0,0,0);
        var bks = CORP[t].indBookings || [];
        var maxBookedOverlap = 0;
        
        for(var dt=new Date(s); dt<e; dt.setDate(dt.getDate()+1)){
            var tp = dt.getTime();
            var dayBooked = 0;
            for(var i=0; i<bks.length; i++){
                var b = bks[i];
                if(b.st==='failed'||b.st==='refunded') continue;
                var bi = new Date(b.ci); bi.setHours(12,0,0,0);
                var bo = new Date(b.co); bo.setHours(12,0,0,0);
                if(tp >= bi.getTime() && tp < bo.getTime()) dayBooked++;
            }
            if(dayBooked > maxBookedOverlap) maxBookedOverlap = dayBooked;
        }
        return Math.max(0, maxU - maxBookedOverlap);
    }

    function isDayBooked(t, dateObj){
        var d=new Date(dateObj); d.setHours(12,0,0,0); var tp=d.getTime();
        var bks=CORP[t].bookings||[];
        // Check direct corporate bookings
        for(var i=0;i<bks.length;i++){
            var b=bks[i];
            if(b.st==='failed'||b.st==='refunded') continue;
            var bi=new Date(b.ci); bi.setHours(12,0,0,0);
            var bo=new Date(b.co); bo.setHours(12,0,0,0);
            if(tp>=bi.getTime()&&tp<bo.getTime()) return true;
        }
        // Check individual bookings availability: block ONLY if ALL units of that type are booked
        var maxU = t === 'glamping' ? 13 : 8;
        var dayBooked = 0;
        var indBks = CORP[t].indBookings || [];
        for(var j=0; j<indBks.length; j++){
            var b2 = indBks[j];
            if(b2.st==='failed'||b2.st==='refunded') continue;
            var bi2 = new Date(b2.ci); bi2.setHours(12,0,0,0);
            var bo2 = new Date(b2.co); bo2.setHours(12,0,0,0);
            if(tp >= bi2.getTime() && tp < bo2.getTime()) dayBooked++;
        }
        if(dayBooked >= maxU) return true;
        
        return false;
    }

    /* ── Pax picker (dengan input ketik) ─────────── */
    var paxInput = document.getElementById('paxVal');

    function setPax(val){
        val = parseInt(val) || 25;
        if(val < 25) val = 25;
        if(val > 150) val = 150;
        pax = val;
        paxInput.value = pax;
        updatePrice('glamping');
        updatePrice('cabin');
    }

    document.getElementById('btnPaxDec').addEventListener('click',function(){
        setPax(pax - 1);
    });
    document.getElementById('btnPaxInc').addEventListener('click',function(){
        setPax(pax + 1);
    });
    paxInput.addEventListener('input', function(){
        // Hanya update harga saat mengetik, jangan clamp nilai agar tidak mengganggu input
        var val = parseInt(this.value);
        if (!isNaN(val) && val >= 25 && val <= 150) {
            pax = val;
            updatePrice('glamping');
            updatePrice('cabin');
        }
    });
    paxInput.addEventListener('blur', function(){
        // Baru clamp saat selesai mengetik
        setPax(parseInt(this.value) || 25);
    });
    paxInput.addEventListener('keydown', function(e){
        if(e.key === 'Enter') { this.blur(); }
    });

    /* ── Init flatpickr ───────────────────────────── */
    window.updateFpPopupFooter = function(instance, selectedDates) {
        if (!instance || !instance.calendarContainer) return;
        let footer = instance.calendarContainer.querySelector('.fp-custom-footer');
        if (!footer) {
            footer = document.createElement('div');
            footer.className = 'fp-custom-footer';
            footer.style.cssText = 'padding: 8px 12px; background: #f8fafc; border-top: 1px solid #e2e8f0; font-size: 11px; color: #334155; font-weight: 600; display: flex; align-items: center; justify-content: space-between; gap: 8px; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; width: 100%; box-sizing: border-box;';
            footer.innerHTML = `
                <div style="display:flex; align-items:center; gap:4px;"><span style="color:#059669; font-weight:700;">Check-in:</span> <span class="fp-in-val" style="color:#0f172a; font-weight:700;">Belum dipilih</span></div>
                <div style="display:flex; align-items:center; gap:4px;"><span style="color:#d97706; font-weight:700;">Check-out:</span> <span class="fp-out-val" style="color:#0f172a; font-weight:700;">Belum dipilih</span></div>
            `;
            instance.calendarContainer.appendChild(footer);
        }
        const inVal = footer.querySelector('.fp-in-val');
        const outVal = footer.querySelector('.fp-out-val');
        const fmtFull = { weekday: 'short', day: 'numeric', month: 'short', year: 'numeric' };

        if (!selectedDates || selectedDates.length === 0) {
            if (inVal) inVal.innerText = 'Belum dipilih';
            if (outVal) outVal.innerText = 'Belum dipilih';
        } else if (selectedDates.length === 1) {
            if (inVal) inVal.innerText = selectedDates[0].toLocaleDateString('id-ID', fmtFull);
            if (outVal) outVal.innerText = 'Pilih Check-out';

            setTimeout(() => {
                const days = instance.calendarContainer.querySelectorAll('.flatpickr-day');
                days.forEach(day => {
                    if (day.dateObj) {
                        const dObj = new Date(day.dateObj);
                        dObj.setHours(0,0,0,0);
                        const sObj = new Date(selectedDates[0]);
                        sObj.setHours(0,0,0,0);
                        if (dObj.getTime() === sObj.getTime()) {
                            day.classList.add('selected', 'startRange');
                            day.style.setProperty('background-color', '#2563eb', 'important');
                            day.style.setProperty('color', '#ffffff', 'important');
                            day.style.setProperty('border-radius', '50%', 'important');
                        }
                    }
                });
            }, 0);
        } else if (selectedDates.length === 2) {
            if (inVal) inVal.innerText = selectedDates[0].toLocaleDateString('id-ID', fmtFull);
            if (outVal) outVal.innerText = selectedDates[1].toLocaleDateString('id-ID', fmtFull);
        }
    };

    function initFp(t){
        var input=document.getElementById('fp-'+t);
        var btn  =document.getElementById('btn-date-'+t);
        var txtEl=document.getElementById('date-text-'+t);
        var nEl  =document.getElementById('nights-'+t);
        var bkEl =document.getElementById('booked-'+t);
        var ctaEl=document.getElementById('btn-pilih-'+t);
        var availEl=document.getElementById('avail-'+t);
        var maxUnits=t==='glamping'?13:8;
        var unitName=t==='glamping'?'Glamping':'Cabin';
        if(!input||!btn) return;

        var fp;
        fp = flatpickr(input,{
            mode:'range', minDate:'today',
            showMonths: window.innerWidth>768?2:1,
            locale: typeof flatpickr.l10ns !== 'undefined' && flatpickr.l10ns.id ? 'id' : 'default',
            disable:[function(d){ 
                var selected = (fp && fp.selectedDates) ? fp.selectedDates : (this && this.selectedDates ? this.selectedDates : []);
                if (selected && selected.length === 1) {
                    var start = new Date(selected[0]);
                    start.setHours(0, 0, 0, 0);

                    var cur = new Date(d);
                    cur.setHours(0, 0, 0, 0);

                    if (cur <= start) {
                        return true;
                    }

                    for (var check = new Date(start); check < cur; check.setDate(check.getDate() + 1)) {
                        if (isDayBooked(t, check)) {
                            return true;
                        }
                    }
                    return false;
                }
                return isDayBooked(t,d); 
            }],
            onDayCreate:function(dObj,dStr,fpI,dayElem){
                var today=new Date(); today.setHours(0,0,0,0);
                if(dayElem.dateObj>=today && isDayBooked(t,dayElem.dateObj))
                    dayElem.classList.add('booked-date');
            },
            onReady:function(selectedDates, dateStr, instance){
                if (window.updateFpPopupFooter) {
                    window.updateFpPopupFooter(instance, selectedDates);
                }
            },
            onOpen:function(selectedDates, dateStr, instance){
                if (window.updateFpPopupFooter) {
                    window.updateFpPopupFooter(instance, selectedDates);
                }
            },
            onChange:function(sel, dateStr, instance){
                if (window.updateFpPopupFooter) {
                    window.updateFpPopupFooter(instance, sel);
                }
                var badge = document.getElementById('date-info-badge-' + t);
                var inTxt = document.getElementById('checkin-txt-' + t);
                var outTxt = document.getElementById('checkout-txt-' + t);
                var fmtFull = { weekday: 'short', day: 'numeric', month: 'short', year: 'numeric' };

                if (sel.length === 1) {
                    var inStr = sel[0].toLocaleDateString('id-ID', fmtFull);
                    if (badge) badge.style.display = 'block';
                    if (inTxt) inTxt.textContent = inStr;
                    if (outTxt) outTxt.textContent = 'Pilih Tanggal Check-out';

                    if (txtEl) txtEl.textContent = 'In: ' + sel[0].toLocaleDateString('id-ID', { day: 'numeric', month: 'short' });
                } else if (sel.length === 2) {
                    var inStr = sel[0].toLocaleDateString('id-ID', fmtFull);
                    var outStr = sel[1].toLocaleDateString('id-ID', fmtFull);
                    if (badge) badge.style.display = 'block';
                    if (inTxt) inTxt.textContent = inStr;
                    if (outTxt) outTxt.textContent = outStr;

                    dateState[t]=sel;
                    var diff=Math.abs(sel[1]-sel[0]);
                    var nights=Math.max(1,Math.ceil(diff/86400000));
                    nightState[t]=nights;
                    var opts={day:'numeric',month:'short',year:'2-digit'};
                    txtEl.textContent=sel[0].toLocaleDateString('id-ID',opts)+' \u2013 '+sel[1].toLocaleDateString('id-ID',opts);
                    nEl.innerHTML='<iconify-icon icon="lucide:moon" style="font-size:.8rem"></iconify-icon> '+nights+' Malam';
                    var booked=isBooked(t,sel);
                    bkEl.style.display=booked?'block':'none';
                    ctaEl.className='corp-btn '+(booked?'dis':'green');
                    
                    if(availEl){
                        if(booked){
                            availEl.textContent='Tersedia: 0 unit '+unitName;
                            availEl.style.color='#c0392b';
                            availEl.style.background='#fef2f2';
                            availEl.style.borderColor='#fecaca';
                        }else{
                            var avail = getAvailableUnits(t, sel);
                            availEl.textContent='Tersedia: '+avail+' unit '+unitName;
                            
                            if (avail === maxUnits) {
                                availEl.style.color='#2c7a2c';
                                availEl.style.background='#e8f5e9';
                                availEl.style.borderColor='#c8dfc8';
                            } else if (avail >= 2) {
                                availEl.style.color='#b45309';
                                availEl.style.background='#fef3c7';
                                availEl.style.borderColor='#fde68a';
                            } else {
                                availEl.style.color='#c0392b';
                                availEl.style.background='#fef2f2';
                                availEl.style.borderColor='#fecaca';
                            }
                        }
                    }

                    updatePrice(t);
                    setTimeout(function(){ fp.close(); },300);
                }
            }
        });
        btn.addEventListener('click',function(e){ e.stopPropagation(); fp.toggle(); });
    }

    initFp('glamping');
    initFp('cabin');
    updatePrice('glamping');
    updatePrice('cabin');

    /* ── Custom Modal Helper ────────────────────── */
    window.openCustomModal = function(options) {
        return new Promise((resolve) => {
            const modal = document.getElementById('customConfirmModal');
            const box = document.getElementById('customConfirmBox');
            const header = document.getElementById('customConfirmHeader');
            const iconWrap = document.getElementById('customConfirmIconWrap');
            const icon = document.getElementById('customConfirmIcon');
            const title = document.getElementById('customConfirmTitle');
            const badge = document.getElementById('customConfirmBadge');
            const msg = document.getElementById('customConfirmMessage');
            const subtext = document.getElementById('customConfirmSubtext');
            const btnCancel = document.getElementById('btnCustomConfirmCancel');
            const btnOk = document.getElementById('btnCustomConfirmOk');

            const isAlertOnly = options.isAlert || false;

            title.textContent = options.title || 'Informasi';
            badge.textContent = options.badge || 'Pemberitahuan';
            msg.textContent = options.message || '';
            
            if (options.subtext) {
                subtext.textContent = options.subtext;
                subtext.style.display = 'block';
            } else {
                subtext.style.display = 'none';
            }

            if (options.type === 'error') {
                header.className = 'p-6 text-center border-b border-gray-100 bg-red-50/70';
                iconWrap.className = 'w-14 h-14 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-3 shadow-inner';
                icon.setAttribute('icon', 'lucide:x-circle');
                badge.className = 'inline-block bg-red-100 text-red-800 text-xs font-extrabold px-3 py-1 rounded-full';
                btnOk.className = 'w-full py-2.5 px-4 bg-red-600 hover:bg-red-700 text-white font-bold text-sm rounded-xl transition shadow cursor-pointer';
                btnOk.textContent = options.okText || 'Tutup';
            } else if (options.type === 'info') {
                header.className = 'p-6 text-center border-b border-gray-100 bg-blue-50/70';
                iconWrap.className = 'w-14 h-14 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-3 shadow-inner';
                icon.setAttribute('icon', 'lucide:info');
                badge.className = 'inline-block bg-blue-100 text-blue-800 text-xs font-extrabold px-3 py-1 rounded-full';
                btnOk.className = 'w-full py-2.5 px-4 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl transition shadow cursor-pointer';
                btnOk.textContent = options.okText || 'Mengerti';
            } else {
                // Default Warning / Confirm
                header.className = 'p-6 text-center border-b border-gray-100 bg-amber-50/70';
                iconWrap.className = 'w-14 h-14 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center mx-auto mb-3 shadow-inner';
                icon.setAttribute('icon', 'lucide:alert-triangle');
                badge.className = 'inline-block bg-amber-100 text-amber-800 text-xs font-extrabold px-3 py-1 rounded-full';
                btnOk.className = 'w-1/2 py-2.5 px-4 bg-[#3a523a] hover:bg-[#2c402c] text-white font-bold text-sm rounded-xl transition shadow cursor-pointer';
                btnOk.textContent = options.okText || 'Ya, Lanjutkan';
            }

            if (isAlertOnly) {
                btnCancel.style.display = 'none';
                btnOk.classList.remove('w-1/2');
                btnOk.classList.add('w-full');
            } else {
                btnCancel.style.display = 'block';
                btnOk.classList.remove('w-full');
                btnOk.classList.add('w-1/2');
            }

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            setTimeout(() => {
                box.classList.remove('scale-90', 'opacity-0');
                box.classList.add('scale-100', 'opacity-100');
            }, 10);

            function close(res) {
                box.classList.remove('scale-100', 'opacity-100');
                box.classList.add('scale-90', 'opacity-0');
                setTimeout(() => {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    btnCancel.onclick = null;
                    btnOk.onclick = null;
                    resolve(res);
                }, 150);
            }

            btnCancel.onclick = function() { close(false); };
            btnOk.onclick = function() { close(true); };
        });
    };

    /* ── Pilih Paket ──────────────────────────────── */
    window.pilihPaket=function(id,t){
        var dates=dateState[t];
        if(!dates||dates.length<2){
            document.getElementById('btn-date-'+t).click();
            return;
        }
        if(isBooked(t,dates)){
            openCustomModal({
                type: 'error',
                isAlert: true,
                title: 'Tanggal Tidak Tersedia',
                badge: 'Sudah Penuh',
                message: 'Tanggal yang Anda pilih sudah dipesan oleh rombongan Corporate lain. Silakan pilih tanggal lain.'
            });
            return;
        }
        
        var maxUnits = t === 'glamping' ? 13 : 8;
        var avail = getAvailableUnits(t, dates);
        var unitName = t === 'glamping' ? 'Glamping' : 'Cabin';
        
        if (avail === 0) {
            openCustomModal({
                type: 'error',
                isAlert: true,
                title: 'Pemesanan Gagal',
                badge: 'Seluruh Unit Dipesan',
                message: 'Seluruh unit ' + unitName + ' di tanggal ini sudah dipesan oleh tamu reguler sehingga tidak tersedia untuk Paket Corporate. Silakan pilih tanggal lain.'
            });
            return;
        } else if (avail < maxUnits) {
            openCustomModal({
                type: 'warning',
                isAlert: false,
                title: 'Konfirmasi Ketersediaan Unit',
                badge: 'Peringatan Unit Terbatas',
                message: 'Jumlah unit ' + unitName + ' yang tersedia di tanggal ini hanya tersisa ' + avail + ' unit (dari total ' + maxUnits + ' unit) karena sebagian sudah dipesan oleh tamu reguler.',
                subtext: 'Apakah Anda yakin ingin tetap melanjutkan pemesanan Paket Corporate ini dengan harga yang sama?'
            }).then(function(confirmed){
                if(confirmed){
                    proceedCorporateBooking(id, t, dates);
                }
            });
            return;
        }

        proceedCorporateBooking(id, t, dates);
    };

    function proceedCorporateBooking(id, t, dates){
        var malam=nightState[t];
        var d=dates[0];
        var ci=d.getFullYear()+'-'+String(d.getMonth()+1).padStart(2,'0')+'-'+String(d.getDate()).padStart(2,'0');
        var url='/reservasi/overview/'+id+'?malam='+malam+'&pax='+pax+'&checkin='+ci+'&is_corporate=1';
        var loggedIn={{ Auth::check() ? 'true' : 'false' }};
        if(loggedIn){ window.location.href=url; }
        else{
            sessionStorage.setItem('pending_redirect',url);
            if(typeof openLoginModal==='function') openLoginModal();
            else {
                openCustomModal({
                    type: 'info',
                    isAlert: true,
                    title: 'Login Diperlukan',
                    badge: 'Autentikasi Pengguna',
                    message: 'Silakan log in terlebih dahulu untuk melanjutkan proses pemesanan.'
                });
            }
        }
    }

    /* ── Lightbox ─────────────────────────────────── */
    var lbImgs=[],lbIdx=0;
    window.openLb=function(t){
        lbImgs=CORP[t].images||[];
        if(!lbImgs.length) return;
        lbIdx=0; showLb();
        document.getElementById('corpLb').classList.add('show');
    };
    window.closeLb=function(){ document.getElementById('corpLb').classList.remove('show'); };
    window.lbNav=function(d){
        lbIdx=Math.max(0,Math.min(lbImgs.length-1,lbIdx+d));
        showLb();
    };
    function showLb(){
        document.getElementById('lbImg').src=lbImgs[lbIdx];
        document.getElementById('lbCount').textContent=(lbIdx+1)+' / '+lbImgs.length;
    }
    document.getElementById('corpLb').addEventListener('click',function(e){
        if(e.target===this) closeLb();
    });
})();
</script>
@endpush
@endsection
