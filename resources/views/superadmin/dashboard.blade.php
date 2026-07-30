@extends('layouts.blank')
@section('content')

{{-- Include Iconify --}}
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

<div
    x-data="{
        sidebarOpen: false,
        showLogs: false,
        activeAdminName: '',
        activeAdminLogs: [],
        openLogsModal(name, logs) {
            this.activeAdminName = name;
            this.activeAdminLogs = logs;
            this.showLogs = true;
        }
    }"
    class="min-h-screen bg-[#f5eed9] text-stone-800 font-sans flex flex-col md:flex-row"
>

    {{-- ── MOBILE HEADER ──────────────────────────────────────── --}}
    <div class="md:hidden flex items-center justify-between bg-stone-900 text-stone-100 px-6 py-4 border-b border-stone-850 z-20 shadow-md">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo-landeuh.png') }}" alt="Logo" class="w-8 h-8 object-contain rounded-full bg-white p-1">
            <div>
                <h2 class="font-extrabold text-stone-100 tracking-tight leading-tight text-sm">Landeuh Village</h2>
                <span class="text-[9px] text-amber-500 uppercase tracking-widest font-bold block">Superadmin</span>
            </div>
        </div>
        <button @click="sidebarOpen = !sidebarOpen" class="w-9 h-9 flex items-center justify-center text-stone-300 hover:text-white bg-stone-800 hover:bg-stone-750 rounded-xl transition duration-200" aria-label="Toggle Sidebar">
            <iconify-icon icon="lucide:menu" class="text-xl"></iconify-icon>
        </button>
    </div>

    {{-- Mobile Sidebar Overlay --}}
    <div
        x-show="sidebarOpen"
        @click="sidebarOpen = false"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-30 bg-black/60 md:hidden"
    ></div>

    {{-- ── SIDEBAR ────────────────────────────────────────────── --}}
    <aside
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
        class="fixed inset-y-0 left-0 z-40 w-64 bg-stone-900 text-stone-300 flex flex-col justify-between shrink-0 border-r border-stone-800 transition-transform duration-300 md:static md:translate-x-0"
    >
        <div>
            {{-- Logo / Brand --}}
            <div class="px-6 py-6 border-b border-stone-800 flex items-center gap-3">
                <img src="{{ asset('images/logo-landeuh.png') }}" alt="Logo" class="w-10 h-10 object-contain rounded-full bg-white p-1">
                <div>
                    <h2 class="font-extrabold text-stone-100 tracking-tight leading-tight">Landeuh Village</h2>
                    <span class="text-[10px] text-amber-500 uppercase tracking-widest font-bold">Superadmin Panel</span>
                </div>
            </div>

            {{-- Nav Links --}}
            <nav class="px-4 py-6 space-y-1.5">
                <a
                    href="{{ route('superadmin.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 bg-amber-600/10 text-amber-500 font-bold rounded-xl border border-amber-600/20 transition-all duration-200"
                >
                    <iconify-icon icon="lucide:layout-dashboard" class="text-xl"></iconify-icon>
                    <span>Kelola Admin</span>
                </a>
            </nav>
        </div>

        {{-- Bottom Profile / Logout --}}
        <div class="p-4 border-t border-stone-800">
            <div class="flex items-center gap-3 mb-4 px-2">
                <div class="w-9 h-9 rounded-full bg-amber-500/10 border border-amber-500/30 flex items-center justify-center text-amber-500 font-bold text-sm uppercase">
                    {{ substr(Auth::guard('admin')->user()->name ?? 'S', 0, 1) }}
                </div>
                <div class="truncate">
                    <h4 class="text-xs font-bold text-stone-200 truncate">{{ Auth::guard('admin')->user()->name }}</h4>
                    <span class="text-[10px] text-stone-500 truncate block">{{ Auth::guard('admin')->user()->email }}</span>
                </div>
            </div>
            
            <form action="{{ route('superadmin.logout') }}" method="POST">
                @csrf
                <button
                    type="submit"
                    class="w-full flex items-center justify-center gap-2 py-2.5 bg-stone-950 hover:bg-red-950/20 hover:text-red-400 border border-stone-850 hover:border-red-900/30 text-stone-400 rounded-xl text-xs font-bold transition duration-200"
                >
                    <iconify-icon icon="lucide:log-out"></iconify-icon>
                    <span>Log Out</span>
                </button>
            </form>
        </div>
    </aside>

    {{-- ── MAIN CONTENT ────────────────────────────────────────── --}}
    <main class="flex-1 overflow-y-auto px-4 md:px-8 py-6 md:py-8">

        {{-- ── TOP HEADER ──────────────────────────────────────── --}}
        <header class="flex justify-between items-center mb-8 border-b border-stone-300 pb-4">
            <div>
                <h1 class="text-2xl font-extrabold tracking-tight text-stone-850" style="font-family:'Georgia',serif;">
                    Dashboard Superadmin
                </h1>
                <p class="text-xs text-stone-500 mt-1">Konfigurasi persetujuan akun pengelola dan pengawasan aktivitas.</p>
            </div>
            <div class="text-right">
                <p class="text-xs text-stone-500">Tanggal Hari Ini</p>
                <p class="text-sm font-bold text-stone-700 mt-0.5">{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</p>
            </div>
        </header>

        {{-- Flash Message Notification --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-800 rounded-2xl text-sm font-semibold flex items-center gap-2">
                <iconify-icon icon="lucide:check-circle" class="text-lg shrink-0"></iconify-icon>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        {{-- ── STAT CARDS ──────────────────────────────────────── --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
            <div class="bg-[#fdf6e3]/80 backdrop-blur-sm rounded-2xl border border-amber-200/60 shadow-sm p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-green-500/10 border border-green-500/20 flex items-center justify-center shrink-0 text-green-700">
                    <iconify-icon icon="lucide:shield-check" class="text-2xl"></iconify-icon>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-stone-500 tracking-widest uppercase">Admin Aktif</p>
                    <p class="text-2xl font-black text-stone-850 mt-0.5 leading-tight">
                        {{ $admins->where('status', 'approved')->count() }}
                    </p>
                </div>
            </div>
            <div class="bg-[#fdf6e3]/80 backdrop-blur-sm rounded-2xl border border-amber-200/60 shadow-sm p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center shrink-0 text-amber-700">
                    <iconify-icon icon="lucide:clock-3" class="text-2xl"></iconify-icon>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-stone-500 tracking-widest uppercase">Menunggu Persetujuan</p>
                    <p class="text-2xl font-black text-stone-850 mt-0.5 leading-tight">
                        {{ $admins->where('status', 'pending')->count() }}
                    </p>
                </div>
            </div>
            <div class="bg-[#fdf6e3]/80 backdrop-blur-sm rounded-2xl border border-amber-200/60 shadow-sm p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-red-500/10 border border-red-500/20 flex items-center justify-center shrink-0 text-red-700">
                    <iconify-icon icon="lucide:user-x" class="text-2xl"></iconify-icon>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-stone-500 tracking-widest uppercase">Admin Ditolak</p>
                    <p class="text-2xl font-black text-stone-850 mt-0.5 leading-tight">
                        {{ $admins->where('status', 'rejected')->count() }}
                    </p>
                </div>
            </div>
        </div>

        {{-- ── SECTION 1: PERMOHONAN REGISTER (PENDING) ─────────── --}}
        <section class="bg-white rounded-3xl border border-stone-200/80 shadow-sm overflow-hidden mb-8">
            <div class="px-6 py-5 bg-[#fcf9f2] border-b border-stone-200 flex justify-between items-center">
                <div>
                    <h3 class="font-extrabold text-stone-850" style="font-family:'Georgia',serif;">Permohonan Persetujuan Admin</h3>
                    <p class="text-[11px] text-stone-500 mt-0.5">Akun pendaftar admin baru yang memerlukan verifikasi superadmin.</p>
                </div>
                <span class="px-3 py-1 bg-amber-100 text-amber-800 rounded-full text-xs font-bold">
                    {{ $admins->where('status', 'pending')->count() }} Pendaftaran
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-stone-50 border-b border-stone-100 text-[11px] font-bold uppercase tracking-wider text-stone-500">
                            <th class="px-6 py-4">Nama Lengkap</th>
                            <th class="px-6 py-4">Jenis Kelamin</th>
                            <th class="px-6 py-4">No. WhatsApp</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Tanggal Daftar</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100 text-xs">
                        @forelse($admins->where('status', 'pending') as $pendingAdmin)
                            <tr class="hover:bg-stone-50/50 transition duration-150">
                                <td class="px-6 py-4 font-bold text-stone-800">{{ $pendingAdmin->name }}</td>
                                <td class="px-6 py-4 text-stone-600">{{ $pendingAdmin->gender ?? '—' }}</td>
                                <td class="px-6 py-4 text-stone-600">
                                    <a
                                        @php
                                            $phoneClean = preg_replace('/[^0-9]/', '', $pendingAdmin->phone);
                                            if (str_starts_with($phoneClean, '0')) {
                                                $phoneClean = '62' . substr($phoneClean, 1);
                                            }
                                        @endphp
                                        href="https://wa.me/{{ $phoneClean }}"
                                        target="_blank"
                                        class="inline-flex items-center gap-1 text-green-700 hover:text-green-900 font-semibold"
                                    >
                                        <iconify-icon icon="lucide:phone-call" class="text-sm"></iconify-icon>
                                        <span>{{ $pendingAdmin->phone }}</span>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-stone-600 font-mono">{{ $pendingAdmin->email }}</td>
                                <td class="px-6 py-4 text-stone-500">{{ $pendingAdmin->created_at->format('d M Y H:i') }}</td>
                                <td class="px-6 py-4 text-right space-x-2 whitespace-nowrap">
                                    <form action="{{ route('superadmin.admins.approve', $pendingAdmin->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button
                                            type="submit"
                                            class="px-3.5 py-1.5 bg-green-600 hover:bg-green-700 text-white rounded-lg font-bold text-[11px] transition shadow-sm"
                                        >
                                            Setujui
                                        </button>
                                    </form>
                                    <form action="{{ route('superadmin.admins.reject', $pendingAdmin->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button
                                            type="submit"
                                            class="px-3.5 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded-lg font-bold text-[11px] transition shadow-sm"
                                        >
                                            Tolak
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-stone-400 font-medium">
                                    Tidak ada permohonan pendaftaran baru saat ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        {{-- ── SECTION 2: DAFTAR ADMIN AKTIF (APPROVED) ─────────── --}}
        <section class="bg-white rounded-3xl border border-stone-200/80 shadow-sm overflow-hidden mb-8">
            <div class="px-6 py-5 bg-[#fcf9f2] border-b border-stone-200">
                <h3 class="font-extrabold text-stone-850" style="font-family:'Georgia',serif;">Daftar Admin Aktif</h3>
                <p class="text-[11px] text-stone-500 mt-0.5">Seluruh administrator pengelola yang saat ini terdaftar aktif.</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-stone-50 border-b border-stone-100 text-[11px] font-bold uppercase tracking-wider text-stone-500">
                            <th class="px-6 py-4">Nama Admin</th>
                            <th class="px-6 py-4">Jenis Kelamin</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Terdaftar</th>
                            <th class="px-6 py-4">Login Terakhir</th>
                            <th class="px-6 py-4">Aktivitas Terbaru</th>
                            <th class="px-6 py-4 text-right font-bold text-amber-800">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100 text-xs">
                        @forelse($admins->where('status', 'approved') as $admin)
                            <tr class="hover:bg-stone-50/50 transition duration-150">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-stone-800">{{ $admin->name }}</div>
                                    <div class="text-[10px] text-stone-400 mt-0.5">{{ $admin->phone }}</div>
                                </td>
                                <td class="px-6 py-4 text-stone-600">{{ $admin->gender ?? '—' }}</td>
                                <td class="px-6 py-4 text-stone-600 font-mono">{{ $admin->email }}</td>
                                <td class="px-6 py-4 text-stone-500">{{ $admin->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-stone-600">
                                    {{ $admin->last_login_at ? $admin->last_login_at->locale('id')->isoFormat('D MMM YYYY, HH:mm') : 'Belum pernah login' }}
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $latestLog = $admin->activityLogs->first();
                                    @endphp
                                    @if($latestLog)
                                        <div class="truncate max-w-[180px] font-medium text-stone-700" title="{{ $latestLog->activity }}">
                                            {{ $latestLog->activity }}
                                        </div>
                                        <span class="text-[9px] text-stone-400 block mt-0.5">{{ $latestLog->created_at->diffForHumans() }}</span>
                                    @else
                                        <span class="text-stone-400 italic">Tidak ada aktivitas</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right space-x-1.5 whitespace-nowrap">
                                    {{-- WhatsApp Button --}}
                                    @php
                                        $adminPhone = preg_replace('/[^0-9]/', '', $admin->phone);
                                        if (str_starts_with($adminPhone, '0')) {
                                            $adminPhone = '62' . substr($adminPhone, 1);
                                        }
                                    @endphp
                                    <a
                                        href="https://wa.me/{{ $adminPhone }}"
                                        target="_blank"
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-green-50 hover:bg-green-100 text-green-700 hover:text-green-800 border border-green-200/50 transition"
                                        title="Hubungi WhatsApp"
                                    >
                                        <iconify-icon icon="lucide:message-square" class="text-base"></iconify-icon>
                                    </a>

                                    {{-- Activity Logs Modal Trigger --}}
                                    <button
                                        type="button"
                                        @click="openLogsModal('{{ addslashes($admin->name) }}', {{ json_encode($admin->activityLogs) }})"
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-700 hover:text-blue-800 border border-blue-200/50 transition"
                                        title="Lihat Log Aktivitas"
                                    >
                                        <iconify-icon icon="lucide:clipboard-list" class="text-base"></iconify-icon>
                                    </button>

                                    {{-- Delete Account Button --}}
                                    <form
                                        action="{{ route('superadmin.admins.destroy', $admin->id) }}"
                                        method="POST"
                                        class="inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun admin {{ $admin->name }}? Semua data log aktivitas admin ini juga akan dihapus.')"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 text-red-650 hover:text-red-750 border border-red-200/50 transition"
                                            title="Hapus Akun Admin"
                                        >
                                            <iconify-icon icon="lucide:trash-2" class="text-base"></iconify-icon>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-stone-400 font-medium">
                                    Belum ada akun admin yang aktif saat ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        {{-- ── SECTION 3: DAFTAR ADMIN DITOLAK (REJECTED) ─────────── --}}
        @if($admins->where('status', 'rejected')->count() > 0)
            <section class="bg-white rounded-3xl border border-stone-200/80 shadow-sm overflow-hidden">
                <div class="px-6 py-4 bg-[#fcf9f2] border-b border-stone-200">
                    <h3 class="font-extrabold text-stone-700 text-sm" style="font-family:'Georgia',serif;">Daftar Pendaftaran Admin Ditolak</h3>
                </div>

                <div class="overflow-x-auto font-sans text-xs">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-stone-50 border-b border-stone-100 text-[10px] font-bold uppercase tracking-wider text-stone-500">
                                <th class="px-6 py-3">Nama</th>
                                <th class="px-6 py-3">Email</th>
                                <th class="px-6 py-3">Jenis Kelamin</th>
                                <th class="px-6 py-3">No. WA</th>
                                <th class="px-6 py-3 text-right">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-stone-100">
                            @foreach($admins->where('status', 'rejected') as $rejectedAdmin)
                                <tr class="hover:bg-stone-50/50">
                                    <td class="px-6 py-3 font-semibold text-stone-700">{{ $rejectedAdmin->name }}</td>
                                    <td class="px-6 py-3 font-mono text-stone-600">{{ $rejectedAdmin->email }}</td>
                                    <td class="px-6 py-3 text-stone-500">{{ $rejectedAdmin->gender ?? '—' }}</td>
                                    <td class="px-6 py-3 text-stone-500">{{ $rejectedAdmin->phone }}</td>
                                    <td class="px-6 py-3 text-right space-x-2">
                                        <form action="{{ route('superadmin.admins.approve', $rejectedAdmin->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button
                                                type="submit"
                                                class="px-3 py-1 bg-green-50 text-green-700 hover:bg-green-100 border border-green-200 rounded-lg font-bold text-[10px] transition"
                                            >
                                                Pindahkan ke Setujui
                                            </button>
                                        </form>
                                        <form
                                            action="{{ route('superadmin.admins.destroy', $rejectedAdmin->id) }}"
                                            method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Hapus permanen pendaftaran admin {{ $rejectedAdmin->name }}?')"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="submit"
                                                class="px-3 py-1 bg-red-50 text-red-700 hover:bg-red-100 border border-red-200 rounded-lg font-bold text-[10px] transition"
                                            >
                                                Hapus Permanen
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        @endif

    </main>

    {{-- ══════════════════════════════════════════════════════════
         MODAL POPUP: LOG AKTIVITAS ADMIN
         ══════════════════════════════════════════════════════════ --}}
    <div
        x-cloak
        x-show="showLogs"
        x-transition:enter="transition duration-300 ease-out"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition duration-200 ease-in"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm px-4"
    >
        <div
            @click.outside="showLogs = false"
            class="w-full max-w-2xl bg-white rounded-3xl shadow-2xl overflow-hidden border border-stone-200"
        >
            {{-- Header --}}
            <div class="px-6 py-5 bg-[#fcf9f2] border-b border-stone-200 flex justify-between items-center">
                <div>
                    <h3 class="font-extrabold text-stone-850" style="font-family:'Georgia',serif;">
                        Log Aktivitas Admin
                    </h3>
                    <p class="text-[11px] text-stone-500 mt-0.5">
                        Menampilkan histori tindakan lengkap untuk <span class="font-bold text-stone-800" x-text="activeAdminName"></span>.
                    </p>
                </div>
                <button
                    @click="showLogs = false"
                    class="w-8 h-8 flex items-center justify-center text-stone-400 hover:text-stone-700 hover:bg-stone-100 rounded-full transition"
                >
                    <iconify-icon icon="lucide:x" class="text-xl"></iconify-icon>
                </button>
            </div>

            {{-- Body --}}
            <div class="p-6 max-h-[400px] overflow-y-auto font-sans">
                <template x-if="activeAdminLogs.length > 0">
                    <div class="border border-stone-100 rounded-2xl overflow-hidden">
                        <table class="w-full text-left border-collapse text-xs">
                            <thead>
                                <tr class="bg-stone-50 border-b border-stone-100 text-[10px] font-bold uppercase tracking-wider text-stone-500">
                                    <th class="px-4 py-3">Waktu</th>
                                    <th class="px-4 py-3">Aktivitas / Tindakan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-stone-100">
                                <template x-for="log in activeAdminLogs" :key="log.id">
                                    <tr class="hover:bg-stone-50/50">
                                        <td class="px-4 py-3 text-stone-500 font-medium whitespace-nowrap">
                                            <span x-text="new Date(log.created_at).toLocaleString('id-ID', {day: 'numeric', month: 'short', hour: '2-digit', minute:'2-digit'})"></span>
                                        </td>
                                        <td class="px-4 py-3 text-stone-700 font-semibold" x-text="log.activity"></td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </template>
                <template x-if="activeAdminLogs.length === 0">
                    <div class="py-12 text-center text-stone-400 italic">
                        Belum ada riwayat aktivitas yang tercatat untuk admin ini.
                    </div>
                </template>
            </div>

            {{-- Footer --}}
            <div class="px-6 py-4 bg-stone-50 border-t border-stone-100 text-right">
                <button
                    @click="showLogs = false"
                    class="px-4 py-2 bg-stone-900 hover:bg-stone-850 text-white rounded-xl font-bold text-xs transition"
                >
                    Tutup
                </button>
            </div>
        </div>
    </div>

</div>

<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

@endsection
