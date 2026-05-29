{{-- ============================================================
     MODAL EDIT PELANGGAN
     ============================================================ --}}

<div id="modalEditPelanggan"
    class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 backdrop-blur-sm hidden"
    onclick="if(event.target===this) closeModalEditPelanggan()"
>
    <div class="relative w-full max-w-md mx-4 bg-[#fdf6e3] rounded-3xl shadow-2xl border border-amber-200/60 overflow-hidden
                animate-[modalIn_0.25s_ease-out_forwards]" style="font-family:'Georgia',serif;">
        <div class="h-1 w-full bg-gradient-to-r from-amber-400 via-yellow-500 to-amber-600"></div>

        <div class="flex items-center justify-between px-8 pt-7 pb-0">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <svg width="36" height="16" viewBox="0 0 36 16" fill="none" class="opacity-50">
                        <path d="M1 13 Q5 3 11 7 Q13 1 18 5 Q22 1 27 7 Q32 3 35 11" stroke="#d97706" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                    </svg>
                    <h2 class="text-xl font-bold text-stone-800 tracking-tight">Edit Pelanggan</h2>
                    <svg width="36" height="16" viewBox="0 0 36 16" fill="none" class="opacity-50" style="transform:scaleX(-1)">
                        <path d="M1 13 Q5 3 11 7 Q13 1 18 5 Q22 1 27 7 Q32 3 35 11" stroke="#d97706" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                    </svg>
                </div>
                <p class="text-xs text-stone-400">Perbarui informasi pelanggan</p>
            </div>
            <button onclick="closeModalEditPelanggan()" class="p-2 rounded-xl text-stone-400 hover:bg-stone-200/60 hover:text-stone-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <input type="hidden" id="editPlg_id">

        <div class="px-8 pt-6 pb-7 space-y-4">
            <div>
                <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Nama Lengkap</label>
                <input type="text" id="editPlg_nama"
                    class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm
                           focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
            </div>
            <div>
                <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Email</label>
                <input type="email" id="editPlg_email"
                    class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm
                           focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
            </div>
            <div>
                <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">No. Telepon</label>
                <input type="tel" id="editPlg_telp"
                    class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm
                           focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 px-8 pb-7 pt-2">
            <button onclick="closeModalEditPelanggan()"
                class="px-6 py-2.5 rounded-xl text-sm font-semibold text-stone-600 bg-stone-100 hover:bg-stone-200 transition">Batal</button>
            <button onclick="submitEditPelanggan()"
                class="px-7 py-2.5 rounded-xl text-sm font-bold text-[#fdf6e3] bg-gradient-to-r from-amber-500 to-amber-600
                       hover:from-amber-600 hover:to-amber-700 shadow-lg shadow-amber-900/20 transition-all active:scale-[0.98] flex items-center gap-2">
                <iconify-icon icon="lucide:save" class="text-base"></iconify-icon> Simpan Perubahan
            </button>
        </div>

        <div class="flex justify-center pb-4 opacity-20 pointer-events-none">
            <svg width="64" height="12" viewBox="0 0 64 12" fill="none">
                <path d="M2 9 Q10 1 20 6 Q26 0 32 5 Q38 0 44 6 Q54 1 62 9" stroke="#d97706" stroke-width="1.2" fill="none" stroke-linecap="round"/>
            </svg>
        </div>
    </div>
</div>

<style>
@keyframes modalIn {
    from { opacity: 0; transform: scale(0.95) translateY(8px); }
    to   { opacity: 1; transform: scale(1) translateY(0); }
}
</style>

<script>
    window.openModalEditPelanggan = function(id) {
        const item = window.PELANGGAN_DATA?.find(p => p.id === id);
        if (!item) return;
        document.getElementById('editPlg_id').value    = item.id;
        document.getElementById('editPlg_nama').value  = item.nama;
        document.getElementById('editPlg_email').value = item.email;
        document.getElementById('editPlg_telp').value  = item.telp;
        document.getElementById('modalEditPelanggan').classList.remove('hidden');
    };

    window.closeModalEditPelanggan = function() {
        document.getElementById('modalEditPelanggan').classList.add('hidden');
    };

    window.submitEditPelanggan = function() {
        const id = parseInt(document.getElementById('editPlg_id').value);
        const nameInput = document.getElementById('editPlg_nama').value.trim();
        const emailInput = document.getElementById('editPlg_email').value.trim();
        const telpInput = document.getElementById('editPlg_telp').value.trim();

        if (!nameInput || !emailInput) {
            alert('Nama Lengkap dan Email wajib diisi.');
            return;
        }

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

        fetch(`/admin/pelanggan/${id}`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                nama: nameInput,
                email: emailInput,
                telp: telpInput
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const item = window.PELANGGAN_DATA?.find(p => p.id === id);
                if (item) {
                    item.nama = data.user.nama;
                    item.email = data.user.email;
                    item.telp = data.user.telp;
                }
                
                if (typeof window.renderPelangganTable === 'function') {
                    window.renderPelangganTable();
                }
                closeModalEditPelanggan();
                if (typeof showToast === 'function') {
                    showToast('Data pelanggan berhasil diperbarui.');
                }
            } else {
                alert('Gagal memperbarui data: ' + (data.message || 'Terjadi kesalahan'));
            }
        })
        .catch(err => {
            console.error('Error:', err);
            alert('Terjadi kesalahan koneksi saat memperbarui data pelanggan.');
        });
    };
</script>
