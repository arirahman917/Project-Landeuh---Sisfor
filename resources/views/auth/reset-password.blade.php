<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Reset Password - Landeuh Village Riverside</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #F8EDD8;
        }
    </style>
</head>
<body class="antialiased min-h-screen flex items-center justify-center relative overflow-hidden p-4">

    <!-- Ornaments -->
    <svg class="absolute top-0 left-0 w-64 h-64 opacity-20 pointer-events-none" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
        <path d="M10,40 Q20,20 40,30 T70,10 T90,30 T70,50 T40,40 T10,60" fill="none" stroke="#d4a373" stroke-width="2"/>
    </svg>
    
    <div class="relative z-10 w-full max-w-md bg-white/60 backdrop-blur-xl rounded-[2rem] shadow-2xl p-8 border border-white/40">
        <div class="text-center mb-8">
            <a href="{{ url('/') }}" class="inline-block mb-4">
                <img src="{{ asset('images/logo-landeuh.png') }}" alt="Logo" class="h-14 mx-auto object-contain">
            </a>
            <h2 class="text-2xl font-bold text-gray-800">Buat Password Baru</h2>
            <p class="text-sm text-gray-600 mt-2">Masukkan password baru untuk akun Anda.</p>
        </div>

        <form id="formResetPassword" onsubmit="handleResetPasswordSubmit(event)" class="space-y-4">
            <input type="hidden" id="resetToken" value="{{ $token }}">
            <input type="hidden" id="resetEmail" value="{{ $email }}">

            <div>
                <label class="block text-xs font-bold text-gray-800 mb-1">Email</label>
                <input type="email" value="{{ $email }}" disabled class="w-full px-4 py-2.5 rounded-lg border border-gray-200 bg-gray-50 text-gray-500 text-sm">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-800 mb-1">Password Baru</label>
                <div class="relative">
                    <input type="password" id="resetPassword" required minlength="6" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:border-[#3a523a] focus:ring-1 focus:ring-[#3a523a] text-sm pr-10" placeholder="Minimal 6 karakter">
                    <button type="button" onclick="toggleVisibility('resetPassword')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700">
                        <svg id="resetPassword-eye" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg id="resetPassword-eye-slash" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                        </svg>
                    </button>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-800 mb-1">Konfirmasi Password Baru</label>
                <div class="relative">
                    <input type="password" id="resetPasswordConfirmation" required minlength="6" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:border-[#3a523a] focus:ring-1 focus:ring-[#3a523a] text-sm pr-10" placeholder="Ulangi password baru">
                    <button type="button" onclick="toggleVisibility('resetPasswordConfirmation')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700">
                        <svg id="resetPasswordConfirmation-eye" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg id="resetPasswordConfirmation-eye-slash" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                        </svg>
                    </button>
                </div>
            </div>

            <div id="resetMessageContainer" class="hidden rounded p-3 text-sm font-semibold text-center mt-2"></div>

            <div class="pt-4">
                <button type="submit" id="btnResetSubmit" class="w-full flex justify-center items-center gap-2 bg-[#2f4f4f] hover:bg-[#233b3b] text-white font-bold py-3.5 rounded-full transition shadow-md disabled:bg-gray-400 disabled:cursor-not-allowed">
                    <span id="btnResetText">Ubah Password</span>
                    <svg id="btnResetSpinner" class="animate-spin h-5 w-5 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </button>
            </div>
        </form>
    </div>

    <script>
        function toggleVisibility(inputId) {
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

        async function handleResetPasswordSubmit(e) {
            e.preventDefault();
            
            const token = document.getElementById('resetToken').value;
            const email = document.getElementById('resetEmail').value;
            const password = document.getElementById('resetPassword').value;
            const passwordConfirmation = document.getElementById('resetPasswordConfirmation').value;
            
            const btnSubmit = document.getElementById('btnResetSubmit');
            const btnText = document.getElementById('btnResetText');
            const btnSpinner = document.getElementById('btnResetSpinner');
            const msgContainer = document.getElementById('resetMessageContainer');
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            if (password !== passwordConfirmation) {
                msgContainer.classList.remove('hidden', 'bg-green-100', 'text-green-700');
                msgContainer.classList.add('bg-red-100', 'text-red-700');
                msgContainer.innerText = 'Konfirmasi password tidak cocok!';
                return;
            }

            btnSubmit.disabled = true;
            btnText.innerText = 'Menyimpan...';
            btnSpinner.classList.remove('hidden');
            msgContainer.classList.add('hidden');

            try {
                const formData = new FormData();
                formData.append('token', token);
                formData.append('email', email);
                formData.append('password', password);
                formData.append('password_confirmation', passwordConfirmation);

                const response = await fetch("{{ route('password.update') }}", {
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
                    msgContainer.innerText = data.message || 'Password berhasil diubah!';
                    setTimeout(() => {
                        window.location.href = "{{ url('/') }}?login=1";
                    }, 2000);
                } else {
                    msgContainer.classList.add('bg-red-100', 'text-red-700');
                    msgContainer.innerText = data.message || 'Gagal mengubah password.';
                }
            } catch (error) {
                console.error(error);
                msgContainer.classList.remove('hidden');
                msgContainer.classList.add('bg-red-100', 'text-red-700');
                msgContainer.innerText = 'Terjadi kesalahan sistem.';
            } finally {
                if (!msgContainer.classList.contains('bg-green-100')) {
                    btnSubmit.disabled = false;
                    btnText.innerText = 'Ubah Password';
                    btnSpinner.classList.add('hidden');
                }
            }
        }
    </script>
</body>
</html>
