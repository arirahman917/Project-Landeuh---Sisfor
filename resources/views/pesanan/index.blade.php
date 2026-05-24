@extends('layouts.app')
@section('title', 'Daftar Pesanan Saya — Landeuh Village')
@section('content')

{{-- Hero Section for Pesanan --}}
<section class="relative w-full pt-[120px] pb-12 overflow-hidden bg-[#F8EDD8]">
    <!-- Batik Accents -->
    <svg class="absolute top-0 right-0 w-64 h-64 opacity-20 pointer-events-none transform translate-x-1/4 -translate-y-1/4 text-[#d4a373]" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
        <path d="M10,40 Q20,20 40,30 T70,10 T90,30 T70,50 T40,40 T10,60" fill="none" stroke="currentColor" stroke-width="2"/>
        <path d="M20,50 Q30,30 50,40 T80,20" fill="none" stroke="currentColor" stroke-width="1.5"/>
    </svg>
    <svg class="absolute bottom-0 left-0 w-48 h-48 opacity-20 pointer-events-none transform -translate-x-1/4 translate-y-1/4 text-[#d4a373] rotate-180" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
        <path d="M10,40 Q20,20 40,30 T70,10 T90,30 T70,50 T40,40 T10,60" fill="none" stroke="currentColor" stroke-width="2"/>
        <path d="M20,50 Q30,30 50,40 T80,20" fill="none" stroke="currentColor" stroke-width="1.5"/>
    </svg>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-5xl font-extrabold text-[#3a523a] mb-4">Pesanan Saya</h1>
            <p class="text-gray-600 max-w-2xl mx-auto text-sm md:text-base">Lacak status pesanan akomodasi Anda di Landeuh Village Riverside. Pastikan untuk segera menyelesaikan pembayaran sebelum batas waktu berakhir.</p>
        </div>

        {{-- Content Area --}}
        <div id="pesananContent" class="min-h-[400px]">
            {{-- This content will be dynamically injected based on login state --}}
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
    const container = document.getElementById('pesananContent');

    if (!isLoggedIn) {
        renderNotLoggedIn(container);
    } else {
        // Mock data. In reality, fetch from API based on user session
        const hasOrders = true; // Set to false to see empty state
        
        if (!hasOrders) {
            renderEmptyState(container);
        } else {
            renderOrders(container);
        }
    }
});

function renderNotLoggedIn(container) {
    container.innerHTML = `
        <div class="bg-white/60 backdrop-blur-md rounded-2xl border border-white/50 shadow-xl p-10 max-w-lg mx-auto text-center mt-10">
            <div class="w-20 h-20 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-3">Anda Belum Log In</h3>
            <p class="text-gray-600 mb-8">Silakan masuk ke akun Anda terlebih dahulu untuk melihat riwayat pesanan.</p>
            <button onclick="if(typeof openLoginModal==='function'){openLoginModal();}else{alert('Fitur login tidak tersedia di halaman ini.');}" class="bg-[#3a523a] hover:bg-[#2c402c] text-white font-bold py-3 px-8 rounded-full transition shadow-md w-full sm:w-auto">
                Masuk / Daftar Sekarang
            </button>
        </div>
    `;
}

function renderEmptyState(container) {
    container.innerHTML = `
        <div class="bg-white/60 backdrop-blur-md rounded-2xl border border-white/50 shadow-xl p-10 max-w-lg mx-auto text-center mt-10">
            <div class="w-20 h-20 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-3">Belum Ada Pesanan</h3>
            <p class="text-gray-600 mb-8">Anda belum melakukan pesanan akomodasi apapun. Yuk mulai eksplorasi akomodasi kami!</p>
            <a href="/akomodasi" class="inline-block bg-[#3a523a] hover:bg-[#2c402c] text-white font-bold py-3 px-8 rounded-full transition shadow-md w-full sm:w-auto">
                Cari Akomodasi
            </a>
        </div>
    `;
}

