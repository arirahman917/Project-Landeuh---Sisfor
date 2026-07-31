@extends('layouts.admin')
@section('content')

@include('admin.corporate._modal-tambah')
@include('admin.corporate._modal-edit')
@include('admin.corporate._modal-delete')
@include('admin.corporate._modal-libur')

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
    {{-- Liburkan Paket --}}
    <button onclick="openModalLiburkanPaket()"
        class="flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-sm text-red-700 bg-red-50 border border-red-200 hover:bg-red-100 transition-all active:scale-[0.98] whitespace-nowrap shadow-sm mr-2">
        <iconify-icon icon="lucide:calendar-off" class="text-base text-red-500"></iconify-icon>
        Liburkan Paket
    </button>

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
const DATE_SETTINGS = @json($dateSettings ?? []);
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
        const accIds = (Array.isArray(pkg.accommodation_ids) ? pkg.accommodation_ids : []).map(id => parseInt(id));
        const accNames = ACCOM_DATA
            .filter(a => accIds.includes(parseInt(a.id)))
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
                                ${checkIsCurrentlyLiburCorp(pkg) ? `
                                    <span class="inline-flex items-center gap-1 text-[10px] font-bold px-2.5 py-1 rounded-lg bg-red-50 text-red-700 border border-red-200 shadow-sm whitespace-nowrap">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span>Libur / Blokir
                                    </span>
                                ` : ''}
                            </div>
                        </div>
                        <div class="flex gap-2 shrink-0">
                            <button onclick="openModalEditCorp(${pkg.id})" class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold text-blue-700 bg-blue-50 border border-blue-200 hover:bg-blue-100 transition shadow-sm">
                                <iconify-icon icon="lucide:pencil" class="text-xs"></iconify-icon> Edit
                            </button>
                            ${hasBlockedPeriodsCorp(pkg) ? `
                                <button onclick="openModalListLiburCorp(${pkg.id})" class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold text-rose-700 bg-rose-50 border border-rose-200 hover:bg-rose-100 transition shadow-sm">
                                    <iconify-icon icon="lucide:calendar-off" class="text-xs"></iconify-icon> Tanggal Libur/Blokir
                                </button>
                            ` : ''}
                            <button onclick="openModalDeleteCorp(${pkg.id}, '${pkg.judul.replace(/'/g,"\\'")}' )"
                                class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold text-red-700 bg-red-50 border border-red-200 hover:bg-red-100 transition shadow-sm">
                                <iconify-icon icon="lucide:trash-2" class="text-xs"></iconify-icon> Hapus
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
            <span>${a.judul} (${a.slot} unit)</span>
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
    document.body.style.overflow = 'hidden';
};
window.closeModalTambahCorp = function() {
    document.getElementById('modalTambahCorporate').classList.add('hidden');
    document.body.style.overflow = '';
};

window.submitTambahCorp = async function() {
    const btn = document.getElementById('btnSubmitTambahCorp');
    const origHTML = btn.innerHTML;
    
    // ... validate ...
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

    btn.innerHTML = '<iconify-icon icon="lucide:loader-2" class="animate-spin text-lg"></iconify-icon> Mengupload & Menyimpan... Mohon Tunggu';
    btn.disabled = true;
    btn.classList.add('opacity-70', 'cursor-not-allowed');

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
            headers: { 
                'X-CSRF-TOKEN': CSRF_TOKEN,
                'Accept': 'application/json'
            },
            body: formData,
        });
        const json = await res.json();
        if (res.ok && json.success) {
            closeModalTambahCorp();
            showCorpToast(json.message);
            setTimeout(() => location.reload(), 1200);
        } else {
            showCorpToast(json.message || 'Terjadi kesalahan validasi.', false);
            btn.innerHTML = origHTML;
            btn.disabled = false;
            btn.classList.remove('opacity-70', 'cursor-not-allowed');
        }
    } catch(e) { 
        console.error(e);
        showCorpToast('Gagal terhubung ke server.', false); 
        btn.innerHTML = origHTML;
        btn.disabled = false;
        btn.classList.remove('opacity-70', 'cursor-not-allowed');
    }
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
    document.body.style.overflow = 'hidden';
};
window.closeModalEditCorp = function() {
    document.getElementById('modalEditCorporate').classList.add('hidden');
    document.body.style.overflow = '';
};

