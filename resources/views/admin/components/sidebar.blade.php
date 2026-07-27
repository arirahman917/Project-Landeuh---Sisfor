{{-- ============================================================
     SIDEBAR — Admin Dashboard Landeuh Village Riverside
     ============================================================ --}}

<aside id="adminSidebar"
    class="fixed top-0 left-0 h-screen w-64 z-50 flex flex-col
           bg-[#1e2d1e] text-white shadow-2xl shadow-black/40"
    style="font-family:'Georgia',serif;"
>
    {{-- ── Brand ─────────────────────────────────────────────── --}}
    <div class="flex items-center gap-3 px-6 py-5 border-b border-white/10">
        {{-- Hamburger (inside sidebar) --}}
        <button id="sidebarClose"
            class="text-white/60 hover:text-white transition-colors duration-200 mr-1"
            style="outline:none"
        >
            <svg class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
        <h2 class="text-base font-bold text-white tracking-tight">Menu</h2>
    </div>

    {{-- ── Nav ────────────────────────────────────────────────── --}}
    <nav class="flex-1 overflow-y-auto px-3 py-5 space-y-1 text-sm">

        @php
            $navItems = [
                ['href' => '/admin/unit',      'icon' => 'lucide:home',           'label' => 'Data Unit'],
                ['href' => '/admin/pesanan',   'icon' => 'lucide:clipboard-list', 'label' => 'Data Pesanan'],
                ['href' => '/admin/pelanggan', 'icon' => 'lucide:user',           'label' => 'Data Pelanggan'],
                ['href' => '/admin/tanggal',   'icon' => 'lucide:calendar-days',  'label' => 'Penentuan Tanggal'],
            ];
        @endphp

        @foreach($navItems as $item)
            @php
                $isActive = request()->is(ltrim($item['href'], '/') . '*')
                         || (request()->is('admin/dashboard') && $item['href'] === '/admin/unit')
                         || (request()->is('admin/reschedule*') && $item['href'] === '/admin/pesanan');
            @endphp
            <a href="{{ $item['href'] }}"
               class="flex items-center gap-3.5 px-4 py-3 rounded-xl group
                      {{ $isActive
                         ? 'bg-[#d4c9a8]/30 text-amber-200 font-bold'
                         : 'text-white/60 hover:bg-white/5 hover:text-white/90' }}"
               style="transition: background-color 0.25s ease, color 0.25s ease, transform 0.15s ease;"
               onmousedown="this.style.transform='scale(0.97)'"
               onmouseup="this.style.transform='scale(1)'"
               onmouseleave="this.style.transform='scale(1)'"
            >
                <iconify-icon icon="{{ $item['icon'] }}"
                    class="text-xl shrink-0
                           {{ $isActive ? 'text-amber-300' : 'text-white/40 group-hover:text-white/70' }}"
                    style="transition: color 0.25s ease;">
                </iconify-icon>
                <span class="truncate text-[0.9rem]">{{ $item['label'] }}</span>
            </a>
        @endforeach

    </nav>

    {{-- ── Footer / Logout ────────────────────────────────────── --}}
    <div class="px-5 py-5 border-t border-white/10">
        <button type="button" onclick="adminLogout()"
            class="flex items-center justify-center gap-2 w-auto mx-auto px-6 py-2.5 rounded-lg text-sm font-bold
                   bg-red-600 text-white hover:bg-red-700 shadow-md"
            style="transition: background-color 0.2s ease, transform 0.15s ease;"
            onmousedown="this.style.transform='scale(0.97)'"
            onmouseup="this.style.transform='scale(1)'"
        >
            <iconify-icon icon="lucide:log-out" class="text-base"></iconify-icon>
            <span>Log Out</span>
        </button>
        <div class="mt-3 text-center text-[10px] text-white/20 tracking-wider">v1.0.0 © Landeuh</div>
    </div>
</aside>

<script>
    document.getElementById('sidebarClose')?.addEventListener('click', toggleSidebar);
</script>