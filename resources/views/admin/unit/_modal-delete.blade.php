{{-- ============================================================
     MODAL HAPUS KAMAR
     Letakkan di: resources/views/admin/unit/_modal-delete.blade.php
     Dipanggil dari: unit/index.blade.php via @include
     ============================================================ --}}

<div id="modalDeleteKamar"
    class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 backdrop-blur-sm hidden"
    onclick="if(event.target===this) closeDeleteModal()"
>
    <div class="relative w-full max-w-sm mx-4 bg-[#fdf6e3] rounded-3xl shadow-2xl border border-red-200/60 overflow-hidden
                animate-[modalIn_0.25s_ease-out_forwards]"
         style="font-family:'Georgia',serif;"
    >
        {{-- Accent bar --}}
        <div class="h-1 w-full bg-gradient-to-r from-red-500 via-rose-500 to-red-600"></div>

        {{-- Body --}}
        <div class="px-8 pt-8 pb-7 text-center">
            <div class="w-16 h-16 mx-auto mb-4 bg-red-100 text-red-500 rounded-full flex items-center justify-center shadow-inner">
                <iconify-icon icon="lucide:alert-triangle" class="text-3xl"></iconify-icon>
            </div>
            <h2 class="text-xl font-bold text-stone-800 tracking-tight mb-2">Hapus Kamar?</h2>
            <p class="text-sm text-stone-500 mb-6">
                Apakah Anda yakin ingin menghapus <span id="deleteKamarName" class="font-bold text-stone-700">kamar ini</span>?<br/>
                Data akan dihapus permanen dari database.
            </p>

            <input type="hidden" id="deleteKamarId">

            <div class="flex items-center justify-center gap-3">
                <button onclick="closeDeleteModal()"
                    class="px-5 py-2.5 rounded-xl text-sm font-semibold text-stone-600 bg-stone-100 hover:bg-stone-200 transition">
                    Batal
                </button>
                <button onclick="submitDeleteKamar()"
                    class="px-5 py-2.5 rounded-xl text-sm font-bold text-white
                           bg-gradient-to-r from-red-500 to-red-600
                           hover:from-red-600 hover:to-red-700
                           shadow-lg shadow-red-900/20 transition-all active:scale-[0.98] flex items-center gap-2">
                    <iconify-icon icon="lucide:trash-2" class="text-base"></iconify-icon>
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    window.openDeleteModal = function(id, nama) {
        document.getElementById('deleteKamarId').value = id;
        document.getElementById('deleteKamarName').innerText = nama || 'kamar ini';
        document.getElementById('modalDeleteKamar').classList.remove('hidden');
    };

    window.closeDeleteModal = function() {
        document.getElementById('modalDeleteKamar').classList.add('hidden');
    };

    window.submitDeleteKamar = function() {
        const id = document.getElementById('deleteKamarId').value;
        if(!id) return;
        
        closeDeleteModal();
        performDelete(id);
    };
</script>
