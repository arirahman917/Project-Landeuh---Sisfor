{{-- ============================================================
     MODAL EDIT INFO KAMAR
     Letakkan di: resources/views/admin/unit/_modal-edit.blade.php
     Dipanggil dari: unit/index.blade.php via @include
     ============================================================ --}}

<div id="modalEditKamar"
    class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 backdrop-blur-sm hidden"
    onclick="if(event.target===this) closeModalEdit()"
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
                    <svg width="36" height="16" viewBox="0 0 36 16" fill="none" class="opacity-50">
                        <path d="M1 13 Q5 3 11 7 Q13 1 18 5 Q22 1 27 7 Q32 3 35 11" stroke="#d97706" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                    </svg>
                    <h2 class="text-xl font-bold text-stone-800 tracking-tight">Edit Info Kamar</h2>
                    <svg width="36" height="16" viewBox="0 0 36 16" fill="none" class="opacity-50" style="transform:scaleX(-1)">
                        <path d="M1 13 Q5 3 11 7 Q13 1 18 5 Q22 1 27 7 Q32 3 35 11" stroke="#d97706" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                    </svg>
                </div>
                <p class="text-xs text-stone-400">Perbarui informasi unit akomodasi</p>
            </div>
            <button onclick="closeModalEdit()"
                class="p-2 rounded-xl text-stone-400 hover:bg-stone-200/60 hover:text-stone-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Hidden ID --}}
        <input type="hidden" id="edit_id">

        {{-- Body --}}
        <div class="px-8 pt-6 pb-7 max-h-[75vh] overflow-y-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">

                {{-- Nama Kamar --}}
                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Nama Kamar</label>
                    <input type="text" id="edit_nama" placeholder="cth. Cabin 1"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm placeholder-stone-400
                               focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
                </div>

                {{-- Jenis Akomodasi --}}
                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Jenis Akomodasi</label>
                    <select id="edit_jenis"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm
                               focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition appearance-none">
                        <option value="Cabin">Cabin</option>
                        <option value="Rumah Industrial">Rumah Industrial</option>
                        <option value="Glamping">Glamping</option>
                    </select>
                </div>

                {{-- Jenis Kasur --}}
                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Jenis Kasur</label>
                    <input type="text" id="edit_kasur" placeholder="cth. Queen Bed (140×200)"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm placeholder-stone-400
                               focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
                </div>

                {{-- Boleh Merokok --}}
                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Boleh Merokok di Kamar</label>
                    <select id="edit_merokok"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm
                               focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition appearance-none">
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </select>
                </div>

                {{-- Fasilitas Kamar --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Fasilitas Kamar</label>
                    <input type="text" id="edit_fasilitas"
                        placeholder="TV kabel, AC, Dapur, Balkon"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm placeholder-stone-400
                               focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
                    <p class="text-[10px] text-stone-400 mt-1">Pisahkan setiap fasilitas dengan tanda koma (,)</p>
                </div>

                {{-- Makanan & Minuman --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Makanan & Minuman</label>
                    <input type="text" id="edit_makanan"
                        placeholder="Sarapan 4 pax, Air Minum Gratis"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm placeholder-stone-400
                               focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
                </div>

                {{-- Untuk Berapa Orang --}}
                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Untuk Berapa Orang (Maks)</label>
                    <input type="number" id="edit_maxOrang" min="1" max="20"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm
                               focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
                </div>

                {{-- Slot --}}
                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Slot (Jumlah Unit)</label>
                    <input type="number" id="edit_slot" min="1" max="100"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm
                               focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
                </div>

                {{-- Harga Weekday --}}
                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Harga Weekday (IDR)</label>
                    <input type="number" id="edit_hargaWeekday"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm
                               focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
                </div>

                {{-- Harga Weekend --}}
                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Harga Weekend (IDR)</label>
                    <input type="number" id="edit_hargaWeekend"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm
                               focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
                </div>

                {{-- Harga Highseason --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Harga Highseason (IDR)</label>
                    <input type="number" id="edit_hargaHighseason"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm
                               focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
                </div>

                {{-- Edit Gambar --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Edit / Tambah Gambar Akomodasi</label>
                    <div id="edit_gambar_preview_container" class="flex flex-wrap gap-3 mb-3">
                        <!-- Preview images injected by JS -->
                    </div>
                    <input type="file" id="edit_gambar" multiple accept="image/*" onchange="handleEditGambarChange(event)"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm
                               file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold
                               file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 transition
                               focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent"/>
                    <p class="text-[10px] text-stone-400 mt-1">Kosongkan jika tidak ingin menambah gambar baru. Tekan dan geser gambar di atas untuk mengubah urutan (gambar pertama menjadi cover depan). Klik "x" untuk menghapus.</p>
                </div>

            </div>
        </div>

        {{-- Footer --}}
        <div class="flex items-center justify-end gap-3 px-8 pb-7 pt-2">
            <button onclick="closeModalEdit()"
                class="px-6 py-2.5 rounded-xl text-sm font-semibold text-stone-600 bg-stone-100 hover:bg-stone-200 transition">
                Batal
            </button>
            <button onclick="submitEditKamar()"
                class="px-7 py-2.5 rounded-xl text-sm font-bold text-[#fdf6e3]
                       bg-gradient-to-r from-amber-500 to-amber-600
                       hover:from-amber-600 hover:to-amber-700
                       shadow-lg shadow-amber-900/20 transition-all active:scale-[0.98] flex items-center gap-2">
                <iconify-icon icon="lucide:save" class="text-base"></iconify-icon>
                Simpan Perubahan
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

<script>
    window.openModalEdit = function(id) {
        const item = AKOMODASI_DATA.find(d => d.id === id);
        if (!item) return;

        document.getElementById('edit_id').value           = item.id;
        document.getElementById('edit_nama').value         = item.judul;
        document.getElementById('edit_jenis').value        = item.jenis;
        document.getElementById('edit_kasur').value        = item.kasur;
        document.getElementById('edit_merokok').value      = item.merokok ? '1' : '0';
        document.getElementById('edit_fasilitas').value    = item.fasilitas.join(', ');
        document.getElementById('edit_makanan').value      = item.makanan.join(', ');
        document.getElementById('edit_maxOrang').value     = item.maxOrang;
        document.getElementById('edit_slot').value         = item.slot;
        document.getElementById('edit_hargaWeekday').value = item.hargaWeekday;
        document.getElementById('edit_hargaWeekend').value = item.hargaWeekend;
        document.getElementById('edit_hargaHighseason').value = item.hargaHighseason;

        const existingImages = Array.isArray(item.gambar) ? item.gambar : (item.gambar ? [item.gambar] : []);
        window.currentEditImages = existingImages.map(url => ({
            type: 'existing',
            url: url.startsWith('http') || url.startsWith('data:') ? url : (url.startsWith('/') ? url : '/' + url)
        }));
            
        renderEditImagePreviews();

        document.getElementById('modalEditKamar').classList.remove('hidden');
    };

    window.handleEditGambarChange = function(event) {
        const files = Array.from(event.target.files);
        let loaded = 0;
        files.forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                window.currentEditImages.push({
                    type: 'new',
                    file: file,
                    url: e.target.result
                });
                loaded++;
                if (loaded === files.length) renderEditImagePreviews();
            };
            reader.readAsDataURL(file);
        });
        event.target.value = '';
    };

    window.renderEditImagePreviews = function() {
        const container = document.getElementById('edit_gambar_preview_container');
        container.innerHTML = '';
        if(!window.currentEditImages || window.currentEditImages.length === 0) {
            container.innerHTML = '<span class="text-xs text-stone-400">Belum ada gambar.</span>';
            return;
        }

        window.currentEditImages.forEach((imgObj, index) => {
            const div = document.createElement('div');
            div.className = 'relative group w-24 h-24 rounded-xl overflow-hidden border border-stone-200 cursor-move bg-white shadow-sm flex-shrink-0';
            div.draggable = true;
            div.dataset.index = index;
            
            div.addEventListener('dragstart', handleDragStart);
            div.addEventListener('dragover', handleDragOver);
            div.addEventListener('drop', handleDrop);
            div.addEventListener('dragenter', handleDragEnter);
            div.addEventListener('dragleave', handleDragLeave);

            const image = document.createElement('img');
            image.src = imgObj.url;
            image.className = 'w-full h-full object-cover pointer-events-none';
            
            const removeBtn = document.createElement('button');
            removeBtn.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';
            removeBtn.className = 'absolute top-1 right-1 w-6 h-6 bg-red-500/90 text-white rounded-full flex items-center justify-center font-bold opacity-0 group-hover:opacity-100 transition-opacity z-10 shadow';
            removeBtn.onclick = (e) => {
                e.preventDefault();
                window.currentEditImages.splice(index, 1);
                renderEditImagePreviews();
            };

            const badge = document.createElement('div');
            if (index === 0) {
                badge.innerHTML = 'Depan';
                badge.className = 'absolute bottom-0 left-0 right-0 bg-amber-500/90 text-white text-[9px] text-center font-bold py-0.5 z-10';
                div.appendChild(badge);
            } else if (index === Math.floor(window.currentEditImages.length / 2)) {
                badge.innerHTML = 'Tengah';
                badge.className = 'absolute bottom-0 left-0 right-0 bg-stone-500/80 text-white text-[9px] text-center font-bold py-0.5 z-10';
                div.appendChild(badge);
            } else if (index === window.currentEditImages.length - 1) {
                badge.innerHTML = 'Belakang';
                badge.className = 'absolute bottom-0 left-0 right-0 bg-stone-500/80 text-white text-[9px] text-center font-bold py-0.5 z-10';
                div.appendChild(badge);
            }

            div.appendChild(image);
            div.appendChild(removeBtn);
            container.appendChild(div);
        });
    }

    let draggedItemIndex = null;
    function handleDragStart(e) {
        draggedItemIndex = parseInt(this.dataset.index);
        e.dataTransfer.effectAllowed = 'move';
        this.classList.add('opacity-40');
    }
    function handleDragOver(e) {
        e.preventDefault();
        e.dataTransfer.dropEffect = 'move';
        return false;
    }
    function handleDragEnter(e) {
        this.classList.add('border-amber-500', 'border-2', 'scale-105');
    }
    function handleDragLeave(e) {
        this.classList.remove('border-amber-500', 'border-2', 'scale-105');
    }
    function handleDrop(e) {
        e.stopPropagation();
        this.classList.remove('border-amber-500', 'border-2', 'scale-105');
        const targetIndex = parseInt(this.dataset.index);
        
        if (draggedItemIndex !== null && draggedItemIndex !== targetIndex) {
            const item = window.currentEditImages.splice(draggedItemIndex, 1)[0];
            window.currentEditImages.splice(targetIndex, 0, item);
            renderEditImagePreviews();
        }
        return false;
    }

    document.addEventListener('dragend', (e) => {
        document.querySelectorAll('#edit_gambar_preview_container > div').forEach(div => {
            div.classList.remove('opacity-40', 'border-amber-500', 'border-2', 'scale-105');
        });
    });

    window.closeModalEdit = function() {
        document.getElementById('modalEditKamar').classList.add('hidden');
    };

    window.submitEditKamar = function() {
        const id       = parseInt(document.getElementById('edit_id').value);
        const idx      = AKOMODASI_DATA.findIndex(d => d.id === id);
        if (idx === -1) return;

        const formData = new FormData();
        formData.append('_method', 'PUT'); // Laravel method spoofing
        formData.append('judul', document.getElementById('edit_nama').value.trim());
        formData.append('jenis', document.getElementById('edit_jenis').value);
        formData.append('kasur', document.getElementById('edit_kasur').value.trim());
        formData.append('merokok', document.getElementById('edit_merokok').value === '1' ? '1' : '0');
        formData.append('fasilitas', document.getElementById('edit_fasilitas').value);
        formData.append('makanan', document.getElementById('edit_makanan').value);
        formData.append('max_orang', document.getElementById('edit_maxOrang').value);
        formData.append('slot', document.getElementById('edit_slot').value);
        formData.append('harga_weekday', document.getElementById('edit_hargaWeekday').value);
        formData.append('harga_weekend', document.getElementById('edit_hargaWeekend').value);
        formData.append('harga_highseason', document.getElementById('edit_hargaHighseason').value);

        window.currentEditImages.forEach(imgObj => {
            if (imgObj.type === 'existing') {
                formData.append('existing_gambar[]', imgObj.url);
            } else if (imgObj.type === 'new') {
                formData.append('gambar[]', imgObj.file);
            }
        });

        const submitBtn = document.querySelector('#modalEditKamar button[onclick="submitEditKamar()"]');
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Menyimpan...';

        fetch(`/admin/unit/${id}`, {
            method: 'POST', // POST for FormData, but _method is PUT
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
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
                submitBtn.innerHTML = '<iconify-icon icon="lucide:save" class="text-base"></iconify-icon> Simpan Perubahan';
            }
        })
        .catch(err => {
            console.error(err);
            alert('Terjadi kesalahan jaringan.');
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<iconify-icon icon="lucide:save" class="text-base"></iconify-icon> Simpan Perubahan';
        });
    };
</script>