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
                <div class="relative">
                    <input type="password" id="regPassword" required class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:border-[#3a523a] focus:ring-1 focus:ring-[#3a523a] text-sm pr-10" placeholder="Masukkan Password">
                    <button type="button" onclick="togglePasswordVisibility('regPassword')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700">
                        <!-- Eye icon -->
                        <svg id="regPassword-eye" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <!-- Eye slash icon (hidden) -->
                        <svg id="regPassword-eye-slash" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" id="regSubmitBtn" class="w-full flex items-center justify-center gap-2 bg-[#2f4f4f] hover:bg-[#233b3b] text-white font-bold py-3.5 rounded-full transition shadow-md disabled:bg-gray-400 disabled:cursor-not-allowed">
                    <span id="regBtnText">Daftar</span>
                    <svg id="regBtnSpinner" class="animate-spin h-5 w-5 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
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
    <div id="modalVerification" class="relative w-full max-w-sm bg-[#F8EDD8] rounded-2xl shadow-2xl p-8 transform scale-95 transition-all duration-300 hidden text-center border border-white/50">
        <!-- SVG Batik Decoration Top Left -->
        <svg class="absolute top-0 left-0 w-24 h-24 opacity-30 pointer-events-none" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <path d="M10,40 Q20,20 40,30 T70,10 T90,30 T70,50 T40,40 T10,60" fill="none" stroke="#d4a373" stroke-width="2"/>
        </svg>

        <h2 class="text-xl font-bold text-gray-800 mb-4 relative z-10">Cek Email Anda</h2>
        <div class="mb-6 relative z-10">
            <div class="w-16 h-16 mx-auto bg-blue-100 rounded-full flex items-center justify-center mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <p class="text-sm text-gray-600 leading-relaxed" id="verifStatusText">
                Email verifikasi sedang dikirim ke <br>
                <span id="verifEmailDisplay" class="text-blue-600 font-bold">xxxxxx@gmail.com</span>
            </p>
            <p class="text-xs text-gray-500 mt-2">Silakan periksa kotak masuk atau folder spam Anda.</p>
        </div>
        
        <div class="flex flex-col gap-3 relative z-10">
            <button onclick="window.finishVerification()" class="w-full bg-[#2f4f4f] hover:bg-[#233b3b] text-white font-bold py-2.5 rounded-full transition shadow-md text-sm">
                OK, Mengerti
            </button>
            <button id="resendVerifBtn" onclick="window.resendVerification()" disabled class="w-full text-blue-500 font-semibold hover:text-blue-700 transition text-sm disabled:text-gray-400 disabled:cursor-not-allowed">
                Kirim Ulang (60s)
            </button>
        </div>
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
if (typeof window.registerModalInitialized === 'undefined') {
    window.registerModalInitialized = true;

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
    let resendTimer = null;
    let resendSeconds = 60;

    // Opens the main register modal
    window.openRegisterModal = function() {
        overlay.classList.remove('hidden');
        // small delay to allow display:block to apply before animating opacity
        setTimeout(() => {
            overlay.classList.remove('opacity-0', 'invisible');
            
            window.hideAllModals();
            modalMain.classList.remove('hidden');
            setTimeout(() => {
                modalMain.classList.remove('scale-95');
                modalMain.classList.add('scale-100');
            }, 10);
        }, 10);
    }

    window.closeRegisterModal = function() {
        overlay.classList.add('opacity-0', 'invisible');
        
        // Scale down the active modal
        const activeModal = overlay.querySelector('.scale-100');
        if(activeModal) {
            activeModal.classList.remove('scale-100');
            activeModal.classList.add('scale-95');
        }

        setTimeout(() => {
            overlay.classList.add('hidden');
            window.hideAllModals();
        }, 300);
    }

    window.hideAllModals = function() {
        const modals = [modalMain, modalManual, modalVerification, modalSuccess, modalFailed];
        modals.forEach(m => {
            m.classList.add('hidden', 'scale-95');
            m.classList.remove('scale-100');
        });
    }

    window.showManualForm = function() {
        window.hideAllModals();
        modalManual.classList.remove('hidden');
        setTimeout(() => {
            modalManual.classList.remove('scale-95');
            modalManual.classList.add('scale-100');
        }, 10);
    }

    window.showMainRegister = function() {
        window.hideAllModals();
        modalMain.classList.remove('hidden');
        setTimeout(() => {
            modalMain.classList.remove('scale-95');
            modalMain.classList.add('scale-100');
        }, 10);
    }

    // Handle form submit
    window.handleRegisterSubmit = async function(e) {
        e.preventDefault();

        const btn = document.getElementById('regSubmitBtn');
        const btnText = document.getElementById('regBtnText');
        const spinner = document.getElementById('regBtnSpinner');
        
        btn.disabled = true;
        btnText.textContent = 'Memproses...';
        spinner.classList.remove('hidden');

        const name = document.getElementById('regName').value;
        const email = document.getElementById('regEmail').value;
        const phone = document.getElementById('regPhone').value;
        const password = document.getElementById('regPassword').value;
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        const formData = new FormData();
        formData.append('name', name);
        formData.append('email', email);
        formData.append('phone', phone);
        formData.append('password', password);

        try {
            const response = await fetch("{{ route('register.post') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken || '',
                    'Accept': 'application/json'
                },
                body: formData
            });

            if (response.ok) {
                registeredName = name;
                
                // Show success modal directly
                window.hideAllModals();
                modalSuccess.classList.remove('hidden');
                setTimeout(() => {
                    modalSuccess.classList.remove('scale-95');
                    modalSuccess.classList.add('scale-100');
                }, 10);
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } else {
                window.showFailedModal();
            }
        } catch (error) {
            console.error(error);
            window.showFailedModal();
        } finally {
            btn.disabled = false;
            btnText.textContent = 'Daftar';
            spinner.classList.add('hidden');
        }
    }

    window.showFailedModal = function() {
        window.hideAllModals();
        modalFailed.classList.remove('hidden');
        setTimeout(() => {
            modalFailed.classList.remove('scale-95');
            modalFailed.classList.add('scale-100');
        }, 10);
    }

    window.startResendCountdown = function() {
        const btn = document.getElementById('resendVerifBtn');
        const statusText = document.getElementById('verifStatusText');
        
        // Update text slightly after a delay to simulate sending
        setTimeout(() => {
            if(statusText) {
                statusText.innerHTML = `Tautan verifikasi telah dikirim ke <br><span class="text-blue-600 font-bold">${document.getElementById('verifEmailDisplay').textContent}</span>`;
            }
        }, 3000);

        if(resendTimer) clearInterval(resendTimer);
        resendSeconds = 60;
        btn.disabled = true;
        btn.textContent = `Kirim Ulang (${resendSeconds}s)`;
        
        resendTimer = setInterval(() => {
            resendSeconds--;
            if(resendSeconds <= 0) {
                clearInterval(resendTimer);
                btn.disabled = false;
                btn.textContent = 'Kirim Ulang Email';
            } else {
                btn.textContent = `Kirim Ulang (${resendSeconds}s)`;
            }
        }, 1000);
    }

    window.resendVerification = async function() {
        const btn = document.getElementById('resendVerifBtn');
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        
        btn.disabled = true;
        btn.textContent = 'Mengirim...';

        try {
            const response = await fetch("{{ route('verification.send') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken || '',
                    'Accept': 'application/json'
                }
            });

            if (response.ok) {
                window.startResendCountdown();
                alert('Email verifikasi berhasil dikirim ulang! Silakan periksa folder Inbox atau Spam Anda.');
            } else {
                alert('Gagal mengirim ulang email. Silakan coba lagi nanti.');
                btn.disabled = false;
                btn.textContent = 'Kirim Ulang Email';
            }
        } catch (error) {
            console.error(error);
            alert('Terjadi kesalahan koneksi.');
            btn.disabled = false;
            btn.textContent = 'Kirim Ulang Email';
        }
    }

    window.finishVerification = function() {
        window.hideAllModals();
        modalSuccess.classList.remove('hidden');
        setTimeout(() => {
            modalSuccess.classList.remove('scale-95');
            modalSuccess.classList.add('scale-100');
        }, 10);
        setTimeout(() => {
            window.location.reload();
        }, 1500);
    }

    // Since register also needs toggle, we might reuse it from login if it's defined globally,
    // but just to be safe, redefine it specifically for the register modal scope if needed
    if (typeof window.togglePasswordVisibility !== 'function') {
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
    }
}
</script>
