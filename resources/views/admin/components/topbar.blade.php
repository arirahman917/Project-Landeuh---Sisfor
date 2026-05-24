{{-- ============================================================
     TOPBAR — Admin Dashboard Landeuh Village Riverside
     ============================================================ --}}

<header class="sticky top-0 z-30 flex items-center gap-4 px-4 sm:px-6 py-3
               bg-[#fdf6e3]/90 backdrop-blur-md border-b border-amber-200/60 shadow-sm"
>
    {{-- Hamburger (all screens) --}}
    <button id="sidebarToggle"
        class="p-2 rounded-xl text-stone-600 hover:bg-amber-100 transition"
        onclick="toggleSidebar()"
    >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
    </button>

    {{-- Logo on the left --}}
    <div class="flex items-center gap-2">
        <img src="{{ asset('images/logo-landeuh.png') }}" alt="Landeuh" class="h-9 w-auto object-contain"
             onerror="this.style.display='none'">
        <div class="hidden sm:block leading-tight">
            <div class="text-xs font-bold text-stone-800 tracking-tight uppercase">Landeuh</div>
            <div class="text-[9px] text-stone-400 tracking-widest uppercase">Village Riverside</div>
        </div>
    </div>

    {{-- Spacer right --}}
    <div class="flex-1"></div>

    {{-- ── Notification Bell ── --}}
    <div class="relative" id="notifContainer">
        <button id="notifBtn"
            class="relative p-2.5 rounded-xl text-stone-500 hover:bg-amber-100 hover:text-stone-700 transition"
            onclick="toggleNotifPanel(event)"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
            </svg>
            {{-- Badge --}}
            <span id="notifBadge"
                class="absolute -top-0.5 -right-0.5 w-5 h-5 rounded-full bg-red-500 text-white text-[10px] font-bold
                       flex items-center justify-center shadow-sm
                       animate-bounce"
                style="animation-duration:2s"
            >3</span>
        </button>

        {{-- Notification Dropdown --}}
        <div id="notifPanel"
            class="hidden absolute right-0 top-[calc(100%+0.75rem)] w-80 bg-white rounded-2xl
                   shadow-[0_15px_40px_-10px_rgba(0,0,0,0.18)] border border-gray-100 z-50 overflow-hidden"
        >
            <div class="px-4 py-3 border-b border-gray-100 flex items-center justify-between">
                <h4 class="text-sm font-extrabold text-stone-800">Notifikasi</h4>
                <button onclick="markAllRead()" class="text-[11px] font-semibold text-amber-600 hover:text-amber-700 transition">Tandai semua dibaca</button>
            </div>
            <div id="notifList" class="max-h-72 overflow-y-auto divide-y divide-gray-50">
                {{-- Populated by JS --}}
            </div>
            <div class="px-4 py-2.5 border-t border-gray-100 text-center">
                <span class="text-[11px] text-stone-400">Semua notifikasi ditampilkan</span>
            </div>
        </div>
    </div>

    {{-- User badge --}}
    <div class="relative" id="userMenuContainer">
        <button id="userMenuBtn"
            class="flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-amber-100 transition"
        >
            <div class="hidden sm:block text-right">
                <div class="text-xs font-bold text-stone-800 leading-tight" id="topbarName">Jhon Doe</div>
            </div>
            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-amber-400 to-amber-600
                        flex items-center justify-center text-white font-bold text-sm shadow"
                 id="topbarAvatar">J</div>
        </button>

        {{-- User dropdown --}}
        <div id="userMenuDropdown"
            class="hidden absolute right-0 top-[calc(100%+0.75rem)] w-52 bg-white rounded-2xl
                   shadow-[0_15px_40px_-10px_rgba(0,0,0,0.15)] border border-gray-100 py-2 z-50"
        >
            <div class="px-5 py-3 border-b border-gray-100">
                <p class="text-sm font-bold text-stone-800" id="dropdownName">Jhon Doe</p>
                <p class="text-xs text-stone-400 truncate" id="dropdownEmail">admin@gmail.com</p>
            </div>
            <div class="border-t border-gray-100 mt-1 pt-1">
                <button type="button" onclick="adminLogout()"
                    class="w-full flex items-center gap-3 px-5 py-2.5 text-sm text-red-600
                           hover:bg-red-50 transition">
                    <iconify-icon icon="lucide:log-out" class="text-base"></iconify-icon> Keluar
                </button>
            </div>
        </div>
    </div>
</header>

{{-- ── Push Notification Toast Container ── --}}
<div id="pushNotifContainer" class="fixed top-4 right-4 z-[9999] flex flex-col gap-3 pointer-events-none"></div>

<style>
/* Push notification toast */
.push-notif-toast {
    pointer-events:auto;
    background:#fff;
    border-radius:1rem;
    padding:1rem 1.25rem;
    min-width:320px;max-width:380px;
    box-shadow:0 15px 40px rgba(0,0,0,.15), 0 0 0 1px rgba(0,0,0,.04);
    display:flex;align-items:flex-start;gap:.75rem;
    transform:translateX(120%);
    opacity:0;
    transition:transform .5s cubic-bezier(.22,1,.36,1), opacity .5s ease;
}
.push-notif-toast.show {
    transform:translateX(0);
    opacity:1;
}
.push-notif-toast.hiding {
    transform:translateX(120%);
    opacity:0;
}
.push-notif-icon {
    width:40px;height:40px;border-radius:.75rem;
    display:flex;align-items:center;justify-content:center;
    flex-shrink:0;
}
.push-notif-icon.order { background:#dcfce7;color:#16a34a }
.push-notif-icon.cancel { background:#fee2e2;color:#dc2626 }
.push-notif-body { flex:1;min-width:0 }
.push-notif-title { font-size:.82rem;font-weight:800;color:#222;margin-bottom:.15rem }
.push-notif-desc { font-size:.75rem;color:#888;line-height:1.4 }
.push-notif-time { font-size:.65rem;color:#bbb;margin-top:.3rem }
.push-notif-close {
    background:none;border:none;color:#ccc;cursor:pointer;
    font-size:1.1rem;line-height:1;padding:0;
    transition:color .2s;flex-shrink:0;margin-top:.1rem;
}
.push-notif-close:hover { color:#888 }
/* Progress bar animation */
.push-notif-progress {
    height:3px;border-radius:2px;margin-top:.5rem;
    background:linear-gradient(90deg,#3a523a,#6ab04c);
    animation:progressShrink 5s linear forwards;
}
@keyframes progressShrink {
    from { width:100% }
    to { width:0% }
}
</style>

<script>
    // ── User info (dari session server) ────────────────────────
    (function(){
        const name  = '{{ Auth::guard("admin")->check() ? Auth::guard("admin")->user()->name : "Admin" }}';
        const email = '{{ Auth::guard("admin")->check() ? Auth::guard("admin")->user()->email : "admin@example.com" }}';
        const el = (id) => document.getElementById(id);
        if (el('topbarAvatar')) el('topbarAvatar').textContent = name.charAt(0).toUpperCase();
        if (el('topbarName'))   el('topbarName').textContent   = name;
        if (el('dropdownName')) el('dropdownName').textContent  = name;
        if (el('dropdownEmail'))el('dropdownEmail').textContent = email;
    })();

    // ── Logout (POST ke Laravel) ────────────────────────────────
    function adminLogout() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
        fetch('/admin/logout', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json' }
        }).then(() => {
            window.location.href = '/admin/login';
        }).catch(() => {
            window.location.href = '/admin/login';
        });
    }

    // ── User menu dropdown ─────────────────────────────────────
    document.getElementById('userMenuBtn')?.addEventListener('click', (e) => {
        e.stopPropagation();
        document.getElementById('userMenuDropdown').classList.toggle('hidden');
        document.getElementById('notifPanel')?.classList.add('hidden');
    });

    // ── Notification Panel ─────────────────────────────────────
    const NOTIF_DATA = [
        { type:'order',  title:'Pesanan Baru Masuk', desc:'M. Akbar R. memesan Cabin 1 untuk 2 malam.', time:'2 menit lalu', read:false },
        { type:'cancel', title:'Pengajuan Pembatalan', desc:'Budi S. mengajukan pembatalan pesanan #LDH-482A3.', time:'15 menit lalu', read:false },
        { type:'order',  title:'Pesanan Baru Masuk', desc:'Citra D. memesan Cabin 3 untuk 1 malam.', time:'1 jam lalu', read:false },
    ];

    function renderNotifList() {
        const list = document.getElementById('notifList');
        if (!list) return;
        list.innerHTML = NOTIF_DATA.map((n, i) => `
            <div class="flex items-start gap-3 px-4 py-3 hover:bg-amber-50/50 transition cursor-pointer ${n.read ? 'opacity-50' : ''}"
                 onclick="clickNotif(${i})">
                <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0 ${n.type === 'order' ? 'bg-emerald-100 text-emerald-600' : 'bg-red-100 text-red-500'}">
                    <iconify-icon icon="${n.type === 'order' ? 'lucide:shopping-bag' : 'lucide:undo-2'}" class="text-base"></iconify-icon>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-xs font-bold text-stone-800">${n.title}</div>
                    <div class="text-[11px] text-stone-500 leading-snug mt-0.5">${n.desc}</div>
                    <div class="text-[10px] text-stone-400 mt-1">${n.time}</div>
                </div>
                ${n.read ? '' : '<div class="w-2 h-2 rounded-full bg-blue-500 flex-shrink-0 mt-1.5"></div>'}
            </div>
        `).join('');

        const unread = NOTIF_DATA.filter(n => !n.read).length;
        const badge = document.getElementById('notifBadge');
        if (badge) {
            badge.textContent = unread;
            badge.style.display = unread > 0 ? 'flex' : 'none';
        }
    }

    function toggleNotifPanel(e) {
        e.stopPropagation();
        const panel = document.getElementById('notifPanel');
        panel.classList.toggle('hidden');
        document.getElementById('userMenuDropdown')?.classList.add('hidden');
    }

    function markAllRead() {
        NOTIF_DATA.forEach(n => n.read = true);
        renderNotifList();
    }

    function clickNotif(idx) {
        NOTIF_DATA[idx].read = true;
        renderNotifList();
        const target = NOTIF_DATA[idx].type === 'cancel' ? '/admin/pengembalian' : '/admin/pesanan';
        window.location.href = target;
    }

    renderNotifList();

    // ── Close on outside click ─────────────────────────────────
    document.addEventListener('click', () => {
        document.getElementById('userMenuDropdown')?.classList.add('hidden');
        document.getElementById('notifPanel')?.classList.add('hidden');
    });

    document.getElementById('notifPanel')?.addEventListener('click', e => e.stopPropagation());

    // ── Push Notification System ───────────────────────────────
    function showPushNotif(type, title, desc) {
        const container = document.getElementById('pushNotifContainer');
        if (!container) return;

        const toast = document.createElement('div');
        toast.className = 'push-notif-toast';
        toast.innerHTML = `
            <div class="push-notif-icon ${type}">
                <iconify-icon icon="${type === 'order' ? 'lucide:shopping-bag' : 'lucide:undo-2'}" class="text-lg"></iconify-icon>
            </div>
            <div class="push-notif-body">
                <div class="push-notif-title">${title}</div>
                <div class="push-notif-desc">${desc}</div>
                <div class="push-notif-time">Baru saja</div>
                <div class="push-notif-progress"></div>
            </div>
            <button class="push-notif-close" onclick="dismissPush(this)">&times;</button>
        `;
        container.appendChild(toast);

        // Trigger entrance
        requestAnimationFrame(() => {
            requestAnimationFrame(() => toast.classList.add('show'));
        });

        // Auto-dismiss after 5s
        setTimeout(() => dismissPush(toast.querySelector('.push-notif-close')), 5200);
    }

    function dismissPush(btn) {
        const toast = btn.closest('.push-notif-toast');
        if (!toast || toast.classList.contains('hiding')) return;
        toast.classList.add('hiding');
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 500);
    }

    // ── Demo: fire push notifications after page load ──────────
    setTimeout(() => {
        showPushNotif('order', 'Pesanan Baru Masuk', 'Eka W. memesan Glamping VIP untuk 2 malam.');
        // Add to notification list
        NOTIF_DATA.unshift({ type:'order', title:'Pesanan Baru Masuk', desc:'Eka W. memesan Glamping VIP untuk 2 malam.', time:'Baru saja', read:false });
        renderNotifList();
    }, 3000);

    setTimeout(() => {
        showPushNotif('cancel', 'Pengajuan Pembatalan Masuk', 'Dian P. mengajukan pembatalan pesanan #LDH-7F3B1.');
        NOTIF_DATA.unshift({ type:'cancel', title:'Pengajuan Pembatalan', desc:'Dian P. mengajukan pembatalan pesanan #LDH-7F3B1.', time:'Baru saja', read:false });
        renderNotifList();
    }, 8000);
</script>