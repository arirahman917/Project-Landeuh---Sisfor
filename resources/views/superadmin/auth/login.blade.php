@extends('layouts.blank')
@section('content')

<style>
    [x-cloak] { display: none !important; }
</style>

<div
    x-data="superLoginApp()"
    class="relative min-h-screen w-full flex items-center justify-center overflow-hidden font-sans"
>

    {{-- ── BACKGROUND ──────────────────────────────────────────── --}}
    <div class="absolute inset-0 z-0 bg-[#0c0f12]">
        {{-- Elegant subtle gradient overlay --}}
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-950/40 via-stone-900/60 to-amber-950/30"></div>
        {{-- subtle grain texture --}}
        <svg class="absolute inset-0 w-full h-full opacity-[0.05] pointer-events-none" xmlns="http://www.w3.org/2000/svg">
            <filter id="noise">
                <feTurbulence type="fractalNoise" baseFrequency="0.8" numOctaves="3" stitchTiles="stitch"/>
                <feColorMatrix type="saturate" values="0"/>
            </filter>
            <rect width="100%" height="100%" filter="url(#noise)"/>
        </svg>
    </div>

    {{-- ── DECORATIVE GOLDEN LIGHTS ────────────────────────────── --}}
    <div class="absolute -top-40 -left-40 w-96 h-96 rounded-full bg-amber-500/10 blur-[120px] pointer-events-none"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 rounded-full bg-yellow-500/10 blur-[120px] pointer-events-none"></div>

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
        <div class="bg-stone-900/80 backdrop-blur-2xl rounded-3xl shadow-2xl border border-stone-800/80 overflow-hidden">

            {{-- gold accent line --}}
            <div class="h-1 w-full bg-gradient-to-r from-amber-600 via-yellow-500 to-amber-600"></div>

            <div class="px-10 py-12">

                {{-- ── HEADER ──────────────────────────────────── --}}
                <div class="text-center mb-8">
                    <div class="flex justify-center mb-4">
                        <div class="w-14 h-14 rounded-2xl bg-amber-500/10 border border-amber-500/30 flex items-center justify-center text-amber-500">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                    </div>
                    <h1 class="text-2xl font-bold tracking-tight text-stone-100" style="font-family:'Georgia',serif;">
                        Superadmin Login
                    </h1>
                    <p class="text-stone-400 text-sm mt-1">Sistem Informasi Landeuh Village</p>
                </div>

                {{-- ── FORM FIELDS ──────────────────────────────── --}}
                <div class="space-y-5">

                    {{-- Email --}}
                    <div>
                        <label class="block text-xs font-semibold text-stone-300 mb-1.5 tracking-widest uppercase">Email Superadmin</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-3.5 flex items-center text-amber-500 pointer-events-none">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </span>
                            <input
                                x-model="email"
                                type="email"
                                placeholder="superadmin@landeuh.com"
                                @keydown.enter="doLogin"
                                class="w-full pl-10 pr-4 py-3 rounded-xl border border-stone-800 bg-stone-950/70 text-stone-200 placeholder-stone-600 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition"
                            />
                        </div>
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="block text-xs font-semibold text-stone-300 mb-1.5 tracking-widest uppercase">Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-3.5 flex items-center text-amber-500 pointer-events-none">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </span>
                            <input
                                x-model="password"
                                type="password"
                                placeholder="••••••••"
                                @keydown.enter="doLogin"
                                class="w-full pl-10 pr-4 py-3 rounded-xl border border-stone-800 bg-stone-950/70 text-stone-200 placeholder-stone-600 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition"
                            />
                        </div>
                    </div>

                    {{-- Submit button --}}
                    <button
                        type="button"
                        @click="doLogin"
                        :disabled="loading"
                        class="w-full py-3.5 rounded-xl bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-500 hover:to-amber-600 text-stone-950 font-bold text-base tracking-wide shadow-lg shadow-amber-950/40 transition-all duration-200 active:scale-[0.98] disabled:opacity-60 flex items-center justify-center gap-2"
                    >
                        <svg x-cloak x-show="loading" class="animate-spin w-5 h-5 shrink-0 text-stone-950" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"/>
                        </svg>
                        <span x-text="loading ? 'Memproses...' : 'Masuk Control Panel'"></span>
                    </button>

                </div>

                {{-- back to website --}}
                <div class="text-center mt-6">
                    <a href="/" class="text-xs text-stone-500 hover:text-stone-300 transition">← Kembali ke Website</a>
                </div>

            </div>
        </div>
    </div>

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
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm px-4"
    >

        {{-- ── Modal SUCCESS ──────────────────────────────────── --}}
        <div
            x-cloak
            x-show="view === 'success'"
            class="relative w-full max-w-xs bg-stone-900 rounded-2xl shadow-2xl p-8 text-center border border-stone-800"
        >
            <div class="mx-auto w-20 h-20 bg-green-950/50 border border-green-500/30 rounded-full flex items-center justify-center mb-4 relative">
                <div class="absolute inset-0 bg-green-500 rounded-full animate-ping opacity-10"></div>
                <div class="w-14 h-14 bg-green-600 rounded-full flex items-center justify-center z-10 text-white">
                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
            </div>
            <h2 class="text-xl font-bold text-stone-100">Login Berhasil</h2>
            <p class="text-stone-400 text-sm mt-1 mb-3">Mengalihkan ke Control Panel…</p>
            <div class="h-1 rounded-full bg-stone-800 overflow-hidden">
                <div class="h-full bg-amber-500 rounded-full" style="animation: grow 1.6s ease-in-out forwards;"></div>
            </div>
        </div>

        {{-- ── Modal FAILED ───────────────────────────────────── --}}
        <div
            x-cloak
            x-show="view === 'failed'"
            class="relative w-full max-w-xs bg-stone-900 rounded-2xl shadow-2xl p-8 text-center border border-stone-800"
        >
            <div class="mx-auto w-20 h-20 bg-red-950/50 border border-red-500/30 rounded-full flex items-center justify-center mb-4 relative">
                <div class="absolute inset-0 bg-red-500 rounded-full animate-ping opacity-10"></div>
                <div class="w-14 h-14 bg-red-600 rounded-full flex items-center justify-center z-10 text-white">
                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>
            </div>
            <h2 class="text-xl font-bold text-stone-100 mb-1">Login Gagal</h2>
            <p class="text-stone-400 text-sm mb-4" x-text="errorMessage"></p>
            <button
                @click="view = 'form'; password = '';"
                class="text-amber-500 font-bold hover:text-amber-400 transition text-sm"
            >
                Coba Lagi
            </button>
        </div>

    </div>

</div>

<style>
    @keyframes grow {
        from { width: 0%; }
        to   { width: 100%; }
    }
</style>

<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<script>
    function superLoginApp() {
        return {
            email: '',
            password: '',
            loading: false,
            view: 'form',
            errorMessage: 'Email atau password salah.',

            async doLogin() {
                if (!this.email || !this.password) return;
                this.loading = true;

                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

                try {
                    const response = await fetch('{{ route("superadmin.login.post") }}', {
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
                    const data = await response.json();

                    if (response.ok && data.success) {
                        this.view = 'success';
                        setTimeout(() => {
                            window.location.href = data.redirect;
                        }, 1800);
                    } else {
                        this.errorMessage = data.message || 'Email atau password salah.';
                        this.view = 'failed';
                    }
                } catch (err) {
                    this.loading = false;
                    this.errorMessage = 'Terjadi kesalahan koneksi.';
                    this.view = 'failed';
                    console.error('Superadmin login error:', err);
                }
            }
        };
    }
</script>

@endsection
