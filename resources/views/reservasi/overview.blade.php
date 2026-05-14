@extends('layouts.booking')
@section('title', 'Overview Reservasi - Landeuh Village Riverside')
@section('content')
<style>
.ov-page{background:#F8EDD8;min-height:100vh;position:relative}
.ov-header{background:transparent;border-bottom:1px solid rgba(0,0,0,0.08);padding:0.75rem 1.5rem;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:50;backdrop-filter:blur(10px)}
.ov-logo{display:flex;align-items:center;gap:1rem}
.ov-logo img{height:40px}
.ov-logo .divider{width:1px;height:30px;background:#ccc}
.ov-logo h2{font-size:1.1rem;font-weight:700;color:#333}
.ov-steps{display:flex;align-items:center;gap:0.5rem;font-size:0.85rem;font-weight:600}
.ov-steps .step{display:flex;align-items:center;gap:0.35rem}
.ov-steps .num{width:24px;height:24px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.75rem;font-weight:700;color:#fff}
.ov-steps .num.active{background:#3a523a}
.ov-steps .num.inactive{background:#bbb}
.ov-steps .line{width:40px;height:2px;background:#ccc}
.ov-back{display:flex;align-items:center;gap:0.5rem;font-weight:700;font-size:0.95rem;cursor:pointer;color:#333;margin:1.5rem 0 1rem}
.ov-back:hover{color:#3a523a}
.ov-login-bar{background:#3a523a;color:#fff;padding:0.6rem 1.2rem;border-radius:0.75rem;font-size:0.85rem;margin-bottom:1rem}
.ov-login-bar strong{font-weight:700}
.ov-section-title{display:flex;align-items:center;gap:0.5rem;font-size:1.15rem;font-weight:800;color:#333;margin-bottom:0.75rem}
.ov-form-group{margin-bottom:1rem}
.ov-form-group label{display:block;font-size:0.85rem;font-weight:600;color:#444;margin-bottom:0.3rem}
.ov-form-group label .req{color:#e53e3e}
.ov-form-group input,.ov-form-group select{width:100%;padding:0.65rem 0.8rem;border:none;border-bottom:2px solid #ccc;background:transparent;font-size:0.9rem;outline:none;transition:border-color 0.2s}
.ov-form-group input:focus{border-bottom-color:#3a523a}
.ov-form-group .hint{font-size:0.72rem;color:#999;margin-top:0.2rem}
.ov-form-row{display:grid;grid-template-columns:1fr 1fr;gap:1rem}
.ov-checkbox{display:flex;align-items:center;gap:0.6rem;cursor:pointer;font-size:0.9rem;font-weight:600;margin:0.75rem 0}
.ov-checkbox input[type=checkbox]{width:20px;height:20px;accent-color:#3a523a;cursor:pointer}
.ov-tambahan{margin-top:0.5rem}
.ov-tambahan .row{display:flex;align-items:center;gap:1rem;margin-bottom:0.5rem;font-size:0.85rem;color:#555}
.ov-tambahan .row .icon{font-size:1.1rem}
.ov-tambahan .row .controls{display:flex;align-items:center;gap:0.5rem;margin-left:auto}
.ov-tambahan .row .controls button{width:28px;height:28px;border-radius:50%;border:none;font-size:1rem;font-weight:700;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:0.2s}
.ov-tambahan .row .controls .minus{background:#3a523a;color:#fff}
.ov-tambahan .row .controls .plus{background:#c8a951;color:#fff}
.ov-tambahan .row .controls span{font-weight:700;min-width:20px;text-align:center}
.ov-catatan{background:linear-gradient(to right, rgb(248, 237, 216) 0%, transparent 100%);border-radius:0.75rem;padding:1rem;margin:1rem 0}
.ov-catatan .item{display:flex;align-items:flex-start;gap:0.5rem;font-size:0.78rem;color:#666;margin-bottom:0.4rem}
.ov-kebijakan{display:flex;align-items:center;gap:0.6rem;font-size:0.9rem;font-weight:600;margin:1rem 0}
.ov-kebijakan a{color:#2563eb;font-size:0.78rem;cursor:pointer;text-decoration:underline}
.ov-btn-simpan{background:#3a523a;color:#fff;border:none;padding:0.8rem 2.5rem;border-radius:0.75rem;font-size:0.95rem;font-weight:700;cursor:pointer;transition:0.2s;display:block;margin:1.5rem auto 0}
.ov-btn-simpan:hover{background:#2c402c}
.ov-sidebar{position:sticky;top:80px}

/* Left container card */
.ov-left-container{background:rgba(253,246,227,0.7);backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,0.4);border-radius:1rem;padding:1.5rem 2rem;box-shadow:0 2px 12px rgba(0,0,0,0.06);margin-bottom:1rem}

/* RIGHT Sidebar Cards — cream */
.ov-card{background:rgba(253,246,227,0.7);backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,0.4);border-radius:1rem;box-shadow:0 2px 12px rgba(0,0,0,0.06);margin-bottom:1rem;overflow:hidden}
.ov-card-inner{padding:1.5rem}
.ov-card h3{font-size:1.05rem;font-weight:800;display:flex;align-items:center;gap:0.5rem;margin-bottom:1rem}

/* Ribbon alert */
.ov-ribbon{background:#c0392b;color:#fff;padding:0.55rem 1.2rem;font-size:0.78rem;display:flex;align-items:center;gap:0.5rem;font-weight:600;border-radius:0.75rem 0.75rem 0 0}
.ov-ribbon iconify-icon{font-size:1rem}

/* Check-in/Check-out highlight — glass */
.ov-checkin-highlight{background:rgba(255,255,255,0.4);backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,0.5);padding:1rem;margin-bottom:1rem}
.ov-checkin-row{display:flex;justify-content:space-between;align-items:center;position:relative}
.ov-checkin-row .ci-label{font-size:0.65rem;color:#e53e3e;font-weight:700;text-transform:uppercase;letter-spacing:0.5px}
.ov-checkin-row .ci-date{font-size:0.85rem;font-weight:700;color:#333}
.ov-checkin-row .ci-time{font-size:0.65rem;color:#999}
.ov-checkin-row .ci-mid{text-align:center;font-size:0.75rem;color:#888}
.ov-checkin-row .ci-mid .arrow{font-size:1.2rem}
.ov-guest-info{font-size:0.8rem;color:#555;margin:0.75rem 0 0;display:flex;align-items:center;gap:0.4rem}

/* Price highlight — glass */
.ov-price-highlight{background:rgba(255,255,255,0.4);backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,0.5);padding:1rem;margin-bottom:0.75rem}
.ov-price-row{display:flex;justify-content:space-between;gap:1rem;font-size:0.82rem;color:#555;padding:0.3rem 0}
.ov-price-row span:last-child{white-space:nowrap;text-align:right;flex-shrink:0}
.ov-price-total{display:flex;justify-content:space-between;align-items:center;border-top:2px solid #3a523a;padding-top:0.75rem;margin-top:0.5rem}
.ov-price-total .label{font-size:0.9rem;font-weight:700}
.ov-price-total .label small{display:block;font-size:0.7rem;color:#999;font-weight:400}
.ov-price-total .amount{font-size:1.3rem;font-weight:800;color:#c0392b}
.ov-btn-lanjut{width:100%;background:#3a523a;color:#fff;border:none;padding:0.85rem;border-radius:0.75rem;font-size:1rem;font-weight:700;cursor:pointer;transition:0.2s;margin-top:0.75rem}
.ov-btn-lanjut:hover{background:#2c402c}
.modal-overlay{position:fixed;inset:0;background:rgba(0,0,0,0.4);z-index:100;display:none;align-items:center;justify-content:center}
.modal-overlay.show{display:flex}
.modal-box{background:#fff;border-radius:1rem;padding:1.5rem;max-width:400px;width:90%;box-shadow:0 20px 60px rgba(0,0,0,0.2)}
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
            <img src="{{ asset('images/logo-landeuh.png') }}" alt="Logo">
            <div class="divider"></div>
            <h2 id="headerTitle">Loading...</h2>
        </div>
        <div class="ov-steps">
            <div class="step"><div class="num active">1</div> Review</div>
            <div class="line"></div>
            <div class="step"><div class="num inactive">2</div> Bayar</div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-2 relative z-10">
        <div class="ov-back" onclick="window.history.back()">← Kembali</div>
        <div class="ov-login-bar" id="dynLoginBar">Log-in sebagai <strong>Ari Rahman (Google)</strong></div>

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
                        <input type="text" id="namaLengkap" placeholder="">
                        <div class="hint">Sesuai KTP/paspor/SIM (tanpa tanda baca atau gelar)</div>
                    </div>
                    <div class="ov-form-row">
                        <div class="ov-form-group">
                            <label>Nomor Handphone<span class="req">*</span></label>
                            <input type="text" id="noHp" placeholder="">
                            <div class="hint">Contoh: 08xxxxxxxxxx</div>
                        </div>
                        <div class="ov-form-group">
                            <label>Email<span class="req">*</span></label>
                            <input type="email" id="email" placeholder="">
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

                    <div id="tambahanSection" style="display:none" class="ov-tambahan">
                        <div class="row">
                            <iconify-icon icon="lucide:baby" class="text-base text-gray-600"></iconify-icon>
                            Anak di bawah 5 tahun Free <span style="color:#999;font-size:0.75rem;margin-left:0.5rem">(maks 2 anak)</span>
                        </div>
                        <div class="row">
                            <iconify-icon icon="lucide:user" class="text-base text-gray-600"></iconify-icon>
                            Anak di atas 5 tahun
                            <div class="controls"><button class="minus" onclick="adj('anak',-1)">−</button><span id="valAnak">0</span><button class="plus" onclick="adj('anak',1)">+</button></div>
                        </div>
                        <div class="row">
                            <iconify-icon icon="lucide:users" class="text-base text-gray-600"></iconify-icon>
                            Dewasa di atas 17 tahun
                            <div class="controls"><button class="minus" onclick="adj('dewasa',-1)">−</button><span id="valDewasaTambahan">0</span><button class="plus" onclick="adj('dewasa',1)">+</button></div>
                        </div>
                    </div>

                    {{-- Divider --}}
                    <div style="border-top:1px solid rgba(0,0,0,0.1);margin:1.5rem 0"></div>

                    {{-- Catatan --}}
                    <div class="ov-section-title">
                        <iconify-icon icon="lucide:clipboard-list" class="text-lg"></iconify-icon> Catatan
                    </div>
                    <div class="ov-catatan" id="catatanBox">
                        <div class="item"><iconify-icon icon="ph:hand-pointing-bold" class="text-sm mt-0.5 text-gray-500 shrink-0"></iconify-icon> Anak di bawah umur 5 tahun Free, maksimal 2 anak.</div>
                        <div class="item"><iconify-icon icon="ph:hand-pointing-bold" class="text-sm mt-0.5 text-gray-500 shrink-0"></iconify-icon> Tambahan anak di atas 5 tahun 75k/orang (Include Extramattrass Lantai Ketebalan 5cm)</div>
                        <div class="item"><iconify-icon icon="ph:hand-pointing-bold" class="text-sm mt-0.5 text-gray-500 shrink-0"></iconify-icon> Tambahan dewasa di atas 17 tahun 100k/orang (Include Extramattrass Lantai Ketebalan 5cm)</div>
                    </div>
                    <label class="ov-kebijakan">
                        <input type="checkbox" id="chkKebijakan" style="width:20px;height:20px;accent-color:#3a523a">
                        Setujui kebijakan reservasi
                        <a onclick="document.getElementById('modalKebijakan').classList.add('show')">klik baca kebijakan</a>
                    </label>
                    <button class="ov-btn-simpan" id="btnSimpan" type="button">Simpan</button>
                </div>
            </div>

            {{-- RIGHT: Sidebar --}}
            <div style="flex:0.8;min-width:300px" class="ov-sidebar">
                {{-- Validasi Reservasi Card --}}
                <div class="ov-card">
                    {{-- Red Ribbon --}}
                    <div class="ov-ribbon">
                        <iconify-icon icon="lucide:alert-triangle"></iconify-icon>
                        Jangan sampai kehabisan! Tersisa <strong id="sisaKamar">3</strong> kamar lagi
                    </div>
                    <div class="ov-card-inner">
                        <h3>
                            <iconify-icon icon="lucide:calendar-check" class="text-lg"></iconify-icon> Validasi Reservasi
                        </h3>
                        {{-- Check-in / Check-out Highlight --}}
                        <div class="ov-checkin-highlight">
                            <div class="ov-checkin-row">
                                <div><div class="ci-label">Check-in</div><div class="ci-date" id="dynCheckin">Selasa, 28 April 2026</div><div class="ci-time">Dari 14.00</div></div>
                                <div class="ci-mid"><div id="malamText">1 malam</div><div class="arrow">→</div></div>
                                <div style="text-align:right"><div class="ci-label">Check-out</div><div class="ci-date" id="dynCheckout">Rabu, 29 April 2026</div><div class="ci-time">Hingga 12.00</div></div>
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
                                <div class="label">Total<small id="totalMalamText">1 kamar, 1 malam</small></div>
                                <div class="amount" id="totalHarga">IDR 1.200.000</div>
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
            <h4>Kebijakan</h4>
            <p>Pemesanan ini tidak dapat diubah</p>
            <p>Pemesanan tidak ada refund jika Anda membatalkannya</p>
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

    // Ensure Cabin and Rumah Industrial have stock 1
    AKOMODASI_DATA.forEach(d => {
        if(d.jenis === 'Cabin' || d.jenis === 'Rumah Industrial') d.slot = 1;
    });

    // Find the selected accommodation
    const akoItem = AKOMODASI_DATA.find(d => d.id === akoId) || AKOMODASI_DATA[0];
    const basePrice = akoItem.hargaWeekday;
    const anakPrice = 75000;
    const dewasaPrice = 100000;
    const maxOrang = akoItem.maxOrang;

    // Update header title with dynamic data
    document.getElementById('headerTitle').textContent = `${akoItem.judul} (${maxOrang} pax)`;

    // Update sidebar sisa kamar
    document.getElementById('sisaKamar').textContent = akoItem.slot;

    // Update guest info
    document.getElementById('guestInfoText').textContent = `${maxOrang} Dewasa`;

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
    document.getElementById('priceLabel').textContent = `Harga kamar ${akoItem.judul} - ${maxOrang} pax (${malam} malam)`;
    document.getElementById('priceValue').textContent = fmt(basePrice * malam);
    document.getElementById('totalHarga').textContent = fmt(basePrice * malam);

    // Update catatan from data
    if(akoItem.catatan && akoItem.catatan.length > 0){
        const box = document.getElementById('catatanBox');
        box.innerHTML = akoItem.catatan.map(c =>
            `<div class="item"><iconify-icon icon="ph:hand-pointing-bold" class="text-sm mt-0.5 text-gray-500 shrink-0"></iconify-icon> ${c}</div>`
        ).join('');
    }

    let anak=0, dewasa=0;

    window.adj=function(type,delta){
        if(type==='anak'){anak=Math.max(0,Math.min(5,anak+delta));document.getElementById('valAnak').textContent=anak;}
        else{dewasa=Math.max(0,Math.min(5,dewasa+delta));document.getElementById('valDewasaTambahan').textContent=dewasa;}
    };

    // Get login data
    const isLoggedIn = sessionStorage.getItem('user_logged_in') === 'true';
    const userName   = sessionStorage.getItem('user_name') || 'User';
    const userEmail  = sessionStorage.getItem('user_email') || '';
    const userPhone  = sessionStorage.getItem('user_phone') || '';

    // Update logged in bar
    const loginBar = document.getElementById('dynLoginBar');
    if (isLoggedIn) {
        loginBar.innerHTML = `Log-in sebagai <strong>${userName}</strong>`;
        
        // Auto-fill form
        document.getElementById('namaLengkap').value = userName;
        document.getElementById('email').value = userEmail;
        document.getElementById('noHp').value = userPhone;
        document.getElementById('chkUntukSaya').checked = true;
        
        // Trigger UI updates
        document.getElementById('untukSiapaSection').style.display = 'none';
        const stmt = document.getElementById('untukSayaStatement');
        stmt.style.display = 'block';
        stmt.textContent = 'Pesanan untuk: ' + userName;
    } else {
        loginBar.innerHTML = `Kamu belum log-in. <a href="/" style="color:#3a523a;font-weight:700">Daftar / Masuk disini</a>`;
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
        if(!this.checked){anak=0;dewasa=0;document.getElementById('valAnak').textContent='0';document.getElementById('valDewasaTambahan').textContent='0';}
    });

    // Fungsi update harga
    function updateHarga() {
        let info=`${maxOrang} Dewasa`;
        if(anak>0)info+=` + ${anak} Anak (di atas 5 tahun)`;
        if(dewasa>0)info+=` + ${dewasa} Dewasa (di atas 17 tahun)`;
        document.getElementById('guestInfoText').textContent=info;

        let breakdown=`<div class="ov-price-row"><span>Harga kamar ${akoItem.judul} - ${maxOrang} pax (${malam} malam)</span><span>${fmt(basePrice * malam)}</span></div>`;
        let total = basePrice * malam;
        if(anak>0){total += anak * anakPrice * malam; breakdown += `<div class="ov-price-row"><span>Tambahan anak (di atas 5 tahun) ${anak} orang x ${malam} malam</span><span>${fmt(anak*anakPrice*malam)}</span></div>`;}
        if(dewasa>0){total += dewasa * dewasaPrice * malam; breakdown += `<div class="ov-price-row"><span>Tambahan dewasa (di atas 17 tahun) ${dewasa} orang x ${malam} malam</span><span>${fmt(dewasa*dewasaPrice*malam)}</span></div>`;}
        document.getElementById('priceBreakdown').innerHTML=breakdown;
        document.getElementById('totalHarga').textContent=fmt(total);
    }

    document.getElementById('btnSimpan').addEventListener('click',function(){
        updateHarga();
        alert('Data berhasil disimpan! Anda bisa klik Lanjutkan.');
    });

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
        
        // Simpan data ke sessionStorage agar dinamis di halaman metode
        const guestName = chkSaya ? nama : untukSiapa;
        
        sessionStorage.setItem('res_judul', akoItem.judul);
        sessionStorage.setItem('res_nama', nama || 'Ari Rahman');
        sessionStorage.setItem('res_hp', hp || '081512345678');
        sessionStorage.setItem('res_email', em || 'arirahman@gmail.com');
        sessionStorage.setItem('res_tamu', guestName || 'M. Akbar R.');
        sessionStorage.setItem('res_guest', document.getElementById('guestInfoText').textContent);
        sessionStorage.setItem('res_malam', malam);
        sessionStorage.setItem('res_checkin', document.getElementById('dynCheckin').textContent);
        sessionStorage.setItem('res_checkout', document.getElementById('dynCheckout').textContent);
        sessionStorage.setItem('res_total', document.getElementById('totalHarga').textContent);
        
        setTimeout(()=>{window.location.href='/reservasi/metode-pembayaran/'+akoId;},2000);
    });
})();
</script>
@endpush
@endsection