window.submitEditCorp = async function() {
    const btn = document.getElementById('btnSubmitEditCorp');
    const origHTML = btn.innerHTML;

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
        if (res.ok && json.success) {
            closeModalEditCorp();
            showCorpToast(json.message);
            setTimeout(() => location.reload(), 1200);
        } else { 
            showCorpToast(json.message || 'Terjadi kesalahan.', false); 
            btn.innerHTML = origHTML;
            btn.disabled = false;
            btn.classList.remove('opacity-70', 'cursor-not-allowed');
        }
    } catch(e) { 
        console.error(e);
        showCorpToast('Gagal terhubung ke server.', false); 
        btn.innerHTML = origHTML;
        btn.disabled = false;
        btn.classList.remove('opacity-70', 'cursor-not-allowed');
    }
};

/* ── Modal Delete ─────────────────────────────────────── */
window.openModalDeleteCorp = function(id, name) {
    document.getElementById('delete_corp_id').value = id;
    document.getElementById('delete_corp_name').textContent = name;
    document.getElementById('modalDeleteCorporate').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
};
window.closeModalDeleteCorp = function() {
    document.getElementById('modalDeleteCorporate').classList.add('hidden');
    document.body.style.overflow = '';
};

window.submitDeleteCorp = async function() {
    const id = document.getElementById('delete_corp_id').value;
    try {
        const res = await fetch(`/admin/corporate/${id}`, {
            method: 'DELETE',
            headers: { 
                'X-CSRF-TOKEN': CSRF_TOKEN,
                'Accept': 'application/json'
            },
        });
        const json = await res.json();
        if (res.ok && json.success) {
            closeModalDeleteCorp();
            showCorpToast(json.message);
            setTimeout(() => location.reload(), 1200);
        } else { showCorpToast(json.message || 'Terjadi kesalahan.', false); }
    } catch(e) { 
        console.error(e);
        showCorpToast('Gagal terhubung ke server.', false); 
    }
};

    // ── Blocked/Libur Paket Logic ──────────────────────────────
    let liburPaketFp = null;
    let pendingLiburPaketCallback = null;
    window.currentLiburPaketDates = null;
    window.currentLiburPaketIds = null;

    function parseToLocalDate(dateInput) {
        if (!dateInput) return new Date();
        if (dateInput instanceof Date) return dateInput;
        const parts = dateInput.split('-');
        if (parts.length === 3) {
            return new Date(parts[0], parts[1] - 1, parts[2]);
        }
        return new Date(dateInput);
    }

    window.checkIsCurrentlyLiburCorp = function(pkg) {
        const today = parseToLocalDate(new Date());
        const y = today.getFullYear();
        const m = String(today.getMonth() + 1).padStart(2, '0');
        const r = String(today.getDate()).padStart(2, '0');
        const todayStr = `${y}-${m}-${r}`;

        const globalLibur = (DATE_SETTINGS || []).filter(d => d.type === 'libur_landeuh');
        for (let gl of globalLibur) {
            if (gl.dates) {
                const datesArr = typeof gl.dates === 'string' ? gl.dates.split(',').map(d => d.trim()) : (Array.isArray(gl.dates) ? gl.dates : []);
                if (datesArr.includes(todayStr)) return true;
            }
        }

        const specificBlocked = pkg.blocked_dates || [];
        for (let sb of specificBlocked) {
            if (sb.dates) {
                const datesArr = typeof sb.dates === 'string' ? sb.dates.split(',').map(d => d.trim()) : (Array.isArray(sb.dates) ? sb.dates : []);
                if (datesArr.includes(todayStr)) return true;
            }
        }

        return false;
    };

    window.hasBlockedPeriodsCorp = function(pkg) {
        const globalLibur = (DATE_SETTINGS || []).filter(d => d.type === 'libur_landeuh');
        const specificLibur = pkg.blocked_dates || [];
        return globalLibur.length > 0 || specificLibur.length > 0;
    };

    window.openModalListLiburCorp = function(id) {
        const pkg = CORP_DATA.find(d => d.id === id);
        if (!pkg) return;
        const html = renderBlockedPeriodsHtml(pkg);
        document.getElementById('modalListLiburCorpTitle').innerText = `Tanggal Libur/Blokir: ${pkg.judul}`;
        document.getElementById('modalListLiburCorpContent').innerHTML = html || '<p class="text-sm text-stone-500">Tidak ada jadwal libur/blokir.</p>';
        document.getElementById('modalListLiburCorp').classList.remove('hidden');
    };

    window.closeModalListLiburCorp = function() {
        document.getElementById('modalListLiburCorp').classList.add('hidden');
    };

    window.renderBlockedPeriodsHtml = function(pkg) {
        const globalLibur = (DATE_SETTINGS || []).filter(d => d.type === 'libur_landeuh');
        const specificLibur = pkg.blocked_dates || [];

        const allLibur = [];
        globalLibur.forEach(gl => {
            let datesVal = '';
            if (typeof gl.dates === 'string') {
                datesVal = gl.dates;
            } else if (Array.isArray(gl.dates)) {
                datesVal = gl.dates.join(', ');
            }
            allLibur.push({
                id: gl.id,
                name: gl.name || 'Libur Landeuh (Global)',
                dates: datesVal,
                is_global: true
            });
        });
        specificLibur.forEach(sl => {
            let datesVal = '';
            if (typeof sl.dates === 'string') {
                datesVal = sl.dates;
            } else if (Array.isArray(sl.dates)) {
                datesVal = sl.dates.join(', ');
            }
            allLibur.push({
                id: sl.id,
                name: sl.name,
                dates: datesVal
            });
        });

        if (allLibur.length === 0) return '';

        const groups = {};
        allLibur.forEach(lib => {
            if (!lib.dates) return;
            const datesStr = typeof lib.dates === 'string' ? lib.dates : (Array.isArray(lib.dates) ? lib.dates.join(', ') : '');
            const dateList = datesStr.split(',').map(d => d.trim()).filter(Boolean).sort();
            if (dateList.length === 0) return;
            
            const firstDate = parseToLocalDate(dateList[0]);
            const key = `${firstDate.getFullYear()}-${String(firstDate.getMonth()).padStart(2, '0')}`;
            if (!groups[key]) {
                groups[key] = {
                    month: firstDate.getMonth(),
                    year: firstDate.getFullYear(),
                    items: []
                };
            }
            
            let rangeLabel = '';
            if (dateList.length === 1) {
                rangeLabel = formatDateStr(dateList[0]);
            } else {
                rangeLabel = `${formatDateStr(dateList[0])} s.d ${formatDateStr(dateList[dateList.length - 1])}`;
            }

            groups[key].items.push({
                ...lib,
                rangeLabel: rangeLabel,
                firstDateObj: firstDate
            });
        });

        function formatDateStr(dateStr) {
            const p = dateStr.split('-');
            return p.length === 3 ? `${p[2]}-${p[1]}-${p[0]}` : dateStr;
        }

        const MONTH_COLORS = [
            { name: 'Januari',   bg: '#FFE0E0', text: '#CC3333', border: '#FFBBBB' },
            { name: 'Februari',  bg: '#DDEAFF', text: '#335599', border: '#B8D0FF' },
            { name: 'Maret',     bg: '#DDFCE0', text: '#1E8C30', border: '#B0E8B8' },
            { name: 'April',     bg: '#FFF6DD', text: '#BB7711', border: '#FFE8AA' },
            { name: 'Mei',       bg: '#E6FFDD', text: '#3D9900', border: '#C0F0A0' },
            { name: 'Juni',      bg: '#EEDDFF', text: '#7733BB', border: '#DDBBFF' },
            { name: 'Juli',      bg: '#DDF0FF', text: '#2266AA', border: '#AADDFF' },
            { name: 'Agustus',   bg: '#FFE5EE', text: '#CC2266', border: '#FFBBCC' },
            { name: 'September', bg: '#FFF0DD', text: '#CC6600', border: '#FFDDAA' },
            { name: 'Oktober',   bg: '#FCFCE0', text: '#7A7A00', border: '#EEE8A0' },
            { name: 'November',  bg: '#FFDDF5', text: '#BB2288', border: '#FFBBDD' },
            { name: 'Desember',  bg: '#DEE0FF', text: '#4444CC', border: '#C0C8FF' },
        ];
        const MONTH_SHORT = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agt','Sep','Okt','Nov','Des'];

        const accordionsHtml = Object.keys(groups).sort().map(key => {
            const g = groups[key];
            const c = MONTH_COLORS[g.month];
            const monthLabel = `${MONTH_SHORT[g.month]} ${g.year}`;
            
            // Collapsed (hidden) by default!
            const isOpen = false;

            const itemsHtml = g.items.map(lib => {
                let deleteBtn = '';
                if (lib.is_global) {
                    return `
                        <div class="flex items-center justify-between gap-2 p-2 rounded-xl bg-amber-50 border border-amber-200 text-amber-700 text-[10px] font-semibold w-full">
                            <span>🌍 Libur Global: <strong>${lib.name}</strong> (${lib.rangeLabel})</span>
                        </div>
                    `;
                } else {
                    deleteBtn = `
                        <button onclick="deleteBlockedPeriodCorp(${pkg.id}, '${lib.id}')" 
                                class="w-6 h-6 rounded-lg bg-red-100 hover:bg-red-200 text-red-600 flex items-center justify-center transition shrink-0">
                            <iconify-icon icon="lucide:trash" class="text-xs"></iconify-icon>
                        </button>
                    `;
                    return `
                        <div class="flex items-center justify-between gap-2 p-2 rounded-xl bg-red-50 border border-red-150 text-red-700 text-[10px] font-semibold w-full">
                            <span>🚫 Libur Paket: <strong>${lib.name}</strong> (${lib.rangeLabel})</span>
                            ${deleteBtn}
                        </div>
                    `;
                }
            }).join('');

            return `
            <div class="border border-stone-200/60 rounded-xl overflow-hidden bg-white/40 shadow-sm mt-1.5">
                <div class="px-3 py-2 bg-stone-50/80 cursor-pointer flex justify-between items-center hover:bg-stone-100 transition" 
                     onclick="this.nextElementSibling.classList.toggle('hidden'); this.querySelector('.chevron').classList.toggle('rotate-180')">
                    <div class="flex items-center gap-2">
                        <span style="background:${c.text}; color:#fff;" class="inline-flex items-center gap-1 px-2 py-1 rounded-md text-[9px] font-bold tracking-wide whitespace-nowrap shadow-sm">
                            <iconify-icon icon="lucide:calendar-clock" class="text-[10px]"></iconify-icon>${monthLabel}
                        </span>
                        <span class="text-[11px] font-bold text-red-600">${g.items.length} libur/blokir</span>
                    </div>
                    <iconify-icon icon="lucide:chevron-down" class="chevron text-stone-400 transition-transform duration-200 ${isOpen ? 'rotate-180' : ''}"></iconify-icon>
                </div>
                <div class="${isOpen ? '' : 'hidden'} border-t border-stone-100 p-2 flex flex-col gap-1.5">
                    ${itemsHtml}
                </div>
            </div>`;
        }).join('');

        return `<div class="flex flex-col gap-1 mt-1">${accordionsHtml}</div>`;
    };

    window.openModalLiburkanPaket = function() {
        const checkboxes = document.getElementById('liburPaketCheckboxes');
        checkboxes.innerHTML = CORP_DATA.map(pkg => `
            <label class="flex items-center gap-2 cursor-pointer text-stone-700 hover:text-[#3a523a] text-xs font-semibold">
                <input type="checkbox" name="libur_pkg_ids[]" value="${pkg.id}" class="rounded border-stone-300 text-red-600 focus:ring-red-500 w-4 h-4 cursor-pointer">
                <span>${pkg.judul} (${pkg.jenis})</span>
            </label>
        `).join('');

        document.getElementById('liburPaket_name').value = '';
        document.getElementById('liburPaket_dates').value = '';
        document.getElementById('btnOpenKalenderLiburPaket').innerHTML = `<iconify-icon icon="lucide:calendar-plus" class="text-xl"></iconify-icon> Pilih Tanggal Blokir`;

        if (liburPaketFp) liburPaketFp.destroy();
        liburPaketFp = flatpickr("#btnOpenKalenderLiburPaket", {
            mode: "multiple",
            minDate: "today",
            onChange: function(selectedDates, dateStr) {
                document.getElementById('liburPaket_dates').value = dateStr;
                document.getElementById('btnOpenKalenderLiburPaket').innerHTML = `<iconify-icon icon="lucide:calendar" class="text-xl"></iconify-icon> ${dateStr}`;
            }
        });

        document.getElementById('liburPaketFormWrap').classList.remove('hidden');
        document.getElementById('liburPaketConflictWrap').classList.add('hidden');
        document.getElementById('btnSaveLiburPaket').classList.remove('hidden');
        document.getElementById('btnSaveAfterLiburPaketConflictsCleared').classList.add('hidden');

        document.getElementById('modalLiburkanPaket').classList.remove('hidden');
    };

    window.closeLiburPaketModal = function() {
        if (liburPaketFp) { liburPaketFp.close(); liburPaketFp.destroy(); liburPaketFp = null; }
        document.getElementById('modalLiburkanPaket').classList.add('hidden');
        pendingLiburPaketCallback = null;
    };

    window.submitLiburPaket = function() {
        const checkedBoxes = document.querySelectorAll('input[name="libur_pkg_ids[]"]:checked');
        const corporatePackageIds = Array.from(checkedBoxes).map(cb => parseInt(cb.value));
        const name = document.getElementById('liburPaket_name').value.trim();
        const dates = document.getElementById('liburPaket_dates').value.trim();

        if (corporatePackageIds.length === 0) {
            alert('Pilih minimal satu paket yang ingin diliburkan.');
            return;
        }
        if (!name) {
            alert('Masukkan nama periode atau alasan libur.');
            return;
        }
        if (!dates) {
            alert('Pilih tanggal libur.');
            return;
        }

        const proceedSave = () => {
            const btn = document.getElementById('btnSaveLiburPaket');
            btn.disabled = true;
            btn.innerHTML = '<iconify-icon icon="lucide:loader-2" class="animate-spin"></iconify-icon> Memproses...';

            fetch('/admin/corporate/blocked-dates', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                body: JSON.stringify({
                    action: 'create',
                    corporate_package_ids: corporatePackageIds,
                    name: name,
                    dates: dates
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                } else {
                    alert('Gagal menyimpan: ' + data.message);
                    btn.disabled = false;
                    btn.innerHTML = '<iconify-icon icon="lucide:check"></iconify-icon> Terapkan Libur';
                }
            })
            .catch(err => {
                console.error(err);
                alert('Terjadi kesalahan jaringan.');
                btn.disabled = false;
                btn.innerHTML = '<iconify-icon icon="lucide:check"></iconify-icon> Terapkan Libur';
            });
        };

        if (pendingLiburPaketCallback) {
            proceedSave();
            return;
        }

        fetch('/admin/tanggal/check-conflicts', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CSRF_TOKEN
            },
            body: JSON.stringify({
                dates: dates,
                corporate_package_ids: corporatePackageIds
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.conflicts && data.conflicts.length > 0) {
                showLiburPaketConflict(data.conflicts, dates, corporatePackageIds, proceedSave);
            } else {
                proceedSave();
            }
        })
        .catch(err => {
            console.error(err);
            alert('Gagal memeriksa konflik pesanan.');
        });
    };

    function showLiburPaketConflict(conflicts, datesStr, corporatePackageIds, onClearCallback) {
        pendingLiburPaketCallback = onClearCallback;
        window.currentLiburPaketDates = datesStr;
        window.currentLiburPaketIds = corporatePackageIds;

        renderLiburPaketConflictsList(conflicts);

        document.getElementById('liburPaketFormWrap').classList.add('hidden');
        document.getElementById('liburPaketConflictWrap').classList.remove('hidden');
        document.getElementById('btnSaveLiburPaket').classList.add('hidden');
        document.getElementById('btnSaveAfterLiburPaketConflictsCleared').classList.remove('hidden');
        document.getElementById('btnSaveAfterLiburPaketConflictsCleared').disabled = true;
    }

    function fmtDate(d) { if (!d) return d; const p = d.split('-'); return p.length === 3 ? `${p[2]}-${p[1]}-${p[0]}` : d; }

    function renderLiburPaketConflictsList(conflicts) {
        const container = document.getElementById('liburPaketConflictList');
        const saveBtn = document.getElementById('btnSaveAfterLiburPaketConflictsCleared');

        if (conflicts.length === 0) {
            container.innerHTML = `
                <div class="text-center py-4 text-green-600 bg-green-50 rounded-xl border border-green-200">
                    <iconify-icon icon="lucide:check-circle" class="text-2xl mb-1"></iconify-icon>
                    <p class="text-xs font-bold">Semua konflik telah terselesaikan!</p>
                </div>
            `;
            saveBtn.disabled = false;
            saveBtn.className = 'w-full py-3 rounded-xl font-bold text-xs text-white bg-green-600 hover:bg-green-700 transition shadow-sm';
            return;
        }

        saveBtn.disabled = true;
        saveBtn.className = 'w-full py-3 rounded-xl font-bold text-xs text-stone-400 bg-stone-100 cursor-not-allowed';

        container.innerHTML = conflicts.map(p => {
            const cleanPhone = p.pemesanTelp.replace(/^0/, '62').replace(/[-+\s]/g, '');
            const waMsg = encodeURIComponent(`Halo Kak ${p.pemesanNama}, kami dari Landeuh Village. Mengenai pemesanan Kakak dengan nomor #${p.noPesanan} untuk akomodasi ${p.akomodasi} pada tanggal ${fmtDate(p.checkin)} s.d ${fmtDate(p.checkout)}, kami ingin menginfokan bahwa paket/kawasan tersebut sedang diliburkan. Apakah boleh kami bantu untuk reschedule ke tanggal alternatif? Terima kasih.`);
            const waUrl = `https://wa.me/${cleanPhone}?text=${waMsg}`;

            return `
                <div class="p-3 rounded-xl border border-stone-200 bg-stone-50 flex flex-col gap-2">
                    <div class="flex justify-between items-start gap-2">
                        <div>
                            <span class="text-[10px] font-bold text-white bg-red-500 px-2 py-0.5 rounded shadow-sm uppercase">${p.noPesanan}</span>
                            <h4 class="text-xs font-bold text-stone-800 mt-1">${p.pemesanNama} <span class="font-normal text-[10px] text-stone-500">(${p.pemesanTelp})</span></h4>
                            <p class="text-[10px] text-stone-600">Akomodasi: <strong>${p.akomodasi}</strong> · Tanggal: <strong>${fmtDate(p.checkin)} &rarr; ${fmtDate(p.checkout)}</strong></p>
                        </div>
                        <div class="flex gap-1">
                            <a href="${waUrl}" target="_blank" class="px-2 py-1 rounded-lg bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-[10px] flex items-center gap-0.5 transition shadow-sm">
                                <iconify-icon icon="lucide:message-square"></iconify-icon> WA
                            </a>
                            <button onclick="initLiburPaketReschedule(${p.id}, '${p.checkin}', '${p.checkout}', ${p.accommodation_id || 'null'}, ${p.corporate_package_id || 'null'}, ${p.is_corporate ? 1 : 0})" class="px-2 py-1 rounded-lg bg-amber-500 hover:bg-amber-600 text-white font-bold text-[10px] flex items-center gap-0.5 transition shadow-sm">
                                <iconify-icon icon="lucide:calendar-range"></iconify-icon> Reschedule
                            </button>
                        </div>
                    </div>
                    
                    <div id="libur-pkg-resched-form-${p.id}" class="hidden p-2 rounded-lg bg-white border border-stone-200 mt-1 flex flex-col gap-2">
                        <div class="flex items-center gap-1.5">
                            <span class="text-[10px] font-bold text-stone-600">Pilih Tanggal:</span>
                            <input type="text" id="libur-pkg-resched-input-${p.id}" class="hidden">
                            <button type="button" id="btn-libur-pkg-resched-picker-${p.id}" class="px-2 py-1 border border-stone-300 rounded text-[10px] font-semibold text-stone-700 bg-stone-50 hover:bg-stone-100 flex items-center gap-1 transition">
                                <iconify-icon icon="lucide:calendar"></iconify-icon> Pilih Check-in & Check-out
                            </button>
                        </div>
                        <div class="flex justify-end gap-1.5">
                            <button onclick="document.getElementById('libur-pkg-resched-form-${p.id}').classList.add('hidden')" class="px-2 py-1 rounded text-[10px] font-bold bg-stone-100 text-stone-600">Batal</button>
                            <button id="btn-libur-pkg-resched-save-${p.id}" disabled onclick="saveLiburPaketReschedule(${p.id})" class="px-2 py-1 rounded text-[10px] font-bold bg-stone-300 text-stone-500 cursor-not-allowed">Simpan</button>
                        </div>
                    </div>
                </div>
            `;
        }).join('');
    }

    window.initLiburPaketReschedule = function(bookingId, checkin, checkout, accomId, pkgId, isCorp) {
        const startOrig = new Date(checkin);
        const endOrig = new Date(checkout);
        const origNights = Math.round((endOrig - startOrig) / (1000 * 60 * 60 * 24));
        window[`origNights_${bookingId}`] = origNights;

        const form = document.getElementById(`libur-pkg-resched-form-${bookingId}`);
        form.classList.toggle('hidden');
        if (form.classList.contains('hidden')) return;

        const input = document.getElementById(`libur-pkg-resched-input-${bookingId}`);
        const btn = document.getElementById(`btn-libur-pkg-resched-picker-${bookingId}`);
        const saveBtn = document.getElementById(`btn-libur-pkg-resched-save-${bookingId}`);

        const targetId = isCorp ? pkgId : accomId;

        fetch(`/reservasi/booked-dates/${targetId}?exclude_booking_id=${bookingId}&is_corporate=${isCorp ? 1 : 0}`)
        .then(res => res.json())
        .then(data => {
            const disabledDates = data.booked_dates || [];

            if (window[`fp_libur_pkg_resched_${bookingId}`]) window[`fp_libur_pkg_resched_${bookingId}`].destroy();

            window[`fp_libur_pkg_resched_${bookingId}`] = flatpickr(input, {
                mode: 'range',
                minDate: 'today',
                positionElement: btn,
                disable: [
                    function(date) {
                        let y = date.getFullYear();
                        let m = String(date.getMonth() + 1).padStart(2, '0');
                        let d = String(date.getDate()).padStart(2, '0');
                        let dateStr = `${y}-${m}-${d}`;

                        const fpInstance = window[`fp_libur_pkg_resched_${bookingId}`];
                        const selected = (fpInstance && fpInstance.selectedDates) ? fpInstance.selectedDates : [];

                        if (selected && selected.length === 1) {
                            const start = new Date(selected[0]);
                            start.setHours(0, 0, 0, 0);
                            const cur = new Date(date);
                            cur.setHours(0, 0, 0, 0);

                            if (cur <= start) return true;

                            for (let dt = new Date(start); dt < cur; dt.setDate(dt.getDate() + 1)) {
                                let sy = dt.getFullYear();
                                let sm = String(dt.getMonth() + 1).padStart(2, '0');
                                let sd = String(dt.getDate()).padStart(2, '0');
                                let sStr = `${sy}-${sm}-${sd}`;
                                if (disabledDates.includes(sStr)) return true;
                            }
                            return false;
                        }
                        return disabledDates.includes(dateStr);
                    }
                ],
                onDayCreate: function(dObj, dStr, fp, dayElem) {
                    let y = dayElem.dateObj.getFullYear();
                    let m = String(dayElem.dateObj.getMonth() + 1).padStart(2, '0');
                    let d = String(dayElem.dateObj.getDate()).padStart(2, '0');
                    let dateStr = `${y}-${m}-${d}`;
                    if (disabledDates.includes(dateStr)) {
                        dayElem.classList.add('booked-date');
                    }
                },
                onChange: function(selectedDates, dateStr, instance) {
                    btn.innerHTML = `<iconify-icon icon="lucide:calendar"></iconify-icon> ${dateStr}`;
                    if (selectedDates.length === 2) {
                        let start = new Date(selectedDates[0]);
                        start.setHours(12,0,0,0);
                        let end = new Date(selectedDates[1]);
                        end.setHours(12,0,0,0);
                        
                        let hasBlockedDate = false;
                        for (let dt = new Date(start); dt < end; dt.setDate(dt.getDate() + 1)) {
                            let sy = dt.getFullYear();
                            let sm = String(dt.getMonth() + 1).padStart(2, '0');
                            let sd = String(dt.getDate()).padStart(2, '0');
                            let sStr = `${sy}-${sm}-${sd}`;
                            if (disabledDates.includes(sStr)) {
                                hasBlockedDate = true;
                                break;
                            }
                        }

                        if (hasBlockedDate) {
                            alert('Beberapa tanggal di dalam rentang yang Anda pilih sudah terisi. Silakan pilih rentang tanggal lain.');
                            saveBtn.disabled = true;
                            saveBtn.className = 'px-2 py-1 rounded text-[10px] font-bold bg-stone-300 text-stone-500 cursor-not-allowed';
                        } else {
                            saveBtn.disabled = false;
                            saveBtn.className = 'px-2 py-1 rounded text-[10px] font-bold bg-green-600 text-white hover:bg-green-700 transition shadow-sm';
                        }
                    } else {
                        saveBtn.disabled = true;
                        saveBtn.className = 'px-2 py-1 rounded text-[10px] font-bold bg-stone-300 text-stone-500 cursor-not-allowed';
                    }
                }
            });

            window[`fp_libur_pkg_resched_${bookingId}`].jumpToDate(checkin);

            btn.onclick = function(e) {
                e.stopPropagation();
                window[`fp_libur_pkg_resched_${bookingId}`].toggle();
            };

            setTimeout(() => {
                window[`fp_libur_pkg_resched_${bookingId}`].open();
            }, 50);
        })
        .catch(err => {
            console.error(err);
            alert('Gagal mengambil tanggal ketersediaan.');
        });
    };

    window.saveLiburPaketReschedule = function(bookingId) {
        const input = document.getElementById(`libur-pkg-resched-input-${bookingId}`);
        const dates = input.value.split(' to ');
        if (dates.length !== 2) {
            alert('Pilih tanggal check-in dan check-out yang valid.');
            return;
        }

        const start = new Date(dates[0]);
        const end = new Date(dates[1]);
        const selectedNights = Math.round((end - start) / (1000 * 60 * 60 * 24));
        const origNights = window[`origNights_${bookingId}`];

        if (selectedNights !== origNights) {
            alert(`Durasi menginap harus sama dengan pesanan awal yaitu ${origNights} malam. Saat ini Anda memilih ${selectedNights} malam.`);
            return;
        }

        const saveBtn = document.getElementById(`btn-libur-pkg-resched-save-${bookingId}`);
        saveBtn.disabled = true;
        saveBtn.innerHTML = '<iconify-icon icon="lucide:loader-2" class="animate-spin text-[10px]"></iconify-icon>';

        fetch('/admin/pesanan/force-reschedule', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CSRF_TOKEN
            },
            body: JSON.stringify({
                booking_id: bookingId,
                check_in_date: dates[0],
                check_out_date: dates[1]
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                recheckLiburPaketConflicts();
            } else {
                alert('Gagal memindahkan jadwal: ' + data.message);
                saveBtn.disabled = false;
                saveBtn.innerHTML = 'Simpan';
            }
        })
        .catch(err => {
            console.error(err);
            alert('Terjadi kesalahan jaringan.');
            saveBtn.disabled = false;
            saveBtn.innerHTML = 'Simpan';
        });
    };

    function recheckLiburPaketConflicts() {
        const dates = window.currentLiburPaketDates;
        const corporatePackageIds = window.currentLiburPaketIds;

        fetch('/admin/tanggal/check-conflicts', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CSRF_TOKEN
            },
            body: JSON.stringify({
                dates: dates,
                corporate_package_ids: corporatePackageIds
            })
        })
        .then(res => res.json())
        .then(data => {
            renderLiburPaketConflictsList(data.conflicts);
        })
        .catch(err => {
            console.error(err);
            alert('Gagal menyegarkan daftar bentrokan.');
        });
    }

    window.deleteBlockedPeriodCorp = function(corporatePackageId, blockId) {
        if (!confirm('Apakah Anda yakin ingin membuka kembali paket corporate pada periode libur ini?')) return;

        fetch('/admin/corporate/blocked-dates', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CSRF_TOKEN
            },
            body: JSON.stringify({
                action: 'delete',
                corporate_package_id: corporatePackageId,
                block_id: blockId
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            } else {
                alert('Gagal menghapus: ' + data.message);
            }
        })
        .catch(err => {
            console.error(err);
            alert('Kesalahan jaringan.');
        });
    };

/* ── Init ─────────────────────────────────────────────── */
renderCorpList(allCorpData);
</script>

{{-- MODAL LIST LIBUR --}}
<div id="modalListLiburCorp" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 backdrop-blur-sm hidden" onclick="if(event.target===this) closeModalListLiburCorp()">
    <div class="relative w-full max-w-lg mx-4 bg-[#fdf6e3] rounded-3xl shadow-2xl border border-amber-200/60 overflow-hidden animate-[modalIn_0.25s_ease-out_forwards]" style="font-family:'Georgia',serif;">
        <div class="h-1.5 w-full bg-gradient-to-r from-red-400 via-rose-500 to-red-600"></div>
        <div class="flex items-center justify-between px-6 pt-5 pb-0">
            <h2 class="text-lg font-bold text-stone-800 tracking-tight" id="modalListLiburCorpTitle">Tanggal Libur/Blokir</h2>
            <button onclick="closeModalListLiburCorp()" class="p-2 rounded-xl text-stone-400 hover:bg-stone-200/60 hover:text-stone-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="px-6 pt-2 pb-6 max-h-[60vh] overflow-y-auto" id="modalListLiburCorpContent">
            <!-- Content injected here -->
        </div>
    </div>
</div>
@endpush
@endsection
