<!DOCTYPE html>
<html lang='id'>
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-landeuh.png') }}">
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name="description" content="Admin Panel Landeuh Village Riverside - Sistem Informasi & Manajemen Penginapan">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel — Landeuh Village')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        /* Sidebar visible by default on desktop, hidden on mobile */
        @media (max-width: 767px) {
            #adminSidebar { transform: translateX(-100%); }
        }

        /* ── Smooth sidebar transitions ─────────────────────────── */
        #adminSidebar {
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            will-change: transform;
        }
        #mainWrapper {
            transition: margin-left 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            will-change: margin-left;
        }

        /* Prevent layout thrashing during sidebar animation */
        #adminSidebar *,
        #mainWrapper * {
            backface-visibility: hidden;
        }

        /* Smooth icon transitions inside sidebar */
        #adminSidebar a {
            transition: background-color 0.25s ease, color 0.25s ease, transform 0.15s ease;
            will-change: background-color, color;
        }
        #adminSidebar a:active {
            transform: scale(0.97);
        }
        #adminSidebar iconify-icon {
            transition: color 0.25s ease;
        }

        /* Topbar toggle button smooth visibility */
        #sidebarToggle {
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
        #sidebarToggle.hidden-smooth {
            opacity: 0;
            transform: scale(0.8);
            pointer-events: none;
        }

        /* Smooth overlay */
        #sidebarOverlay {
            transition: opacity 0.35s ease;
        }
    </style>
    <script>
        let sidebarOpen = true;

        function toggleSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            const wrapper = document.getElementById('mainWrapper');
            const overlay = document.getElementById('sidebarOverlay');
            const topbarToggle = document.getElementById('sidebarToggle');

            sidebarOpen = !sidebarOpen;

            if (window.innerWidth >= 768) {
                // Desktop
                if (sidebarOpen) {
                    sidebar.style.transform = 'translateX(0)';
                    wrapper.style.marginLeft = '16rem'; // w-64 = 16rem
                    topbarToggle.classList.add('hidden-smooth');
                } else {
                    sidebar.style.transform = 'translateX(-100%)';
                    wrapper.style.marginLeft = '0';
                    topbarToggle.classList.remove('hidden-smooth');
                }
            } else {
                // Mobile
                if (sidebarOpen) {
                    sidebar.style.transform = 'translateX(0)';
                    overlay.classList.remove('hidden');
                    requestAnimationFrame(() => overlay.style.opacity = '1');
                } else {
                    sidebar.style.transform = 'translateX(-100%)';
                    overlay.style.opacity = '0';
                    setTimeout(() => overlay.classList.add('hidden'), 350);
                }
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('adminSidebar');
            const wrapper = document.getElementById('mainWrapper');
            const topbarToggle = document.getElementById('sidebarToggle');

            if (window.innerWidth >= 768) {
                // Desktop: Sidebar open by default
                sidebarOpen = true;
                sidebar.style.transform = 'translateX(0)';
                wrapper.style.marginLeft = '16rem';
                topbarToggle.classList.add('hidden-smooth');
            } else {
                // Mobile: Sidebar closed by default
                sidebarOpen = false;
                sidebar.style.transform = 'translateX(-100%)';
                wrapper.style.marginLeft = '0';
                topbarToggle.classList.remove('hidden-smooth');
            }

            // Close overlay on click
            document.getElementById('sidebarOverlay')?.addEventListener('click', () => {
                if (sidebarOpen) toggleSidebar();
            });
        });
    </script>
</head>
<body class="bg-[#f5eed9] min-h-screen font-sans">

    {{-- Auth Guard (server-side) --}}
    @if(!Auth::guard('admin')->check() || Auth::guard('admin')->user()->role !== 'admin')
        <script>window.location.href = '/admin/login';</script>
    @endif

    {{-- Sidebar --}}
    @include('admin.components.sidebar')

    {{-- Mobile Overlay --}}
    <div id="sidebarOverlay"
        class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm hidden md:hidden"
        style="opacity:0"></div>

    {{-- Main wrapper --}}
    <div id="mainWrapper" class="min-h-screen flex flex-col" style="margin-left:16rem">

        {{-- Topbar --}}
        @include('admin.components.topbar')

        {{-- Page content --}}
        <main class="flex-1 px-4 sm:px-6 lg:px-8 py-6">
            @yield('content')
        </main>
    </div>

    {{-- Scripts stack --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
    @stack('scripts')
</body>
</html>
