@extends('layouts.booking')
@section('title', 'Overview Reservasi - Landeuh Village Riverside')
@section('content')
<style>
.ov-page{background:#F8EDD8;min-height:100vh;position:relative;overflow-x:hidden}
.ov-header{background:transparent;border-bottom:1px solid rgba(0,0,0,0.08);padding:0.75rem 1rem;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:50;backdrop-filter:blur(10px)}
@media(min-width:768px){.ov-header{padding:1rem 1.5rem}}
.ov-logo{display:flex;align-items:center}
.ov-logo img{height:36px;object-fit:contain}
@media(min-width:768px){.ov-logo img{height:42px}}
.ov-steps{display:flex;align-items:center;gap:0.4rem;font-size:0.8rem;font-weight:600}
@media(min-width:768px){.ov-steps{gap:0.5rem;font-size:0.85rem}}
.ov-steps .step{display:flex;align-items:center;gap:0.35rem}
.ov-steps .num{width:22px;height:22px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.75rem;font-weight:700;color:#fff}
@media(min-width:768px){.ov-steps .num{width:24px;height:24px}}
.ov-steps .num.active{background:#3a523a}
.ov-steps .num.inactive{background:#bbb}
.ov-steps .line{width:25px;height:2px;background:#ccc}
@media(min-width:768px){.ov-steps .line{width:40px}}
.ov-service-title{text-align:center;padding:0.75rem 1rem 0.25rem}
.ov-service-title h1{font-size:1.05rem;font-weight:800;color:#222;line-height:1.35}
@media(min-width:768px){.ov-service-title h1{font-size:1.25rem}}
.ov-back{display:flex;align-items:center;gap:0.5rem;font-weight:700;font-size:0.95rem;cursor:pointer;color:#333;margin:0.5rem 0 0.75rem}
.ov-back:hover{color:#3a523a}
.ov-section-title{display:flex;align-items:center;gap:0.5rem;font-size:1.1rem;font-weight:800;color:#333;margin-top:0.5rem;margin-bottom:1rem}
.ov-form-group{margin-bottom:0.85rem}
.ov-form-group label{display:block;font-size:0.82rem;font-weight:600;color:#444;margin-bottom:0.25rem}
.ov-form-group label .req{color:#e53e3e}
.ov-form-group input,.ov-form-group select{width:100%;padding:0.55rem 0.75rem;border:none;border-bottom:2px solid #ccc;background:transparent;font-size:0.9rem;outline:none;transition:border-color 0.2s}
.ov-form-group input:focus{border-bottom-color:#3a523a}
.ov-form-group .hint{font-size:0.7rem;color:#999;margin-top:0.2rem}
.ov-form-row{display:grid;grid-template-columns:1fr 1fr;gap:0.75rem}
.ov-checkbox{display:flex;align-items:center;gap:0.6rem;cursor:pointer;font-size:0.85rem;font-weight:600;margin:0.65rem 0}
.ov-checkbox input[type=checkbox]{width:18px;height:18px;accent-color:#3a523a;cursor:pointer}
.ov-tambahan{margin-top:0.4rem}
.ov-catatan{background:linear-gradient(to right, rgb(248, 237, 216) 0%, transparent 100%);border-radius:0.75rem;padding:0.75rem 0.85rem;margin:0.85rem 0}
.ov-catatan .item{display:flex;align-items:flex-start;gap:0.5rem;font-size:0.75rem;color:#666;margin-bottom:0.35rem}
.ov-btn-simpan{background:#3a523a;color:#fff;border:none;padding:0.8rem 2.5rem;border-radius:0.75rem;font-size:0.95rem;font-weight:700;cursor:pointer;transition:0.2s;display:block;margin:1.5rem auto 0}
.ov-btn-simpan:hover{background:#2c402c}
.ov-sidebar{position:sticky;top:80px}

/* Left container card */
.ov-left-container{background:rgba(253,246,227,0.7);backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,0.4);border-radius:1rem;padding:0.85rem 1rem;box-shadow:0 2px 12px rgba(0,0,0,0.06);margin-bottom:1rem}
@media(min-width:768px){.ov-left-container{padding:1.25rem 1.5rem}}

/* RIGHT Sidebar Cards — cream */
.ov-card{background:rgba(253,246,227,0.7);backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,0.4);border-radius:1rem;box-shadow:0 2px 12px rgba(0,0,0,0.06);margin-bottom:1rem;overflow:hidden}
.ov-card-inner{padding:0.85rem 1rem}
@media(min-width:768px){.ov-card-inner{padding:1.15rem 1.25rem}}
.ov-card h3{font-size:1.05rem;font-weight:800;display:flex;align-items:center;gap:0.5rem;margin-top:0.5rem;margin-bottom:1rem}

/* Ribbon alert */
.ov-ribbon{background:#c0392b;color:#fff;padding:0.5rem 0.85rem;font-size:0.75rem;font-weight:600;border-radius:0.75rem 0.75rem 0 0}
@media(min-width:768px){.ov-ribbon{padding:0.55rem 1.15rem;font-size:0.78rem}}

/* Check-in/Check-out highlight — glass with border-radius: 0 */
.ov-checkin-highlight{background:rgba(255,255,255,0.55);backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,0.7);border-radius:0;padding:0.75rem 0.65rem;margin-bottom:0.75rem}
@media(min-width:768px){.ov-checkin-highlight{padding:0.85rem 1rem}}
.ov-checkin-row{display:flex;justify-content:space-between;align-items:center;position:relative;gap:0.25rem}
.ov-checkin-row .ci-label{font-size:0.65rem;color:#e53e3e;font-weight:700;text-transform:uppercase;letter-spacing:0.5px}
.ov-checkin-row .ci-date{font-size:0.78rem;font-weight:700;color:#333;line-height:1.25}
@media(min-width:768px){.ov-checkin-row .ci-date{font-size:0.85rem}}
.ov-checkin-row .ci-time{font-size:0.65rem;color:#999;margin-top:2px}
.ov-checkin-row .ci-mid{text-align:center;font-size:0.75rem;color:#666;flex-shrink:0;padding:0 0.25rem}
.ov-checkin-row .ci-mid .arrow{font-size:1.1rem;color:#999;line-height:1}
.ov-guest-info{font-size:0.8rem;color:#555;margin:0.6rem 0 0;display:flex;align-items:center;gap:0.4rem}

/* Price highlight — glass with border-radius: 0 */
.ov-price-highlight{background:rgba(255,255,255,0.55);backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,0.7);border-radius:0;padding:0.75rem 0.85rem;margin-bottom:0.75rem}
@media(min-width:768px){.ov-price-highlight{padding:1rem}}
.ov-price-row{display:flex;justify-content:space-between;align-items:center;gap:0.75rem;font-size:0.8rem;color:#555;padding:0.2rem 0}
.ov-price-row span:last-child{white-space:nowrap;text-align:right;flex-shrink:0}
.ov-price-total{border-top:2px solid #3a523a;padding-top:0.6rem;margin-top:0.5rem}
.ov-price-total .amount{font-size:1.15rem;font-weight:800;color:#c0392b;white-space:nowrap}
@media(min-width:768px){.ov-price-total .amount{font-size:1.35rem}}
.ov-btn-lanjut{width:100%;background:#3a523a;color:#fff;border:none;padding:0.85rem;border-radius:0.75rem;font-size:1rem;font-weight:700;cursor:pointer;transition:0.2s;margin-top:0.75rem}
.ov-btn-lanjut:hover{background:#2c402c}
.modal-overlay{position:fixed;inset:0;background:rgba(0,0,0,0.4);z-index:100;display:none;align-items:center;justify-content:center}
.modal-overlay.show{display:flex}
.modal-box{background:#fff;border-radius:1rem;padding:1.5rem;max-width:550px;width:90%;box-shadow:0 20px 60px rgba(0,0,0,0.2);max-height:80vh;overflow-y:auto}
.modal-box h4{font-size:1rem;font-weight:800;margin-bottom:0.75rem}
.modal-box p{font-size:0.85rem;color:#555;margin-bottom:0.5rem}
.modal-box .close{text-align:right}
.modal-box .close button{background:#3a523a;color:#fff;border:none;padding:0.5rem 1.5rem;border-radius:0.5rem;cursor:pointer;font-weight:600}
.modal-loading{background:#fdf6e3;border-radius:1rem;padding:2rem;text-align:center;max-width:320px;width:90%}
.modal-loading h4{font-weight:800;font-size:1rem;margin-bottom:0.5rem}
.modal-loading p{color:#666;font-size:0.9rem}
@media(max-width:768px){.ov-form-row{grid-template-columns:1fr}.ov-main-grid{flex-direction:column!important}}
</style>

<div class="ov-page">
    {{-- Batik Ornaments --}}
    <img src="{{ asset('images/assets_lain/batik.png') }}" class="absolute top-20 -left-8 w-36 opacity-20 pointer-events-none rotate-12 z-0" alt="">
    <img src="{{ asset('images/assets_lain/batik.png') }}" class="absolute top-1/3 -right-10 w-40 opacity-15 pointer-events-none -rotate-12 scale-x-[-1] z-0" alt="">
    <img src="{{ asset('images/assets_lain/batik.png') }}" class="absolute bottom-10 left-1/4 w-32 opacity-10 pointer-events-none rotate-45 z-0" alt="">

    {{-- Header --}}
    <div class="ov-header">
        <div class="ov-logo">
            <a href="/" class="flex items-center">
                <img src="{{ asset('images/logo-landeuh.png') }}" alt="Logo">
            </a>
        </div>
        <div class="ov-steps">
            <div class="step"><div class="num active">1</div> Review</div>
            <div class="line"></div>
            <div class="step"><div class="num inactive">2</div> Bayar</div>
        </div>
    </div>

    {{-- Nama Layanan Terpilih (Centered below top bar) --}}
    <div class="ov-service-title relative z-10 max-w-7xl mx-auto px-4">
        <h1 id="headerTitle">Loading...</h1>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-1 relative z-10">
        <div class="ov-back" onclick="window.history.back()">← Kembali</div>

        <div class="ov-main-grid" style="display:flex;gap:1.5rem;align-items:flex-start">
            {{-- LEFT: All Content in Single Container --}}
            <div style="flex:1.4;min-width:0">
                {{-- Data Pemesan & Catatan Section --}}
                <div class="ov-left-container">
                    <div class="ov-section-title">
                        <iconify-icon icon="lucide:mail" class="text-lg"></iconify-icon> Data Pemesan
                    </div>
                    <p style="font-size:0.82rem;color:#666;margin-bottom:1rem">Pastikan seluruh data terisi dengan lengkap dan benar.</p>

                    <div class="ov-form-group">
                        <label>Nama Lengkap<span class="req">*</span></label>
                        <input type="text" id="namaLengkap" placeholder="" value="{{ Auth::check() ? Auth::user()->name : '' }}">
                        <div class="hint">Sesuai KTP/paspor/SIM (tanpa tanda baca atau gelar)</div>
                    </div>
                    <div class="ov-form-row">
                        <div class="ov-form-group">
                            <label>Nomor Handphone (WhatsApp)<span class="req">*</span></label>
                            <input type="text" id="noHp" placeholder="" value="{{ Auth::check() ? Auth::user()->phone : '' }}">
                            <div class="hint">Contoh: 08xxxxxxxxxx</div>
                        </div>
                        <div class="ov-form-group">
                            <label>Email<span class="req">*</span></label>
                            <input type="email" id="email" placeholder="" value="{{ Auth::check() ? Auth::user()->email : '' }}" {{ Auth::check() ? 'readonly style=background-color:rgba(0,0,0,0.05);cursor:not-allowed;' : '' }}>
                            <div class="hint">Contoh: email@example.com</div>
                        </div>
                    </div>

                    <label class="ov-checkbox"><input type="checkbox" id="chkUntukSaya"> Pesanan ini untuk saya?</label>

                    <div id="untukSiapaSection">
                        <div class="ov-form-group">
                            <label>Untuk Siapa?<span class="req">*</span></label>
                            <input type="text" id="untukSiapa" placeholder="">
                            <div class="hint">Sesuai KTP/paspor/SIM (tanpa tanda baca atau gelar)</div>
                        </div>
                    </div>
                    <div id="untukSayaStatement" style="display:none;font-size:0.85rem;color:#3a523a;font-weight:600;margin:0.5rem 0;padding:0.5rem 0.75rem;background:#e8f5e9;border-radius:0.5rem"></div>

                    <label class="ov-checkbox"><input type="checkbox" id="chkTambahan"> Apakah ada tambahan orang?</label>

                    <div id="tambahanSection" style="display:none" class="ov-tambahan mt-2 pt-2 border-t border-gray-100">
                        <div class="flex items-center justify-between text-xs sm:text-sm text-gray-700 py-1.5 border-b border-gray-100/60">
                            <div class="flex items-center gap-2 min-w-0">
                                <iconify-icon icon="lucide:baby" class="text-base text-gray-500 shrink-0"></iconify-icon>
                                <span class="font-medium text-gray-800">Anak di bawah 5 tahun <span class="text-emerald-700 font-bold">Free</span></span>
                            </div>
                            <span class="text-[11px] sm:text-xs text-gray-500 font-medium whitespace-nowrap shrink-0 ml-2">(maks 2 orang)</span>
                        </div>
                        <div class="flex items-center justify-between py-2 border-b border-gray-100/60">
                            <div class="flex items-center gap-2 min-w-0">
                                <iconify-icon icon="lucide:user" class="text-base text-gray-500 shrink-0"></iconify-icon>
                                <span class="text-xs sm:text-sm font-medium text-gray-800">Anak di atas 5 tahun</span>
                            </div>
                            <div class="flex items-center gap-2.5 shrink-0">
                                <button type="button" id="btn-min-anak" onclick="adj('anak',-1)" class="w-7 h-7 sm:w-8 sm:h-8 flex items-center justify-center rounded-full border border-red-300 text-red-500 hover:bg-red-50 transition cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed" disabled>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 sm:h-4 sm:w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4" /></svg>
                                </button>
                                <span class="text-xs sm:text-sm font-bold w-4 text-center text-gray-800" id="valAnak">0</span>
                                <button type="button" id="btn-plus-anak" onclick="adj('anak',1)" class="w-7 h-7 sm:w-8 sm:h-8 flex items-center justify-center rounded-full border border-emerald-400 text-emerald-600 hover:bg-emerald-50 transition cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 sm:h-4 sm:w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                                </button>
                            </div>
                        </div>
                        <div class="flex items-center justify-between py-2">
                            <div class="flex items-center gap-2 min-w-0">
                                <iconify-icon icon="lucide:users" class="text-base text-gray-500 shrink-0"></iconify-icon>
                                <span class="text-xs sm:text-sm font-medium text-gray-800">Dewasa di atas 17 tahun</span>
                            </div>
                            <div class="flex items-center gap-2.5 shrink-0">
                                <button type="button" id="btn-min-dewasa" onclick="adj('dewasa',-1)" class="w-7 h-7 sm:w-8 sm:h-8 flex items-center justify-center rounded-full border border-red-300 text-red-500 hover:bg-red-50 transition cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed" disabled>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 sm:h-4 sm:w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4" /></svg>
                                </button>
                                <span class="text-xs sm:text-sm font-bold w-4 text-center text-gray-800" id="valDewasaTambahan">0</span>
                                <button type="button" id="btn-plus-dewasa" onclick="adj('dewasa',1)" class="w-7 h-7 sm:w-8 sm:h-8 flex items-center justify-center rounded-full border border-emerald-400 text-emerald-600 hover:bg-emerald-50 transition cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 sm:h-4 sm:w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Divider --}}
                    <div style="border-top:1px solid rgba(0,0,0,0.1);margin:1.25rem 0"></div>

                    {{-- Catatan --}}
                    <div class="ov-section-title">
                        <iconify-icon icon="lucide:clipboard-list" class="text-lg"></iconify-icon> Catatan
                    </div>
                    <div class="ov-catatan" id="catatanBox">
                        <div class="item"><iconify-icon icon="ph:hand-pointing-bold" class="text-sm mt-0.5 text-gray-500 shrink-0"></iconify-icon> Anak di bawah umur 5 tahun Free, maksimal 2 anak.</div>
                        <div class="item"><iconify-icon icon="ph:hand-pointing-bold" class="text-sm mt-0.5 text-gray-500 shrink-0"></iconify-icon> Tambahan anak di atas 5 tahun 75k/orang (Include Extramattrass Lantai Ketebalan 5cm)</div>
                        <div class="item"><iconify-icon icon="ph:hand-pointing-bold" class="text-sm mt-0.5 text-gray-500 shrink-0"></iconify-icon> Tambahan dewasa di atas 17 tahun 100k/orang (Include Extramattrass Lantai Ketebalan 5cm)</div>
                    </div>
                    
                    {{-- Kebijakan Reservasi --}}
                    <div class="mt-4 mb-2">
                        <label class="flex items-center gap-2.5 cursor-pointer select-none">
                            <input type="checkbox" id="chkKebijakan" class="w-5 h-5 rounded accent-[#3a523a] cursor-pointer shrink-0">
                            <span class="text-sm sm:text-base font-bold text-gray-800 whitespace-nowrap">Setujui Kebijakan Reservasi</span>
                        </label>
                        <div class="pl-7 pt-1">
                            <a onclick="document.getElementById('modalKebijakan').classList.add('show')" class="text-xs sm:text-sm text-blue-600 hover:text-blue-800 underline cursor-pointer inline-block font-medium">Klik baca kebijakan</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT: Sidebar --}}
            <div style="flex:0.8;min-width:300px" class="ov-sidebar">
                {{-- Validasi Reservasi Card --}}
                <div class="ov-card">
                    {{-- Red Ribbon --}}
                    <div class="ov-ribbon" id="redRibbonSlots">
                        <div class="flex items-center gap-2 w-full text-xs font-semibold whitespace-nowrap overflow-hidden">
                            <iconify-icon icon="lucide:alert-triangle" class="text-sm shrink-0"></iconify-icon>
                            <span class="truncate">Jangan sampai kehabisan! Sisa <strong id="sisaKamar">{{ $remainingSlots ?? 3 }}</strong> kamar lagi</span>
                        </div>
                    </div>
                    <div class="ov-card-inner">
                        <h3>
                            <iconify-icon icon="lucide:calendar-check" class="text-lg"></iconify-icon> Validasi Reservasi
                        </h3>
                        {{-- Check-in / Check-out Highlight --}}
                        <div class="ov-checkin-highlight">
                            <div class="ov-checkin-row">
                                <div class="flex-1 min-w-0">
                                    <div class="ci-label">Check-in</div>
                                    <div class="ci-date" id="dynCheckin">Selasa, 28 April 2026</div>
                                    <div class="ci-time">Dari 14.00</div>
                                </div>
                                <div class="ci-mid shrink-0 px-2 sm:px-3 text-center">
                                    <div id="malamText" class="whitespace-nowrap font-semibold text-[11px] sm:text-xs text-gray-600">1 malam</div>
                                    <div class="arrow">→</div>
                                </div>
                                <div class="flex-1 min-w-0 text-right">
                                    <div class="ci-label">Check-out</div>
                                    <div class="ci-date" id="dynCheckout">Rabu, 29 April 2026</div>
                                    <div class="ci-time">Hingga 12.00</div>
                                </div>
                            </div>
                        </div>
                        <div class="ov-guest-info" id="guestInfo">
                            <iconify-icon icon="lucide:user-check" class="text-base"></iconify-icon>
                            <span id="guestInfoText">4 Dewasa</span>
                        </div>
                    </div>
                </div>

                {{-- Verifikasi Harga Card --}}
                <div class="ov-card">
                    <div class="ov-card-inner">
                        <h3>
                            <iconify-icon icon="lucide:tag" class="text-lg"></iconify-icon> Verifikasi Harga
                        </h3>
                        {{-- Price Highlight --}}
                        <div class="ov-price-highlight">
                            <div id="priceBreakdown">
                                <div class="ov-price-row"><span id="priceLabel">Harga kamar (1 malam)</span><span id="priceValue">IDR 1.200.000</span></div>
                            </div>
                            <div class="ov-price-total">
                                <div class="text-sm font-bold text-gray-900 mb-0.5">Total</div>
                                <div class="flex items-baseline justify-between gap-2">
                                    <span id="totalMalamText" class="text-xs text-gray-500 font-medium whitespace-nowrap">1 kamar, 1 malam</span>
                                    <span class="amount" id="totalHarga">IDR 1.200.000</span>
                                </div>
                            </div>
                        </div>
                        <button class="ov-btn-lanjut" id="btnLanjutkan" type="button">Lanjutkan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Kebijakan --}}
    <div class="modal-overlay" id="modalKebijakan">
        <div class="modal-box">
            <h4>Syarat & Ketentuan Layanan</h4>
            <div style="font-size: 0.85rem; color: #333; line-height: 1.6; text-align: left; margin: 1rem 0 1.5rem 0;">
                <p>Syarat & ketentuan berikut mengatur penggunaan sistem pemesanan online dan aturan menginap di Landeuh Village Riverside. Dengan melakukan reservasi, Anda dianggap telah menyetujui seluruh ketentuan ini.</p>
                
                <div style="padding: 1rem; background-color: #FFFDF6; border: 1px solid #EEDC9A; border-radius: 0.75rem; margin: 1rem 0;">
                    <h5 style="font-weight: 800; color: #8B4A1A; display: flex; align-items: center; gap: 0.5rem; margin-top: 0; margin-bottom: 0.5rem; font-size: 0.8rem;">
                        <span>⚠️</span> INFORMASI PENTING (Reschedule & Pembatalan)
                    </h5>
                    <ul style="list-style-type: disc; padding-left: 1.25rem; font-size: 0.75rem; color: #1c1917; margin: 0;">
                        <li style="font-weight: 600; margin-bottom: 0.25rem;">Seluruh pesanan yang telah dikonfirmasi dan dibayar bersifat <span style="color: #dc2626; font-weight: 800;">TIDAK DAPAT DIBATALKAN / DI-REFUND</span> dengan alasan apa pun.</li>
                        <li style="margin-bottom: 0.25rem;">Pelanggan <span style="color: #047857; font-weight: 800;">DAPAT mengajukan reschedule</span> tanggal menginap.</li>
                        <li style="margin-bottom: 0.25rem;">Pengajuan reschedule wajib diajukan oleh pelanggan <strong>minimal H-3</strong> sebelum tanggal check-in.</li>
                        <li style="margin-bottom: 0.25rem;">Persetujuan reschedule didasarkan pada ketersediaan akomodasi di tanggal baru serta memerlukan persetujuan resmi dari pihak Admin.</li>
                        <li style="margin-bottom: 0;">Reschedule hanya berlaku dengan <strong>durasi menginap (jumlah malam) yang sama</strong> dengan pemesanan awal.</li>
                    </ul>
                </div>

                <div style="margin-bottom: 1rem;">
                    <h5 style="font-weight: 700; color: #000; margin-bottom: 0.25rem; font-size: 0.8rem;">1. Ketentuan Check-In & Check-Out</h5>
                    <ul style="list-style-type: disc; padding-left: 1.25rem; font-size: 0.75rem; color: #444; margin: 0;">
                        <li>Waktu Check-In resmi: pukul 14.00 – 21.00 WIB.</li>
                        <li>Waktu Check-Out maksimal: pukul 12.00 WIB.</li>
                        <li>Check-in di luar jam operasional standar wajib diinformasikan terlebih dahulu ke pihak pengelola.</li>
                    </ul>
                </div>

                <div style="margin-bottom: 1rem;">
                    <h5 style="font-weight: 700; color: #000; margin-bottom: 0.25rem; font-size: 0.8rem;">2. Aturan Umum Penginapan</h5>
                    <ul style="list-style-type: disc; padding-left: 1.25rem; font-size: 0.75rem; color: #444; margin: 0;">
                        <li>Dilarang keras membawa senjata tajam, senjata api, narkoba, bahan kimia berbahaya, dan hewan peliharaan ke dalam area Landeuh Village.</li>
                        <li>Tamu berkewajiban menjaga kebersihan, ketertiban, dan ketenangan demi kenyamanan bersama.</li>
                        <li>Kerusakan fasilitas akibat kelalaian tamu akan dikenakan denda sesuai dengan nilai kerusakan.</li>
                    </ul>
                </div>

                <div style="margin-bottom: 0;">
                    <h5 style="font-weight: 700; color: #000; margin-bottom: 0.25rem; font-size: 0.8rem;">3. Pembayaran & Konfirmasi</h5>
                    <p style="font-size: 0.75rem; color: #444; margin: 0;">Reservasi Anda hanya dianggap sah setelah pembayaran diverifikasi oleh sistem kami. Segala bentuk keterlambatan pembayaran dapat menyebabkan reservasi dibatalkan otomatis.</p>
                </div>
            </div>
            <div class="close"><button onclick="document.getElementById('modalKebijakan').classList.remove('show')">Tutup</button></div>
        </div>
    </div>

    {{-- Modal Loading --}}
    <div class="modal-overlay" id="modalLoading">
        <div class="modal-loading">
            <h4>Mohon Tunggu</h4>
            <p>Kami sedang memproses permintaan anda</p>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script src="{{ asset('js/akomodasi-data.js') }}"></script>
<script>
(function(){
    // Parse accommodation ID from URL
    const urlParts = window.location.pathname.split('/');
    const akoId = parseInt(urlParts[urlParts.length - 1]) || 1;

    // Parse malam parameter
    const params = new URLSearchParams(window.location.search);
    const malam = parseInt(params.get('malam')) || 1;
    const pax = parseInt(params.get('pax')) || null;

    // Parse checkin date parameter (menghindari pergeseran timezone UTC)
    const checkinParam = params.get('checkin');
    let displayDate = new Date();
    if (checkinParam) {
        const dateParts = checkinParam.split('-');
        if (dateParts.length === 3) {
            displayDate = new Date(parseInt(dateParts[0]), parseInt(dateParts[1]) - 1, parseInt(dateParts[2]));
        }
    }
    const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    const mNames = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    if (!isNaN(displayDate.getTime())) {
        const formatted = `${days[displayDate.getDay()]}, ${displayDate.getDate()} ${mNames[displayDate.getMonth()]} ${displayDate.getFullYear()}`;
        document.getElementById('dynCheckin').textContent = formatted;
    }

    // Find the selected accommodation from database variables passed from controller
    const accommodationRaw = @json($accommodation);
    const akoItem = {
        id: accommodationRaw.id,
        jenis: accommodationRaw.jenis,
        judul: accommodationRaw.judul,
        maxOrang: accommodationRaw.max_orang,
        hargaWeekday: parseFloat(accommodationRaw.harga_weekday),
        hargaWeekend: parseFloat(accommodationRaw.harga_weekend),
        hargaHighseason: parseFloat(accommodationRaw.harga_highseason),
        catatan: typeof accommodationRaw.catatan === 'string' ? JSON.parse(accommodationRaw.catatan) : (accommodationRaw.catatan || []),
        fasilitas: typeof accommodationRaw.fasilitas === 'string' ? JSON.parse(accommodationRaw.fasilitas) : (accommodationRaw.fasilitas || []),
        makanan: typeof accommodationRaw.makanan === 'string' ? JSON.parse(accommodationRaw.makanan) : (accommodationRaw.makanan || []),
        gambar: typeof accommodationRaw.gambar === 'string' ? JSON.parse(accommodationRaw.gambar) : (accommodationRaw.gambar || [])
    };

    const dateSettings = @json($dateSettings ?? []);

    const weekdayDates = dateSettings.find(s => s.type === 'weekday')?.dates?.split(',').map(s => s.trim()) || [];
    const weekendDates = dateSettings.find(s => s.type === 'weekend')?.dates?.split(',').map(s => s.trim()) || [];
    
    const highseasonDates = [];
    dateSettings.forEach(s => {
        if (s.type === 'highseason' && s.dates) {
            s.dates.split(',').forEach(dStr => {
                const trimmed = dStr.trim();
                if (trimmed && !highseasonDates.includes(trimmed)) {
                    highseasonDates.push(trimmed);
                }
            });
        }
    });

    const anakPrice = 75000;
    const dewasaPrice = 100000;
    const maxOrang = akoItem.maxOrang;

    // Calculate dynamic stay dates & night-by-night pricing
    const datesOfStay = [];
    let checkinDate = new Date(); // fallback to today
    if (checkinParam) {
        const parts = checkinParam.split('-');
        if (parts.length === 3) {
            checkinDate = new Date(parseInt(parts[0]), parseInt(parts[1]) - 1, parseInt(parts[2]));
        }
    }

    for (let i = 0; i < malam; i++) {
        const d = new Date(checkinDate);
        d.setDate(d.getDate() + i);
        const yyyy = d.getFullYear();
        const mm = String(d.getMonth() + 1).padStart(2, '0');
        const dd = String(d.getDate()).padStart(2, '0');
        datesOfStay.push(`${yyyy}-${mm}-${dd}`);
    }

    let totalBasePrice = 0;
    const priceBreakdownDetails = [];
    
    datesOfStay.forEach(dateStr => {
        let price = akoItem.hargaWeekday;
        let typeLabel = 'Weekday';
        
        if (highseasonDates.includes(dateStr)) {
            price = akoItem.hargaHighseason;
            typeLabel = 'Highseason';
        } else if (weekendDates.includes(dateStr)) {
            price = akoItem.hargaWeekend;
            typeLabel = 'Weekend';
        } else if (weekdayDates.includes(dateStr)) {
            price = akoItem.hargaWeekday;
            typeLabel = 'Weekday';
        } else {
            // Day of week fallback
            const parts = dateStr.split('-');
            const d = new Date(parseInt(parts[0]), parseInt(parts[1]) - 1, parseInt(parts[2]));
            const dayOfWeek = d.getDay();
            if (dayOfWeek === 5 || dayOfWeek === 6) { // Friday or Saturday
                price = akoItem.hargaWeekend;
                typeLabel = 'Weekend';
            } else {
                price = akoItem.hargaWeekday;
                typeLabel = 'Weekday';
            }
        }
        
        if (akoItem.jenis && (akoItem.jenis === 'Corporate Glamping' || akoItem.jenis === 'Corporate Cabin') && pax) {
            price = price * pax;
        }
        
        totalBasePrice += price;
        priceBreakdownDetails.push({ date: dateStr, price: price, label: typeLabel });
    });

    // Update header title with dynamic data
    if (akoItem.jenis && (akoItem.jenis === 'Corporate Glamping' || akoItem.jenis === 'Corporate Cabin') && pax) {
        document.getElementById('headerTitle').textContent = `${akoItem.judul} (${pax} pax)`;
    } else {
        document.getElementById('headerTitle').textContent = `${akoItem.judul} (${maxOrang} pax)`;
    }

    // Update guest info
    if (akoItem.jenis && (akoItem.jenis === 'Corporate Glamping' || akoItem.jenis === 'Corporate Cabin') && pax) {
        document.getElementById('guestInfoText').textContent = `${pax} Pax`;
        const chkTambahanLabel = document.getElementById('chkTambahan')?.closest('label');
        if (chkTambahanLabel) chkTambahanLabel.style.display = 'none';
        
        const redRibbon = document.getElementById('redRibbonSlots');
        if (redRibbon) redRibbon.style.display = 'none';
    } else {
        document.getElementById('guestInfoText').textContent = `${maxOrang} Dewasa`;
    }

    // Update malam labels
    document.getElementById('malamText').textContent = `${malam} malam`;
    document.getElementById('totalMalamText').textContent = `1 kamar, ${malam} malam`;

    // Calculate checkout date
    const checkinStr = document.getElementById('dynCheckin').textContent;
    const parts = checkinStr.split(', ');
    if(parts.length === 2) {
        const dateStr = parts[1];
        const months = {'Januari':0,'Februari':1,'Maret':2,'April':3,'Mei':4,'Juni':5,'Juli':6,'Agustus':7,'September':8,'Oktober':9,'November':10,'Desember':11};
        const dParts = dateStr.split(' ');
        if(dParts.length === 3) {
            let d = new Date(parseInt(dParts[2]), months[dParts[1]], parseInt(dParts[0]));
            d.setDate(d.getDate() + malam);
            const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
            const mNames = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
            document.getElementById('dynCheckout').textContent = `${days[d.getDay()]}, ${d.getDate()} ${mNames[d.getMonth()]} ${d.getFullYear()}`;
        }
    }

    // Update price labels
    function fmt(n){ return 'IDR ' + n.toLocaleString('id-ID'); }
    if (akoItem.jenis && (akoItem.jenis === 'Corporate Glamping' || akoItem.jenis === 'Corporate Cabin') && pax) {
        document.getElementById('priceLabel').textContent = `Harga paket ${akoItem.judul} - ${pax} pax (${malam} malam)`;
    } else {
        document.getElementById('priceLabel').textContent = `Harga kamar ${akoItem.judul} - ${maxOrang} pax (${malam} malam)`;
    }
    document.getElementById('priceValue').textContent = fmt(totalBasePrice);
    document.getElementById('totalHarga').textContent = fmt(totalBasePrice);

    // Update catatan from data
    if(akoItem.catatan && akoItem.catatan.length > 0){
        const box = document.getElementById('catatanBox');
        box.innerHTML = akoItem.catatan.map(c =>
            `<div class="item"><iconify-icon icon="ph:hand-pointing-bold" class="text-sm mt-0.5 text-gray-500 shrink-0"></iconify-icon> ${c}</div>`
        ).join('');
    }

    let anak=0, dewasa=0;

    window.adj=function(type,delta){
        if(type==='anak'){
            anak=Math.max(0,Math.min(5,anak+delta));
            document.getElementById('valAnak').textContent=anak;
            const btnMin = document.getElementById('btn-min-anak');
            const btnPlus = document.getElementById('btn-plus-anak');
            if(btnMin) btnMin.disabled = (anak <= 0);
            if(btnPlus) btnPlus.disabled = (anak >= 5);
        } else {
            dewasa=Math.max(0,Math.min(5,dewasa+delta));
            document.getElementById('valDewasaTambahan').textContent=dewasa;
            const btnMin = document.getElementById('btn-min-dewasa');
            const btnPlus = document.getElementById('btn-plus-dewasa');
            if(btnMin) btnMin.disabled = (dewasa <= 0);
            if(btnPlus) btnPlus.disabled = (dewasa >= 5);
        }
        updateHarga();
    };

    // Automatically set up chkUntukSaya behavior if logged in via backend
    const isLoggedInBackend = {{ Auth::check() ? 'true' : 'false' }};
    if (isLoggedInBackend) {
        document.getElementById('chkUntukSaya').checked = true;
        document.getElementById('untukSiapaSection').style.display = 'none';
        const stmt = document.getElementById('untukSayaStatement');
        if (stmt) {
            stmt.style.display = 'block';
            stmt.textContent = 'Pesanan untuk: ' + '{{ Auth::check() ? Auth::user()->name : "" }}';
        }
    }

    // Interactive UI
    document.getElementById('chkUntukSaya').addEventListener('change',function(){
        const sec=document.getElementById('untukSiapaSection');
        const stmt=document.getElementById('untukSayaStatement');
        if(this.checked){
            sec.style.display='none';
            stmt.style.display='block';
            stmt.textContent='Pesanan untuk: '+(document.getElementById('namaLengkap').value||'(isi nama lengkap dulu)');
        }else{
            sec.style.display='block';
            stmt.style.display='none';
        }
    });

    document.getElementById('namaLengkap').addEventListener('input',function(){
        const chk=document.getElementById('chkUntukSaya');
        if(chk.checked){
            document.getElementById('untukSayaStatement').textContent='Pesanan untuk: '+(this.value||'(isi nama lengkap dulu)');
        }
    });

    document.getElementById('chkTambahan').addEventListener('change',function(){
        document.getElementById('tambahanSection').style.display=this.checked?'block':'none';
        if(!this.checked){
            anak=0;
            dewasa=0;
            document.getElementById('valAnak').textContent='0';
            document.getElementById('valDewasaTambahan').textContent='0';
            const btnMinAnak = document.getElementById('btn-min-anak');
            const btnMinDewasa = document.getElementById('btn-min-dewasa');
            if(btnMinAnak) btnMinAnak.disabled = true;
            if(btnMinDewasa) btnMinDewasa.disabled = true;
        }
        updateHarga();
    });

    // Fungsi update harga
    function updateHarga() {
        let info = `${maxOrang} Dewasa`;
        if (akoItem.jenis && (akoItem.jenis === 'Corporate Glamping' || akoItem.jenis === 'Corporate Cabin') && pax) {
            info = `${pax} Pax`;
        } else {
            if(anak>0)info+=` + ${anak} Anak (di atas 5 tahun)`;
            if(dewasa>0)info+=` + ${dewasa} Dewasa (di atas 17 tahun)`;
        }
        document.getElementById('guestInfoText').textContent=info;

        let breakdownLabel = `Harga kamar ${akoItem.judul} - ${maxOrang} pax (${malam} malam)`;
        if (akoItem.jenis && (akoItem.jenis === 'Corporate Glamping' || akoItem.jenis === 'Corporate Cabin') && pax) {
            breakdownLabel = `Harga paket ${akoItem.judul} - ${pax} pax (${malam} malam)`;
        }
        let breakdown = `<div class="flex items-center justify-between text-xs sm:text-sm font-bold text-gray-900 pb-1.5 border-b border-gray-200/60 mb-2"><span>${breakdownLabel}</span><span class="whitespace-nowrap font-bold text-gray-900 ml-2">${fmt(totalBasePrice)}</span></div>`;
        
        breakdown += `<div class="space-y-1.5 my-2 pl-2 border-l-2 border-emerald-600/30">`;
        priceBreakdownDetails.forEach((night) => {
            const parts = night.date.split('-');
            const d = new Date(parseInt(parts[0]), parseInt(parts[1]) - 1, parseInt(parts[2]));
            const mNamesShort = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
            const formattedDate = `${d.getDate()} ${mNamesShort[d.getMonth()]}`;
            
            let fontColor = '#f97316'; // Weekday (Orange)
            if (night.label === 'Weekend') {
                fontColor = '#3b82f6'; // Weekend (Blue)
            } else if (night.label === 'Highseason') {
                fontColor = '#ef4444'; // Highseason (Red)
            }
            
            breakdown += `
            <div class="flex items-center justify-between text-xs py-0.5">
                <div class="flex items-center gap-2 min-w-0">
                    <span class="text-stone-700 font-medium whitespace-nowrap text-[11px] sm:text-xs">${formattedDate}</span>
                    <span style="color:${fontColor};" class="text-[10px] font-bold shrink-0">${night.label}</span>
                </div>
                <span class="text-stone-600 font-semibold whitespace-nowrap text-right ml-2 text-[11px] sm:text-xs">${fmt(night.price)}</span>
            </div>`;
        });
        breakdown += `</div>`;

        let total = totalBasePrice;
        if(anak>0){
            const subAnak = anak * anakPrice * malam;
            total += subAnak;
            breakdown += `
            <div class="flex items-start justify-between gap-2 text-xs py-1.5 px-1 border-t border-gray-200/50 my-1">
                <div class="min-w-0">
                    <div class="font-semibold text-gray-800 text-xs">Tambahan: Anak (&gt;5 thn)</div>
                    <div class="text-[10px] text-gray-500">${anak} orang × ${malam} malam</div>
                </div>
                <span class="font-bold text-gray-800 whitespace-nowrap text-right shrink-0 text-xs">${fmt(subAnak)}</span>
            </div>`;
        }
        if(dewasa>0){
            const subDewasa = dewasa * dewasaPrice * malam;
            total += subDewasa;
            breakdown += `
            <div class="flex items-start justify-between gap-2 text-xs py-1.5 px-1 border-t border-gray-200/50 my-1">
                <div class="min-w-0">
                    <div class="font-semibold text-gray-800 text-xs">Tambahan: Dewasa (&gt;17 thn)</div>
                    <div class="text-[10px] text-gray-500">${dewasa} orang × ${malam} malam</div>
                </div>
                <span class="font-bold text-gray-800 whitespace-nowrap text-right shrink-0 text-xs">${fmt(subDewasa)}</span>
            </div>`;
        }
        document.getElementById('priceBreakdown').innerHTML=breakdown;
        document.getElementById('totalHarga').textContent=fmt(total);
    }

    // Render price breakdown immediately on page load
    updateHarga();

    document.getElementById('btnLanjutkan').addEventListener('click',function(){
        const nama = document.getElementById('namaLengkap').value.trim();
        const hp = document.getElementById('noHp').value.trim();
        const em = document.getElementById('email').value.trim();
        const chkSaya = document.getElementById('chkUntukSaya').checked;
        const untukSiapa = document.getElementById('untukSiapa')?.value?.trim() || '';
        const kebijakan = document.getElementById('chkKebijakan').checked;

        if(!nama){alert('Nama Lengkap wajib diisi');return;}
        if(!hp){alert('Nomor Handphone wajib diisi');return;}
        if(!em){alert('Email wajib diisi');return;}
        if(!chkSaya && !untukSiapa){alert('Untuk Siapa wajib diisi');return;}
        if(!kebijakan){alert('Harap setujui kebijakan reservasi');return;}

        // Pastikan harga terupdate sebelum lanjut
        updateHarga();

        const modal=document.getElementById('modalLoading');
        modal.classList.add('show');
        
        // Bersihkan data pembayaran lama agar tidak ada kebocoran cache browser
        sessionStorage.removeItem('res_va');
        sessionStorage.removeItem('res_payment_method');
        sessionStorage.removeItem('res_minimarket');
        sessionStorage.removeItem('res_payment_status');
        sessionStorage.removeItem('res_snap_token');
        sessionStorage.removeItem('res_booking_no');
        
        const guestName = chkSaya ? nama : untukSiapa;

        // Siapkan data untuk dikirim ke backend MySQL
        const isCorp = {{ isset($isCorporate) && $isCorporate ? 'true' : 'false' }};
        const payload = {
            pemesan_nama: nama,
            pemesan_telp: hp,
            pemesan_email: em,
            nama_tamu: guestName,
            check_in_date: document.getElementById('dynCheckin').textContent,
            malam: malam,
            jumlah_pax: pax,
            tambahan_anak: anak,
            tambahan_dewasa: dewasa,
            total: document.getElementById('totalHarga').textContent,
            metode_pembayaran: 'pending'
        };
        if (isCorp) {
            payload.corporate_package_id = akoId;
        } else {
            payload.accommodation_id = akoId;
        }

        // Kirim data via AJAX POST ke database
        fetch('/reservasi/store', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(payload)
        })
        .then(response => {
            if(!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Simpan data ke sessionStorage untuk dibaca di halaman pembayaran mockup
                const finalJudul = (akoItem.jenis && (akoItem.jenis === 'Corporate Glamping' || akoItem.jenis === 'Corporate Cabin') && pax)
                    ? `${akoItem.judul} (${pax} pax)`
                    : akoItem.judul;
                sessionStorage.setItem('res_judul', finalJudul);
                sessionStorage.setItem('res_nama', nama);
                sessionStorage.setItem('res_hp', hp);
                sessionStorage.setItem('res_email', em);
                sessionStorage.setItem('res_tamu', guestName);
                sessionStorage.setItem('res_guest', document.getElementById('guestInfoText').textContent);
                sessionStorage.setItem('res_malam', malam);
                sessionStorage.setItem('res_checkin', document.getElementById('dynCheckin').textContent);
                sessionStorage.setItem('res_checkout', document.getElementById('dynCheckout').textContent);
                sessionStorage.setItem('res_total', document.getElementById('totalHarga').textContent);
                sessionStorage.setItem('res_akoId', akoId);
                sessionStorage.setItem('res_is_corporate', isCorp ? '1' : '0');
                
                if (isCorp) {
                    sessionStorage.setItem('res_corp_judul', akoItem.judul);
                    sessionStorage.setItem('res_corp_fasilitas', JSON.stringify(akoItem.fasilitas));
                    sessionStorage.setItem('res_corp_makanan', JSON.stringify(akoItem.makanan));
                    sessionStorage.setItem('res_corp_gambar', akoItem.gambar && akoItem.gambar.length > 0 ? akoItem.gambar[0] : '');
                }
                
                // Simpan nomor pesanan resmi hasil generate MySQL
                sessionStorage.setItem('res_booking_no', data.booking.no_pesanan);
                sessionStorage.setItem('res_snap_token', data.booking.snap_token);
                sessionStorage.setItem('res_created_at', data.booking.created_at);

                setTimeout(() => {
                    window.location.href = '/reservasi/metode-pembayaran/' + akoId;
                }, 1000);
            } else {
                alert('Gagal: ' + data.message);
                modal.classList.remove('show');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan: ' + (error.message || 'Koneksi gagal'));
            modal.classList.remove('show');
        });
    });

    // Hide the loading modal if the user came back via history (back button)
    window.addEventListener('pageshow', function(event) {
        const loadingModal = document.getElementById('modalLoading');
        if (loadingModal) {
            loadingModal.classList.remove('show');
        }
    });
})();
</script>
@endpush
@endsection
