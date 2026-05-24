@extends('layouts.blank')
@section('content')

<style>
    [x-cloak] { display: none !important; }
</style>

{{-- ============================================================
     LOGIN PAGE — Admin Dashboard Reservasi Akomodasi
     Stack  : Tailwind CSS + Alpine.js
     Autentikasi : Terhubung ke database MySQL via Laravel Auth
     ============================================================ --}}

<div
    x-data="loginApp()"
    class="relative min-h-screen w-full flex items-center justify-center overflow-hidden font-sans"
>

    {{-- ── BACKGROUND ──────────────────────────────────────────── --}}
    <div class="absolute inset-0 z-0">
        {{-- Ganti URL ini dengan asset foto asli (storage/public atau Unsplash lokal) --}}
        <img
            src="{{ asset('images/akomodasi/carousel/a.png') }}"
            alt="Background akomodasi"
            class="w-full h-full object-cover"
        />
        {{-- warm-dark overlay --}}
        <div class="absolute inset-0 bg-gradient-to-br from-stone-900/70 via-stone-800/50 to-amber-900/60 backdrop-blur-[2px]"></div>
        {{-- subtle grain texture --}}
        <svg class="absolute inset-0 w-full h-full opacity-[0.04] pointer-events-none" xmlns="http://www.w3.org/2000/svg">
            <filter id="noise">
                <feTurbulence type="fractalNoise" baseFrequency="0.65" numOctaves="3" stitchTiles="stitch"/>
                <feColorMatrix type="saturate" values="0"/>
            </filter>
            <rect width="100%" height="100%" filter="url(#noise)"/>
        </svg>
    </div>

    {{-- ── DECORATIVE RINGS ────────────────────────────────────── --}}
    <div class="absolute top-16 left-16 w-64 h-64 rounded-full border border-amber-400/20 animate-[spin_30s_linear_infinite] hidden md:block pointer-events-none"></div>
    <div class="absolute bottom-20 right-20 w-96 h-96 rounded-full border border-amber-400/10 animate-[spin_45s_linear_infinite_reverse] hidden md:block pointer-events-none"></div>

    {{-- ══════════════════════════════════════════════════════════
         FORM CARD
         ══════════════════════════════════════════════════════════ --}}
    <div
        x-cloak
        class="relative z-10 w-full max-w-md mx-4"
        x-show="view === 'form'"
        x-transition:enter="transition duration-500 ease-out"
        x-transition:enter-start="opacity-0 translate-y-6"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition duration-200 ease-in"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div class="bg-[#fdf6e3]/95 backdrop-blur-xl rounded-3xl shadow-2xl shadow-black/40 overflow-hidden border border-amber-200/60">

            {{-- accent bar --}}
            <div class="h-1 w-full bg-gradient-to-r from-amber-400 via-yellow-500 to-amber-600"></div>

            <div class="px-10 py-10">

                {{-- ── HEADER ──────────────────────────────────── --}}
                <div class="text-center mb-8">
                    <div class="flex justify-center gap-2 mb-3 opacity-60">
                        {{-- awan kiri --}}
                        <svg width="52" height="24" viewBox="0 0 52 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 20 Q8 6 18 12 Q20 2 28 8 Q34 2 42 10 Q46 4 52 16" stroke="#d97706" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                            <path d="M0 22 Q7 12 14 16 Q17 8 24 12" stroke="#f59e0b" stroke-width="1.5" fill="none" stroke-linecap="round" opacity="0.5"/>
                        </svg>
                        {{-- awan kanan (mirror) --}}
                        <svg width="52" height="24" viewBox="0 0 52 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="transform:scaleX(-1)">
                            <path d="M2 20 Q8 6 18 12 Q20 2 28 8 Q34 2 42 10 Q46 4 52 16" stroke="#d97706" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                            <path d="M0 22 Q7 12 14 16 Q17 8 24 12" stroke="#f59e0b" stroke-width="1.5" fill="none" stroke-linecap="round" opacity="0.5"/>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold tracking-tight text-stone-800" style="font-family:'Georgia',serif;">
                        Masuk Admin
                    </h1>
                    <p class="text-stone-500 text-sm mt-1 tracking-wide">Dashboard Reservasi Akomodasi</p>
                </div>

                {{-- ── FORM FIELDS ──────────────────────────────── --}}
                <div class="space-y-5">

                    {{-- Email --}}
                    <div>
                        <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-widest uppercase">Email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-3.5 flex items-center text-amber-600 pointer-events-none">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </span>
                            <input
                                x-model="email"
                                type="email"
                                placeholder="Masukkan Email"
                                @keydown.enter="doLogin"
                                autocomplete="email"
                                class="w-full pl-10 pr-4 py-3 rounded-xl border border-stone-200 bg-white/80 text-stone-800 placeholder-stone-400 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"
                            />
                        </div>
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-widest uppercase">Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-3.5 flex items-center text-amber-600 pointer-events-none">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </span>
                            <input
                                x-model="password"
                                :type="showPass ? 'text' : 'password'"
                                placeholder="Masukkan Password"
                                @keydown.enter="doLogin"
                                autocomplete="current-password"
                                class="w-full pl-10 pr-10 py-3 rounded-xl border border-stone-200 bg-white/80 text-stone-800 placeholder-stone-400 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"
                            />
                            <button
                                type="button"
                                @click="showPass = !showPass"
                                class="absolute inset-y-0 right-3.5 flex items-center text-stone-400 hover:text-amber-600 transition"
                                tabindex="-1"
                                :aria-label="showPass ? 'Sembunyikan password' : 'Tampilkan password'"
                            >
                                {{-- eye open --}}
                                <svg x-cloak x-show="!showPass" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                {{-- eye closed --}}
                                <svg x-cloak x-show="showPass" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Submit button --}}
                    <button
                        type="button"
                        @click="doLogin"
                        :disabled="loading"
                        class="w-full py-3.5 rounded-xl bg-gradient-to-r from-[#2d4a2d] to-[#3d6b3d] hover:from-[#3d6b3d] hover:to-[#4a824a] text-[#fdf6e3] font-bold text-base tracking-wide shadow-lg shadow-green-900/30 transition-all duration-200 active:scale-[0.98] disabled:opacity-60 flex items-center justify-center gap-2"
                    >
                        <svg x-cloak x-show="loading" class="animate-spin w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"/>
                        </svg>
                        <span x-text="loading ? 'Memproses...' : 'Log In'"></span>
                    </button>

                </div>{{-- /space-y-5 --}}

                {{-- footer note --}}
                <p class="text-center text-stone-400 text-xs mt-6 leading-relaxed">
                    Dengan melanjutkan, kamu setuju dengan aturan<br/>penggunaan aplikasi ini.
                </p>

                {{-- ornament bawah --}}
                <div class="flex justify-center mt-4 opacity-30">
                    <svg width="72" height="16" viewBox="0 0 72 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 12 Q12 2 22 8 Q27 0 36 6 Q44 0 50 8 Q60 2 70 12" stroke="#d97706" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                    </svg>
                </div>

            </div>{{-- /px-10 py-10 --}}
        </div>{{-- /card --}}
    </div>{{-- /form wrapper --}}


    {{-- ══════════════════════════════════════════════════════════
         MODAL OVERLAY
         ══════════════════════════════════════════════════════════ --}}
    <div
        x-cloak
        x-show="view === 'success' || view === 'failed'"
        x-transition:enter="transition duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm px-4"
    >

        {{-- ── Modal SUCCESS ──────────────────────────────────── --}}
        <div
            id="modalLoginSuccess"
            x-cloak
            x-show="view === 'success'"
            x-transition:enter="transition duration-300 ease-out"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            class="relative w-full max-w-xs bg-white rounded-2xl shadow-2xl p-8 text-center"
        >
            <div class="mx-auto w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mb-4 relative">
                <div class="absolute inset-0 bg-green-200 rounded-full animate-ping opacity-20"></div>
                <div class="w-14 h-14 bg-[#34c759] rounded-full flex items-center justify-center z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
            </div>
            <h2 class="text-xl font-bold text-gray-800">Log In Berhasil</h2>
            <p class="text-gray-400 text-sm mt-1 mb-3">Mengalihkan ke dashboard…</p>
            {{-- progress bar --}}
            <div class="h-1 rounded-full bg-gray-100 overflow-hidden">
                <div class="h-full bg-[#34c759] rounded-full" style="animation: grow 1.6s ease-in-out forwards;"></div>
            </div>
        </div>

        {{-- ── Modal FAILED ───────────────────────────────────── --}}
        <div
            id="modalLoginFailed"
            x-cloak
            x-show="view === 'failed'"
            x-transition:enter="transition duration-300 ease-out"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            class="relative w-full max-w-xs bg-white rounded-2xl shadow-2xl p-8 text-center"
        >
            <div class="mx-auto w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mb-4 relative">
                <div class="absolute inset-0 bg-red-200 rounded-full animate-ping opacity-20"></div>
                <div class="w-14 h-14 bg-[#ff3b30] rounded-full flex items-center justify-center z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>
            </div>
            <h2 class="text-xl font-bold text-gray-800 mb-1">Log In Gagal</h2>
            <p class="text-gray-400 text-sm mb-4">Email atau password tidak valid.</p>
            <button
                onclick="showLoginManualForm()"
                class="text-blue-500 font-bold hover:text-blue-700 transition text-sm"
            >
                Coba Lagi
            </button>
        </div>

    </div>{{-- /modal overlay --}}

