<header class="sticky top-0 z-50 w-full bg-[#F8EDD8]/95 backdrop-blur-md border-b border-[#ebdcc4] shadow-xs transition-all" id="mainHeader">

    <div class="w-full px-4 sm:px-6 py-2.5 flex justify-between items-center max-w-7xl mx-auto relative">
        <!-- Left Side: Logo -->
        <a href="{{ url('/') }}" class="flex items-center z-50">
            <img src="{{ asset('images/logo-landeuh.png') }}" alt="Landeuh Village Riverside Logo" width="136" height="48" class="h-10 md:h-12 w-auto object-contain" fetchpriority="high" loading="eager" decoding="async">
        </a>

        <!-- Right Side: Navigation & Auth -->
        <div class="flex items-center gap-6 lg:gap-10">
            <!-- Navigation (Desktop/Tablet) -->
            <nav class="hidden md:flex items-center gap-6 lg:gap-8 font-semibold text-gray-800 text-sm lg:text-base">
                <a href="/#hero" class="hover:text-green-800 transition py-2">Beranda</a>
                <a href="/akomodasi" class="hover:text-green-800 transition py-2">Akomodasi</a>
                <a href="/paket-corporate" class="hover:text-green-800 transition py-2">Paket Corporate</a>
                <a href="/pesanan" class="hover:text-green-800 transition py-2">Pesanan</a>
            </nav>

            <!-- Auth Buttons (Desktop/Tablet) -->
            @guest
            <div class="hidden sm:flex items-center gap-3" id="desktopAuthButtons">
                <button type="button" onclick="openLoginModal()" class="flex items-center gap-2 bg-[#789e3a] hover:bg-[#688a32] text-white px-3 lg:px-4 py-2.5 rounded-lg font-semibold transition shadow-sm text-xs lg:text-sm min-h-[44px]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                    </svg>
                    Masuk
                </button>
                <button type="button" onclick="openRegisterModal()" class="flex items-center gap-2 bg-[#2f4f4f] hover:bg-[#233b3b] text-white px-3 lg:px-4 py-2.5 rounded-lg font-semibold transition shadow-sm text-xs lg:text-sm min-h-[44px]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                    </svg>
                    Daftar
                </button>
            </div>
            @endguest
            
            <!-- Logged in State (Desktop) -->
            @auth
            <div class="hidden sm:flex items-center gap-3" id="desktopUserMenu">
                <div class="flex items-center gap-2 bg-white/60 px-4 py-2 rounded-lg shadow-sm border border-white/50 min-h-[44px]">
                    <div class="w-6 h-6 rounded-full bg-[#789e3a] text-white flex items-center justify-center text-xs font-bold" id="desktopUserInitial">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                    <span class="font-semibold text-gray-800 text-sm" id="desktopUserName">{{ Auth::user()->name }}</span>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-red-500 hover:text-red-700 font-semibold text-xs lg:text-sm transition cursor-pointer min-h-[44px] px-2 flex items-center">Keluar</button>
                </form>
            </div>
            @endauth

            <!-- Mobile Hamburger Button -->
            <button id="mobileMenuBtn" type="button" class="md:hidden min-w-[44px] min-h-[44px] flex items-center justify-center p-2 text-gray-800 hover:bg-stone-200/50 rounded-xl transition cursor-pointer" aria-label="Buka Menu Navigasi Seluler" aria-expanded="false">
                <!-- Hamburger Icon (Bars) -->
                <svg id="menuIconBars" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7 transition-all duration-200" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                <!-- Close Icon (X) -->
                <svg id="menuIconClose" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 hidden transition-all duration-200" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Dropdown Menu (Full Width, SS3 Style with Smooth Top-to-Bottom Slide) -->
    <div id="mobileMenu" class="absolute top-full left-0 right-0 w-full bg-[#F8EDD8] border-b border-[#ebdcc4] shadow-[0_20px_40px_-15px_rgba(0,0,0,0.15)] flex flex-col pt-4 pb-6 px-5 sm:px-8 z-50 md:hidden is-closed">
        <!-- Navigation Links Centered -->
        <div class="flex flex-col items-center space-y-1 w-full max-w-sm mx-auto">
            <a href="/#hero" class="mobile-nav-link w-full text-center font-medium text-gray-900 text-lg py-2.5 hover:text-[#284E3A] transition-colors rounded-xl">Beranda</a>
            <a href="/akomodasi" class="mobile-nav-link w-full text-center font-medium text-gray-900 text-lg py-2.5 hover:text-[#284E3A] transition-colors rounded-xl">Akomodasi</a>
            <a href="/paket-corporate" class="mobile-nav-link w-full text-center font-medium text-gray-900 text-lg py-2.5 hover:text-[#284E3A] transition-colors rounded-xl">Paket Corporate</a>
            <a href="/pesanan" class="mobile-nav-link w-full text-center font-medium text-gray-900 text-lg py-2.5 hover:text-[#284E3A] transition-colors rounded-xl">Pesanan</a>
        </div>
        
        <!-- Auth Section -->
        <div class="mt-3 pt-4 border-t border-[#ebdcc4] w-full max-w-sm mx-auto">
            @guest
            <div class="grid grid-cols-2 gap-3.5 w-full" id="mobileAuthButtons">
                <!-- Daftar Button (Left side, dark green as in SS3) -->
                <button type="button" onclick="closeMobileMenu(); openRegisterModal()" class="w-full flex items-center justify-center gap-2 bg-[#284E3A] hover:bg-[#1f3c2c] active:scale-[0.98] text-white py-3.5 px-3 rounded-2xl font-bold shadow-sm transition text-base cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-5 h-5 flex-shrink-0" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                    </svg>
                    <span>Daftar</span>
                </button>

                <!-- Masuk Button (Right side, olive green as in SS3) -->
                <button type="button" onclick="closeMobileMenu(); openLoginModal()" class="w-full flex items-center justify-center gap-2 bg-[#6E8F28] hover:bg-[#5c7a1f] active:scale-[0.98] text-white py-3.5 px-3 rounded-2xl font-bold shadow-sm transition text-base cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-5 h-5 flex-shrink-0" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                    </svg>
                    <span>Masuk</span>
                </button>
            </div>
            @endguest
            
            <!-- Logged in State (Mobile) -->
            @auth
            <div class="w-full" id="mobileUserMenu">
                <!-- User Profile Card with Symmetrical Logout Button -->
                <div class="w-full bg-white/70 backdrop-blur-md rounded-xl p-3 sm:p-3.5 border border-[#ebdcc4] shadow-xs flex items-center justify-between gap-3">
                    <!-- Left: Identity -->
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-10 h-10 rounded-full bg-[#6E8F28] text-white flex items-center justify-center font-bold text-sm shadow-sm flex-shrink-0 ring-2 ring-[#6E8F28]/25" id="mobileUserInitial">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="min-w-0 text-left">
                            <div class="flex items-center gap-1.5">
                                <p class="font-bold text-gray-800 text-sm truncate" id="mobileUserName">{{ Auth::user()->name }}</p>
                                <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-100 text-emerald-800 flex-shrink-0">Aktif</span>
                            </div>
                            <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email ?? 'Pelanggan Landeuh' }}</p>
                        </div>
                    </div>

                    <!-- Right: Logout Button -->
                    <form action="{{ route('logout') }}" method="POST" class="m-0 flex-shrink-0">
                        @csrf
                        <button type="submit" class="flex items-center gap-1.5 bg-[#c23939] hover:bg-[#aa2e2e] active:scale-[0.96] text-white py-2.5 px-3.5 rounded-md font-bold shadow-xs transition text-xs sm:text-sm cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-4 h-4 flex-shrink-0" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                            </svg>
                            <span>Keluar</span>
                        </button>
                    </form>
                </div>
            </div>
            @endauth
        </div>
    </div>

    <!-- Mobile Backdrop Dimming Overlay -->
    <div id="mobileMenuBackdrop" class="fixed inset-0 top-[60px] bg-black/25 backdrop-blur-[2px] transition-opacity duration-300 opacity-0 invisible pointer-events-none z-40 md:hidden is-closed"></div>
