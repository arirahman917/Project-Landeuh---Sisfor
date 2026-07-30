{{-- MODAL LIBURKAN PAKET CORPORATE --}}
<div id="modalLiburkanPaket"
    class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 backdrop-blur-sm hidden"
    onclick="if(event.target===this) closeLiburPaketModal()"
>
    <div class="relative w-full max-w-xl mx-4 bg-[#fdf6e3] rounded-3xl shadow-2xl border border-amber-200/60
                animate-[modalIn_0.25s_ease-out_forwards]" style="font-family:'Georgia',serif;">
        <div class="h-1 w-full rounded-t-3xl bg-red-500"></div>
        <div class="flex items-center justify-between px-8 pt-7 pb-0">
            <div>
                <h2 class="text-xl font-bold text-stone-800 tracking-tight">Liburkan Paket (Blokir Tanggal)</h2>
                <p class="text-xs text-stone-400 mt-0.5">Tentukan paket corporate dan tanggal yang ingin diliburkan</p>
            </div>
            <button onclick="closeLiburPaketModal()" class="p-2 rounded-xl text-stone-400 hover:bg-stone-200/60 hover:text-stone-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        {{-- Form Content --}}
        <div id="liburPaketFormWrap" class="px-8 pt-5 pb-3">
            <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Pilih Paket Corporate (Bisa Lebih Dari Satu)</label>
            <div id="liburPaketCheckboxes" class="grid grid-cols-1 gap-2 p-3 bg-white rounded-xl border border-stone-200 max-h-[150px] overflow-y-auto mb-4">
                <!-- Checkboxes rendered dynamically -->
            </div>

            <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Nama Periode Libur / Alasan</label>
            <input type="text" id="liburPaket_name" placeholder="Misal: Event Tertutup, Libur Seasonal"
                class="w-full px-4 py-2.5 mb-4 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm
                       focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>

            <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Pilih Tanggal Libur</label>
            <div class="mb-4">
                <input type="text" id="liburPaket_dates" class="hidden">
                <button type="button" id="btnOpenKalenderLiburPaket"
                    class="w-full px-5 py-3.5 rounded-2xl border-2 border-dashed border-red-300 bg-red-50/50 hover:bg-red-100/50 text-red-700 font-bold flex items-center justify-center gap-2 transition shadow-sm active:scale-[0.98]">
                    <iconify-icon icon="lucide:calendar-plus" class="text-xl"></iconify-icon>
                    Pilih Tanggal Blokir
                </button>
            </div>
        </div>

        {{-- Conflict Content (Shown only if conflict exists) --}}
        <div id="liburPaketConflictWrap" class="px-8 pt-5 pb-3 hidden">
            <div class="p-3 bg-red-50 text-red-700 rounded-xl border border-red-200 text-xs font-semibold mb-4 leading-relaxed">
                ⚠️ Ditemukan pesanan aktif pada paket & tanggal terpilih. Silakan reschedule/hubungi tamu terlebih dahulu.
            </div>
            <div id="liburPaketConflictList" class="space-y-3 max-h-[220px] overflow-y-auto p-1">
                <!-- Conflicts list -->
            </div>
        </div>

        {{-- Footer Actions --}}
        <div class="flex items-center justify-end gap-3 px-8 pb-7 pt-2">
            <button onclick="closeLiburPaketModal()"
                class="px-6 py-2.5 rounded-full text-sm font-semibold text-stone-600 bg-stone-100 hover:bg-stone-200 transition">Batal</button>
            
            <button id="btnSaveLiburPaket" onclick="submitLiburPaket()"
                class="px-8 py-2.5 rounded-full text-sm font-bold text-[#fdf6e3] bg-gradient-to-r from-red-500 to-red-600
                       hover:from-red-600 hover:to-red-700 shadow-lg shadow-red-900/20 transition-all active:scale-[0.98] flex items-center gap-2">
                <iconify-icon icon="lucide:check" class="text-base"></iconify-icon> Terapkan Libur
            </button>

            <button id="btnSaveAfterLiburPaketConflictsCleared" onclick="submitLiburPaket()" class="hidden px-8 py-2.5 rounded-full text-sm font-bold text-white bg-green-600 hover:bg-green-700 transition-all shadow-md active:scale-95">
                Konflik Bersih, Simpan Libur
            </button>
        </div>
    </div>
</div>
