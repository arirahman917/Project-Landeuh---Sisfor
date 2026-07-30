@extends('layouts.booking')
@section('title', 'Pembayaran Virtual Account - Landeuh Village Riverside')
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
.va-title{font-size:1.15rem;font-weight:800;color:#333;margin-bottom:1.5rem;display:flex;justify-content:space-between;align-items:center;border-bottom:1px solid #dfd4be;padding-bottom:1rem}
.va-input-group{display:flex;flex-direction:column;gap:0.5rem;margin-bottom:1.2rem}
.va-input-group label{font-size:0.85rem;font-weight:700;color:#444}
.va-input-wrapper{position:relative;display:flex;align-items:center}
.va-input{width:100%;padding:0.8rem 1rem;border:1px solid #dfd4be;border-radius:0.5rem;font-size:0.95rem;outline:none;background:#fff;font-weight:600;color:#333}
.va-copy-btn{position:absolute;right:0.5rem;top:50%;transform:translateY(-50%);background:transparent;border:none;color:#3a523a;cursor:pointer;padding:0.5rem;display:flex;align-items:center;justify-content:center}
.va-btn-outline{width:100%;background:#3a523a;color:#fff;border:none;padding:0.85rem;border-radius:0.5rem;font-size:1rem;font-weight:700;cursor:pointer;transition:0.2s}
.va-btn-outline:hover{background:#2c402c}
.inst-item{border-bottom:1px solid #dfd4be}
.inst-item:last-child{border-bottom:none}
.inst-header{display:flex;justify-content:space-between;align-items:center;padding:1.2rem 0;cursor:pointer;font-weight:700;font-size:0.95rem;color:#333}
.inst-header .chevron{transition:transform 0.3s}
.inst-item.open .chevron{transform:rotate(180deg)}
.inst-content{display:none;padding:0 0 1.2rem 0;font-size:0.85rem;color:#444;line-height:1.6}
.inst-item.open .inst-content{display:block}
.inst-content ol{padding-left:1.2rem;margin-bottom:0}
.inst-content ol li{margin-bottom:0.4rem}
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
                <div class="pay-timer-bar">Harga sudah kami amankan. Selesaikan pembayaran dalam <span class="timer" id="countdownTimer">00:30:00</span></div>
                
                <div style="background:#e6a645; color:#fff; padding:0.8rem 1.2rem; border-radius:0.5rem; font-size:0.85rem; margin-bottom:1.5rem;">
                    Cek emailmu (<strong><span id="userEmailSpan">...</span></strong>) sekarang untuk detail cara bayar.
                </div>
                
                <h3 style="font-size:1.15rem; font-weight:800; color:#333; margin-bottom:0.8rem;">Mohon transfer ke</h3>
                
                <div class="va-card">
                    <div class="va-title">
                        <span id="dynVaName">Virtual Account</span>
                        <div style="height:36px; display:flex; align-items:center; justify-content:flex-end;">
                            <img id="dynVaLogo" src="" alt="Logo" style="height:32px; object-fit:contain;">
                        </div>
                    </div>
                    
                    <div style="display:grid; grid-template-columns:1.5fr 1fr; gap:1rem;">
                        <div class="va-input-group">
                            <label>No. Virtual Account</label>
                            <div class="va-input-wrapper">
                                <input type="text" class="va-input" id="dynVaNumber" value="" readonly>
                                <button type="button" class="va-copy-btn" onclick="copyText('dynVaNumber')">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="20" height="20"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75" /></svg>
                                </button>
                            </div>
                        </div>
                        <div class="va-input-group">
                            <label>Nama Penerima</label>
                            <input type="text" class="va-input" id="dynNamaPenerima" value="Landeuh Village" readonly>
                        </div>
                    </div>
                    
                    <div style="margin-top:0.5rem; margin-bottom:1.5rem; text-align:center;">
                        <label style="font-size:0.85rem; font-weight:700; color:#444; display:block; margin-bottom:0.5rem;">Jumlah Transfer</label>
                        <input type="text" class="va-input" id="dynTransferAmount" value="" readonly style="width:auto; display:inline-block; font-size:1.4rem; font-weight:800; color:##333333; text-align:center; padding:0.8rem 1.5rem;">
                    </div>
                </div>
                
                <h3 style="font-size:1.15rem; font-weight:800; color:#333; margin-bottom:0.8rem;">Bagaimana Cara Transfer</h3>
                <div class="va-card" id="dynInstructions" style="padding: 0.5rem 1.5rem">
                    <!-- Dynamic accordion items will be injected here -->
                </div>
                
                <h3 style="font-size:1.15rem; font-weight:800; color:#333; margin-bottom:0.8rem; margin-top:2rem;">Sudah selesai bayar?</h3>
                <div class="va-card-confirm">
                    <p style="font-size:0.9rem; color:#555; margin-bottom:1.5rem;">Setelah pembayaran berhasil terverifikasi, e-ticket dan bukti pembayaran akan kami kirimkan ke email Anda.</p>
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
                        <div><div class="label green">Check-in</div><div class="date" id="dynCheckin">Selasa, 28 April 2026</div><div class="time">Dari 14.00</div></div>
                        <div style="text-align:center;color:#888"><div id="dynMalam" style="font-size:0.7rem;font-weight:600">1 malam</div><div style="font-size:1.2rem;margin-top:-4px">→</div></div>
                        <div style="text-align:right"><div class="label red">Check-out</div><div class="date" id="dynCheckout">Rabu, 29 April 2026</div><div class="time">Hingga 12.00</div></div>
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
                        <iconify-icon icon="lucide:user" class="text-lg"></iconify-icon> <span id="dynGuestInfo">Memuat...</span>
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
function copyText(id) {
    const el = document.getElementById(id);
    if(el) {
        navigator.clipboard.writeText(el.value).then(() => {
            alert('Berhasil disalin: ' + el.value);
        });
    }
}

function toggleInst(el) {
    el.closest('.inst-item').classList.toggle('open');
}

const VA_DATA = {
    'BCA Virtual Account': {
        logo: 'bca.png',
        name: 'BCA Virtual Account',
        account: '3901234567890123',
        instructions: [
            {
                title: 'BCA Mobile',
                steps: [
                    'Buka aplikasi BCA mobile, pilih m-BCA dan masukkan kode akses Anda.',
                    'Pilih m-Transfer > BCA Virtual Account.',
                    'Masukkan nomor Virtual Account yang tertera lalu pilih Send.',
                    'Periksa kembali rincian pembayaran Anda, lalu masukkan PIN m-BCA.',
                    'Transaksi selesai. Simpan bukti pembayaran jika diperlukan.'
                ]
            },
            {
                title: 'KlikBCA',
                steps: [
                    'Login ke KlikBCA Individual.',
                    'Pilih Transfer Dana > Transfer ke BCA Virtual Account.',
                    'Masukkan nomor Virtual Account.',
                    'Pastikan detail pembayaran sudah sesuai.',
                    'Masukkan respon KeyBCA APPLI 1 untuk menyelesaikan transaksi.'
                ]
            },
            {
                title: 'ATM BCA',
                steps: [
                    'Masukkan kartu ATM BCA dan PIN Anda.',
                    'Pilih menu Transaksi Lainnya > Transfer > ke Rekening BCA Virtual Account.',
                    'Masukkan nomor Virtual Account.',
                    'Periksa kembali rincian pembayaran dan konfirmasi transaksi.'
                ]
            }
        ]
    },
    'Mandiri Virtual Account': {
        logo: 'mandiri.png',
        name: 'Mandiri Virtual Account',
        account: '8901234567890123',
        instructions: [
            {
                title: 'Livin\' by Mandiri',
                steps: [
                    'Buka aplikasi Livin\' by Mandiri dan login.',
                    'Pilih menu Bayar > Buat Pembayaran Baru > Multipayment.',
                    'Masukkan nomor Virtual Account atau pilih penyedia jasa yang sesuai.',
                    'Pastikan detail tagihan benar, lalu masukkan PIN Livin\' Anda.',
                    'Pembayaran selesai.'
                ]
            },
            {
                title: 'ATM Mandiri',
                steps: [
                    'Masukkan kartu ATM Mandiri dan PIN Anda.',
                    'Pilih menu Bayar/Beli > Lainnya > Multipayment.',
                    'Masukkan kode perusahaan dan nomor Virtual Account.',
                    'Konfirmasi pembayaran sesuai detail yang tertera di layar.'
                ]
            }
        ]
    },
    'BRI Virtual Account': {
        logo: 'bri.png',
        name: 'BRI Virtual Account',
        account: '123456789012345',
        instructions: [
            {
                title: 'BRImo',
                steps: [
                    'Buka aplikasi BRImo, lalu masuk dengan akunmu.',
                    'Pilih menu BRIVA.',
                    'Masukkan nomor Virtual Account yang tertera lalu pilih Lanjutkan.',
                    'Pastikan informasi sudah sesuai: nama Penerima beserta total tagihanmu.',
                    'Masukkan PIN BRImo kamu untuk menyelesaikan pembayaran.',
                    'Pembayaran selesai. Simpan notifikasi pembayaran sebagai referensi.'
                ]
            },
            {
                title: 'Internet Banking',
                steps: [
                    'Login ke Internet Banking BRI.',
                    'Pilih menu Pembayaran > BRIVA.',
                    'Masukkan nomor BRIVA yang tertera.',
                    'Masukkan password dan mToken untuk melanjutkan transaksi.'
                ]
            },
            {
                title: 'ATM BRI',
                steps: [
                    'Masukkan kartu ATM BRI dan PIN Anda.',
                    'Pilih menu Transaksi Lainnya > Pembayaran > BRIVA.',
                    'Masukkan nomor BRIVA yang tertera.',
                    'Konfirmasi pembayaran dan simpan struk.'
                ]
            }
        ]
    },
    'BNI Virtual Account': {
        logo: 'bni.png',
        name: 'BNI Virtual Account',
        account: '8201234567890123',
        instructions: [
            {
                title: 'BNI Mobile Banking',
                steps: [
                    'Buka aplikasi BNI Mobile Banking dan login.',
                    'Pilih menu Transfer > Virtual Account Billing.',
                    'Pilih Input Baru dan masukkan nomor Virtual Account.',
                    'Pastikan tagihan sesuai dan masukkan Password Transaksi.'
                ]
            },
            {
                title: 'ATM BNI',
                steps: [
                    'Masukkan kartu ATM BNI dan PIN.',
                    'Pilih Menu Lain > Transfer > Virtual Account Billing.',
                    'Masukkan nomor Virtual Account.',
                    'Konfirmasi pembayaran.'
                ]
            }
        ]
    },
    'BSI Virtual Account': {
        logo: 'bsi.png',
        name: 'BSI Virtual Account',
        account: '9001234567890123',
        instructions: [
            {
                title: 'BSI Mobile',
                steps: [
                    'Buka aplikasi BSI Mobile dan login.',
                    'Pilih menu Bayar > Institusi/Akademik.',
                    'Masukkan nomor Virtual Account.',
                    'Konfirmasi nominal dan masukkan PIN.'
                ]
            },
            {
                title: 'ATM BSI',
                steps: [
                    'Masukkan kartu ATM BSI dan PIN Anda.',
                    'Pilih menu Pembayaran/Pembelian.',
                    'Pilih Institusi/Akademik.',
                    'Masukkan nomor Virtual Account dan ikuti instruksi selanjutnya.'
                ]
            }
        ]
    },
    'Virtual Account Lainnya': {
        logo: 'va.png',
        name: 'Virtual Account',
        account: '0000123456789012',
        instructions: [
            {
                title: 'Transfer Antar Bank',
                steps: [
                    'Pilih menu Transfer Antar Bank pada ATM/Mobile Banking Anda.',
                    'Pilih bank tujuan dan masukkan kode bank.',
                    'Masukkan nomor Virtual Account sebagai rekening tujuan.',
                    'Masukkan nominal pembayaran yang sesuai.',
                    'Konfirmasi transaksi.'
                ]
            }
        ]
    }
};

(function(){
    // Countdown timer
    let seconds=30*60;
    const el=document.getElementById('countdownTimer');
    setInterval(()=>{
        if(seconds<=0)return;
        seconds--;
        const m=String(Math.floor(seconds/60)).padStart(2,'0');
        const s=String(seconds%60).padStart(2,'0');
        el.textContent='00:'+m+':'+s;
    },1000);
    
    // Load dynamic user data from sessionStorage
    const dNama = sessionStorage.getItem('res_nama') || 'Ari Rahman';
    const dHp = sessionStorage.getItem('res_hp') || '081512345678';
    const dEmail = sessionStorage.getItem('res_email') || 'arirahman@gmail.com';
    const dTamu = sessionStorage.getItem('res_tamu') || 'M. Akbar R.';
    const dGuest = sessionStorage.getItem('res_guest') || '4 Dewasa + 1 Anak + 2 Dewasa';
    const dTotal = sessionStorage.getItem('res_total') || '1.475.000';
    const dMalam = sessionStorage.getItem('res_malam');
    const dJudul = sessionStorage.getItem('res_judul');
    const dCheckin = sessionStorage.getItem('res_checkin');
    const dCheckout = sessionStorage.getItem('res_checkout');
    
    if(dJudul) document.getElementById('headerAkoJudul').textContent = dJudul;
    
    if(dNama) document.getElementById('dynNama').textContent = dNama;
    if(dHp) document.getElementById('dynHp').textContent = dHp;
    if(dEmail) {
        document.getElementById('dynEmail').textContent = dEmail;
        document.getElementById('userEmailSpan').textContent = dEmail;
    }
    if(dTamu) document.getElementById('dynTamu').textContent = dTamu;
    if(dGuest) document.getElementById('dynGuestInfo').textContent = dGuest;
    if(dTotal) {
        const amt = dTotal.replace(/IDR\s?/i, '').trim();
        document.getElementById('dynTransferAmount').value = amt;
    }
    if(dMalam) {
        const dynMalamEl = document.getElementById('dynMalam');
        if(dynMalamEl) dynMalamEl.textContent = `${dMalam} malam`;
    }
    if(dCheckin) {
        const ciEl = document.getElementById('dynCheckin');
        if(ciEl) ciEl.textContent = dCheckin;
    }
    if(dCheckout) {
        const coEl = document.getElementById('dynCheckout');
        if(coEl) coEl.textContent = dCheckout;
    }

    // Parse accommodation ID from URL or sessionStorage
    // Since we are in virtual account page, we can't get ID from URL easily, let's use a stored ID or just 1
    const akoId = parseInt(sessionStorage.getItem('res_akoId')) || 1;
    const akoItem = AKOMODASI_DATA.find(d => d.id === akoId) || AKOMODASI_DATA[0];
    
    if(akoItem) {
        document.getElementById('headerAkoJudul').textContent = akoItem.judul;
        document.getElementById('dynBed').innerHTML = `<iconify-icon icon="lucide:bed-double" class="text-lg"></iconify-icon> ${akoItem.kasur}`;
        document.getElementById('dynSmoking').innerHTML = `<iconify-icon icon="${akoItem.merokok ? 'lucide:cigarette' : 'lucide:cigarette-off'}" class="text-lg"></iconify-icon> ${akoItem.merokok ? 'Boleh merokok di kamar' : 'Dilarang merokok'}`;
        
        const fasLen = Math.ceil(akoItem.fasilitas.length / 2);
        document.getElementById('dynFasilitas1').innerHTML = akoItem.fasilitas.slice(0, fasLen).map(f => `<li>${f}</li>`).join('');
        document.getElementById('dynFasilitas2').innerHTML = akoItem.fasilitas.slice(fasLen).map(f => `<li>${f}</li>`).join('');
        document.getElementById('dynMakanan').innerHTML = akoItem.makanan.map(m => `<li>${m}</li>`).join('');
    }

    // Load VA Data
    const selectedVa = sessionStorage.getItem('res_va') || 'BRI Virtual Account';
    const vaInfo = VA_DATA[selectedVa] || VA_DATA['Virtual Account Lainnya'];

    document.getElementById('dynVaName').textContent = vaInfo.name;
    const logoEl = document.getElementById('dynVaLogo');
    logoEl.src = "{{ asset('images/partner-pembayaran') }}/" + vaInfo.logo;

    // Per-bank logo sizing: BNI & BCA lebih kecil, sisanya default
    const logoSizes = {
        'BNI Virtual Account': '28px',
        'BCA Virtual Account': '28px',
        'BRI Virtual Account': '60px',
        'Mandiri Virtual Account': '80px',
        'BSI Virtual Account': '80px',
        'Virtual Account Lainnya': '80px'
    };
    logoEl.style.height = logoSizes[selectedVa] || '32px';

    document.getElementById('dynVaNumber').value = vaInfo.account;
    
    // Render Instructions
    const instContainer = document.getElementById('dynInstructions');
    let instHtml = '';
    vaInfo.instructions.forEach((inst, idx) => {
        const isOpen = idx === 0 ? 'open' : '';
        instHtml += `
            <div class="inst-item ${isOpen}">
                <div class="inst-header" onclick="toggleInst(this)">
                    ${inst.title}
                    <svg class="chevron" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m6 9 6 6 6-6"/></svg>
                </div>
                <div class="inst-content">
                    <ol>
                        ${inst.steps.map(step => `<li>${step}</li>`).join('')}
                    </ol>
                </div>
            </div>
        `;
    });
    instContainer.innerHTML = instHtml;
})();

function goToKonfirmasi(status) {
    sessionStorage.setItem('res_payment_status', status);
    const bookingNo = sessionStorage.getItem('res_booking_no');
    const method = sessionStorage.getItem('res_payment_method') || sessionStorage.getItem('res_va') || 'Virtual Account';

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
