{{-- ============================================================
     MODAL TAMBAH PAKET CORPORATE
     ============================================================ --}}
<div id="modalTambahCorporate"
    class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 backdrop-blur-sm hidden"
>
    <div class="relative w-full max-w-2xl mx-4 bg-[#fdf6e3] rounded-3xl shadow-2xl border border-amber-200/60 overflow-hidden"
         style="font-family:'Georgia',serif;"
    >
        <div class="h-1 w-full bg-gradient-to-r from-amber-400 via-yellow-500 to-amber-600"></div>
        <div class="flex items-center justify-between px-8 pt-7 pb-0">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <svg width="36" height="16" viewBox="0 0 36 16" fill="none" class="opacity-50"><path d="M1 13 Q5 3 11 7 Q13 1 18 5 Q22 1 27 7 Q32 3 35 11" stroke="#d97706" stroke-width="1.5" fill="none" stroke-linecap="round"/></svg>
                    <h2 class="text-xl font-bold text-stone-800 tracking-tight">Tambah Paket Corporate</h2>
                    <svg width="36" height="16" viewBox="0 0 36 16" fill="none" class="opacity-50" style="transform:scaleX(-1)"><path d="M1 13 Q5 3 11 7 Q13 1 18 5 Q22 1 27 7 Q32 3 35 11" stroke="#d97706" stroke-width="1.5" fill="none" stroke-linecap="round"/></svg>
                </div>
                <p class="text-xs text-stone-400">Isi informasi paket corporate baru</p>
            </div>
            <button onclick="closeModalTambahCorp()"
                class="p-2 rounded-xl text-stone-400 hover:bg-stone-200/60 hover:text-stone-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div class="px-8 pt-6 pb-7 max-h-[75vh] overflow-y-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                {{-- Judul --}}
                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Judul Paket</label>
                    <input type="text" id="tambah_corp_judul" placeholder="cth. Paket Corporate Glamping"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
                </div>

                {{-- Jenis --}}
                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Jenis Paket</label>
                    <select id="tambah_corp_jenis" onchange="onTambahJenisChange(this.value)"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition appearance-none">
                        <option value="">Pilih jenis…</option>
                        <option value="Corporate Glamping">Corporate Glamping</option>
                        <option value="Corporate Cabin">Corporate Cabin</option>
                    </select>
                </div>

                {{-- Jenis Akomodasi (hidden, auto-filled) --}}
                <input type="hidden" id="tambah_corp_jenis_akomodasi">

                {{-- Unit Terkait (multi-select checkbox) --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Unit Akomodasi Terkait</label>
                    <div id="tambah_corp_accommodation_list"
                        class="grid grid-cols-2 gap-2 p-3 rounded-xl border border-stone-200 bg-white/80 max-h-40 overflow-y-auto text-sm">
                        <p class="text-stone-400 text-xs col-span-2">Pilih jenis paket terlebih dahulu…</p>
                    </div>
                    <p class="text-[10px] text-stone-400 mt-1">Total unit terkait akan dihitung dari jumlah slot unit yang dipilih</p>
                </div>

                {{-- Max Orang --}}
                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Maks. Peserta (pax)</label>
                    <input type="number" id="tambah_corp_max_orang" min="1" value="150"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
                </div>

                {{-- Harga Weekday --}}
                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Harga/Pax Weekday (Rp)</label>
                    <input type="number" id="tambah_corp_harga_weekday" min="0" placeholder="400000"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
                </div>

                {{-- Harga Weekend --}}
                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Harga/Pax Weekend (Rp)</label>
                    <input type="number" id="tambah_corp_harga_weekend" min="0" placeholder="400000"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
                </div>

                {{-- Harga Highseason --}}
                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Harga/Pax Highseason (Rp)</label>
                    <input type="number" id="tambah_corp_harga_highseason" min="0" placeholder="400000"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
                </div>

                {{-- Fasilitas --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Fasilitas</label>
                    <div id="tambah_corp_fasilitas_list" class="flex flex-col gap-2"></div>
                    <button type="button" onclick="addFasilitasRow('tambah')"
                        class="mt-2 text-xs font-semibold text-amber-600 hover:text-amber-800 flex items-center gap-1 transition">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        Tambah Fasilitas
                    </button>
                </div>

                {{-- Makanan --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Makanan & Minuman</label>
                    <div id="tambah_corp_makanan_list" class="flex flex-col gap-2"></div>
                    <button type="button" onclick="addMakananRow('tambah')"
                        class="mt-2 text-xs font-semibold text-amber-600 hover:text-amber-800 flex items-center gap-1 transition">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        Tambah Item
                    </button>
                </div>

                {{-- Catatan --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Catatan</label>
                    <div id="tambah_corp_catatan_list" class="flex flex-col gap-2"></div>
                    <button type="button" onclick="addCatatanRow('tambah')"
                        class="mt-2 text-xs font-semibold text-amber-600 hover:text-amber-800 flex items-center gap-1 transition">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        Tambah Catatan
                    </button>
                </div>

                {{-- Upload Gambar --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Upload Gambar Paket Corporate</label>
                    <div id="tambah_corp_gambar_preview_container" class="flex flex-wrap gap-3 mb-3"></div>
                    <input type="file" id="tambah_corp_gambar" multiple accept="image/*, .heic" onchange="handleTambahCorpGambarChange(event)"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm
                               file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold
                               file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 transition
                               focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent"/>
                    <p class="text-[10px] text-stone-400 mt-1">Anda dapat memilih lebih dari 1 gambar (Format: JPG, PNG, JPEG, Webp, HEIC). Maksimal ukuran gambar 2MB/gambar.</p>
                </div>
            </div>

            {{-- Footer --}}
            <div class="flex gap-3 mt-6 justify-end">
                <button onclick="closeModalTambahCorp()"
                    class="px-5 py-2.5 rounded-xl text-sm font-semibold text-stone-600 bg-stone-100 hover:bg-stone-200 transition">Batal</button>
                <button id="btnSubmitTambahCorp" onclick="submitTambahCorp()"
                    class="px-5 py-2.5 rounded-xl text-sm font-bold text-[#fdf6e3] bg-gradient-to-r from-[#2d4a2d] to-[#3d6b3d] hover:from-[#3d6b3d] hover:to-[#4a824a] shadow transition flex items-center justify-center gap-2">
                    Simpan Paket
                </button>
            </div>
        </div>
    </div>
</div>
