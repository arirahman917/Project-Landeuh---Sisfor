@extends('layouts.booking')
@section('title', 'Metode Pembayaran - Landeuh Village Riverside')
@section('content')
<style>
.pay-page{background:#F8EDD8;min-height:100vh;position:relative}
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
.pay-method-container{background:#f1e5cc;border-radius:0.75rem;border:1px solid #dfd4be;margin-bottom:1rem;overflow:hidden}
.pm-main-title{display:flex;align-items:center;gap:0.8rem;padding:1.2rem 1.5rem;font-size:1.05rem;font-weight:800;border-bottom:1px solid #dfd4be;color:#333}
.pay-method-row{border-bottom:1px solid #dfd4be;transition:background 0.3s}
.pay-method-row:last-child{border-bottom:none}
.pay-method-header{display:flex;align-items:center;justify-content:space-between;padding:0 1rem;min-height:70px;cursor:pointer;font-size:0.95rem;font-weight:600;user-select:none}
.pay-method-header:hover{background:rgba(0,0,0,0.03)}
.pay-method-header .chevron{transition:transform 0.3s}
.pay-method-row.open .chevron{transform:rotate(180deg)}
.pay-method-header .radio-left{display:flex;align-items:center;gap:0.8rem}
.pay-method-header input[type="radio"]{accent-color:#3a523a;width:16px;height:16px;cursor:pointer}
.pay-method-header .logos{display:flex;gap:0.75rem;align-items:center;justify-content:flex-end}
.pay-method-header .logos img{object-fit:contain;object-position:right center}
.pay-method-content{display:none;padding:0 1rem 1rem 1rem}
.pay-method-row.open .accordion-content{display:block}
.pay-method-row.selected .direct-content{display:block}
.pay-radio{display:flex;align-items:center;justify-content:space-between;padding:0 1rem;min-height:70px;border:1px solid #dfd4be;border-radius:0.6rem;margin-bottom:0.5rem;cursor:pointer;transition:0.2s;background:#fff}
.pay-radio:hover{border-color:#3a523a;background:#f9f9f5}
.pay-radio input[type=radio]{accent-color:#3a523a;margin-right:0.6rem}
.pay-radio .logo-wrapper{display:flex;justify-content:flex-end;align-items:center}
.pay-radio img{object-fit:contain;object-position:right center}
.pay-radio label{flex:1;font-size:0.85rem;font-weight:500;cursor:pointer}
.pay-info-box{background:#fff;border:1px solid #eee;border-radius:0.75rem;padding:0.8rem 1rem;font-size:0.78rem;color:#666;margin-bottom:0.75rem}
.pay-info-box ul{margin:0.3rem 0 0 1rem;list-style:disc}
.pay-info-box ul li{margin-bottom:0.2rem}
.cc-fields{display:flex;flex-direction:column;gap:0.75rem}
.cc-fields input{width:100%;padding:0.6rem 0.8rem;border:1px solid #ddd;border-radius:0.5rem;font-size:0.85rem;outline:none;background:#fff}
.cc-fields input:focus{border-color:#3a523a}
.cc-fields .row{display:flex;gap:0.75rem}
.cc-fields .row input{flex:1}
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
.pay-bottom-cream{background:#f1e5cc;border-radius:1rem;border:1px solid #dfd4be;padding:1.5rem;box-shadow:0 10px 25px rgba(0,0,0,0.05)}
.pay-bottom-cream .pb-top{display:flex;justify-content:space-between;align-items:flex-start;gap:1rem;margin-bottom:1rem}
.pay-bottom-cream .pay-with{font-size:0.95rem;color:#444;flex:1;min-width:0}
.pay-bottom-cream .pay-amount{font-size:1.4rem;font-weight:800;color:#c0392b;white-space:nowrap;flex-shrink:0;text-align:right}
.pay-bottom-cream .pay-btn{width:100%;background:#3a523a;color:#fff;border:none;padding:0.85rem;border-radius:0.5rem;font-size:1rem;font-weight:700;cursor:pointer;transition:0.2s}
.pay-bottom-cream .pay-btn:hover{background:#2c402c}
@media(max-width:768px){.pay-grid{flex-direction:column!important}}
</style>

<div class="pay-page">
    <img src="{{ asset('images/assets_lain/batik.png') }}" class="absolute top-16 -left-6 w-36 opacity-20 pointer-events-none rotate-6 z-0" alt="">
    <img src="{{ asset('images/assets_lain/batik.png') }}" class="absolute top-1/2 -right-8 w-40 opacity-15 pointer-events-none -rotate-12 scale-x-[-1] z-0" alt="">
    <img src="{{ asset('images/assets_lain/batik.png') }}" class="absolute bottom-8 left-10 w-32 opacity-10 pointer-events-none rotate-45 z-0" alt="">

    <div class="pay-header">
        <div class="pay-logo">
            <img src="{{ asset('images/logo-landeuh.png') }}" alt="Logo">
            <div class="divider"></div>
            <h2><span id="dynJudul">Cabin 1</span></h2>
        </div>
        <div class="pay-steps">
            <div style="display:flex;align-items:center;gap:0.35rem"><div class="num done">1</div> Review</div>
            <div class="line"></div>
            <div style="display:flex;align-items:center;gap:0.35rem"><div class="num active">2</div> Bayar</div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-2 relative z-10">
        <div class="pay-back" onclick="window.location.href = '/pesanan'">← Kembali</div>
        <div class="pay-timer-bar">Harga sudah kami amankan. Selesaikan pembayaran dalam <span class="timer" id="countdownTimer">00:30:00</span></div>

        <div class="pay-grid" style="display:flex;gap:1.5rem;align-items:flex-start">
            {{-- LEFT --}}
            <div style="flex:1.4;">
                @php
                $methods = [
                    ['key'=>'va','title'=>'Virtual Account','type'=>'accordion','items'=>[
                        ['val'=>'BCA Virtual Account','logo'=>'bca.png', 'w'=>70,  'h'=>18],
                        ['val'=>'Mandiri Virtual Account','logo'=>'mandiri.png', 'w'=>380,  'h'=>66],
                        ['val'=>'BRI Virtual Account','logo'=>'bri.png', 'w'=>160,  'h'=>39],
                        ['val'=>'BNI Virtual Account','logo'=>'bni.png', 'w'=>74,  'h'=>18],
                        ['val'=>'BSI Virtual Account','logo'=>'bsi.png', 'w'=>180,  'h'=>62],
                        // ['val'=>'Virtual Account Lainnya','logo'=>'va.png', 'w'=>180,  'h'=>60],
                    ]],
                    ['key'=>'atm','title'=>'ATM','type'=>'direct','logos'=>[
                        ['file'=>'atm_bersama.png', 'h'=>30],
                        ['file'=>'linkaja.png', 'h'=>30]
                    ],'info'=>true],
                    ['key'=>'cc','title'=>'Kartu Kredit / Debit','type'=>'direct','logos'=>[
                        ['file'=>'kartu_kredit.png', 'h'=>34]
                    ],'cc'=>true],
                    ['key'=>'qris','title'=>'QRIS','type'=>'direct','logos'=>[
                        ['file'=>'qris.png', 'h'=>42]
                    ]],
                    ['key'=>'ewallet','title'=>'E-Wallet','type'=>'accordion','items'=>[
                        ['val'=>'DANA','logo'=>'dana.png', 'w'=>155,  'h'=>35],
                        ['val'=>'GoPay','logo'=>'gopay.png', 'w'=>170,  'h'=>45],
                        ['val'=>'OVO','logo'=>'ovo.png', 'w'=>125,  'h'=>23],
                        ['val'=>'ShopeePay','logo'=>'shopeepay.png', 'w'=>175,  'h'=>45],
                    ]],
                    ['key'=>'minimarket','title'=>'Minimarket','type'=>'accordion','items'=>[
                        ['val'=>'Alfamart / Alfamidi','logo'=>'alfamart.png', 'w'=>90,  'h'=>20],
                        ['val'=>'Indomaret','logo'=>'indomaret.png', 'w'=>100,  'h'=>20],
                    ]],
                ];
                @endphp

                <div class="pay-method-container">
                    <div class="pm-main-title">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 12V7H5a2 2 0 0 1 0-4h14v4"/><path d="M3 5v14a2 2 0 0 0 2 2h16v-5"/><path d="M18 12a2 2 0 0 0 0 4h4v-4Z"/></svg>
                        Pilih metode pembayaran Anda
                    </div>

                    @foreach($methods as $m)
                    <div class="pay-method-row" id="row-{{$m['key']}}">
                        @if($m['type'] === 'accordion')
                            <div class="pay-method-header" onclick="toggleAccordion('{{$m['key']}}')">
                                <span>{{$m['title']}}</span>
                                <svg class="chevron" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m6 9 6 6 6-6"/></svg>
                            </div>
                            <div class="pay-method-content accordion-content" id="content-{{$m['key']}}">
                                @if(!empty($m['items']))
                                    @foreach($m['items'] as $item)
                                    <div class="pay-radio" onclick="document.getElementById('radio-{{Str::slug($item['val'])}}').click()">
                                        <input type="radio" name="paymentMethod" value="{{$item['val']}}" id="radio-{{Str::slug($item['val'])}}" onchange="handlePaymentChange(this)">
                                        <label for="radio-{{Str::slug($item['val'])}}">{{$item['val']}}</label>
                                        <div class="logo-wrapper">
                                            <img src="{{ asset('images/partner-pembayaran/'.$item['logo']) }}" onerror="this.style.display='none'" alt="{{$item['val']}}" style="{{ isset($item['w']) ? 'width:'.$item['w'].'px;' : '' }} {{ isset($item['h']) ? 'height:'.$item['h'].'px;' : '' }}">
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        @else
                            <div class="pay-method-header" onclick="document.getElementById('radio-{{$m['key']}}').click()">
                                <div class="radio-left">
                                    <input type="radio" name="paymentMethod" value="{{$m['title']}}" id="radio-{{$m['key']}}" onchange="handlePaymentChange(this)">
                                    <label for="radio-{{$m['key']}}" style="cursor:pointer">{{$m['title']}}</label>
                                </div>
                                <div class="logos" id="logos-{{$m['key']}}">
                                    @if(!empty($m['logos']))
                                        @foreach($m['logos'] as $logo)
                                            <img src="{{ asset('images/partner-pembayaran/'.$logo['file']) }}" onerror="this.style.display='none'" alt="" style="{{ isset($logo['w']) ? 'width:'.$logo['w'].'px;' : '' }} {{ isset($logo['h']) ? 'height:'.$logo['h'].'px;' : '' }}">
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            @if(!empty($m['info']) || !empty($m['cc']))
                            <div class="pay-method-content direct-content" id="content-{{$m['key']}}">
                                @if(!empty($m['info']))
                                <div class="pay-info-box" style="margin-top:0.5rem">
                                    <ul>
                                        <li>Pembayaran hanya dapat dilakukan melalui transfer online secara realtime.</li>
                                        <li>Transfer melalui RTGS, SKN, atau BI Fast tidak dapat diproses untuk verifikasi otomatis.</li>
                                        <li>Pastikan nominal pembayaran sesuai dengan total tagihan.</li>
                                    </ul>
                                </div>
                                @endif
                                @if(!empty($m['cc']))
                                <div class="cc-fields" style="margin-top:0.5rem">
                                    <div><label style="font-size:0.8rem;font-weight:600">Nomor Kartu Kredit/Debit</label><input type="text" placeholder="Nomor Kartu Kredit / Debit"></div>
                                    <div class="row" style="align-items:flex-end">
                                        <div style="flex:1"><label style="font-size:0.8rem;font-weight:600">Masa Berlaku</label><input type="text" placeholder="MM / YY"></div>
                                        <div style="flex:1"><label style="font-size:0.8rem;font-weight:600">CVV/CVN</label><input type="text" placeholder="3 - 4 Digit"></div>
                                        <div style="flex-shrink:0"><img src="{{ asset('images/partner-pembayaran/cvv.png') }}" alt="CVV" style="height:45px;object-fit:contain" onerror="this.style.display='none'"></div>
                                    </div>
                                    <div><label style="font-size:0.8rem;font-weight:600">Nama di Kartu</label><input type="text" placeholder="Nama yang Tertera di Kartu"></div>
                                </div>
                                @endif
                            </div>
                            @endif
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- RIGHT --}}
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
                        <div id="dynBed"><iconify-icon icon="lucide:bed-double" class="text-lg"></iconify-icon> Queen Bed (140×200)</div>
                        <div class="divider"></div>
                        <div id="dynSmoking"><iconify-icon icon="lucide:cigarette" class="text-lg"></iconify-icon> Boleh merokok di kamar</div>
                    </div>
                    
                    <div class="sb-fasilitas">
                        <div>
                            <div class="col-title">Fasilitas Kamar:</div>
                            <ul id="dynFasilitas1">
                                <li>TV kabel</li>
                                <li>Meja</li>
                            </ul>
                        </div>
                        <div style="padding-top:1.4rem">
                            <ul id="dynFasilitas2">
                                <li>Ruang tamu</li>
                                <li>Balkon</li>
                            </ul>
                        </div>
                        <div>
                            <div class="col-title">Makanan & Minuman:</div>
                            <ul id="dynMakanan">
                                <li>Fasilitas Membuat Kopi/Teh</li>
                                <li>Air Minum Gratis</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="sb-guest">
                        <iconify-icon icon="lucide:user" class="text-lg"></iconify-icon> <span id="dynGuestInfo">4 Dewasa + 1 Anak (di atas 5 tahun) + 2 Dewasa (di atas 17 tahun)</span>
                    </div>
                    
                    <div class="sb-identity">
                        <div>
                            <div class="title">Identitas Pemesan:</div>
                            <div class="row">
                                <iconify-icon icon="lucide:user-check" class="text-base mt-1"></iconify-icon>
                                <div class="details">
                                    <div id="dynNama">Ari Rahman</div>
                                    <div id="dynHp">081512345678</div>
                                    <div id="dynEmail">arirahman@gmail.com</div>
                                </div>
                            </div>
                        </div>
                        <div style="text-align:right">
                            <div class="title">Nama Tamu:</div>
                            <div class="row" style="justify-content:flex-end">
                                <iconify-icon icon="lucide:book-user" class="text-base mt-0.5"></iconify-icon>
                                <div class="details">
                                    <div id="dynTamu">M. Akbar R.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="pay-bottom-cream">
                    <div class="pb-top">
                        <div class="pay-with">Bayar dengan <strong id="selectedMethod">metode?</strong></div>
                        <div class="pay-amount" id="dynTotalHarga">IDR 1.475.000</div>
                    </div>
                    <button class="pay-btn" onclick="processPayment()">Bayar</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Waktu Habis --}}
<div id="timeoutModal" class="fixed inset-0 z-50 flex items-center justify-center hidden" style="opacity: 0; transition: opacity 0.3s ease;">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>
    <div class="bg-white rounded-2xl shadow-xl w-[90%] max-w-sm overflow-hidden z-10 transform scale-95 transition-transform duration-300" id="timeoutBox">
        <div class="p-6 text-center">
            <div class="w-16 h-16 rounded-full bg-red-100 text-red-500 flex items-center justify-center mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Waktu Habis!</h3>
            <p class="text-sm text-gray-500 mb-6">Waktu pembayaran Anda telah habis. Pesanan otomatis dibatalkan.</p>
            <button onclick="window.location.href='/pesanan'" class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-4 rounded-xl transition">
                Kembali ke Pesanan
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script src="{{ asset('js/akomodasi-data.js') }}"></script>
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script>
function toggleAccordion(key) {
    const row = document.getElementById('row-' + key);
    row.classList.toggle('open');
}

function handlePaymentChange(radio) {
    // Update teks kanan
    document.getElementById('selectedMethod').textContent = radio.value;
    
    // Hapus status selected dari semua row direct
    document.querySelectorAll('.pay-method-row').forEach(el => {
        el.classList.remove('selected');
    });

    // Jika yang diklik adalah input radio utama (direct method)
    const row = radio.closest('.pay-method-row');
    if(row) {
        row.classList.add('selected');
    }
}

function processPayment() {
    const selected = document.querySelector('input[name="paymentMethod"]:checked');
    if(!selected) {
        alert('Pilih metode pembayaran terlebih dahulu!');
        return;
    }
    const method = selected.value;
    
    // Simpan ID akomodasi untuk memuat data di halaman berikutnya
    const urlParts = window.location.pathname.split('/');
    const akoId = parseInt(urlParts[urlParts.length - 1]) || 1;
    sessionStorage.setItem('res_akoId', akoId);

    // Ambil No Pesanan yang tersimpan dari database MySQL
    const bookingNo = sessionStorage.getItem('res_booking_no');

    if (bookingNo) {
        // Tampilkan loading indicator
        const payBtn = document.querySelector('.pay-btn');
        const origText = payBtn.innerHTML;
        payBtn.disabled = true;
        payBtn.innerHTML = 'Memproses Pembayaran...';

        // Panggil backend untuk mendapatkan Snap Token khusus metode yang dipilih
        fetch('/reservasi/get-snap-token', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                no_pesanan: bookingNo,
                metode_pembayaran: method
            })
        })
        .then(response => {
            if(!response.ok) {
                throw new Error('Gagal memuat token');
            }
            return response.json();
        })
        .then(data => {
            payBtn.disabled = false;
            payBtn.innerHTML = origText;

            if (data.success && data.snap_token) {
                // Tampilkan pop-up Snap Midtrans khusus metode tersebut
                snap.pay(data.snap_token, {
                    onSuccess: function(result) {
                        sessionStorage.setItem('res_payment_status', 'success');
                        
                        let actualMethod = method; // Default ke pilihan UI (misal: 'Mandiri Virtual Account')
                        if (result.va_numbers && result.va_numbers.length > 0) {
                            const bankName = result.va_numbers[0].bank.toUpperCase();
                            actualMethod = bankName + ' Virtual Account';
                        } else if (result.payment_type === 'qris' || result.payment_type === 'gopay' || result.payment_type === 'shopeepay') {
                            actualMethod = result.payment_type.toUpperCase();
                        }
                        
                        sessionStorage.setItem('res_payment_method', actualMethod);
                        window.location.href = '/reservasi/konfirmasi';
                    },
                    onPending: function(result) {
                        sessionStorage.setItem('res_payment_status', 'pending');
                        
                        let actualMethod = method;
                        if (result.va_numbers && result.va_numbers.length > 0) {
                            const bankName = result.va_numbers[0].bank.toUpperCase();
                            actualMethod = bankName + ' Virtual Account';
                        } else if (result.payment_type === 'qris' || result.payment_type === 'gopay' || result.payment_type === 'shopeepay') {
                            actualMethod = result.payment_type.toUpperCase();
                        }
                        
                        sessionStorage.setItem('res_payment_method', actualMethod);
                        window.location.href = '/reservasi/konfirmasi';
                    },
                    onError: function(result) {
                        sessionStorage.setItem('res_payment_status', 'failed');
                        window.location.href = '/reservasi/konfirmasi';
                    },
                    onClose: function() {
                        alert('Anda menutup popup pembayaran sebelum menyelesaikan transaksi.');
                    }
                });
            } else {
                // FALLBACK JIKA CREDENTIALS MIDTRANS BELUM DISET (Mockup Mode)
                console.log('Menggunakan Fallback Mockup Payment karena Midtrans Key belum terpasang.');
                useFallbackPayment(method, akoId);
            }
        })
        .catch(err => {
            console.error('Error fetching snap token:', err);
            payBtn.disabled = false;
            payBtn.innerHTML = origText;
            // FALLBACK JIKA ERROR (Mockup Mode)
            useFallbackPayment(method, akoId);
        });
    } else {
        useFallbackPayment(method, akoId);
    }
}

// Fungsi Helper untuk Fallback Pembayaran Mockup Bawaan
function useFallbackPayment(method, akoId) {
    // Redirect ke halaman VA jika user memilih Virtual Account
    if(method.toLowerCase().includes('virtual account') || method.toLowerCase().includes('va')) {
        sessionStorage.setItem('res_va', method);
        window.location.href = '/payment/virtual-account';
    } 
    // Redirect ke halaman ATM jika user memilih ATM
    else if(method.toLowerCase() === 'atm') {
        sessionStorage.setItem('res_payment_method', 'ATM');
        window.location.href = '/payment/atm';
    } 
    // Redirect ke halaman Minimarket jika user memilih Alfamart/Indomaret
    else if(method.toLowerCase().includes('alfamart') || method.toLowerCase().includes('indomaret')) {
        sessionStorage.setItem('res_minimarket', method);
        window.location.href = '/payment/minimarket';
    } 
    // Redirect ke halaman QRIS jika user memilih QRIS
    else if(method.toLowerCase().includes('qris')) {
        sessionStorage.setItem('res_payment_method', 'QRIS');
        window.location.href = '/payment/qris';
    } 
    else {
        alert('Pembayaran menggunakan ' + method + ' akan diintegrasikan dengan Midtrans.');
    }
}
// Countdown timer
(function(){
    @if(isset($booking))
        // Populate sessionStorage with the database booking data
        sessionStorage.setItem('res_booking_no', '{{ $booking->no_pesanan }}');
        sessionStorage.setItem('res_judul', '{{ $booking->accommodation->judul }}');
        sessionStorage.setItem('res_nama', '{{ $booking->pemesan_nama }}');
        sessionStorage.setItem('res_hp', '{{ $booking->pemesan_telp }}');
        sessionStorage.setItem('res_email', '{{ $booking->pemesan_email }}');
        sessionStorage.setItem('res_tamu', '{{ $booking->nama_tamu }}');
        sessionStorage.setItem('res_guest', '{{ $booking->accommodation->max_orang }} Dewasa');
        sessionStorage.setItem('res_malam', '{{ $booking->malam }}');
        
        @php
            $days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
            $mNames = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
            
            $ci = $booking->check_in_date;
            $ciDay = $days[$ci->dayOfWeek] ?? 'Minggu';
            $ciMonth = $mNames[$ci->month - 1] ?? 'Januari';
            $ciStr = "{$ciDay}, {$ci->day} {$ciMonth} {$ci->year}";
            
            $co = $booking->check_out_date;
            $coDay = $days[$co->dayOfWeek] ?? 'Senin';
            $coMonth = $mNames[$co->month - 1] ?? 'Januari';
            $coStr = "{$coDay}, {$co->day} {$coMonth} {$co->year}";
            
            $formattedTotal = 'IDR ' . number_format($booking->total, 0, ',', '.');
        @endphp
        
        sessionStorage.setItem('res_checkin', '{{ $ciStr }}');
        sessionStorage.setItem('res_checkout', '{{ $coStr }}');
        sessionStorage.setItem('res_total', '{{ $formattedTotal }}');
        sessionStorage.setItem('res_akoId', '{{ $booking->accommodation_id }}');
        sessionStorage.setItem('res_created_at', '{{ $booking->created_at->toIso8601String() }}');
    @endif

    let expireTime = 0;
    const createdAtStr = sessionStorage.getItem('res_created_at');
    if (createdAtStr) {
        const createdTime = new Date(createdAtStr).getTime();
        expireTime = createdTime + 30 * 60 * 1000;
    }

    const el = document.getElementById('countdownTimer');
    
    function updateTimer() {
        const now = new Date().getTime();
        let seconds = 0;
        
        if (expireTime > 0) {
            seconds = Math.max(0, Math.floor((expireTime - now) / 1000));
        } else {
            // Fallback for missing data
            seconds = 30 * 60;
        }

        if (seconds <= 0 && expireTime > 0) {
            el.textContent = '00:00:00';
            
            // Automatically mark as failed/expired in the database
            const bookingNo = sessionStorage.getItem('res_booking_no');
            if (bookingNo) {
                fetch('/reservasi/update-status', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        no_pesanan: bookingNo,
                        status: 'failed'
                    })
                })
                .then(() => {
                    const modal = document.getElementById('timeoutModal');
                    const box = document.getElementById('timeoutBox');
                    modal.classList.remove('hidden');
                    
                    // Trigger reflow to apply animation
                    void modal.offsetWidth;
                    
                    modal.style.opacity = '1';
                    box.classList.remove('scale-95');
                    box.classList.add('scale-100');
                });
            } else {
                const modal = document.getElementById('timeoutModal');
                const box = document.getElementById('timeoutBox');
                modal.classList.remove('hidden');
                void modal.offsetWidth;
                modal.style.opacity = '1';
                box.classList.remove('scale-95');
                box.classList.add('scale-100');
            }
            return true; // indicates timer finished
        }
        
        const m = String(Math.floor(seconds / 60)).padStart(2, '0');
        const s = String(seconds % 60).padStart(2, '0');
        el.textContent = '00:' + m + ':' + s;
        return false;
    }
    
    // Initial call
    const isFinished = updateTimer();
    
    if (!isFinished) {
        const interval = setInterval(() => {
            if (updateTimer()) {
                clearInterval(interval);
            }
        }, 1000);
    }
    
    // Parse accommodation ID from URL
    const urlParts = window.location.pathname.split('/');
    const akoId = parseInt(urlParts[urlParts.length - 1]) || 1;
    const akoItem = AKOMODASI_DATA.find(d => d.id === akoId) || AKOMODASI_DATA[0];

    // Populasikan rincian bed, smoking, dan fasilitas
    document.getElementById('dynBed').innerHTML = `<iconify-icon icon="lucide:bed-double" class="text-lg"></iconify-icon> ${akoItem.kasur}`;
    document.getElementById('dynSmoking').innerHTML = `<iconify-icon icon="${akoItem.merokok ? 'lucide:cigarette' : 'lucide:cigarette-off'}" class="text-lg"></iconify-icon> ${akoItem.merokok ? 'Boleh merokok di kamar' : 'Dilarang merokok'}`;
    
    // Pecah fasilitas jadi dua kolom
    const fasLen = Math.ceil(akoItem.fasilitas.length / 2);
    document.getElementById('dynFasilitas1').innerHTML = akoItem.fasilitas.slice(0, fasLen).map(f => `<li>${f}</li>`).join('');
    document.getElementById('dynFasilitas2').innerHTML = akoItem.fasilitas.slice(fasLen).map(f => `<li>${f}</li>`).join('');
    document.getElementById('dynMakanan').innerHTML = akoItem.makanan.map(m => `<li>${m}</li>`).join('');
    
    // Load dynamic user data from sessionStorage
    const dJudul = sessionStorage.getItem('res_judul');
    const dNama = sessionStorage.getItem('res_nama');
    const dHp = sessionStorage.getItem('res_hp');
    const dEmail = sessionStorage.getItem('res_email');
    const dTamu = sessionStorage.getItem('res_tamu');
    const dGuest = sessionStorage.getItem('res_guest');
    const dTotal = sessionStorage.getItem('res_total');
    const dMalam = sessionStorage.getItem('res_malam');
    const dCheckin = sessionStorage.getItem('res_checkin');
    const dCheckout = sessionStorage.getItem('res_checkout');
    
    if(dJudul) document.getElementById('dynJudul').textContent = dJudul;
    if(dNama) document.getElementById('dynNama').textContent = dNama;
    if(dHp) document.getElementById('dynHp').textContent = dHp;
    if(dEmail) document.getElementById('dynEmail').textContent = dEmail;
    if(dTamu) document.getElementById('dynTamu').textContent = dTamu;
    if(dGuest) document.getElementById('dynGuestInfo').textContent = dGuest;
    if(dTotal) document.getElementById('dynTotalHarga').textContent = dTotal;
    if(dMalam) document.getElementById('dynMalam').textContent = `${dMalam} malam`;
    if(dCheckin) document.getElementById('dynCheckin').textContent = dCheckin;
    if(dCheckout) document.getElementById('dynCheckout').textContent = dCheckout;
    
})();
</script>
@endpush
@endsection
