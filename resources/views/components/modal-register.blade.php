<!-- Overlay / Backdrop for Modals -->
<div id="registerModalOverlay" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/40 backdrop-blur-sm opacity-0 invisible transition-all duration-300 px-4">

    <!-- Modal 1: Register Method Selection -->
    <div id="modalRegisterMain" class="relative w-full max-w-md bg-[#F8EDD8] rounded-[1.5rem] shadow-2xl p-6 md:p-8 transform scale-95 transition-all duration-300 hidden">
        <!-- SVG Batik Decoration Top Left -->
        <svg class="absolute top-0 left-0 w-32 h-32 opacity-30 pointer-events-none" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <path d="M10,40 Q20,20 40,30 T70,10 T90,30 T70,50 T40,40 T10,60" fill="none" stroke="#d4a373" stroke-width="2"/>
            <path d="M20,50 Q30,30 50,40 T80,20" fill="none" stroke="#d4a373" stroke-width="1.5"/>
        </svg>
        
        <!-- SVG Batik Decoration Bottom Right -->
        <svg class="absolute bottom-0 right-0 w-32 h-32 opacity-30 pointer-events-none transform rotate-180" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <path d="M10,40 Q20,20 40,30 T70,10 T90,30 T70,50 T40,40 T10,60" fill="none" stroke="#d4a373" stroke-width="2"/>
            <path d="M20,50 Q30,30 50,40 T80,20" fill="none" stroke="#d4a373" stroke-width="1.5"/>
        </svg>

        <button onclick="closeRegisterModal()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-800 transition z-10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <h2 class="text-2xl font-bold text-center text-gray-800 mb-8 relative z-10">Daftar</h2>

        <div class="space-y-4 relative z-10">
            <button class="w-full flex items-center justify-center gap-3 bg-white hover:bg-gray-50 text-gray-700 py-3 rounded-full font-semibold shadow-sm border border-gray-200 transition">
                <svg class="w-5 h-5" viewBox="0 0 24 24">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                </svg>
                Google
            </button>
            
            <div class="text-center mt-6">
                <button onclick="showManualForm()" class="text-blue-500 font-semibold hover:text-blue-700 transition">Metode lain</button>
            </div>
        </div>

        <div class="text-center mt-4 relative z-10">
            <p class="text-sm text-gray-600">Sudah punya akun? <button type="button" onclick="closeRegisterModal(); setTimeout(() => openLoginModal(), 300)" class="text-blue-500 font-bold hover:text-blue-700 transition">Klik Log In</button></p>
        </div>

        <p class="text-center text-xs text-gray-500 mt-4 relative z-10">
            Dengan melanjutkan, kamu setuju dengan aturan penggunaan aplikasi ini.
        </p>
    </div>

    <!-- Modal 2: Manual Registration Form -->
    <div id="modalRegisterManual" class="relative w-full max-w-lg bg-[#F8EDD8] rounded-[1.5rem] shadow-2xl p-6 md:p-8 transform scale-95 transition-all duration-300 hidden">
        <!-- SVG Batik Decoration Top Left -->
        <svg class="absolute top-0 left-0 w-32 h-32 opacity-30 pointer-events-none" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <path d="M10,40 Q20,20 40,30 T70,10 T90,30 T70,50 T40,40 T10,60" fill="none" stroke="#d4a373" stroke-width="2"/>
            <path d="M20,50 Q30,30 50,40 T80,20" fill="none" stroke="#d4a373" stroke-width="1.5"/>
        </svg>
        
        <!-- SVG Batik Decoration Bottom Right -->
        <svg class="absolute bottom-10 right-0 w-32 h-32 opacity-30 pointer-events-none transform rotate-180" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <path d="M10,40 Q20,20 40,30 T70,10 T90,30 T70,50 T40,40 T10,60" fill="none" stroke="#d4a373" stroke-width="2"/>
            <path d="M20,50 Q30,30 50,40 T80,20" fill="none" stroke="#d4a373" stroke-width="1.5"/>
        </svg>

        <button onclick="closeRegisterModal()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-800 transition z-10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6 relative z-10">Daftar</h2>

        <form id="formRegisterManual" onsubmit="handleRegisterSubmit(event)" class="space-y-4 relative z-10">
            <div>
                <label class="block text-xs font-bold text-gray-800 mb-1">Nama Lengkap sesuai KTP</label>
                <input type="text" id="regName" required class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:border-[#3a523a] focus:ring-1 focus:ring-[#3a523a] text-sm" placeholder="Masukkan Nama Lengkap sesuai KTP">
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-800 mb-1">Email</label>
                    <input type="email" id="regEmail" required class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:border-[#3a523a] focus:ring-1 focus:ring-[#3a523a] text-sm" placeholder="Masukkan Email">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-800 mb-1">No. Telfon</label>
                    <input type="tel" id="regPhone" required class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:border-[#3a523a] focus:ring-1 focus:ring-[#3a523a] text-sm" placeholder="Masukkan No. Telfon">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-800 mb-1">Password</label>
                <input type="password" id="regPassword" required class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:border-[#3a523a] focus:ring-1 focus:ring-[#3a523a] text-sm" placeholder="Masukkan Password">
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-[#2f4f4f] hover:bg-[#233b3b] text-white font-bold py-3.5 rounded-full transition shadow-md">
                    Daftar
                </button>
            </div>
            
            <div class="text-center mt-2">
                <button type="button" onclick="showMainRegister()" class="text-blue-500 font-semibold hover:text-blue-700 transition">Kembali</button>
            </div>
        </form>

        <div class="text-center mt-3 relative z-10">
            <p class="text-sm text-gray-600">Sudah punya akun? <button type="button" onclick="closeRegisterModal(); setTimeout(() => openLoginModal(), 300)" class="text-blue-500 font-bold hover:text-blue-700 transition">Klik Log In</button></p>
        </div>

        <p class="text-center text-xs text-gray-500 mt-4 relative z-10">
            Dengan melanjutkan, kamu setuju dengan aturan penggunaan aplikasi ini.
        </p>
    </div>
    
    <!-- Modal 3: Verification -->
    <div id="modalVerification" class="relative w-full max-w-sm bg-white rounded-2xl shadow-2xl p-8 transform scale-95 transition-all duration-300 hidden text-center">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Verifikasi</h2>
        <p class="text-sm text-gray-600 leading-relaxed mb-6">
            Kami telah mengirimkan email verifikasi ke <br>
            <span id="verifEmailDisplay" class="text-blue-500">xxxxxx@gmail.com</span>. Silakan periksa email Anda dan lakukan konfirmasi.
        </p>
        <button onclick="finishVerification()" class="text-blue-500 font-bold hover:text-blue-700 transition">OK, Mengerti</button>
    </div>

    <!-- Modal 4: Success -->
    <div id="modalSuccess" class="relative w-full max-w-xs bg-white rounded-2xl shadow-2xl p-8 transform scale-95 transition-all duration-300 hidden text-center">
        <div class="mx-auto w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mb-4 relative">
            <div class="absolute inset-0 bg-green-200 rounded-full animate-ping opacity-20"></div>
            <div class="w-14 h-14 bg-[#34c759] rounded-full flex items-center justify-center z-10">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
        </div>
        <h2 class="text-xl font-bold text-gray-800">Daftar Berhasil</h2>
    </div>

    <!-- Modal 5: Failed -->
    <div id="modalFailed" class="relative w-full max-w-xs bg-white rounded-2xl shadow-2xl p-8 transform scale-95 transition-all duration-300 hidden text-center">
        <div class="mx-auto w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mb-4 relative">
            <div class="absolute inset-0 bg-red-200 rounded-full animate-ping opacity-20"></div>
            <div class="w-14 h-14 bg-[#ff3b30] rounded-full flex items-center justify-center z-10">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
        </div>
        <h2 class="text-xl font-bold text-gray-800 mb-4">Daftar Gagal</h2>
        <button onclick="showManualForm()" class="text-blue-500 font-bold hover:text-blue-700 transition text-sm">Coba Lagi</button>
    </div>

</div>

<script>
    // Elements
    const overlay = document.getElementById('registerModalOverlay');
    const modalMain = document.getElementById('modalRegisterMain');
    const modalManual = document.getElementById('modalRegisterManual');
    const modalVerification = document.getElementById('modalVerification');
    const modalSuccess = document.getElementById('modalSuccess');
    const modalFailed = document.getElementById('modalFailed');
    
    // Auth Headers Elements
    const desktopAuthBtns = document.getElementById('desktopAuthButtons');
    const desktopUserMenu = document.getElementById('desktopUserMenu');
    const desktopUserName = document.getElementById('desktopUserName');
    const desktopUserInitial = document.getElementById('desktopUserInitial');
    
    const mobileAuthBtns = document.getElementById('mobileAuthButtons');
    const mobileUserMenu = document.getElementById('mobileUserMenu');
    const mobileUserName = document.getElementById('mobileUserName');
    const mobileUserInitial = document.getElementById('mobileUserInitial');

    let registeredName = '';

    // Mock Login open function just to prevent errors if clicked (Removed, implemented in modal-login.blade.php)

    // Opens the main register modal
    function openRegisterModal() {
        overlay.classList.remove('hidden');
        // small delay to allow display:block to apply before animating opacity
        setTimeout(() => {
            overlay.classList.remove('opacity-0', 'invisible');
            
            hideAllModals();
            modalMain.classList.remove('hidden');
            setTimeout(() => {
                modalMain.classList.remove('scale-95');
                modalMain.classList.add('scale-100');
            }, 10);
        }, 10);
    }

    function closeRegisterModal() {
        overlay.classList.add('opacity-0', 'invisible');
        
        // Scale down the active modal
        const activeModal = overlay.querySelector('.scale-100');
        if(activeModal) {
            activeModal.classList.remove('scale-100');
            activeModal.classList.add('scale-95');
        }

        setTimeout(() => {
            overlay.classList.add('hidden');
            hideAllModals();
        }, 300);
    }

    function hideAllModals() {
        const modals = [modalMain, modalManual, modalVerification, modalSuccess, modalFailed];
        modals.forEach(m => {
            m.classList.add('hidden', 'scale-95');
            m.classList.remove('scale-100');
        });
    }

    function showManualForm() {
        hideAllModals();
        modalManual.classList.remove('hidden');
        setTimeout(() => {
            modalManual.classList.remove('scale-95');
            modalManual.classList.add('scale-100');
        }, 10);
    }

    function showMainRegister() {
        hideAllModals();
        modalMain.classList.remove('hidden');
        setTimeout(() => {
            modalMain.classList.remove('scale-95');
            modalMain.classList.add('scale-100');
        }, 10);
    }

    // Handle form submit
    function handleRegisterSubmit(e) {
        e.preventDefault();
        const name = document.getElementById('regName').value;
        const email = document.getElementById('regEmail').value;
        const password = document.getElementById('regPassword').value;

        // Mock validation or simulated failure
        // For demonstration, if password is 'gagal', we show Failed Modal.
        if (password === 'gagal') {
            showFailedModal();
            return;
        }

        registeredName = name;
        document.getElementById('verifEmailDisplay').textContent = email;
        
        // Show verification modal
        hideAllModals();
        modalVerification.classList.remove('hidden');
        setTimeout(() => {
            modalVerification.classList.remove('scale-95');
            modalVerification.classList.add('scale-100');
        }, 10);
    }

    function showFailedModal() {
        hideAllModals();
        modalFailed.classList.remove('hidden');
        setTimeout(() => {
            modalFailed.classList.remove('scale-95');
            modalFailed.classList.add('scale-100');
        }, 10);
    }

    function finishVerification() {
        // Show success modal
        hideAllModals();
        modalSuccess.classList.remove('hidden');
        setTimeout(() => {
            modalSuccess.classList.remove('scale-95');
            modalSuccess.classList.add('scale-100');
        }, 10);

        // After 2 seconds, close modal and login user
        const regEmail = document.getElementById('regEmail')?.value || '';
        const regPhone = document.getElementById('regPhone')?.value || '';
        setTimeout(() => {
            closeRegisterModal();
            loginMockUser(registeredName, regEmail, regPhone);
        }, 2000);
    }

    function loginMockUser(name, email, phone) {
        if(!name) name = "User";
        const initial = name.charAt(0).toUpperCase();

        // Persist user data to sessionStorage
        sessionStorage.setItem('user_logged_in', 'true');
        sessionStorage.setItem('user_name', name);
        sessionStorage.setItem('user_email', email || '');
        sessionStorage.setItem('user_phone', phone || '');

        // Update Desktop Navbar
        if(desktopAuthBtns) desktopAuthBtns.classList.add('hidden');
        if(desktopAuthBtns) desktopAuthBtns.classList.remove('sm:flex');
        
        if(desktopUserMenu) {
            desktopUserMenu.classList.remove('hidden');
            desktopUserMenu.classList.add('flex');
            desktopUserName.textContent = name;
            desktopUserInitial.textContent = initial;
        }

        // Update Mobile Navbar
        if(mobileAuthBtns) mobileAuthBtns.classList.add('hidden');
        
        if(mobileUserMenu) {
            mobileUserMenu.classList.remove('hidden');
            mobileUserMenu.classList.add('flex');
            mobileUserName.textContent = name;
            mobileUserInitial.textContent = initial;
        }

        // If there's a pending redirect (from Pilih Kamar), go there
        const pendingUrl = sessionStorage.getItem('pending_redirect');
        if (pendingUrl) {
            sessionStorage.removeItem('pending_redirect');
            setTimeout(() => { window.location.href = pendingUrl; }, 500);
        }
    }

    function logoutMock() {
        // Clear sessionStorage
        sessionStorage.removeItem('user_logged_in');
        sessionStorage.removeItem('user_name');
        sessionStorage.removeItem('user_email');
        sessionStorage.removeItem('user_phone');

        // Revert Desktop Navbar
        if(desktopAuthBtns) {
            desktopAuthBtns.classList.remove('hidden');
            desktopAuthBtns.classList.add('sm:flex');
        }
        
        if(desktopUserMenu) {
            desktopUserMenu.classList.add('hidden');
            desktopUserMenu.classList.remove('flex');
        }

        // Revert Mobile Navbar
        if(mobileAuthBtns) {
            mobileAuthBtns.classList.remove('hidden');
        }
        
        if(mobileUserMenu) {
            mobileUserMenu.classList.add('hidden');
            mobileUserMenu.classList.remove('flex');
        }
    }

    // ── Restore login state on page load ──────────────────────
    (function restoreLoginState() {
        const isLoggedIn = sessionStorage.getItem('user_logged_in') === 'true';
        const userName = sessionStorage.getItem('user_name');
        if (isLoggedIn && userName) {
            loginMockUser(userName, sessionStorage.getItem('user_email'), sessionStorage.getItem('user_phone'));
        }
    })();
</script>