</div>{{-- /root --}}


{{-- ── CUSTOM STYLES ────────────────────────────────────────────── --}}
<style>
    @keyframes grow {
        from { width: 0%; }
        to   { width: 100%; }
    }
    @keyframes spin_reverse {
        from { transform: rotate(360deg); }
        to   { transform: rotate(0deg); }
    }
</style>


{{-- ── ALPINE.JS ────────────────────────────────────────────────── --}}
{{-- Hapus baris ini jika Alpine sudah di-load lewat app.js / layouts --}}
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<script>
    // ── Dipanggil dari tombol "Coba Lagi" di modal failed ──
    function showLoginManualForm() {
        // Alpine meng-handle ini via retry(), tapi agar kompatibel
        // dengan pola onclick langsung dari HTML modal:
        const root = document.querySelector('[x-data]');
        if (root && root._x_dataStack) {
            root._x_dataStack[0].retry();
        }
    }

    function loginApp() {
        return {
            email    : '',
            password : '',
            showPass : false,
            loading  : false,
            view     : 'form',   // 'form' | 'success' | 'failed'

            async doLogin() {
                if (this.loading) return;
                this.loading = true;

                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

                try {
                    const response = await fetch('/admin/login', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: JSON.stringify({
                            email: this.email.trim(),
                            password: this.password,
                        }),
                    });

                    this.loading = false;

                    if (response.ok) {
                        this.view = 'success';
                        setTimeout(() => {
                            window.location.href = '/admin/dashboard';
                        }, 1800);
                    } else {
                        this.view = 'failed';
                    }
                } catch (err) {
                    this.loading = false;
                    this.view = 'failed';
                    console.error('Login error:', err);
                }
            },

            retry() {
                this.view     = 'form';
                this.password = '';
            },
        };
    }
</script>

@endsection