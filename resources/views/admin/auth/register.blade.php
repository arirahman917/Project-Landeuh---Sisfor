@extends('layouts.blank')
@section('content')

<style>
    [x-cloak] { display: none !important; }
</style>

<div
    x-data="registerApp()"
    class="relative min-h-screen w-full flex items-center justify-center overflow-hidden font-sans py-12"
>

    {{-- ── BACKGROUND ──────────────────────────────────────────── --}}
    <div class="absolute inset-0 z-0">
        <img
            src="{{ asset('images/akomodasi/carousel/a.webp') }}"
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
                <div class="text-center mb-6">
                    <div class="flex justify-center gap-2 mb-3 opacity-60">
                        <svg width="52" height="24" viewBox="0 0 52 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 20 Q8 6 18 12 Q20 2 28 8 Q34 2 42 10 Q46 4 52 16" stroke="#d97706" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                        </svg>
                        <svg width="52" height="24" viewBox="0 0 52 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="transform:scaleX(-1)">
                            <path d="M2 20 Q8 6 18 12 Q20 2 28 8 Q34 2 42 10 Q46 4 52 16" stroke="#d97706" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold tracking-tight text-stone-800" style="font-family:'Georgia',serif;">
                        Daftar Admin Baru
                    </h1>
                    <p class="text-stone-500 text-sm mt-1 tracking-wide">Pendaftaran Akun Pengelola Akomodasi</p>
                </div>

                {{-- ── FORM FIELDS ──────────────────────────────── --}}
                <div class="space-y-4">

                    {{-- Nama Lengkap --}}
                    <div>
                        <label class="block text-xs font-semibold text-stone-600 mb-1 tracking-widest uppercase">Nama Lengkap</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-3.5 flex items-center text-amber-600 pointer-events-none">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </span>
                            <input
                                x-model="name"
                                type="text"
                                placeholder="Nama Lengkap Anda"
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 placeholder-stone-400 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"
                            />
                        </div>
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div>
                        <label class="block text-xs font-semibold text-stone-600 mb-1 tracking-widest uppercase">Jenis Kelamin</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-3.5 flex items-center text-amber-600 pointer-events-none">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </span>
                            <select
                                x-model="gender"
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"
                            >
                                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>

                    {{-- No. WhatsApp --}}
                    <div>
                        <label class="block text-xs font-semibold text-stone-600 mb-1 tracking-widest uppercase">No. WhatsApp</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-3.5 flex items-center text-amber-600 pointer-events-none">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </span>
                            <input
                                x-model="phone"
                                type="text"
                                placeholder="Contoh: 08123456789"
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 placeholder-stone-400 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"
                            />
                        </div>
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-xs font-semibold text-stone-600 mb-1 tracking-widest uppercase">Email</label>
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
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 placeholder-stone-400 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"
                            />
                        </div>
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="block text-xs font-semibold text-stone-600 mb-1 tracking-widest uppercase">Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-3.5 flex items-center text-amber-600 pointer-events-none">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </span>
                            <input
                                x-model="password"
                                type="password"
                                placeholder="Masukkan Password (min 6 karakter)"
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 placeholder-stone-400 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"
                            />
                        </div>
                    </div>

                    {{-- Submit button --}}
                    <button
                        type="button"
                        @click="doRegister"
                        :disabled="loading"
                        class="w-full py-3 rounded-xl bg-gradient-to-r from-[#2d4a2d] to-[#3d6b3d] hover:from-[#3d6b3d] hover:to-[#4a824a] text-[#fdf6e3] font-bold text-base tracking-wide shadow-lg shadow-green-900/30 transition-all duration-200 active:scale-[0.98] disabled:opacity-60 flex items-center justify-center gap-2 mt-2"
                    >
                        <svg x-cloak x-show="loading" class="animate-spin w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"/>
                        </svg>
                        <span x-text="loading ? 'Memproses...' : 'Daftar Sekarang'"></span>
                    </button>

                </div>

                {{-- back to login --}}
                <div class="text-center mt-6">
                    <p class="text-xs text-stone-500">
                        Sudah punya akun? 
                        <a href="{{ route('admin.login') }}" class="font-bold text-amber-700 hover:text-amber-900 hover:underline transition">Masuk di sini</a>
                    </p>
                </div>

            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════════════════
         MODAL OVERLAY (Success / Failure)
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
            x-cloak
            x-show="view === 'success'"
            class="relative w-full max-w-sm bg-white rounded-2xl shadow-2xl p-8 text-center"
        >
            <div class="mx-auto w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mb-4 relative">
                <div class="absolute inset-0 bg-green-200 rounded-full animate-ping opacity-20"></div>
                <div class="w-14 h-14 bg-[#34c759] rounded-full flex items-center justify-center z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
            </div>
            <h2 class="text-xl font-bold text-gray-800">Pendaftaran Berhasil</h2>
            <p class="text-gray-500 text-sm mt-2 mb-4" x-text="successMessage"></p>
            <a
                href="{{ route('admin.login') }}"
                class="inline-block px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-xl font-bold text-sm transition"
            >
                Ke Halaman Login
            </a>
        </div>

        {{-- ── Modal FAILED ───────────────────────────────────── --}}
        <div
            x-cloak
            x-show="view === 'failed'"
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
            <h2 class="text-xl font-bold text-gray-800 mb-1">Registrasi Gagal</h2>
            <p class="text-gray-500 text-sm mb-4" x-text="errorMessage"></p>
            <button
                @click="view = 'form'"
                class="text-blue-500 font-bold hover:text-blue-700 transition text-sm"
            >
                Coba Lagi
            </button>
        </div>

    </div>

</div>

<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<script>
    function registerApp() {
        return {
            name: '',
            gender: '',
            phone: '',
            email: '',
            password: '',
            loading: false,
            view: 'form',
            errorMessage: '',
            successMessage: '',

            async doRegister() {
                if (!this.name || !this.gender || !this.phone || !this.email || !this.password) {
                    this.errorMessage = 'Semua field wajib diisi.';
                    this.view = 'failed';
                    return;
                }
                if (this.password.length < 6) {
                    this.errorMessage = 'Password minimal 6 karakter.';
                    this.view = 'failed';
                    return;
                }

                this.loading = true;
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

                try {
                    const response = await fetch('{{ route("admin.register.post") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: JSON.stringify({
                            name: this.name.trim(),
                            gender: this.gender,
                            phone: this.phone.trim(),
                            email: this.email.trim(),
                            password: this.password,
                        }),
                    });

                    this.loading = false;
                    const data = await response.json();

                    if (response.ok) {
                        this.successMessage = data.message;
                        this.view = 'success';
                    } else {
                        // Extract validation messages if any
                        let msg = data.message || 'Pendaftaran gagal.';
                        if (data.errors) {
                            msg = Object.values(data.errors).flat().join(' ');
                        }
                        this.errorMessage = msg;
                        this.view = 'failed';
                    }
                } catch (err) {
                    this.loading = false;
                    this.errorMessage = 'Terjadi kesalahan jaringan.';
                    this.view = 'failed';
                    console.error('Registration error:', err);
                }
            }
        };
    }
</script>

@endsection
