{{-- ============================================================
     MODAL TAMBAH KAMAR
     Letakkan di: resources/views/admin/unit/_modal-tambah.blade.php
     Dipanggil dari: unit/index.blade.php via @include
     ============================================================ --}}

<div id="modalTambahKamar"
    class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 backdrop-blur-sm hidden"
    onclick="if(event.target===this) closeModalTambah()"
>
    <div class="relative w-full max-w-2xl mx-4 bg-[#fdf6e3] rounded-3xl shadow-2xl border border-amber-200/60 overflow-hidden
                animate-[modalIn_0.25s_ease-out_forwards]"
         style="font-family:'Georgia',serif;"
    >
        {{-- Accent bar --}}
        <div class="h-1 w-full bg-gradient-to-r from-amber-400 via-yellow-500 to-amber-600"></div>

        {{-- Header --}}
        <div class="flex items-center justify-between px-8 pt-7 pb-0">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    {{-- Awan ornament kecil --}}
                    <svg width="36" height="16" viewBox="0 0 36 16" fill="none" class="opacity-50">
                        <path d="M1 13 Q5 3 11 7 Q13 1 18 5 Q22 1 27 7 Q32 3 35 11" stroke="#d97706" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                    </svg>
                    <h2 class="text-xl font-bold text-stone-800 tracking-tight">Tambah Kamar</h2>
                    <svg width="36" height="16" viewBox="0 0 36 16" fill="none" class="opacity-50" style="transform:scaleX(-1)">
                        <path d="M1 13 Q5 3 11 7 Q13 1 18 5 Q22 1 27 7 Q32 3 35 11" stroke="#d97706" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                    </svg>
                </div>
                <p class="text-xs text-stone-400">Isi informasi unit akomodasi baru</p>
            </div>
            <button onclick="closeModalTambah()"
                class="p-2 rounded-xl text-stone-400 hover:bg-stone-200/60 hover:text-stone-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Body --}}
        <div class="px-8 pt-6 pb-7 max-h-[75vh] overflow-y-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">

                {{-- Nama Kamar --}}
                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Nama Kamar</label>
                    <input type="text" id="tambah_nama" placeholder="cth. Cabin 1"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm placeholder-stone-400
                               focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
                </div>

                {{-- Jenis Akomodasi --}}
                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Jenis Akomodasi</label>
                    <select id="tambah_jenis"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm
                               focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition appearance-none">
                        <option value="">Pilih jenis…</option>
                        <option value="Cabin">Cabin</option>
                        <option value="Rumah Industrial">Rumah Industrial</option>
                        <option value="Glamping">Glamping</option>
                    </select>
                </div>

                {{-- Jenis Kasur --}}
                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Jenis Kasur</label>
                    <input type="text" id="tambah_kasur" placeholder="cth. Queen Bed (140×200)"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm placeholder-stone-400
                               focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
                </div>

                {{-- Boleh Merokok --}}
                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Boleh Merokok di Kamar</label>
                    <select id="tambah_merokok"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm
                               focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition appearance-none">
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </select>
                </div>

                {{-- Fasilitas Kamar --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Fasilitas Kamar</label>
                    <input type="text" id="tambah_fasilitas"
                        placeholder="Pisahkan dengan koma: TV kabel, AC, Dapur, Balkon"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm placeholder-stone-400
                               focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
                    <p class="text-[10px] text-stone-400 mt-1">Pisahkan setiap fasilitas dengan tanda koma (,)</p>
                </div>

                {{-- Makanan & Minuman --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Makanan & Minuman</label>
                    <input type="text" id="tambah_makanan"
                        placeholder="Pisahkan dengan koma: Sarapan 4 pax, Air Minum Gratis"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm placeholder-stone-400
                               focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
                </div>

                {{-- Untuk Berapa Orang --}}
                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Untuk Berapa Orang (Maks)</label>
                    <input type="number" id="tambah_maxOrang" min="1" max="20" value="4"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm
                               focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
                </div>

                {{-- Slot --}}
                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Slot (Jumlah Unit)</label>
                    <input type="number" id="tambah_slot" min="1" max="100" value="1"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm
                               focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
                </div>

                {{-- Harga Weekday --}}
                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Harga Weekday (IDR)</label>
                    <input type="number" id="tambah_hargaWeekday" placeholder="1200000"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm placeholder-stone-400
                               focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
                </div>

                {{-- Harga Weekend --}}
                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Harga Weekend (IDR)</label>
                    <input type="number" id="tambah_hargaWeekend" placeholder="1400000"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm placeholder-stone-400
                               focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
                </div>

                {{-- Harga Highseason --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Harga Highseason (IDR)</label>
                    <input type="number" id="tambah_hargaHighseason" placeholder="1800000"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm placeholder-stone-400
                               focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
                </div>

                {{-- Upload Gambar --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Upload Gambar Akomodasi</label>
                    <div id="tambah_gambar_preview_container" class="flex flex-wrap gap-3 mb-3"></div>
                    <input type="file" id="tambah_gambar" multiple accept="image/*" onchange="handleTambahGambarChange(event)"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm
                               file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold
                               file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 transition
                               focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent"/>
                    <p class="text-[10px] text-stone-400 mt-1">Anda dapat memilih lebih dari 1 gambar (Format: JPG, PNG, dll).</p>
                </div>

            </div>{{-- /grid --}}
        </div>{{-- /body --}}

        {{-- Footer --}}
        <div class="flex items-center justify-end gap-3 px-8 pb-7 pt-2">
            <button onclick="closeModalTambah()"
                class="px-6 py-2.5 rounded-xl text-sm font-semibold text-stone-600 bg-stone-100 hover:bg-stone-200 transition">
                Batal
            </button>
            <button onclick="submitTambahKamar()"
                class="px-7 py-2.5 rounded-xl text-sm font-bold text-[#fdf6e3]
                       bg-gradient-to-r from-[#2d4a2d] to-[#3d6b3d]
                       hover:from-[#3d6b3d] hover:to-[#4a824a]
                       shadow-lg shadow-green-900/20 transition-all active:scale-[0.98] flex items-center gap-2">
                <iconify-icon icon="lucide:plus-circle" class="text-base"></iconify-icon>
                Tambah Kamar
            </button>
        </div>

        {{-- Bottom ornament --}}
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
    window.tambahKamarFiles = [];

    window.openModalTambah = function() {
        document.getElementById('modalTambahKamar').classList.remove('hidden');
        window.tambahKamarFiles = [];
        renderTambahImagePreviews();
    };
    window.closeModalTambah = function() {
        document.getElementById('modalTambahKamar').classList.add('hidden');
    };

    window.handleTambahGambarChange = function(event) {
        const files = Array.from(event.target.files);
        window.tambahKamarFiles = window.tambahKamarFiles.concat(files);
        event.target.value = ''; // Reset input so user can select same file again if they want
        renderTambahImagePreviews();
    };

    window.renderTambahImagePreviews = function() {
        const container = document.getElementById('tambah_gambar_preview_container');
        container.innerHTML = '';
        if(window.tambahKamarFiles.length === 0) {
            container.innerHTML = '<span class="text-xs text-stone-400">Belum ada gambar yang dipilih.</span>';
            return;
        }

        window.tambahKamarFiles.forEach((file, index) => {
            const div = document.createElement('div');
            div.className = 'relative group w-24 h-24 rounded-xl overflow-hidden border border-stone-200 bg-white shadow-sm flex-shrink-0';

            const reader = new FileReader();
            reader.onload = function(e) {
                const image = document.createElement('img');
                image.src = e.target.result;
                image.className = 'w-full h-full object-cover pointer-events-none';
                div.insertBefore(image, div.firstChild);
            };
            reader.readAsDataURL(file);
            
            const removeBtn = document.createElement('button');
            removeBtn.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';
            removeBtn.className = 'absolute top-1 right-1 w-6 h-6 bg-red-500/90 text-white rounded-full flex items-center justify-center font-bold opacity-0 group-hover:opacity-100 transition-opacity z-10 shadow';
            removeBtn.onclick = (e) => {
                e.preventDefault();
                window.tambahKamarFiles.splice(index, 1);
                renderTambahImagePreviews();
            };

            const badge = document.createElement('div');
            if (index === 0) {
                badge.innerHTML = 'Depan';
                badge.className = 'absolute bottom-0 left-0 right-0 bg-amber-500/90 text-white text-[9px] text-center font-bold py-0.5 z-10';
                div.appendChild(badge);
            }

            div.appendChild(removeBtn);
            container.appendChild(div);
        });
    };
    window.submitTambahKamar = function() {
        // ── Ambil nilai dari form ──────────────────────────────
        const nama        = document.getElementById('tambah_nama').value.trim();
        const jenis       = document.getElementById('tambah_jenis').value;
        const kasur       = document.getElementById('tambah_kasur').value.trim();
        const merokok     = document.getElementById('tambah_merokok').value === '1';
        const fasilitasRaw= document.getElementById('tambah_fasilitas').value;
        const makananRaw  = document.getElementById('tambah_makanan').value;
        const maxOrang    = parseInt(document.getElementById('tambah_maxOrang').value) || 4;
        const slot        = parseInt(document.getElementById('tambah_slot').value) || 1;
        const hwkd        = parseInt(document.getElementById('tambah_hargaWeekday').value) || 0;
        const hwknd       = parseInt(document.getElementById('tambah_hargaWeekend').value) || 0;
        const hhs         = parseInt(document.getElementById('tambah_hargaHighseason').value) || 0;

        if (!nama || !jenis) {
            alert('Nama Kamar dan Jenis Akomodasi wajib diisi.');
            return;
        }

        const formData = new FormData();
        formData.append('judul', nama);
        formData.append('jenis', jenis);
        formData.append('kasur', kasur);
        formData.append('merokok', merokok ? '1' : '0');
        formData.append('fasilitas', fasilitasRaw);
        formData.append('makanan', makananRaw);
        formData.append('max_orang', maxOrang);
        formData.append('slot', slot);
        formData.append('harga_weekday', hwkd);
        formData.append('harga_weekend', hwknd);
        formData.append('harga_highseason', hhs);

        window.tambahKamarFiles.forEach((file) => {
            formData.append('gambar[]', file);
        });

        const submitBtn = document.querySelector('#modalTambahKamar button[onclick="submitTambahKamar()"]');
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Menyimpan...';

        fetch('/admin/unit', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            } else {
                alert('Terjadi kesalahan saat menyimpan data.');
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<iconify-icon icon="lucide:plus-circle" class="text-base"></iconify-icon> Tambah Kamar';
            }
        })
        .catch(err => {
            console.error(err);
            alert('Terjadi kesalahan jaringan.');
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<iconify-icon icon="lucide:plus-circle" class="text-base"></iconify-icon> Tambah Kamar';
        });
    };
</script>