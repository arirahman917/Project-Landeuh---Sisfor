{{-- ============================================================
     MODAL DELETE PAKET CORPORATE
     ============================================================ --}}
<div id="modalDeleteCorporate"
    class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 backdrop-blur-sm hidden"
>
    <div class="relative w-full max-w-sm mx-4 bg-[#fdf6e3] rounded-3xl shadow-2xl border border-red-200/60 overflow-hidden"
         style="font-family:'Georgia',serif;"
    >
        <div class="h-1 w-full bg-gradient-to-r from-red-400 via-red-500 to-red-600"></div>
        <div class="p-8 text-center">
            <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <iconify-icon icon="lucide:trash-2" class="text-red-500 text-3xl"></iconify-icon>
            </div>
            <h2 class="text-lg font-bold text-stone-800 mb-2">Hapus Paket Corporate</h2>
            <p class="text-sm text-stone-500 mb-1">Anda yakin ingin menghapus paket:</p>
            <p class="text-sm font-bold text-stone-800 mb-4" id="delete_corp_name">—</p>
            <p class="text-xs text-red-500 bg-red-50 border border-red-100 rounded-lg px-3 py-2 mb-6">
                Tindakan ini tidak dapat dibatalkan. Booking yang terkait tidak akan ikut terhapus.
            </p>
            <input type="hidden" id="delete_corp_id">
            <div class="flex gap-3 justify-center">
                <button onclick="closeModalDeleteCorp()"
                    class="px-5 py-2.5 rounded-xl text-sm font-semibold text-stone-600 bg-stone-100 hover:bg-stone-200 transition">Batal</button>
                <button onclick="submitDeleteCorp()"
                    class="px-5 py-2.5 rounded-xl text-sm font-bold text-white bg-red-600 hover:bg-red-700 shadow transition duration-200">
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>
</div>
