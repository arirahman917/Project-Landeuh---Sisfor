@extends('layouts.admin')
@section('content')

@include('admin.corporate._modal-tambah')
@include('admin.corporate._modal-edit')
@include('admin.corporate._modal-delete')

{{-- ── STAT CARDS ──────────────────────────────────────────────── --}}
<div class="grid grid-cols-2 gap-4 mb-6">
    <div class="bg-[#fdf6e3]/80 backdrop-blur-sm rounded-2xl border border-amber-200/60 shadow-sm p-5 flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-[#3a523a]/10 flex items-center justify-center shrink-0">
            <iconify-icon icon="lucide:briefcase" class="text-2xl text-[#3a523a]"></iconify-icon>
        </div>
        <div>
            <p class="text-xs font-semibold text-stone-500 tracking-wider uppercase">Jumlah Paket</p>
            <p class="text-3xl font-extrabold text-stone-800 leading-tight">{{ $packages->count() }}</p>
        </div>
    </div>
    <div class="bg-[#fdf6e3]/80 backdrop-blur-sm rounded-2xl border border-amber-200/60 shadow-sm p-5 flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-amber-400/15 flex items-center justify-center shrink-0">
            <iconify-icon icon="lucide:layout-grid" class="text-2xl text-amber-600"></iconify-icon>
        </div>
        <div>
            <p class="text-xs font-semibold text-stone-500 tracking-wider uppercase">Total Unit Terkait</p>
            <p class="text-3xl font-extrabold text-stone-800 leading-tight">{{ $packages->sum('slot') }}</p>
        </div>
    </div>
</div>