</header>

<style>
    /* Mobile Menu Dropdown Animation (Top to Bottom Slide) */
    #mobileMenu {
        transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1),
                    opacity 0.28s ease,
                    visibility 0.35s ease;
        will-change: transform, opacity;
    }
    #mobileMenu.is-open {
        transform: translateY(0);
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
    }
    #mobileMenu.is-closed {
        transform: translateY(-16px);
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
    }
    #mobileMenuBackdrop {
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }
    #mobileMenuBackdrop.is-open {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
    }
    #mobileMenuBackdrop.is-closed {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const btn = document.getElementById('mobileMenuBtn');
        const menu = document.getElementById('mobileMenu');
        const backdrop = document.getElementById('mobileMenuBackdrop');
        const barsIcon = document.getElementById('menuIconBars');
        const closeIcon = document.getElementById('menuIconClose');
        
        window.closeMobileMenu = function() {
            if (!menu) return;
            menu.classList.remove('is-open');
            menu.classList.add('is-closed');
            
            if (backdrop) {
                backdrop.classList.remove('is-open');
                backdrop.classList.add('is-closed');
            }
            if (btn) {
                btn.setAttribute('aria-expanded', 'false');
            }
            if (barsIcon && closeIcon) {
                barsIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            }
        };

        window.openMobileMenu = function() {
            if (!menu) return;
            menu.classList.remove('is-closed');
            menu.classList.add('is-open');
            
            if (backdrop) {
                backdrop.classList.remove('is-closed');
                backdrop.classList.add('is-open');
            }
            if (btn) {
                btn.setAttribute('aria-expanded', 'true');
            }
            if (barsIcon && closeIcon) {
                barsIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
            }
        };

        window.toggleMobileMenu = function() {
            if (!menu) return;
            if (menu.classList.contains('is-open')) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        };
        
        if (btn) {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                toggleMobileMenu();
            });
        }

        if (backdrop) {
            backdrop.addEventListener('click', () => {
                closeMobileMenu();
            });
        }

        // Close menu when clicking outside
        document.addEventListener('click', (e) => {
            if (menu && menu.classList.contains('is-open')) {
                if (!menu.contains(e.target) && !btn.contains(e.target)) {
                    closeMobileMenu();
                }
            }
        });

        // Close menu when navigating through links
        document.querySelectorAll('.mobile-nav-link').forEach(link => {
            link.addEventListener('click', () => {
                closeMobileMenu();
            });
        });

        // Close menu on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && menu && menu.classList.contains('is-open')) {
                closeMobileMenu();
            }
        });

        // Navbar + SearchBar stack animation
        const header = document.getElementById('mainHeader');
        if (header) {
            const searchBar = document.getElementById('searchBarFixed');

            const TRANSITION = 'transform 0.38s cubic-bezier(0.4,0,0.2,1)';
            header.style.transition = TRANSITION;
            header.style.willChange = 'transform';
            if (searchBar) {
                searchBar.style.transition = TRANSITION;
                searchBar.style.willChange = 'transform';
                const updateTop = () => {
                    searchBar.style.top = header.offsetHeight + 'px';
                };
                updateTop();
                window.addEventListener('resize', updateTop);
            }

            let lastScrollY = window.scrollY;
            let ticking = false;

            window.addEventListener('scroll', () => {
                // If menu is open and user scrolls significantly, close it
                if (menu && menu.classList.contains('is-open') && Math.abs(window.scrollY - lastScrollY) > 25) {
                    closeMobileMenu();
                }

                if (!ticking) {
                    window.requestAnimationFrame(() => {
                        const currentY = window.scrollY;
                        const hH = header.offsetHeight;

                        if (currentY <= 0) {
                            header.style.transform = 'translateY(0)';
                            if (searchBar) searchBar.style.transform = 'translateY(0)';
                        } else if (currentY > lastScrollY && (!menu || !menu.classList.contains('is-open'))) {
                            header.style.transform = 'translateY(-100%)';
                            if (searchBar) searchBar.style.transform = `translateY(-${hH}px)`;
                        } else {
                            header.style.transform = 'translateY(0)';
                            if (searchBar) searchBar.style.transform = 'translateY(0)';
                        }

                        lastScrollY = currentY;
                        ticking = false;
                    });
                    ticking = true;
                }
            }, { passive: true });
        }
    });
</script>
