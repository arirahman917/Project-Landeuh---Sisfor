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
                    <div class="flex justify-between items-center mb-1">
                        <label class="block text-xs font-bold text-gray-800">Password</label>
                        <button type="button" onclick="closeLoginModal(); setTimeout(() => openForgotPasswordModal(), 300)" class="text-[10px] text-blue-500 hover:text-blue-700 hover:underline">Lupa Password?</button>
                    </div>
                    <div class="relative">
                        <input type="password" id="logPassword" required class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:border-[#3a523a] focus:ring-1 focus:ring-[#3a523a] text-sm pr-10" placeholder="Masukkan Password">
                        <button type="button" onclick="togglePasswordVisibility('logPassword')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700">
                            <!-- Eye icon -->
                            <svg id="logPassword-eye" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <!-- Eye slash icon (hidden) -->
                            <svg id="logPassword-eye-slash" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
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

    <!-- Modal 5: Forgot Password -->
    <div id="modalForgotPassword" class="relative w-full max-w-lg bg-[#F8EDD8] rounded-[1.5rem] shadow-2xl p-6 md:p-8 transform scale-95 transition-all duration-300 hidden">
        <div class="text-center mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Lupa Password</h2>
            <p class="text-sm text-gray-600 mt-2">Masukkan email Anda untuk menerima tautan reset password.</p>
        </div>
        
        <form id="formForgotPassword" onsubmit="handleForgotPasswordSubmit(event)" class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-gray-800 mb-1">Email</label>
                <input type="email" id="forgotEmail" required class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:border-[#3a523a] focus:ring-1 focus:ring-[#3a523a] text-sm" placeholder="Masukkan Email Anda">
            </div>

            <!-- Message Alert Container -->
            <div id="forgotMessageContainer" class="hidden rounded p-3 text-sm font-semibold text-center mt-2"></div>

            <div class="pt-2">
                <button type="submit" id="btnForgotSubmit" class="w-full flex justify-center items-center gap-2 bg-[#2f4f4f] hover:bg-[#233b3b] text-white font-bold py-3.5 rounded-full transition shadow-md disabled:bg-gray-400 disabled:cursor-not-allowed">
                    <span id="btnForgotText">Kirim Tautan Reset</span>
                    <svg id="btnForgotSpinner" class="animate-spin h-5 w-5 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </button>
            </div>
            
            <div class="text-center mt-2">
                <button type="button" onclick="showLoginManualForm()" class="text-blue-500 font-semibold hover:text-blue-700 transition">Kembali ke Log In</button>
            </div>
        </form>
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
    const modalForgotPassword = document.getElementById('modalForgotPassword');
    
    // Override the mock function in modal-register.blade.php
    window.openLoginModal = function() {
        loginOverlay.classList.remove('hidden');
        loginOverlay.classList.remove('opacity-0', 'invisible');
        
        hideAllLoginModals();
        modalLoginMain.classList.remove('hidden');
        setTimeout(() => {
            modalLoginMain.classList.remove('scale-95');
            modalLoginMain.classList.add('scale-100');
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
        const modals = [modalLoginMain, modalLoginManual, modalLoginSuccess, modalLoginFailed, modalForgotPassword];
        modals.forEach(m => {
            m.classList.add('hidden', 'scale-95');
            m.classList.remove('scale-100');
        });
    }

    window.openForgotPasswordModal = function() {
        hideAllLoginModals();
        
        // Reset form messages
        const msgContainer = document.getElementById('forgotMessageContainer');
        msgContainer.className = 'hidden rounded p-3 text-sm font-semibold text-center mt-2';
        msgContainer.innerText = '';
        document.getElementById('forgotEmail').value = '';

        modalForgotPassword.classList.remove('hidden');
        setTimeout(() => {
            modalForgotPassword.classList.remove('scale-95');
            modalForgotPassword.classList.add('scale-100');
        }, 10);
        
        // If the user clicked "Lupa Password" from the home page but login modal wasn't open yet:
        if (loginOverlay.classList.contains('hidden')) {
            loginOverlay.classList.remove('hidden');
            loginOverlay.classList.remove('opacity-0', 'invisible');
        }
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

    window.togglePasswordVisibility = function(inputId) {
        const input = document.getElementById(inputId);
        const eyeIcon = document.getElementById(inputId + '-eye');
        const eyeSlashIcon = document.getElementById(inputId + '-eye-slash');
        
        if (input.type === 'password') {
            input.type = 'text';
            eyeIcon.classList.add('hidden');
            eyeSlashIcon.classList.remove('hidden');
        } else {
            input.type = 'password';
            eyeIcon.classList.remove('hidden');
            eyeSlashIcon.classList.add('hidden');
        }
    }
    window.handleForgotPasswordSubmit = async function(e) {
        e.preventDefault();
        const email = document.getElementById('forgotEmail').value;
        const btnSubmit = document.getElementById('btnForgotSubmit');
        const btnText = document.getElementById('btnForgotText');
        const btnSpinner = document.getElementById('btnForgotSpinner');
        const msgContainer = document.getElementById('forgotMessageContainer');
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        // Loading state
        btnSubmit.disabled = true;
        btnText.innerText = 'Mengirim...';
        btnSpinner.classList.remove('hidden');
        msgContainer.classList.add('hidden');

        try {
            const formData = new FormData();
            formData.append('email', email);

            const response = await fetch("{{ route('password.email') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken || '',
                    'Accept': 'application/json'
                },
                body: formData
            });

            const data = await response.json();

            msgContainer.classList.remove('hidden', 'bg-red-100', 'text-red-700', 'bg-green-100', 'text-green-700');
            if (response.ok) {
                msgContainer.classList.add('bg-green-100', 'text-green-700');
                msgContainer.innerText = data.message || 'Link reset password telah dikirim ke email Anda.';
                document.getElementById('forgotEmail').value = '';
            } else {
                msgContainer.classList.add('bg-red-100', 'text-red-700');
                msgContainer.innerText = data.message || 'Gagal mengirim email reset password.';
            }
        } catch (error) {
            console.error(error);
            msgContainer.classList.remove('hidden');
            msgContainer.classList.add('bg-red-100', 'text-red-700');
            msgContainer.innerText = 'Terjadi kesalahan sistem.';
        } finally {
            // Restore state
            btnSubmit.disabled = false;
            btnText.innerText = 'Kirim Tautan Reset';
            btnSpinner.classList.add('hidden');
        }
    }
}
</script>