{{-- ── TOOLBAR ─────────────────────────────────────────────────── --}}
<div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mb-5">
    <div class="relative flex-1 max-w-xs">
        <span class="absolute inset-y-0 left-3.5 flex items-center text-stone-400 pointer-events-none">
            <iconify-icon icon="lucide:search" class="text-base"></iconify-icon>
        </span>
        <input type="text" id="corpSearchInput" placeholder="Cari paket…"
            class="w-full pl-9 pr-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm
                   placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
    </div>
    <div class="flex-1 hidden sm:block"></div>
    <button onclick="openModalTambahCorp()"
        class="flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-sm text-[#fdf6e3]
               bg-gradient-to-r from-[#2d4a2d] to-[#3d6b3d]
               hover:from-[#3d6b3d] hover:to-[#4a824a]
               shadow-lg shadow-green-900/20 transition-all active:scale-[0.98] whitespace-nowrap">
        <iconify-icon icon="lucide:plus" class="text-base"></iconify-icon>
        Tambah Paket
    </button>
</div>

{{-- ── PACKAGE LIST ─────────────────────────────────────────────── --}}
<div id="corpList" class="flex flex-col gap-5 relative z-10"></div>

{{-- ── TOAST ───────────────────────────────────────────────────── --}}
<div id="corpToast"
    class="fixed bottom-6 right-6 z-[200] flex items-center gap-3 px-5 py-3.5 rounded-2xl shadow-xl
           bg-[#1e2d1e] text-white text-sm font-medium opacity-0 pointer-events-none transition-all duration-300"
>
    <iconify-icon icon="lucide:check-circle" class="text-green-400 text-lg shrink-0" id="corpToastIcon"></iconify-icon>
    <span id="corpToastMsg">Berhasil!</span>
</div>

<style>
.corp-admin-card {
    background: rgba(253,246,227,0.65);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.45);
    border-radius: 1rem;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    transition: transform 0.2s, box-shadow 0.2s;
}
.corp-admin-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(0,0,0,0.1);
}
.corp-img-thumb {
    width: 120px; min-width: 120px; height: 80px;
    border-radius: 0.6rem; overflow: hidden; flex-shrink: 0;
}
.corp-img-thumb img {
    width: 100%; height: 100%; object-fit: cover;
}
.dynamic-row-input {
    flex: 1; padding: 0.45rem 0.75rem;
    border: 1px solid #e7e5e4; border-radius: 0.6rem;
    background: rgba(255,255,255,0.85); font-size: 0.82rem;
    color: #1c1917; outline: none;
    transition: border-color 0.2s;
}
.dynamic-row-input:focus { border-color: #fbbf24; }
.dynamic-row-del {
    padding: 0.4rem; border-radius: 0.5rem;
    background: #fef2f2; border: none; cursor: pointer;
    color: #dc2626; transition: background 0.2s;
}
.dynamic-row-del:hover { background: #fee2e2; }
</style>

@push('scripts')
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script>
const CORP_DATA   = @json($packages);
const ACCOM_DATA  = @json($accommodations);
const CSRF_TOKEN  = '{{ csrf_token() }}';

/* ── Jenis → Jenis Akomodasi mapping ──────────────────── */
const JENIS_MAP = {
    'Corporate Glamping': 'Glamping',
    'Corporate Cabin':    'Cabin',
};

/* ── Toast ────────────────────────────────────────────── */
function showCorpToast(msg, ok = true) {
    const t   = document.getElementById('corpToast');
    const m   = document.getElementById('corpToastMsg');
    const ico = document.getElementById('corpToastIcon');
    m.textContent = msg;
    ico.setAttribute('icon', ok ? 'lucide:check-circle' : 'lucide:alert-circle');
    ico.className = (ok ? 'text-green-400' : 'text-red-400') + ' text-lg shrink-0';
    t.style.opacity = '1';
    setTimeout(() => { t.style.opacity = '0'; }, 3000);
}

/* ── Format Rupiah ────────────────────────────────────── */
function fmtRp(n) { return 'Rp ' + Number(n).toLocaleString('id-ID'); }

/* ── Render List ─────────────────────────────────────── */
function renderCorpList(data) {
    const el = document.getElementById('corpList');
    if (!data.length) {
        el.innerHTML = `<div class="text-center py-16 text-stone-400">
            <iconify-icon icon="lucide:briefcase" class="text-4xl mb-3 block opacity-40"></iconify-icon>
            <p class="text-sm font-semibold">Belum ada paket corporate.</p>
        </div>`;
        return;
    }
    el.innerHTML = data.map(pkg => {
        const imgs = Array.isArray(pkg.gambar) ? pkg.gambar : [];
        const thumb = imgs[0] || 'https://placehold.co/200x120/3a523a/fff?text=No+Image';
        const fas   = Array.isArray(pkg.fasilitas) ? pkg.fasilitas : [];
        const accIds= Array.isArray(pkg.accommodation_ids) ? pkg.accommodation_ids : [];
        const accNames = ACCOM_DATA
            .filter(a => accIds.includes(a.id))
            .map(a => a.judul).join(', ') || '—';

        return `
        <div class="corp-admin-card flex flex-col md:flex-row gap-4 p-4">
            <div class="corp-img-thumb">
                <img src="${thumb}" alt="${pkg.judul}" onerror="this.src='https://placehold.co/200x120/3a523a/fff?text=No+Image'">
            </div>
            <div class="flex-1 flex flex-col justify-between gap-2 min-w-0">
                <div>
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <h3 class="text-base font-bold text-stone-800 leading-tight">${pkg.judul}</h3>
                            <div class="flex items-center gap-2 mt-1 flex-wrap">
                                <span class="text-[11px] font-semibold px-2 py-0.5 rounded-full bg-[#3a523a]/10 text-[#3a523a]">${pkg.jenis}</span>
                                <span class="text-[11px] font-semibold px-2 py-0.5 rounded-full bg-amber-100 text-amber-700">
                                    ${pkg.slot} unit terkait
                                </span>
                                <span class="text-[11px] text-stone-500">Maks. ${pkg.max_orang} pax</span>
                            </div>
                        </div>
                        <div class="flex gap-2 shrink-0">
                            <button onclick="openModalEditCorp(${pkg.id})"
                                class="flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-bold text-blue-700 bg-blue-50 hover:bg-blue-100 border border-blue-200 transition">
                                <iconify-icon icon="lucide:pencil" class="text-sm"></iconify-icon> Edit
                            </button>
                            <button onclick="openModalDeleteCorp(${pkg.id}, '${pkg.judul.replace(/'/g,"\\'")}' )"
                                class="flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-bold text-red-600 bg-red-50 hover:bg-red-100 border border-red-200 transition">
                                <iconify-icon icon="lucide:trash-2" class="text-sm"></iconify-icon> Hapus
                            </button>
                        </div>
                    </div>
                    <div class="mt-2 text-xs text-stone-500">
                        <span class="font-semibold text-stone-600">Unit:</span> ${accNames}
                    </div>
                    ${fas.length ? `<div class="mt-1.5 flex flex-wrap gap-1">${fas.slice(0,4).map(f=>`<span class="text-[10px] px-2 py-0.5 rounded-full bg-stone-100 text-stone-600 border border-stone-200">${f}</span>`).join('')}${fas.length>4?`<span class="text-[10px] text-stone-400">+${fas.length-4} lainnya</span>`:''}</div>` : ''}
                </div>
                <div class="flex flex-wrap gap-3 pt-2 border-t border-stone-200/60 text-xs font-semibold text-stone-600">
                    <span>Weekday: <span class="text-[#3a523a] font-bold">${fmtRp(pkg.harga_weekday)}/pax</span></span>
                    <span>Weekend: <span class="text-amber-700 font-bold">${fmtRp(pkg.harga_weekend)}/pax</span></span>
                    <span>Highseason: <span class="text-red-700 font-bold">${fmtRp(pkg.harga_highseason)}/pax</span></span>
                </div>
            </div>
        </div>`;
    }).join('');
}

/* ── Search ──────────────────────────────────────────── */
let allCorpData = [...CORP_DATA];
document.getElementById('corpSearchInput').addEventListener('input', function() {
    const q = this.value.toLowerCase().trim();
    const filtered = q ? allCorpData.filter(p =>
        p.judul.toLowerCase().includes(q) || p.jenis.toLowerCase().includes(q)
    ) : allCorpData;
    renderCorpList(filtered);
});

/* ── Dynamic Rows ─────────────────────────────────────── */
function createDynRow(prefix, listId, value = '') {
    const div = document.createElement('div');
    div.className = 'flex gap-2 items-center';
    div.innerHTML = `
        <input type="text" class="dynamic-row-input" value="${value}" placeholder="Tambah item…">
        <button type="button" class="dynamic-row-del" onclick="this.closest('div').remove()">
            <iconify-icon icon="lucide:x" style="font-size:.85rem"></iconify-icon>
        </button>`;
    document.getElementById(listId).appendChild(div);
}
window.addFasilitasRow = (prefix) => createDynRow(prefix, `${prefix}_corp_fasilitas_list`);
window.addMakananRow  = (prefix) => createDynRow(prefix, `${prefix}_corp_makanan_list`);
window.addCatatanRow  = (prefix) => createDynRow(prefix, `${prefix}_corp_catatan_list`);
window.addGambarRow   = (prefix) => createDynRow(prefix, `${prefix}_corp_gambar_list`);

function getListValues(listId) {
    return [...document.querySelectorAll(`#${listId} .dynamic-row-input`)]
        .map(i => i.value.trim()).filter(v => v);
}
function populateList(listId, values) {
    const el = document.getElementById(listId);
    el.innerHTML = '';
    (values || []).forEach(v => createDynRow('', listId, v));
}

/* ── Accommodation Checkboxes ─────────────────────────── */
function renderAccomCheckboxes(containerId, selectedIds, jenisAkomodasi) {
    const el = document.getElementById(containerId);
    if (!jenisAkomodasi) {
        el.innerHTML = '<p class="text-stone-400 text-xs col-span-2">Pilih jenis paket terlebih dahulu…</p>';
        return;
    }
    const filtered = ACCOM_DATA.filter(a => a.jenis === jenisAkomodasi);
    if (!filtered.length) {
        el.innerHTML = `<p class="text-stone-400 text-xs col-span-2">Tidak ada unit ${jenisAkomodasi} ditemukan.</p>`;
        return;
    }
    // Normalize selectedIds to integers to handle JSON string vs number mismatch
    const selectedInts = (selectedIds || []).map(id => parseInt(id));
    el.innerHTML = filtered.map(a => `
        <label class="flex items-center gap-2 cursor-pointer text-stone-700 hover:text-[#3a523a] text-xs font-medium">
            <input type="checkbox" value="${a.id}" ${selectedInts.includes(parseInt(a.id)) ? 'checked' : ''}
                class="rounded accent-[#3a523a] w-3.5 h-3.5 cursor-pointer">
            <span>${a.judul}</span>
        </label>`).join('');
}

function getSelectedAccomIds(containerId) {
    return [...document.querySelectorAll(`#${containerId} input[type=checkbox]:checked`)]
        .map(cb => parseInt(cb.value));
}

/* ── Jenis Change → Update Jenis Akomodasi & Checkbox List ── */
window.onTambahJenisChange = function(val) {
    const ja = JENIS_MAP[val] || '';
    document.getElementById('tambah_corp_jenis_akomodasi').value = ja;
    renderAccomCheckboxes('tambah_corp_accommodation_list', [], ja);
};
window.onEditJenisChange = function(val) {
    const ja = JENIS_MAP[val] || '';
    document.getElementById('edit_corp_jenis_akomodasi').value = ja;
    const currentIds = getSelectedAccomIds('edit_corp_accommodation_list');
    renderAccomCheckboxes('edit_corp_accommodation_list', currentIds, ja);
};

/* ── Corporate Image Upload Helpers ──────────────────── */
window.tambahCorpFiles = [];
window.currentEditCorpImages = [];

function formatImgUrl(url) {
    if (!url) return '/images/placeholder.jpg';
    if (url.startsWith('http://') || url.startsWith('https://') || url.startsWith('/')) {
        return url;
    }
    return '/' + url;
}

window.handleTambahCorpGambarChange = function(event) {
    const files = Array.from(event.target.files);
    const validFiles = [];
    
    files.forEach(file => {
        if (file.size > 2 * 1024 * 1024) {
            alert(`Gambar "${file.name}" gagal diupload karena ukurannya melebihi 2MB.`);
        } else {
            validFiles.push(file);
        }
    });

    validFiles.sort((a, b) => a.name.localeCompare(b.name));
    window.tambahCorpFiles = window.tambahCorpFiles.concat(validFiles);
    event.target.value = '';
    renderTambahCorpImagePreviews();
};

window.renderTambahCorpImagePreviews = function() {
    const container = document.getElementById('tambah_corp_gambar_preview_container');
    if (!container) return;
    container.innerHTML = '';
    if (window.tambahCorpFiles.length === 0) {
        container.innerHTML = '<span class="text-xs text-stone-400">Belum ada gambar yang dipilih.</span>';
        return;
    }

    window.tambahCorpFiles.forEach((file, index) => {
        const div = document.createElement('div');
        div.className = 'relative group w-24 h-24 rounded-xl overflow-hidden border border-stone-200 bg-white shadow-sm flex-shrink-0';

        const image = document.createElement('img');
        image.src = URL.createObjectURL(file);
        image.className = 'w-full h-full object-cover pointer-events-none';
        div.appendChild(image);
        
        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';
        removeBtn.className = 'absolute top-1 right-1 w-6 h-6 bg-red-500/90 text-white rounded-full flex items-center justify-center font-bold opacity-0 group-hover:opacity-100 transition-opacity z-10 shadow';
        removeBtn.onclick = (e) => {
            e.preventDefault();
            window.tambahCorpFiles.splice(index, 1);
            renderTambahCorpImagePreviews();
        };

        if (index === 0) {
            const badge = document.createElement('div');
            badge.innerHTML = 'Depan';
            badge.className = 'absolute bottom-0 left-0 right-0 bg-amber-500/90 text-white text-[9px] text-center font-bold py-0.5 z-10';
            div.appendChild(badge);
        }

        div.appendChild(removeBtn);
        container.appendChild(div);
    });
};

window.handleEditCorpGambarChange = function(event) {
    const files = Array.from(event.target.files);
    const validFiles = [];
    
    files.forEach(file => {
        if (file.size > 2 * 1024 * 1024) {
            alert(`Gambar "${file.name}" gagal diupload karena ukurannya melebihi 2MB.`);
        } else {
            validFiles.push(file);
        }
    });

    validFiles.sort((a, b) => a.name.localeCompare(b.name));
    
    const results = validFiles.map(file => ({
        type: 'new',
        file: file,
        url: URL.createObjectURL(file)
    }));

    window.currentEditCorpImages = window.currentEditCorpImages.concat(results);
    renderEditCorpImagePreviews();
    event.target.value = '';
};

window.renderEditCorpImagePreviews = function() {
    const container = document.getElementById('edit_corp_gambar_preview_container');
    if (!container) return;
    container.innerHTML = '';
    if (!window.currentEditCorpImages || window.currentEditCorpImages.length === 0) {
        container.innerHTML = '<span class="text-xs text-stone-400">Belum ada gambar.</span>';
        return;
    }

    window.currentEditCorpImages.forEach((imgObj, index) => {
        const div = document.createElement('div');
        div.className = 'relative group w-24 h-24 rounded-xl overflow-hidden border border-stone-200 bg-white shadow-sm flex-shrink-0';

        const image = document.createElement('img');
        image.src = imgObj.url;
        image.className = 'w-full h-full object-cover pointer-events-none';
        div.appendChild(image);
        
        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';
        removeBtn.className = 'absolute top-1 right-1 w-6 h-6 bg-red-500/90 text-white rounded-full flex items-center justify-center font-bold opacity-0 group-hover:opacity-100 transition-opacity z-10 shadow';
        removeBtn.onclick = (e) => {
            e.preventDefault();
            window.currentEditCorpImages.splice(index, 1);
            renderEditCorpImagePreviews();
        };

        if (index === 0) {
            const badge = document.createElement('div');
            badge.innerHTML = 'Depan';
            badge.className = 'absolute bottom-0 left-0 right-0 bg-amber-500/90 text-white text-[9px] text-center font-bold py-0.5 z-10';
            div.appendChild(badge);
        }

        div.appendChild(removeBtn);
        container.appendChild(div);
    });
};

/* ── Modal Tambah ─────────────────────────────────────── */
window.openModalTambahCorp = function() {
    document.getElementById('tambah_corp_judul').value = '';
    document.getElementById('tambah_corp_jenis').value = '';
    document.getElementById('tambah_corp_jenis_akomodasi').value = '';
    document.getElementById('tambah_corp_max_orang').value = 150;
    document.getElementById('tambah_corp_harga_weekday').value = '';
    document.getElementById('tambah_corp_harga_weekend').value = '';
    document.getElementById('tambah_corp_harga_highseason').value = '';
    ['fasilitas','makanan','catatan'].forEach(k => document.getElementById(`tambah_corp_${k}_list`).innerHTML = '');
    window.tambahCorpFiles = [];
    renderTambahCorpImagePreviews();
    renderAccomCheckboxes('tambah_corp_accommodation_list', [], '');
    document.getElementById('modalTambahCorporate').classList.remove('hidden');
};
window.closeModalTambahCorp = function() {
    document.getElementById('modalTambahCorporate').classList.add('hidden');
};

window.submitTambahCorp = async function() {
    const judul = document.getElementById('tambah_corp_judul').value.trim();
    const jenis = document.getElementById('tambah_corp_jenis').value;
    const ja    = document.getElementById('tambah_corp_jenis_akomodasi').value;
    const accomIds = getSelectedAccomIds('tambah_corp_accommodation_list');

    if (!judul || !jenis || !ja) {
        showCorpToast('Judul dan jenis wajib diisi.', false); return;
    }
    if (!accomIds.length) {
        showCorpToast('Pilih minimal 1 unit akomodasi.', false); return;
    }

    const formData = new FormData();
    formData.append('judul', judul);
    formData.append('jenis', jenis);
    formData.append('jenis_akomodasi', ja);
    formData.append('max_orang', parseInt(document.getElementById('tambah_corp_max_orang').value) || 150);
    formData.append('harga_weekday', parseFloat(document.getElementById('tambah_corp_harga_weekday').value) || 0);
    formData.append('harga_weekend', parseFloat(document.getElementById('tambah_corp_harga_weekend').value) || 0);
    formData.append('harga_highseason', parseFloat(document.getElementById('tambah_corp_harga_highseason').value) || 0);

    accomIds.forEach(id => formData.append('accommodation_ids[]', id));
    getListValues('tambah_corp_fasilitas_list').forEach(val => formData.append('fasilitas[]', val));
    getListValues('tambah_corp_makanan_list').forEach(val => formData.append('makanan[]', val));
    getListValues('tambah_corp_catatan_list').forEach(val => formData.append('catatan[]', val));

    window.tambahCorpFiles.forEach(file => {
        formData.append('gambar[]', file);
    });

    try {
        const res = await fetch('/admin/corporate', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': CSRF_TOKEN },
            body: formData,
        });
        const json = await res.json();
        if (json.success) {
            closeModalTambahCorp();
            showCorpToast(json.message);
            setTimeout(() => location.reload(), 1200);
        } else {
            showCorpToast(json.message || 'Terjadi kesalahan.', false);
        }
    } catch(e) { showCorpToast('Gagal terhubung ke server.', false); }
};

/* ── Modal Edit ───────────────────────────────────────── */
window.openModalEditCorp = function(id) {
    const pkg = CORP_DATA.find(p => p.id === id);
    if (!pkg) return;
    const ja = pkg.jenis_akomodasi || JENIS_MAP[pkg.jenis] || '';
    document.getElementById('edit_corp_id').value = pkg.id;
    document.getElementById('edit_corp_judul').value = pkg.judul;
    document.getElementById('edit_corp_jenis').value = pkg.jenis;
    document.getElementById('edit_corp_jenis_akomodasi').value = ja;
    document.getElementById('edit_corp_max_orang').value = pkg.max_orang;
    document.getElementById('edit_corp_harga_weekday').value = pkg.harga_weekday;
    document.getElementById('edit_corp_harga_weekend').value = pkg.harga_weekend;
    document.getElementById('edit_corp_harga_highseason').value = pkg.harga_highseason;
    const accIds = Array.isArray(pkg.accommodation_ids) ? pkg.accommodation_ids : [];
    renderAccomCheckboxes('edit_corp_accommodation_list', accIds, ja);
    populateList('edit_corp_fasilitas_list',  pkg.fasilitas);
    populateList('edit_corp_makanan_list',     pkg.makanan);
    populateList('edit_corp_catatan_list',     pkg.catatan);

    const existingImages = Array.isArray(pkg.gambar) ? pkg.gambar : (pkg.gambar ? [pkg.gambar] : []);
    window.currentEditCorpImages = existingImages.map(url => ({
        type: 'existing',
        url: formatImgUrl(url)
    }));
    renderEditCorpImagePreviews();

    document.getElementById('modalEditCorporate').classList.remove('hidden');
};
window.closeModalEditCorp = function() {
    document.getElementById('modalEditCorporate').classList.add('hidden');
};

window.submitEditCorp = async function() {
    const id = document.getElementById('edit_corp_id').value;
    const judul = document.getElementById('edit_corp_judul').value.trim();
    const jenis = document.getElementById('edit_corp_jenis').value;
    const ja    = document.getElementById('edit_corp_jenis_akomodasi').value;
    const accomIds = getSelectedAccomIds('edit_corp_accommodation_list');

    if (!judul || !jenis) { showCorpToast('Judul dan jenis wajib diisi.', false); return; }
    if (!accomIds.length) { showCorpToast('Pilih minimal 1 unit akomodasi.', false); return; }

    const formData = new FormData();
    formData.append('_method', 'PUT');
    formData.append('judul', judul);
    formData.append('jenis', jenis);
    formData.append('jenis_akomodasi', ja);
    formData.append('max_orang', parseInt(document.getElementById('edit_corp_max_orang').value) || 150);
    formData.append('harga_weekday', parseFloat(document.getElementById('edit_corp_harga_weekday').value) || 0);
    formData.append('harga_weekend', parseFloat(document.getElementById('edit_corp_harga_weekend').value) || 0);
    formData.append('harga_highseason', parseFloat(document.getElementById('edit_corp_harga_highseason').value) || 0);

    accomIds.forEach(id => formData.append('accommodation_ids[]', id));
    getListValues('edit_corp_fasilitas_list').forEach(val => formData.append('fasilitas[]', val));
    getListValues('edit_corp_makanan_list').forEach(val => formData.append('makanan[]', val));
    getListValues('edit_corp_catatan_list').forEach(val => formData.append('catatan[]', val));

    if (window.currentEditCorpImages && window.currentEditCorpImages.length > 0) {
        window.currentEditCorpImages.forEach(imgObj => {
            if (imgObj.type === 'existing') {
                formData.append('existing_gambar[]', imgObj.url);
            } else if (imgObj.type === 'new' && imgObj.file) {
                formData.append('gambar[]', imgObj.file);
            }
        });
    }

    try {
        const res = await fetch(`/admin/corporate/${id}`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': CSRF_TOKEN },
            body: formData,
        });
        const json = await res.json();
        if (json.success) {
            closeModalEditCorp();
            showCorpToast(json.message);
            setTimeout(() => location.reload(), 1200);
        } else { showCorpToast(json.message || 'Terjadi kesalahan.', false); }
    } catch(e) { showCorpToast('Gagal terhubung ke server.', false); }
};

/* ── Modal Delete ─────────────────────────────────────── */
window.openModalDeleteCorp = function(id, name) {
    document.getElementById('delete_corp_id').value = id;
    document.getElementById('delete_corp_name').textContent = name;
    document.getElementById('modalDeleteCorporate').classList.remove('hidden');
};
window.closeModalDeleteCorp = function() {
    document.getElementById('modalDeleteCorporate').classList.add('hidden');
};

window.submitDeleteCorp = async function() {
    const id = document.getElementById('delete_corp_id').value;
    try {
        const res = await fetch(`/admin/corporate/${id}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': CSRF_TOKEN },
        });
        const json = await res.json();
        if (json.success) {
            closeModalDeleteCorp();
            showCorpToast(json.message);
            setTimeout(() => location.reload(), 1200);
        } else { showCorpToast(json.message || 'Terjadi kesalahan.', false); }
    } catch(e) { showCorpToast('Gagal terhubung ke server.', false); }
};

/* ── Init ─────────────────────────────────────────────── */
renderCorpList(allCorpData);
</script>
@endpush
@endsection
