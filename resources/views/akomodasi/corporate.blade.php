@extends('layouts.app')
@section('title', 'Paket Corporate & Gathering Kantor di Bogor - Landeuh Village')
@section('meta_description', 'Paket gathering kantor, outing perusahaan, dan outbound tepi sungai di Landeuh Village Bogor. Fasilitas lengkap 3x makan, api unggun, kapasitas besar, & suasana alam asri.')
@section('meta_keywords', 'paket gathering kantor bogor, tempat outing bogor, outbound tepi sungai bogor, family gathering bogor, paket corporate landeuh village')
@section('canonical_url', url('/paket-corporate'))
@section('hide_footer', true)
@section('content')

<style>
/* ── Page ──────────────────────────────────────────── */
.corp-page { background:#F8EDD8; min-height:100vh; padding-bottom:4rem; }

/* ── Hero ──────────────────────────────────────────── */
.corp-hero {
    background: linear-gradient(135deg,#2c3e2d 0%,#3a523a 60%,#4a6741 100%);
    padding: 3.5rem 1.5rem 5.5rem;
    text-align:center;
    position:relative;
    overflow:hidden;
}
.corp-badge {
    display:inline-flex; align-items:center; gap:.4rem;
    background:rgba(255,255,255,.18); border:1px solid rgba(255,255,255,.3);
    color:#ffffff; font-size:.7rem; font-weight:700; letter-spacing:.1em;
    text-transform:uppercase; padding:.35rem 1rem; border-radius:99px; margin-bottom:1rem;
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
}
.corp-hero h1 {
    font-size:clamp(1.8rem,5vw,3rem); font-weight:900; color:#fff;
    margin:0 0 .75rem; line-height:1.15;
}
.corp-hero p { color:rgba(255,255,255,.8); font-size:.95rem; max-width:520px; margin:0 auto; line-height:1.6; }
.corp-pills { 
    display:flex; align-items:center; justify-content:center; gap:.65rem; flex-wrap:wrap; 
    margin-top:1.5rem; margin-bottom:1rem;
}
.corp-pill {
    display:inline-flex; align-items:center; gap:.45rem;
    background:rgba(255,255,255,.15); border:1px solid rgba(255,255,255,.25);
    color:#ffffff; font-size:.78rem; font-weight:600;
    padding:.45rem 1rem; border-radius:99px;
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
    box-shadow: 0 2px 6px rgba(0,0,0,0.06);
    transition: background .2s;
}

/* ── Pax Bar ──────────────────────────────────────── */
.pax-bar {
    max-width:860px;
    margin:-2.25rem auto 0;
    padding:0 1rem;
    position:relative;
    z-index:20;
}
.pax-card {
    background:#fff;
    border-radius:1.25rem;
    box-shadow:0 20px 60px -10px rgba(0,0,0,.15);
    padding:1.1rem 1.5rem;
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:1.25rem;
}
.pax-info {
    display:flex;
    align-items:center;
    gap:.85rem;
}
.pax-icon {
    font-size:1.6rem;
    color:#3a523a;
    flex-shrink:0;
}
.pax-label-col { display:flex; flex-direction:column; }
.pax-label { font-size:.74rem; font-weight:800; color:#333; text-transform:uppercase; letter-spacing:.06em; }
.pax-hint { font-size:.66rem; color:#888; margin-top:.1rem; }
.pax-action-group {
    display:flex;
    align-items:center;
    gap:1.25rem;
    margin-left:auto;
}
.pax-ctrl {
    display:flex;
    align-items:center;
    gap:.5rem;
    background:#f8f9fa;
    border:1.5px solid #e9ecef;
    border-radius:.75rem;
    padding:.4rem .65rem;
    flex-shrink:0;
}
.pax-btn {
    width:30px;
    height:30px;
    border-radius:50%;
    border:none;
    font-size:1rem;
    font-weight:700;
    cursor:pointer;
    display:flex;
    align-items:center;
    justify-content:center;
    transition:.2s;
    flex-shrink:0;
}
.pax-btn.dec { background:#e9ecef; color:#555; }
.pax-btn.inc { background:#3a523a; color:#fff; }
.pax-btn.dec:hover { background:#dee2e6; }
.pax-btn.inc:hover { background:#2c402c; }
/* Typeable pax input */
.pax-val-input {
    font-size:1.45rem;
    font-weight:900;
    color:#3a523a;
    width:48px;
    text-align:center;
    border:none;
    background:transparent;
    outline:none;
    -moz-appearance:textfield;
}
.pax-val-input::-webkit-inner-spin-button,
.pax-val-input::-webkit-outer-spin-button { -webkit-appearance:none; margin:0; }
.pax-note {
    font-size:.72rem;
    color:#888;
    font-style:italic;
    text-align:right;
    line-height:1.35;
    white-space:nowrap;
}

@media (max-width: 640px) {
    .corp-hero {
        padding: 3rem 1rem 4.75rem;
    }
    .corp-pills {
        gap: .5rem;
        margin-top: 1.25rem;
        margin-bottom: .75rem;
    }
    .corp-pill {
        font-size: .74rem;
        padding: .4rem .85rem;
    }
    .pax-bar {
        margin: -1.75rem auto 0;
        padding: 0 .85rem;
    }
    .pax-card {
        padding:.95rem 1.1rem;
        flex-direction:column;
        align-items:stretch;
        gap:.85rem;
        border-radius:1.15rem;
    }
    .pax-info {
        display:flex;
        align-items:center;
        gap:.75rem;
        width:100%;
    }
    .pax-icon {
        font-size:1.45rem;
    }
    .pax-label {
        font-size:.72rem;
    }
    .pax-hint {
        font-size:.64rem;
    }
    .pax-action-group {
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:.5rem;
        width:100%;
        margin-left:0;
    }
    .pax-ctrl {
        padding:.35rem .5rem;
        gap:.35rem;
        border-radius:.65rem;
    }
    .pax-btn {
        width:28px;
        height:28px;
    }
    .pax-val-input {
        font-size:1.3rem;
        width:42px;
    }
    .pax-note {
        font-size:.67rem;
        line-height:1.3;
        white-space:normal;
        text-align:right;
        flex:1;
    }
}

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
            <div class="pax-info">
                <iconify-icon icon="lucide:users" class="pax-icon"></iconify-icon>
                <div class="pax-label-col">
                    <div class="pax-label">Jumlah Peserta</div>
                    <div class="pax-hint">Min 25 pax · Maks 150 pax</div>
                </div>
            </div>
            <div class="pax-action-group">
                <div class="pax-ctrl">
                    <button type="button" class="pax-btn dec" id="btnPaxDec" aria-label="Kurangi peserta"><iconify-icon icon="lucide:minus" style="font-size:.9rem"></iconify-icon></button>
                    <input type="number" class="pax-val-input" id="paxVal" min="25" max="150" value="25" aria-label="Jumlah peserta">
                    <button type="button" class="pax-btn inc" id="btnPaxInc" aria-label="Tambah peserta"><iconify-icon icon="lucide:plus" style="font-size:.9rem"></iconify-icon></button>
                </div>
                <div class="pax-note">Pax mempengaruhi<br>estimasi total harga</div>
            </div>
        </div>
    </div>

    {{-- Cards --}}
    <div class="corp-grid">
        @forelse($accommodations as $pkg)
        @php
            $k = 'pkg_' . $pkg->id;
            $imgs = is_array($pkg->gambar) ? $pkg->gambar : (json_decode($pkg->gambar ?? '[]', true) ?: []);
            $fas  = is_array($pkg->fasilitas) ? $pkg->fasilitas : (json_decode($pkg->fasilitas ?? '[]', true) ?: []);
            $mak  = is_array($pkg->makanan) ? $pkg->makanan : (json_decode($pkg->makanan ?? '[]', true) ?: []);
            $cat  = is_array($pkg->catatan) ? $pkg->catatan : (json_decode($pkg->catatan ?? '[]', true) ?: []);
            $jenisName = $pkg->jenis_akomodasi ?: 'Unit';
            $jenisSlug = strtolower(str_replace(' ', '', $jenisName));
            $maxUnits = $pkg->slot;
        @endphp
        <div class="corp-card">
            <div class="corp-photo" onclick="window.location.href='/akomodasi?jenis={{ urlencode($jenisName) }}'">
                <img src="{{ $imgs[0] ?? 'https://placehold.co/600x400/3a523a/fff?text='.urlencode($pkg->judul) }}" alt="{{ $pkg->judul }}">
                <div class="corp-photo-badge">{{ $jenisName }}</div>
                <div class="corp-photo-overlay">
                    <button class="corp-gallery-btn"><iconify-icon icon="lucide:layout-list" style="font-size:.9rem"></iconify-icon> Lihat Detail Unit</button>
                </div>
            </div>
            <div class="corp-body">
                <div>
                    <div class="corp-title">{{ $pkg->judul }}</div>
                    <div class="corp-sub">{{ $pkg->jenis }}</div>
                </div>
                <ul class="corp-feats">
                    @foreach(array_merge($fas, $mak) as $f)
                    <li><iconify-icon icon="lucide:check-circle-2" class="chk" style="font-size:.85rem"></iconify-icon> {{ $f }}</li>
                    @endforeach
                </ul>
                <div>
                    <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:.35rem;">
                        <div style="font-size:.67rem;font-weight:700;color:#555;">Pilih Tanggal</div>
                        <div id="avail-{{ $k }}" style="font-size:.6rem;font-weight:800;color:#2c7a2c;background:#e8f5e9;padding:.15rem .4rem;border-radius:.25rem;border:1px solid #c8dfc8;">Tersedia: {{ $maxUnits }} unit {{ $jenisName }}</div>
                    </div>
                    <div class="corp-date-row">
                        <div style="position:absolute;visibility:hidden;width:0;height:0;"><input type="text" id="fp-{{ $k }}"></div>
                        <button type="button" class="corp-date-btn" id="btn-date-{{ $k }}">
                            <iconify-icon icon="lucide:calendar-days" style="font-size:.95rem;flex-shrink:0"></iconify-icon>
                            <span id="date-text-{{ $k }}">Sesuaikan Tanggal</span>
                        </button>
                        <div class="nights-badge" id="nights-{{ $k }}"><iconify-icon icon="lucide:moon" style="font-size:.8rem"></iconify-icon> 1 Malam</div>
                    </div>
                </div>
                <div class="corp-price-box">
                    <div class="corp-per-pax" style="margin-bottom: 0.1rem;">Rp {{ number_format($pkg->harga_weekday,0,',','.') }}/pax/malam</div>
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <div class="corp-total-price" id="price-{{ $k }}">Rp {{ number_format(($pkg->harga_weekday ?? 0) * 25, 0, ',', '.') }}</div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 cursor-pointer hover:text-[#3a523a] transition" fill="currentColor" viewBox="0 0 24 24" onclick="openCorpPriceInfo('{{ addslashes($pkg->judul) }}', {{ $pkg->harga_weekday ?? 0 }}, {{ $pkg->harga_weekend ?? 0 }}, {{ $pkg->harga_highseason ?? 0 }})"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                    </div>
                    <div class="corp-est">Estimasi total</div>
                    <div class="corp-formula" id="formula-{{ $k }}">25 pax × 1 malam × Rp {{ number_format($pkg->harga_weekday,0,',','.') }}</div>
                </div>
                @if(count($cat))
                <div class="corp-notes">
                    @foreach($cat as $c)
                    <p><iconify-icon icon="ph:hand-pointing-bold" style="font-size:.85rem;flex-shrink:0;margin-top:1px"></iconify-icon> {{ $c }}</p>
                    @endforeach
                </div>
                @endif
                <div id="booked-{{ $k }}" style="display:none" class="booked-banner"><iconify-icon icon="lucide:alert-circle"></iconify-icon> Tanggal ini sudah penuh — pilih tanggal lain</div>
                <button class="corp-btn green" id="btn-pilih-{{ $k }}" onclick="pilihPaket({{ $pkg->id }}, '{{ $k }}')">
                    Pilih Paket
                </button>
            </div>
        </div>
        @empty
        <div style="grid-column:1/-1;text-align:center;padding:4rem 2rem;color:#888;">
            <p style="font-size:.9rem;font-weight:600">Data paket corporate belum tersedia.</p>
        </div>
        @endforelse
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

<!-- Price Info Modal -->
<div id="corpPriceInfoOverlay" class="fixed inset-0 z-[99999] bg-black/50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-200" onclick="closeCorpPriceInfo()">
    <div class="bg-white rounded-2xl p-6 shadow-2xl max-w-sm w-[90%] transform scale-95 transition-transform duration-200" id="corpPriceInfoModal" onclick="event.stopPropagation()">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-base font-bold text-gray-900">Detail Harga <span id="corpPriceModalTitle" class="font-normal text-gray-500 text-sm"></span></h3>
            <button onclick="closeCorpPriceInfo()" class="w-7 h-7 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center text-gray-500 transition cursor-pointer">&times;</button>
        </div>
        <div id="corpPriceInfoContent"></div>
        <div class="text-[10px] text-gray-400 mt-3 text-right italic">/pax/malam</div>
    </div>
</div>

@push('scripts')
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
<script>
(function(){
    @php
        $liburLandeuh = \App\Models\DateSetting::where('type', 'libur_landeuh')->get();
    @endphp
    var LIBUR_LANDEUH = @json($liburLandeuh ?? []);
    var DATE_SETTINGS = @json($dateSettings ?? []);

    /* ── Backend data ─────────────────────────────── */
    var CORP = {};
    @foreach($accommodations as $pkg)
    @php
        $k = 'pkg_' . $pkg->id;
        $jenisName = $pkg->jenis_akomodasi ?: 'Unit';
        $maxUnits = $pkg->slot;
        $indB = isset($indBookingsPerPackage[$pkg->id]) ? $indBookingsPerPackage[$pkg->id]->map(function($b){ return ['ci'=>(string)$b->check_in_date,'co'=>(string)$b->check_out_date,'st'=>$b->status]; })->toArray() : [];
        
        $pkgBlocked = $pkg->blocked_dates ?: [];
        $assocAccomBlocked = \App\Models\Accommodation::whereIn('id', $pkg->accommodation_ids ?? [])
            ->get()
            ->pluck('blocked_dates')
            ->filter()
            ->flatten(1)
            ->toArray();
        $mergedBlocked = array_merge($pkgBlocked, $assocAccomBlocked);
    @endphp
    CORP['{{ $k }}'] = {
        id: {{ $pkg->id }},
        judul: "{{ addslashes($pkg->judul) }}",
        hargaWeekday: {{ $pkg->harga_weekday ?? 0 }},
        hargaWeekend: {{ $pkg->harga_weekend ?? 0 }},
        hargaHighseason: {{ $pkg->harga_highseason ?? 0 }},
        harga: {{ $pkg->harga_weekday ?? 0 }},
        slot: {{ $pkg->slot ?? 0 }},
        jenisName: "{{ $jenisName }}",
        maxUnits: {{ $maxUnits }},
        images: @json(is_array($pkg->gambar) ? $pkg->gambar : (json_decode($pkg->gambar ?? '[]', true) ?: [])),
        bookings: @json($pkg->bookings->map(function($b){ return ['ci'=>(string)$b->check_in_date,'co'=>(string)$b->check_out_date,'st'=>$b->status]; })->toArray()),
        indBookings: @json($indB),
        blockedDates: @json($mergedBlocked)
    };
    @endforeach

    /* ── State ────────────────────────────────────── */
    var pax = 25;
    var dateState  = {};
    var nightState = {};
    var fpInstances = {};
    for (var key in CORP) {
        dateState[key] = null;
        nightState[key] = 1;
    }

    /* ── Utils ────────────────────────────────────── */
    function fmtRp(n){ return 'Rp ' + Math.round(n).toLocaleString('id-ID'); }

    function getDateType(dateObj) {
        var year = dateObj.getFullYear();
        var month = String(dateObj.getMonth() + 1).padStart(2, '0');
        var day = String(dateObj.getDate()).padStart(2, '0');
        var dateString = year + '-' + month + '-' + day;
        
        var daysIndo = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', "Jum'at", 'Sabtu'];
        var dayName = daysIndo[dateObj.getDay()];

        // 1. Check Highseason
        for (var i = 0; i < DATE_SETTINGS.length; i++) {
            var s = DATE_SETTINGS[i];
            if (s.type === 'highseason' && s.dates) {
                var dArr = s.dates.split(',').map(function(x){ return x.trim(); });
                if (dArr.indexOf(dateString) !== -1) return 'highseason';
            }
        }

        // 2. Check Weekend
        for (var j = 0; j < DATE_SETTINGS.length; j++) {
            var w = DATE_SETTINGS[j];
            if (w.type === 'weekend' && w.dates) {
                var wArr = w.dates.split(',').map(function(x){ return x.trim(); });
                if (wArr.indexOf(dateString) !== -1 || wArr.indexOf(dayName) !== -1) return 'weekend';
            }
        }

        // Fallback weekend: Friday (5) & Saturday (6)
        if (dateObj.getDay() === 5 || dateObj.getDay() === 6) return 'weekend';

        return 'weekday';
    }

    function calculateTotal(t) {
        var pkg = CORP[t];
        if (!pkg) return { total: 0, formula: '0 pax \u00d7 1 malam \u00d7 Rp 0' };

        var dates = dateState[t];
        var nights = nightState[t] || 1;

        if (!dates || dates.length < 2) {
            var rate = pkg.hargaWeekday || pkg.harga || 0;
            return {
                total: rate * pax * nights,
                formula: pax + ' pax \u00d7 ' + nights + ' malam \u00d7 ' + fmtRp(rate)
            };
        }

        var s = new Date(dates[0]); s.setHours(12, 0, 0, 0);
        var e = new Date(dates[1]); e.setHours(12, 0, 0, 0);
        var sumRatePerPax = 0;
        var nightCount = 0;

        for (var dt = new Date(s); dt < e; dt.setDate(dt.getDate() + 1)) {
            var dtType = getDateType(dt);
            var nRate = pkg.hargaWeekday || pkg.harga;
            if (dtType === 'highseason' && pkg.hargaHighseason) nRate = pkg.hargaHighseason;
            else if (dtType === 'weekend' && pkg.hargaWeekend) nRate = pkg.hargaWeekend;

            sumRatePerPax += nRate;
            nightCount++;
        }

        if (nightCount === 0) nightCount = nights;
        var grandTotal = sumRatePerPax * pax;
        var avgRate = Math.round(sumRatePerPax / nightCount);

        return {
            total: grandTotal,
            formula: pax + ' pax \u00d7 ' + nightCount + ' malam \u00d7 ' + fmtRp(avgRate)
        };
    }

    function updatePrice(t){
        if (!CORP[t]) return;
        var calc = calculateTotal(t);
        var priceEl = document.getElementById('price-' + t);
        var formulaEl = document.getElementById('formula-' + t);
        if (priceEl) priceEl.textContent = fmtRp(calc.total);
        if (formulaEl) formulaEl.textContent = calc.formula;
    }

    function isBooked(t, dates){
        if(!dates||dates.length<2) return false;
        var s=new Date(dates[0]); s.setHours(12,0,0,0);
        var e=new Date(dates[1]); e.setHours(12,0,0,0);
        var bks=CORP[t].bookings||[];
        for(var dt=new Date(s); dt<e; dt.setDate(dt.getDate()+1)){
            var tp=dt.getTime();

            // Blocked check
            var y = dt.getFullYear();
            var m = String(dt.getMonth() + 1).padStart(2, '0');
            var r = String(dt.getDate()).padStart(2, '0');
            var dateStr = y + '-' + m + '-' + r;

            // Check global Libur Landeuh
            var isLibur = false;
            for (var idx = 0; idx < LIBUR_LANDEUH.length; idx++) {
                var gl = LIBUR_LANDEUH[idx];
                if (gl.dates && gl.dates.indexOf(dateStr) !== -1) { isLibur = true; break; }
            }
            if (isLibur) return true;

            // Check specific package and unit blocked dates
            var blocked = CORP[t].blockedDates || [];
            for (var idx2 = 0; idx2 < blocked.length; idx2++) {
                var sb = blocked[idx2];
                if (sb.dates && sb.dates.indexOf(dateStr) !== -1) { isLibur = true; break; }
            }
            if (isLibur) return true;

            // Check direct corporate bookings
            for(var i=0;i<bks.length;i++){
                var b=bks[i];
                if(b.st==='failed'||b.st==='refunded') continue;
                var bi=new Date(b.ci); bi.setHours(12,0,0,0);
                var bo=new Date(b.co); bo.setHours(12,0,0,0);
                if(tp>=bi.getTime()&&tp<bo.getTime()) return true;
            }
            // Check individual bookings availability: block ONLY if ALL units of that type are booked
            var maxU = CORP[t].maxUnits;
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
        var maxU = CORP[t].maxUnits;
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

        var y = d.getFullYear();
        var m = String(d.getMonth() + 1).padStart(2, '0');
        var r = String(d.getDate()).padStart(2, '0');
        var dateStr = y + '-' + m + '-' + r;

        // Check global Libur Landeuh
        for (var idx = 0; idx < LIBUR_LANDEUH.length; idx++) {
            var gl = LIBUR_LANDEUH[idx];
            if (gl.dates && gl.dates.indexOf(dateStr) !== -1) return true;
        }

        // Check specific package and unit blocked dates
        var blocked = CORP[t].blockedDates || [];
        for (var idx2 = 0; idx2 < blocked.length; idx2++) {
            var sb = blocked[idx2];
            if (sb.dates && sb.dates.indexOf(dateStr) !== -1) return true;
        }

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
        var maxU = CORP[t].maxUnits;
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
        if (paxInput) paxInput.value = pax;
        for (var key in CORP) { updatePrice(key); }
    }

    var btnDec = document.getElementById('btnPaxDec');
    if (btnDec) {
        btnDec.addEventListener('click',function(){
            setPax(pax - 1);
        });
    }
    var btnInc = document.getElementById('btnPaxInc');
    if (btnInc) {
        btnInc.addEventListener('click',function(){
            setPax(pax + 1);
        });
    }
    if (paxInput) {
        paxInput.addEventListener('input', function(){
            var val = parseInt(this.value);
            if (!isNaN(val) && val >= 25 && val <= 150) {
                pax = val;
                for (var key in CORP) { updatePrice(key); }
            }
        });
        paxInput.addEventListener('blur', function(){
            setPax(parseInt(this.value) || 25);
        });
        paxInput.addEventListener('keydown', function(e){
            if(e.key === 'Enter') { this.blur(); }
        });
    }

    window.openCorpPriceInfo = function(name, hw, hwe, hhs) {
        var elTitle = document.getElementById('corpPriceModalTitle');
        var elContent = document.getElementById('corpPriceInfoContent');
        if (elTitle) elTitle.textContent = '(' + name + ')';
        if (elContent) {
            elContent.innerHTML = `
                <div class="flex items-center gap-3 py-2.5 border-b border-gray-100">
                    <div class="w-2 h-2 rounded-full shrink-0 bg-orange-500"></div>
                    <div class="font-semibold text-sm w-24 text-orange-600">Weekday</div>
                    <div class="font-bold text-sm flex-1 text-right text-gray-800">${fmtRp(hw)}</div>
                </div>
                <div class="flex items-center gap-3 py-2.5 border-b border-gray-100">
                    <div class="w-2 h-2 rounded-full shrink-0 bg-blue-500"></div>
                    <div class="font-semibold text-sm w-24 text-blue-600">Weekend</div>
                    <div class="font-bold text-sm flex-1 text-right text-gray-800">${fmtRp(hwe)}</div>
                </div>
                <div class="flex items-center gap-3 py-2.5">
                    <div class="w-2 h-2 rounded-full shrink-0 bg-red-500"></div>
                    <div class="font-semibold text-sm w-24 text-red-600">Highseason</div>
                    <div class="font-bold text-sm flex-1 text-right text-gray-800">${fmtRp(hhs)}</div>
                </div>
            `;
        }
        var overlay = document.getElementById('corpPriceInfoOverlay');
        var modal = document.getElementById('corpPriceInfoModal');
        if (overlay && modal) {
            overlay.classList.remove('opacity-0', 'pointer-events-none');
            overlay.classList.add('opacity-100');
            modal.classList.remove('scale-95');
            modal.classList.add('scale-100');
            document.body.style.overflow = 'hidden';
        }
    };

    window.closeCorpPriceInfo = function() {
        var overlay = document.getElementById('corpPriceInfoOverlay');
        var modal = document.getElementById('corpPriceInfoModal');
        if (overlay && modal) {
            overlay.classList.add('opacity-0', 'pointer-events-none');
            overlay.classList.remove('opacity-100');
            modal.classList.add('scale-95');
            modal.classList.remove('scale-100');
            document.body.style.overflow = '';
        }
    };

    /* ── Custom Modal Helper ────────────────────── */
    window.openCustomModal = function(options) {
        return new Promise(function(resolve) {
            var modal = document.getElementById('customConfirmModal');
            var box = document.getElementById('customConfirmBox');
            var header = document.getElementById('customConfirmHeader');
            var iconWrap = document.getElementById('customConfirmIconWrap');
            var icon = document.getElementById('customConfirmIcon');
            var title = document.getElementById('customConfirmTitle');
            var badge = document.getElementById('customConfirmBadge');
            var msg = document.getElementById('customConfirmMessage');
            var subtext = document.getElementById('customConfirmSubtext');
            var btnCancel = document.getElementById('btnCustomConfirmCancel');
            var btnOk = document.getElementById('btnCustomConfirmOk');

            if (!modal) {
                alert(options.message || options.title || 'Pemberitahuan');
                resolve(true);
                return;
            }

            var isAlertOnly = options.isAlert || false;

            if (title) title.textContent = options.title || 'Informasi';
            if (badge) badge.textContent = options.badge || 'Pemberitahuan';
            if (msg) msg.textContent = options.message || '';
            
            if (subtext) {
                if (options.subtext) {
                    subtext.textContent = options.subtext;
                    subtext.style.display = 'block';
                } else {
                    subtext.style.display = 'none';
                }
            }

            if (options.type === 'error') {
                if (header) header.className = 'p-6 text-center border-b border-gray-100 bg-red-50/70';
                if (iconWrap) iconWrap.className = 'w-14 h-14 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-3 shadow-inner';
                if (icon) icon.setAttribute('icon', 'lucide:x-circle');
                if (badge) badge.className = 'inline-block bg-red-100 text-red-800 text-xs font-extrabold px-3 py-1 rounded-full';
                if (btnOk) {
                    btnOk.className = 'w-full py-2.5 px-4 bg-red-600 hover:bg-red-700 text-white font-bold text-sm rounded-xl transition shadow cursor-pointer';
                    btnOk.textContent = options.okText || 'Tutup';
                }
            } else if (options.type === 'info') {
                if (header) header.className = 'p-6 text-center border-b border-gray-100 bg-blue-50/70';
                if (iconWrap) iconWrap.className = 'w-14 h-14 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-3 shadow-inner';
                if (icon) icon.setAttribute('icon', 'lucide:info');
                if (badge) badge.className = 'inline-block bg-blue-100 text-blue-800 text-xs font-extrabold px-3 py-1 rounded-full';
                if (btnOk) {
                    btnOk.className = 'w-full py-2.5 px-4 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl transition shadow cursor-pointer';
                    btnOk.textContent = options.okText || 'Mengerti';
                }
            } else {
                // Default Warning / Confirm
                if (header) header.className = 'p-6 text-center border-b border-gray-100 bg-amber-50/70';
                if (iconWrap) iconWrap.className = 'w-14 h-14 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center mx-auto mb-3 shadow-inner';
                if (icon) icon.setAttribute('icon', 'lucide:alert-triangle');
                if (badge) badge.className = 'inline-block bg-amber-100 text-amber-800 text-xs font-extrabold px-3 py-1 rounded-full';
                if (btnOk) {
                    btnOk.className = 'w-1/2 py-2.5 px-4 bg-[#3a523a] hover:bg-[#2c402c] text-white font-bold text-sm rounded-xl transition shadow cursor-pointer';
                    btnOk.textContent = options.okText || 'Ya, Lanjutkan';
                }
            }

            if (btnCancel && btnOk) {
                if (isAlertOnly) {
                    btnCancel.style.display = 'none';
                    btnOk.classList.remove('w-1/2');
                    btnOk.classList.add('w-full');
                } else {
                    btnCancel.style.display = 'block';
                    btnOk.classList.remove('w-full');
                    btnOk.classList.add('w-1/2');
                }
            }

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';

            setTimeout(function() {
                if (box) {
                    box.classList.remove('scale-90', 'opacity-0');
                    box.classList.add('scale-100', 'opacity-100');
                }
            }, 10);

            function close(res) {
                if (box) {
                    box.classList.remove('scale-100', 'opacity-100');
                    box.classList.add('scale-90', 'opacity-0');
                }
                setTimeout(function() {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    document.body.style.overflow = '';
                    if (btnCancel) btnCancel.onclick = null;
                    if (btnOk) btnOk.onclick = null;
                    resolve(res);
                }, 150);
            }

            if (btnCancel) btnCancel.onclick = function() { close(false); };
            if (btnOk) btnOk.onclick = function() { close(true); };
        });
    };

    /* ── Pilih Paket ──────────────────────────────── */
    window.pilihPaket = function(id, t) {
        var dates = dateState[t];
        if (!dates || dates.length < 2) {
            if (fpInstances[t]) {
                fpInstances[t].open();
            } else {
                var btn = document.getElementById('btn-date-' + t);
                if (btn) btn.click();
            }
            openCustomModal({
                type: 'info',
                isAlert: true,
                title: 'Pilih Tanggal',
                badge: 'Tanggal Belum Dipilih',
                message: 'Silakan tentukan tanggal Check-in dan Check-out pada kalender terlebih dahulu untuk melanjutkan pemesanan.'
            });
            return;
        }

        if (isBooked(t, dates)) {
            openCustomModal({
                type: 'error',
                isAlert: true,
                title: 'Tanggal Tidak Tersedia',
                badge: 'Sudah Penuh',
                message: 'Tanggal yang Anda pilih sudah dipesan oleh rombongan Corporate lain. Silakan pilih tanggal lain.'
            });
            return;
        }
        
        var maxUnits = CORP[t].maxUnits;
        var avail = getAvailableUnits(t, dates);
        var unitName = CORP[t].jenisName;
        
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
                if (confirmed) {
                    proceedCorporateBooking(id, t, dates);
                }
            });
            return;
        }

        proceedCorporateBooking(id, t, dates);
    };

    function proceedCorporateBooking(id, t, dates) {
        var malam = nightState[t] || 1;
        var d = dates[0];
        var ci = d.getFullYear() + '-' + String(d.getMonth() + 1).padStart(2, '0') + '-' + String(d.getDate()).padStart(2, '0');
        var url = '/reservasi/overview/' + id + '?malam=' + malam + '&pax=' + pax + '&checkin=' + ci + '&is_corporate=1';
        var loggedIn = {{ Auth::check() ? 'true' : 'false' }};
        if (loggedIn) {
            window.location.href = url;
        } else {
            sessionStorage.setItem('pending_redirect', url);
            if (typeof openLoginModal === 'function') {
                openLoginModal();
            } else {
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

    /* ── Init flatpickr ───────────────────────────── */
    window.updateFpPopupFooter = function(instance, selectedDates) {
        if (!instance || !instance.calendarContainer) return;
        var footer = instance.calendarContainer.querySelector('.fp-custom-footer');
        if (!footer) {
            footer = document.createElement('div');
            footer.className = 'fp-custom-footer';
            footer.style.cssText = 'padding: 8px 10px; background: #f8fafc; border-top: 1px solid #e2e8f0; font-size: clamp(9px, 2.7vw, 11px); color: #334155; font-weight: 600; display: flex; align-items: center; justify-content: space-between; gap: 4px; border-bottom-left-radius: 1.2rem; border-bottom-right-radius: 1.2rem; box-sizing: border-box; white-space: nowrap; flex-wrap: nowrap; overflow: hidden;';
            footer.innerHTML = `
                <div style="display:inline-flex; align-items:center; gap:3px; white-space:nowrap; min-width:0; flex-shrink:1;">
                    <span style="color:#059669; font-weight:700; flex-shrink:0; white-space:nowrap;">Check-in:</span>
                    <span class="fp-in-val" style="color:#0f172a; font-weight:700; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">Belum dipilih</span>
                </div>
                <div style="width:1px; height:12px; background:#cbd5e1; flex-shrink:0; margin:0 2px;"></div>
                <div style="display:inline-flex; align-items:center; gap:3px; white-space:nowrap; min-width:0; flex-shrink:1; justify-content:flex-end;">
                    <span style="color:#d97706; font-weight:700; flex-shrink:0; white-space:nowrap;">Check-out:</span>
                    <span class="fp-out-val" style="color:#0f172a; font-weight:700; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">Belum dipilih</span>
                </div>
            `;
            instance.calendarContainer.appendChild(footer);
        }
        var inVal = footer.querySelector('.fp-in-val');
        var outVal = footer.querySelector('.fp-out-val');

        function formatFpDate(d) {
            if (!d) return 'Belum dipilih';
            if (window.innerWidth < 400) {
                return d.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
            }
            return d.toLocaleDateString('id-ID', { weekday: 'short', day: 'numeric', month: 'short', year: 'numeric' });
        }

        if (!selectedDates || selectedDates.length === 0) {
            if (inVal) inVal.innerText = 'Belum dipilih';
            if (outVal) outVal.innerText = 'Belum dipilih';
        } else if (selectedDates.length === 1) {
            if (inVal) inVal.innerText = formatFpDate(selectedDates[0]);
            if (outVal) outVal.innerText = 'Pilih Check-out';

            setTimeout(function() {
                var days = instance.calendarContainer.querySelectorAll('.flatpickr-day');
                days.forEach(function(day) {
                    if (day.dateObj) {
                        var dObj = new Date(day.dateObj);
                        dObj.setHours(0,0,0,0);
                        var sObj = new Date(selectedDates[0]);
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
            if (inVal) inVal.innerText = formatFpDate(selectedDates[0]);
            if (outVal) outVal.innerText = formatFpDate(selectedDates[1]);
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
        if(!input||!btn||typeof flatpickr === 'undefined') return;

        var maxUnits=CORP[t].maxUnits;
        var unitName=CORP[t].jenisName;

        var fp;
        fp = flatpickr(input,{
            mode:'range',
            minDate:'today',
            positionElement: btn,
            position: window.innerWidth > 768 ? 'top left' : 'auto',
            showMonths: window.innerWidth>768?2:1,
            locale: (typeof flatpickr.l10ns !== 'undefined' && flatpickr.l10ns.id) ? 'id' : 'default',
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

                if (sel.length === 1) {
                    if (txtEl) txtEl.textContent = 'In: ' + sel[0].toLocaleDateString('id-ID', { day: 'numeric', month: 'short' });
                } else if (sel.length === 2) {
                    dateState[t]=sel;
                    var diff=Math.abs(sel[1]-sel[0]);
                    var nights=Math.max(1,Math.ceil(diff/86400000));
                    nightState[t]=nights;
                    var opts={day:'numeric',month:'short',year:'2-digit'};
                    if (txtEl) txtEl.textContent=sel[0].toLocaleDateString('id-ID',opts)+' \u2013 '+sel[1].toLocaleDateString('id-ID',opts);
                    if (nEl) nEl.innerHTML='<iconify-icon icon="lucide:moon" style="font-size:.8rem"></iconify-icon> '+nights+' Malam';
                    var booked=isBooked(t,sel);
                    if (bkEl) bkEl.style.display=booked?'block':'none';
                    if (ctaEl) ctaEl.className='corp-btn '+(booked?'dis':'green');
                    
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

        fpInstances[t] = fp;
        btn.addEventListener('click',function(e){ e.stopPropagation(); fp.toggle(); });
    }

    /* ── Bootstrap Initialization ───────────────── */
    function initCorporateApp() {
        for (var key in CORP) {
            initFp(key);
            updatePrice(key);
        }
    }

    if (typeof flatpickr !== 'undefined') {
        initCorporateApp();
    } else {
        var checkCount = 0;
        var checkFp = setInterval(function() {
            checkCount++;
            if (typeof flatpickr !== 'undefined') {
                clearInterval(checkFp);
                initCorporateApp();
            } else if (checkCount > 50) {
                clearInterval(checkFp);
                console.error('Flatpickr failed to load.');
            }
        }, 50);
    }

    /* ── Lightbox ─────────────────────────────────── */
    var lbImgs=[],lbIdx=0;
    window.openLb=function(t){
        lbImgs=CORP[t].images||[];
        if(!lbImgs.length) return;
        lbIdx=0; showLb();
        document.getElementById('corpLb').classList.add('show');
        document.body.style.overflow = 'hidden';
    };
    window.closeLb=function(){ 
        document.getElementById('corpLb').classList.remove('show'); 
        document.body.style.overflow = '';
    };
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