function renderOrders(container) {
    // Basic Tabs Layout
    container.innerHTML = `
        <div class="flex flex-wrap gap-2 md:gap-4 border-b border-gray-300 pb-2 mb-8" id="pesananTabs">
            <button class="tab-btn active px-4 py-2 font-bold text-sm md:text-base border-b-2 border-[#3a523a] text-[#3a523a] transition" data-target="belumbayar">Belum Dibayar</button>
            <button class="tab-btn px-4 py-2 font-bold text-sm md:text-base border-b-2 border-transparent text-gray-500 hover:text-gray-800 transition" data-target="lunas">Selesai/Lunas</button>
            <button class="tab-btn px-4 py-2 font-bold text-sm md:text-base border-b-2 border-transparent text-gray-500 hover:text-gray-800 transition" data-target="batal">Dibatalkan</button>
        </div>

        <div id="tabContent_belumbayar" class="tab-pane flex flex-col gap-4">
            <!-- Example: Belum Bayar Item -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-4 md:p-6 border-b border-gray-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-3 bg-red-50/50">
                    <div>
                        <div class="text-xs font-bold text-red-600 uppercase tracking-wider mb-1">Menunggu Pembayaran</div>
                        <div class="text-sm font-semibold text-gray-800">Order ID: LDH-7F3B1</div>
                    </div>
                    <div class="bg-red-100 text-red-700 px-3 py-1.5 rounded-lg text-sm font-bold flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span id="countdown_timer">23:59:00</span>
                    </div>
                </div>
                <div class="p-4 md:p-6 flex flex-col md:flex-row gap-6">
                    <img src="{{ asset('images/akomodasi/cabin1.jpg') }}" alt="Cabin" class="w-full md:w-48 h-32 object-cover rounded-xl shrink-0">
                    <div class="flex-1">
                        <h4 class="text-xl font-bold text-gray-800 mb-2">Cabin 1</h4>
                        <div class="text-sm text-gray-500 space-y-1 mb-4">
                            <div class="flex gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> 28 Apr 2026 - 30 Apr 2026 (2 Malam)</div>
                            <div class="flex gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg> 2 Dewasa</div>
                        </div>
                        <div class="text-lg font-extrabold text-[#e53e3e]">IDR 2.400.000</div>
                    </div>
                    <div class="flex items-center">
                        <a href="#" class="w-full md:w-auto text-center bg-[#3a523a] hover:bg-[#2c402c] text-white font-bold py-2.5 px-6 rounded-lg transition shadow">Lanjutkan Pembayaran</a>
                    </div>
                </div>
            </div>
        </div>

        <div id="tabContent_lunas" class="tab-pane flex flex-col gap-4 hidden">
            <!-- Example: Lunas Item -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden opacity-90">
                <div class="p-4 md:p-6 border-b border-gray-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-3 bg-green-50/50">
                    <div>
                        <div class="text-xs font-bold text-green-600 uppercase tracking-wider mb-1">Berhasil & Lunas</div>
                        <div class="text-sm font-semibold text-gray-800">Order ID: LDH-9A2C4</div>
                    </div>
                </div>
                <div class="p-4 md:p-6 flex flex-col md:flex-row gap-6">
                    <div class="w-full md:w-48 h-32 bg-gray-200 rounded-xl shrink-0 flex items-center justify-center text-gray-400"><iconify-icon icon="lucide:image" class="text-3xl"></iconify-icon></div>
                    <div class="flex-1">
                        <h4 class="text-xl font-bold text-gray-800 mb-2">Glamping VIP</h4>
                        <div class="text-sm text-gray-500 space-y-1 mb-4">
                            <div class="flex gap-2"><iconify-icon icon="lucide:calendar"></iconify-icon> 10 Mar 2026 - 11 Mar 2026 (1 Malam)</div>
                        </div>
                        <div class="text-lg font-extrabold text-[#e53e3e]">IDR 1.500.000</div>
                    </div>
                    <div class="flex flex-col gap-2 justify-center">
                        <button class="bg-blue-50 text-blue-600 hover:bg-blue-100 font-bold py-2 px-4 rounded-lg transition text-sm shadow-sm border border-blue-100">Cetak E-Voucher</button>
                        <button onclick="ajukanPembatalan()" class="bg-white text-red-500 hover:bg-red-50 border border-red-200 font-bold py-2 px-4 rounded-lg transition text-sm">Ajukan Pembatalan</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="tabContent_batal" class="tab-pane flex flex-col gap-4 hidden">
            <!-- Example: Pending Batal Item -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden opacity-75">
                <div class="p-4 md:p-6 border-b border-gray-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-3 bg-yellow-50/50">
                    <div>
                        <div class="text-xs font-bold text-yellow-600 uppercase tracking-wider mb-1">Pengajuan Pembatalan: Diproses</div>
                        <div class="text-sm font-semibold text-gray-800">Order ID: LDH-4X9M1</div>
                    </div>
                </div>
                <div class="p-4 md:p-6 flex flex-col md:flex-row gap-6">
                    <div class="w-full md:w-48 h-32 bg-gray-200 rounded-xl shrink-0 flex items-center justify-center text-gray-400"><iconify-icon icon="lucide:image" class="text-3xl"></iconify-icon></div>
                    <div class="flex-1">
                        <h4 class="text-xl font-bold text-gray-800 mb-2">Rumah Industrial</h4>
                        <div class="text-sm text-gray-500 space-y-1 mb-4">
                            <div class="flex gap-2"><iconify-icon icon="lucide:calendar"></iconify-icon> 05 May 2026 - 07 May 2026 (2 Malam)</div>
                        </div>
                        <div class="text-lg font-extrabold text-[#e53e3e]">IDR 3.000.000</div>
                    </div>
                    <div class="flex items-center justify-center">
                         <span class="text-sm text-yellow-600 font-semibold italic text-center">Menunggu konfirmasi Admin</span>
                    </div>
                </div>
            </div>

            <!-- Example: Batal Item -->
            <div class="bg-gray-50 rounded-2xl shadow-sm border border-gray-200 overflow-hidden opacity-60">
                <div class="p-4 md:p-6 border-b border-gray-200 flex flex-col md:flex-row justify-between items-start md:items-center gap-3 bg-gray-100/50">
                    <div>
                        <div class="text-xs font-bold text-gray-600 uppercase tracking-wider mb-1">Dibatalkan</div>
                        <div class="text-sm font-semibold text-gray-500 line-through">Order ID: LDH-1B2C3</div>
                    </div>
                    <div class="text-sm font-bold text-gray-500">Dana Dikembalikan</div>
                </div>
                <div class="p-4 md:p-6 flex flex-col md:flex-row gap-6">
                    <div class="flex-1">
                        <h4 class="text-xl font-bold text-gray-500 mb-2">Cabin 2</h4>
                        <div class="text-lg font-extrabold text-gray-400">IDR 1.200.000</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Pembatalan (Sama dengan konfirmasi) -->
        <style>
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
        @keyframes scaleInBounce{
            0%{transform:scale(0);opacity:0}
            50%{transform:scale(1.1);opacity:1}
            100%{transform:scale(1);opacity:1}
        }
        .cp-check-path{stroke-dasharray:45;stroke-dashoffset:45;animation:drawCheck .5s .2s forwards}
        @keyframes drawCheck{to{stroke-dashoffset:0}}
        </style>
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
                <button class="modal-btn-wa" onclick="window.open('https://wa.me/6281234567890?text=Halo%20Admin%2C%20saya%20ingin%20mengonfirmasi%20pengajuan%20pembatalan%20pesanan%20saya.%20No.%20Pemesanan%3A%20' + encodeURIComponent('LDH-9A2C4'), '_blank')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    Hubungi Admin via WhatsApp
                </button>
                <button class="modal-btn-close" onclick="closeModalPembatalan()">Tutup</button>
            </div>
        </div>
    `;

    // Setup Tabs Logic
    const tabs = container.querySelectorAll('.tab-btn');
    const panes = container.querySelectorAll('.tab-pane');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            // Remove active styles from all
            tabs.forEach(t => {
                t.classList.remove('active', 'border-[#3a523a]', 'text-[#3a523a]');
                t.classList.add('border-transparent', 'text-gray-500');
            });
            panes.forEach(p => p.classList.add('hidden'));

            // Add active styles to clicked
            tab.classList.add('active', 'border-[#3a523a]', 'text-[#3a523a]');
            tab.classList.remove('border-transparent', 'text-gray-500');
            
            // Show content
            const target = tab.getAttribute('data-target');
            document.getElementById('tabContent_' + target).classList.remove('hidden');
        });
    });
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
document.addEventListener('click', function(e) {
    const modal = document.getElementById('modalPembatalan');
    if (modal && e.target === modal) {
        closeModalPembatalan();
    }
});
</script>
@endpush
