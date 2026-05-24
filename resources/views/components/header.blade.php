<header class="sticky top-0 z-50 w-full bg-white/40 backdrop-blur-xl border-b border-white/30 shadow-sm transition-all" id="mainHeader">
    <div class="w-full px-4 sm:px-6 py-2.5 flex justify-between items-center max-w-7xl mx-auto relative">
        <!-- Left Side: Logo -->
        <a href="{{ url('/') }}" class="flex items-center z-50">
            <img src="{{ asset('images/logo-landeuh.png') }}" alt="Landeuh Logo" class="h-10 md:h-12 object-contain" onerror="this.src='https://placehold.co/150x50?text=Logo+Landeuh'">
        </a>

        <!-- Right Side: Navigation & Auth -->
        <div class="flex items-center gap-6 lg:gap-10">
            <!-- Navigation (Desktop/Tablet) -->
            <nav class="hidden md:flex items-center gap-6 lg:gap-8 font-semibold text-gray-800 text-sm lg:text-base">
                <a href="/" class="hover:text-green-800 transition">Beranda</a>
                <a href="/akomodasi" class="hover:text-green-800 transition">Akomodasi</a>
                <a href="/pesanan" class="hover:text-green-800 transition">Pesanan</a>
            </nav>

            <!-- Auth Buttons (Desktop/Tablet) -->
            @guest
            <div class="hidden sm:flex items-center gap-3" id="desktopAuthButtons">
                <button type="button" onclick="openLoginModal()" class="flex items-center gap-2 bg-[#789e3a] hover:bg-[#688a32] text-white px-3 lg:px-4 py-2 rounded-lg font-semibold transition shadow-sm text-xs lg:text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                    </svg>
                    Masuk
                </button>
                <button type="button" onclick="openRegisterModal()" class="flex items-center gap-2 bg-[#2f4f4f] hover:bg-[#233b3b] text-white px-3 lg:px-4 py-2 rounded-lg font-semibold transition shadow-sm text-xs lg:text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                    </svg>
                    Daftar
                </button>
            </div>
            @endguest
            
            <!-- Logged in State (Desktop) -->
            @auth
            <div class="hidden sm:flex items-center gap-3" id="desktopUserMenu">
                <div class="flex items-center gap-2 bg-white/60 px-4 py-2 rounded-lg shadow-sm border border-white/50">
                    <div class="w-6 h-6 rounded-full bg-[#789e3a] text-white flex items-center justify-center text-xs font-bold" id="desktopUserInitial">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                    <span class="font-semibold text-gray-800 text-sm" id="desktopUserName">{{ Auth::user()->name }}</span>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-red-500 hover:text-red-700 font-semibold text-xs lg:text-sm transition cursor-pointer">Keluar</button>
                </form>
            </div>
            @endauth

            <!-- Mobile Hamburger -->
            <button id="mobileMenuBtn" class="md:hidden p-2 text-gray-800 hover:bg-white/50 rounded-lg transition" aria-label="Menu">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Floating Card Menu (Matches UI/UX) -->
    <div id="mobileMenu" class="absolute top-[80px] right-4 w-[260px] bg-[#F8EDD8] rounded-[2rem] shadow-[0_20px_50px_-10px_rgba(0,0,0,0.2)] border border-white/50 flex flex-col py-6 px-5 transition-all duration-300 opacity-0 invisible origin-top-right transform scale-95 z-[60] md:hidden">
        <a href="/" class="text-center font-semibold text-gray-800 text-base py-3 hover:text-green-800 transition">Beranda</a>
        <a href="/akomodasi" class="text-center font-semibold text-gray-800 text-base py-3 hover:text-green-800 transition">Akomodasi</a>
        <a href="/pesanan" class="text-center font-semibold text-gray-800 text-base py-3 hover:text-green-800 transition">Pesanan</a>
        
        <div class="mt-4 flex flex-col gap-3">
            @guest
            <div class="flex flex-col gap-3" id="mobileAuthButtons">
                <button type="button" onclick="openLoginModal()" class="w-full flex items-center justify-center gap-2 bg-[#6b8e23] hover:bg-[#55711c] text-white py-3.5 rounded-2xl font-bold shadow-sm transition text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                    </svg>
                    Masuk
                </button>
                <button type="button" onclick="openRegisterModal()" class="w-full flex items-center justify-center gap-2 bg-[#2f4f4f] hover:bg-[#233b3b] text-white py-3.5 rounded-2xl font-bold shadow-sm transition text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                    </svg>
                    Daftar
                </button>
            </div>
            @endguest
            
            <!-- Logged in State (Mobile) -->
            @auth
            <div class="flex flex-col gap-3 border-t border-white/50 pt-3" id="mobileUserMenu">
                <div class="flex items-center gap-3 px-2">
                    <div class="w-8 h-8 rounded-full bg-[#789e3a] text-white flex items-center justify-center text-sm font-bold" id="mobileUserInitial">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                    <span class="font-semibold text-gray-800 text-base" id="mobileUserName">{{ Auth::user()->name }}</span>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="w-full text-center py-2 text-red-500 hover:text-red-700 font-semibold text-sm transition">Keluar</button>
                </form>
            </div>
            @endauth
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const btn = document.getElementById('mobileMenuBtn');
        const menu = document.getElementById('mobileMenu');
        
        if(btn && menu) {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                menu.classList.toggle('opacity-0');
                menu.classList.toggle('invisible');
                menu.classList.toggle('scale-95');
            });

            // Close menu when clicking outside
            document.addEventListener('click', (e) => {
                if (!menu.contains(e.target) && !btn.contains(e.target)) {
                    menu.classList.add('opacity-0', 'invisible', 'scale-95');
                }
            });
        }

        // Navbar + SearchBar stack animation
        const header = document.getElementById('mainHeader');
        if (header) {
            const headerH = () => header.offsetHeight;
            const searchBar = document.getElementById('searchBarFixed');

            const TRANSITION = 'transform 0.38s cubic-bezier(0.4,0,0.2,1)';
            header.style.transition = TRANSITION;
            if (searchBar) searchBar.style.transition = TRANSITION;

            let lastScrollY = window.scrollY;
            let ticking = false;

            window.addEventListener('scroll', () => {
                if (!ticking) {
                    window.requestAnimationFrame(() => {
                        const currentY = window.scrollY;

                        if (currentY <= 0) {
                            // At top
                            header.style.transform = 'translateY(0)';
                            if (searchBar) searchBar.style.transform = 'translateY(0)';
                        } else if (currentY > lastScrollY) {
                            // Scroll down
                            header.style.transform = 'translateY(-100%)';
                            if (searchBar) searchBar.style.transform = 'translateY(0)';
                        } else {
                            // Scroll up
                            header.style.transform = 'translateY(0)';
                            if (searchBar) searchBar.style.transform = `translateY(${header.offsetHeight}px)`;
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
