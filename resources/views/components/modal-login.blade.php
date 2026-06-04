<!-- Overlay / Backdrop for Login Modals -->
<div id="loginModalOverlay" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/40 backdrop-blur-sm opacity-0 invisible transition-all duration-300 px-4">

    <!-- Modal 1: Login Method Selection -->
    <div id="modalLoginMain" class="relative w-full max-w-md bg-[#F8EDD8] rounded-[1.5rem] shadow-2xl p-6 md:p-8 transform scale-95 transition-all duration-300 hidden">
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

        <button onclick="closeLoginModal()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-800 transition z-10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <h2 class="text-2xl font-bold text-center text-gray-800 mb-8 relative z-10">Log In</h2>

        <div class="space-y-4 relative z-10">
            <a href="{{ route('auth.google') }}" class="w-full flex items-center justify-center gap-3 bg-white hover:bg-gray-50 text-gray-700 py-3 rounded-full font-semibold shadow-sm border border-gray-200 transition">
                <svg class="w-5 h-5" viewBox="0 0 24 24">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                </svg>
                Google
            </a>
            
            <div class="text-center mt-6">
                <button onclick="showLoginManualForm()" class="text-blue-500 font-semibold hover:text-blue-700 transition">Metode lain</button>
            </div>
        </div>

        <div class="text-center mt-4 relative z-10">
            <p class="text-sm text-gray-600">Belum punya akun? <button type="button" onclick="closeLoginModal(); setTimeout(() => openRegisterModal(), 300)" class="text-blue-500 font-bold hover:text-blue-700 transition">Klik Daftar</button></p>
        </div>

        <p class="text-center text-xs text-gray-500 mt-4 relative z-10">
            Dengan melanjutkan, kamu setuju dengan aturan penggunaan aplikasi ini.
        </p>
    </div>

    <!-- Modal 2: Manual Login Form -->
    <div id="modalLoginManual" class="relative w-full max-w-lg bg-[#F8EDD8] rounded-[1.5rem] shadow-2xl p-6 md:p-8 transform scale-95 transition-all duration-300 hidden">
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

        <button onclick="closeLoginModal()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-800 transition z-10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6 relative z-10">Log In</h2>

        <form id="formLoginManual" onsubmit="handleLoginSubmit(event)" class="space-y-4 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-800 mb-1">Email</label>
                    <input type="email" id="logEmail" required class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:border-[#3a523a] focus:ring-1 focus:ring-[#3a523a] text-sm" placeholder="Masukkan Email">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-800 mb-1">Password</label>
                    <input type="password" id="logPassword" required class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:border-[#3a523a] focus:ring-1 focus:ring-[#3a523a] text-sm" placeholder="Masukkan Password">
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-[#2f4f4f] hover:bg-[#233b3b] text-white font-bold py-3.5 rounded-full transition shadow-md">
                    Log In
                </button>
            </div>
            
            <div class="text-center mt-2">
                <button type="button" onclick="showMainLogin()" class="text-blue-500 font-semibold hover:text-blue-700 transition">Kembali</button>
            </div>
        </form>

        <div class="text-center mt-3 relative z-10">
            <p class="text-sm text-gray-600">Belum punya akun? <button type="button" onclick="closeLoginModal(); setTimeout(() => openRegisterModal(), 300)" class="text-blue-500 font-bold hover:text-blue-700 transition">Klik Daftar</button></p>
        </div>

        <p class="text-center text-xs text-gray-500 mt-4 relative z-10">
            Dengan melanjutkan, kamu setuju dengan aturan penggunaan aplikasi ini.
        </p>
    </div>

    <!-- Modal 3: Success -->
    <div id="modalLoginSuccess" class="relative w-full max-w-xs bg-white rounded-2xl shadow-2xl p-8 transform scale-95 transition-all duration-300 hidden text-center">
        <div class="mx-auto w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mb-4 relative">
            <div class="absolute inset-0 bg-green-200 rounded-full animate-ping opacity-20"></div>
            <div class="w-14 h-14 bg-[#34c759] rounded-full flex items-center justify-center z-10">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
        </div>
        <h2 class="text-xl font-bold text-gray-800">Log In Berhasil</h2>
    </div>

    <!-- Modal 4: Failed -->
    <div id="modalLoginFailed" class="relative w-full max-w-xs bg-white rounded-2xl shadow-2xl p-8 transform scale-95 transition-all duration-300 hidden text-center">
        <div class="mx-auto w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mb-4 relative">
            <div class="absolute inset-0 bg-red-200 rounded-full animate-ping opacity-20"></div>
            <div class="w-14 h-14 bg-[#ff3b30] rounded-full flex items-center justify-center z-10">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
        </div>
        <h2 class="text-xl font-bold text-gray-800 mb-4">Log In Gagal</h2>
        <button onclick="showLoginManualForm()" class="text-blue-500 font-bold hover:text-blue-700 transition text-sm">Coba Lagi</button>
    </div>

</div>

<script>
if (typeof window.loginModalInitialized === 'undefined') {
    window.loginModalInitialized = true;

    // Elements for Login
    const loginOverlay = document.getElementById('loginModalOverlay');
    const modalLoginMain = document.getElementById('modalLoginMain');
    const modalLoginManual = document.getElementById('modalLoginManual');
    const modalLoginSuccess = document.getElementById('modalLoginSuccess');
    const modalLoginFailed = document.getElementById('modalLoginFailed');
    
    // Override the mock function in modal-register.blade.php
    window.openLoginModal = function() {
        loginOverlay.classList.remove('hidden');
        setTimeout(() => {
            loginOverlay.classList.remove('opacity-0', 'invisible');
            
            hideAllLoginModals();
            modalLoginMain.classList.remove('hidden');
            setTimeout(() => {
                modalLoginMain.classList.remove('scale-95');
                modalLoginMain.classList.add('scale-100');
            }, 10);
        }, 10);
    }

    window.closeLoginModal = function() {
        loginOverlay.classList.add('opacity-0', 'invisible');
        
        const activeModal = loginOverlay.querySelector('.scale-100');
        if(activeModal) {
            activeModal.classList.remove('scale-100');
            activeModal.classList.add('scale-95');
        }

        setTimeout(() => {
            loginOverlay.classList.add('hidden');
            hideAllLoginModals();
        }, 300);
    }

    window.hideAllLoginModals = function() {
        const modals = [modalLoginMain, modalLoginManual, modalLoginSuccess, modalLoginFailed];
        modals.forEach(m => {
            m.classList.add('hidden', 'scale-95');
            m.classList.remove('scale-100');
        });
    }

    window.showLoginManualForm = function() {
        hideAllLoginModals();
        modalLoginManual.classList.remove('hidden');
        setTimeout(() => {
            modalLoginManual.classList.remove('scale-95');
            modalLoginManual.classList.add('scale-100');
        }, 10);
    }

    window.showMainLogin = function() {
        hideAllLoginModals();
        modalLoginMain.classList.remove('hidden');
        setTimeout(() => {
            modalLoginMain.classList.remove('scale-95');
            modalLoginMain.classList.add('scale-100');
        }, 10);
    }

    // Handle login submit
    window.handleLoginSubmit = async function(e) {
        e.preventDefault();
        const email = document.getElementById('logEmail').value;
        const password = document.getElementById('logPassword').value;
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        const formData = new FormData();
        formData.append('email', email);
        formData.append('password', password);

        try {
            const response = await fetch("{{ route('login.post') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken || '',
                    'Accept': 'application/json'
                },
                body: formData
            });

            if (response.ok) {
                // Show success modal directly
                hideAllLoginModals();
                modalLoginSuccess.classList.remove('hidden');
                setTimeout(() => {
                    modalLoginSuccess.classList.remove('scale-95');
                    modalLoginSuccess.classList.add('scale-100');
                }, 10);

                // After 1.5 seconds, close modal and reload page
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } else {
                showLoginFailedModal();
            }
        } catch (error) {
            console.error(error);
            showLoginFailedModal();
        }
    }

    window.showLoginFailedModal = function() {
        hideAllLoginModals();
        modalLoginFailed.classList.remove('hidden');
        setTimeout(() => {
            modalLoginFailed.classList.remove('scale-95');
            modalLoginFailed.classList.add('scale-100');
        }, 10);
    }
}
</script>
