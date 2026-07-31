{{-- ============================================================
     MODAL EDIT PAKET CORPORATE
     ============================================================ --}}
<div id="modalEditCorporate"
    class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 backdrop-blur-sm hidden"
>
    <div class="relative w-full max-w-2xl mx-4 bg-[#fdf6e3] rounded-3xl shadow-2xl border border-amber-200/60 overflow-hidden"
         style="font-family:'Georgia',serif;"
    >
        <div class="h-1 w-full bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600"></div>
        <div class="flex items-center justify-between px-8 pt-7 pb-0">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <h2 class="text-xl font-bold text-stone-800 tracking-tight">Edit Paket Corporate</h2>
                </div>
                <p class="text-xs text-stone-400">Ubah informasi paket corporate</p>
            </div>
            <button onclick="closeModalEditCorp()"
                class="p-2 rounded-xl text-stone-400 hover:bg-stone-200/60 hover:text-stone-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div class="px-8 pt-6 pb-7 max-h-[75vh] overflow-y-auto">
            <input type="hidden" id="edit_corp_id">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                {{-- Judul --}}
                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Judul Paket</label>
                    <input type="text" id="edit_corp_judul"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
                </div>

                {{-- Jenis --}}
                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Jenis Paket</label>
                    <select id="edit_corp_jenis" onchange="onEditJenisChange(this.value)"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition appearance-none">
                        <option value="">Pilih jenis…</option>
                        <option value="Corporate Glamping">Corporate Glamping</option>
                        <option value="Corporate Cabin">Corporate Cabin</option>
                    </select>
                </div>

                <input type="hidden" id="edit_corp_jenis_akomodasi">

                {{-- Unit Terkait --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Unit Akomodasi Terkait</label>
                    <div id="edit_corp_accommodation_list"
                        class="grid grid-cols-2 gap-2 p-3 rounded-xl border border-stone-200 bg-white/80 max-h-40 overflow-y-auto text-sm">
                    </div>
                    <p class="text-[10px] text-stone-400 mt-1">Total unit terkait akan dihitung dari jumlah slot unit yang dipilih</p>
                </div>

                {{-- Max Orang --}}
                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Maks. Peserta (pax)</label>
                    <input type="number" id="edit_corp_max_orang" min="1"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
                </div>

                {{-- Harga Weekday --}}
                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Harga/Pax Weekday (Rp)</label>
                    <input type="number" id="edit_corp_harga_weekday" min="0"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
                </div>

                {{-- Harga Weekend --}}
                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Harga/Pax Weekend (Rp)</label>
                    <input type="number" id="edit_corp_harga_weekend" min="0"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
                </div>

                {{-- Harga Highseason --}}
                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Harga/Pax Highseason (Rp)</label>
                    <input type="number" id="edit_corp_harga_highseason" min="0"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
                </div>

                {{-- Fasilitas --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Fasilitas</label>
                    <div id="edit_corp_fasilitas_list" class="flex flex-col gap-2"></div>
                    <button type="button" onclick="addFasilitasRow('edit')"
                        class="mt-2 text-xs font-semibold text-amber-600 hover:text-amber-800 flex items-center gap-1 transition">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        Tambah Fasilitas
                    </button>
                </div>

                {{-- Makanan --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Makanan & Minuman</label>
                    <div id="edit_corp_makanan_list" class="flex flex-col gap-2"></div>
                    <button type="button" onclick="addMakananRow('edit')"
                        class="mt-2 text-xs font-semibold text-amber-600 hover:text-amber-800 flex items-center gap-1 transition">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        Tambah Item
                    </button>
                </div>

                {{-- Catatan --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Catatan</label>
                    <div id="edit_corp_catatan_list" class="flex flex-col gap-2"></div>
                    <button type="button" onclick="addCatatanRow('edit')"
                        class="mt-2 text-xs font-semibold text-amber-600 hover:text-amber-800 flex items-center gap-1 transition">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        Tambah Catatan
                    </button>
                </div>

                {{-- Edit Gambar --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Edit / Tambah Gambar Paket Corporate</label>
                    <div id="edit_corp_gambar_preview_container" class="flex flex-wrap gap-3 mb-3"></div>
                    <input type="file" id="edit_corp_gambar" multiple accept="image/*, .heic" onchange="handleEditCorpGambarChange(event)"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm
                               file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold
                               file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 transition
                               focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent"/>
                    <p class="text-[10px] text-stone-400 mt-1">Kosongkan jika tidak ingin menambah gambar baru. Tekan dan geser gambar di atas untuk mengubah urutan (gambar pertama menjadi cover depan). Klik "x" untuk menghapus. Maksimal ukuran gambar 2MB/gambar.</p>
                </div>
            </div>

            <div class="flex gap-3 mt-6 justify-end">
                <button onclick="closeModalEditCorp()"
                    class="px-5 py-2.5 rounded-xl text-sm font-semibold text-stone-600 bg-stone-100 hover:bg-stone-200 transition">Batal</button>
                <button id="btnSubmitEditCorp" onclick="submitEditCorp()"
                    class="px-5 py-2.5 rounded-xl text-sm font-bold text-[#fdf6e3] bg-gradient-to-r from-[#2d4a2d] to-[#3d6b3d] hover:from-[#3d6b3d] hover:to-[#4a824a] shadow transition flex items-center justify-center gap-2">
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</div>
