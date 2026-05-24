@extends('layouts.admin')
@section('content')

{{-- ============================================================
     PENENTUAN TANGGAL — Weekday / Weekend / Highseason
     ============================================================ --}}

{{-- ── MODAL EDIT TANGGAL ─────────────────────────────────────── --}}
<div id="modalEditTanggal"
    class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 backdrop-blur-sm hidden"
    onclick="if(event.target===this) closeModalTanggal()"
>
    <div class="relative w-full max-w-xl mx-4 bg-[#fdf6e3] rounded-3xl shadow-2xl border border-amber-200/60 overflow-hidden
                animate-[modalIn_0.25s_ease-out_forwards]" style="font-family:'Georgia',serif;">
        <div class="h-1 w-full bg-gradient-to-r from-amber-400 via-yellow-500 to-amber-600"></div>
        <div class="flex items-center justify-between px-8 pt-7 pb-0">
            <div>
                <h2 class="text-xl font-bold text-stone-800 tracking-tight" id="modalTglTitle">Edit Tanggal</h2>
                <p class="text-xs text-stone-400 mt-0.5" id="modalTglSubtitle">Perbarui daftar tanggal</p>
            </div>
            <button onclick="closeModalTanggal()" class="p-2 rounded-xl text-stone-400 hover:bg-stone-200/60 hover:text-stone-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <input type="hidden" id="editTgl_key">
        <input type="hidden" id="editTgl_idx">
        <div class="px-8 pt-5 pb-3">
            <div id="editTgl_nameWrap" class="mb-4 hidden">
                <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Nama Periode</label>
                <input type="text" id="editTgl_name"
                    class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm
                           focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"/>
            </div>
            <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Daftar Tanggal / Hari</label>
            <textarea id="editTgl_dates" rows="5"
                class="w-full px-4 py-2.5 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm
                       placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"
                placeholder="Pisahkan dengan koma, misal: 2026-01-01, 2026-01-02"></textarea>
            <p class="text-[10px] text-stone-400 mt-1">Pisahkan setiap item dengan tanda koma (,)</p>
        </div>
        <div class="flex items-center justify-end gap-3 px-8 pb-7 pt-2">
            <button onclick="closeModalTanggal()"
                class="px-6 py-2.5 rounded-xl text-sm font-semibold text-stone-600 bg-stone-100 hover:bg-stone-200 transition">Batal</button>
            <button onclick="saveModalTanggal()"
                class="px-7 py-2.5 rounded-xl text-sm font-bold text-[#fdf6e3] bg-gradient-to-r from-amber-500 to-amber-600
                       hover:from-amber-600 hover:to-amber-700 shadow-lg shadow-amber-900/20 transition-all active:scale-[0.98] flex items-center gap-2">
                <iconify-icon icon="lucide:save" class="text-base"></iconify-icon> Simpan
            </button>
        </div>
    </div>
</div>

{{-- ── MAIN CONTENT ───────────────────────────────────────────── --}}
<div class="bg-[#fdf6e3]/80 backdrop-blur-sm rounded-2xl border border-amber-200/60 shadow-sm overflow-hidden">

    {{-- ── WEEKDAY ─────────────────────────────────────────── --}}
    <div class="flex items-start gap-4 sm:gap-6 px-5 sm:px-8 py-4 border-b border-amber-200/40" id="rowWeekday">
        <span class="shrink-0 inline-flex items-center px-4 py-2 rounded-lg text-sm font-bold text-white bg-[#3a523a] shadow-sm min-w-[120px] justify-center">
            Weekday
        </span>
        <div class="flex-1 bg-white rounded-xl border border-stone-200 px-4 py-3 text-sm text-stone-700 leading-relaxed" id="weekdayContent">
            Minggu, Senin, Selasa, Rabu, Kamis
        </div>
        <button onclick="openEditTanggal('weekday')"
            class="shrink-0 w-10 h-10 rounded-lg bg-amber-400 hover:bg-amber-500 text-white flex items-center justify-center transition shadow-sm active:scale-95">
            <iconify-icon icon="lucide:pencil" class="text-lg"></iconify-icon>
        </button>
    </div>

    {{-- ── WEEKEND ─────────────────────────────────────────── --}}
    <div class="flex items-start gap-4 sm:gap-6 px-5 sm:px-8 py-4 border-b border-amber-200/40" id="rowWeekend">
        <span class="shrink-0 inline-flex items-center px-4 py-2 rounded-lg text-sm font-bold text-white bg-amber-500 shadow-sm min-w-[120px] justify-center">
            Weekend
        </span>
        <div class="flex-1 bg-white rounded-xl border border-stone-200 px-4 py-3 text-sm text-stone-700 leading-relaxed" id="weekendContent">
            —
        </div>
        <button onclick="openEditTanggal('weekend')"
            class="shrink-0 w-10 h-10 rounded-lg bg-amber-400 hover:bg-amber-500 text-white flex items-center justify-center transition shadow-sm active:scale-95">
            <iconify-icon icon="lucide:pencil" class="text-lg"></iconify-icon>
        </button>
    </div>

    {{-- ── HIGHSEASON ──────────────────────────────────────── --}}
    <div class="px-5 sm:px-8 py-6">
        <div class="flex items-center gap-4 mb-5">
            <span class="shrink-0 inline-flex items-center px-4 py-2 rounded-lg text-sm font-bold text-white bg-red-500 shadow-sm min-w-[120px] justify-center">
                Highseason
            </span>
            <div class="flex-1"></div>
            <button onclick="addHighseason()"
                class="flex items-center gap-1.5 px-4 py-2 rounded-lg text-xs font-bold text-[#fdf6e3]
                       bg-gradient-to-r from-[#2d4a2d] to-[#3d6b3d] hover:from-[#3d6b3d] hover:to-[#4a824a]
                       shadow-md transition-all active:scale-[0.98]">
                <iconify-icon icon="lucide:plus" class="text-sm"></iconify-icon> Tambah Periode
            </button>
        </div>
        <div id="highseasonList" class="flex flex-col gap-4"></div>
    </div>
</div>

<style>
@keyframes modalIn {
    from { opacity: 0; transform: scale(0.95) translateY(8px); }
    to   { opacity: 1; transform: scale(1) translateY(0); }
}
</style>

@push('scripts')
<script>
(function(){
    // ── Data (dari backend) ───────────────────────────────────
    const TANGGAL_DATA = {
        weekday: {
            label: 'Weekday',
            dates: `{!! addslashes($weekday ? $weekday->dates : 'Minggu, Senin, Selasa, Rabu, Kamis') !!}`
        },
        weekend: {
            label: 'Weekend',
            dates: `{!! addslashes($weekend ? $weekend->dates : '') !!}`
        },
        highseason: [
            @foreach($highseason as $hs)
            { name: `{!! addslashes($hs->name) !!}`, dates: `{!! addslashes($hs->dates) !!}` },
            @endforeach
        ]
    };

    // ── Render ──────────────────────────────────────────────────
    function renderAll() {
        document.getElementById('weekdayContent').textContent = TANGGAL_DATA.weekday.dates;
        document.getElementById('weekendContent').textContent = TANGGAL_DATA.weekend.dates;
        renderHighseason();
    }

    function renderHighseason() {
        const list = document.getElementById('highseasonList');
        list.innerHTML = TANGGAL_DATA.highseason.map((h, i) => `
            <div class="flex items-start gap-4 sm:gap-5">
                <div class="text-sm font-bold text-stone-600 shrink-0 w-[140px] sm:w-[170px] pt-2.5">
                    ${i+1}. ${h.name}
                </div>
                <div class="flex-1 bg-white rounded-xl border border-stone-200 px-4 py-3 text-sm text-stone-700 leading-relaxed border-l-4 border-l-amber-400">
                    ${h.dates}
                </div>
                <div class="flex items-center gap-2 mt-1">
                    <button onclick="openEditTanggal('highseason', ${i})"
                        class="shrink-0 w-10 h-10 rounded-lg bg-amber-400 hover:bg-amber-500 text-white flex items-center justify-center transition shadow-sm active:scale-95">
                        <iconify-icon icon="lucide:pencil" class="text-lg"></iconify-icon>
                    </button>
                    <button onclick="deleteHighseason(${i})"
                        class="shrink-0 w-10 h-10 rounded-lg bg-red-500 hover:bg-red-600 text-white flex items-center justify-center transition shadow-sm active:scale-95">
                        <iconify-icon icon="lucide:trash-2" class="text-lg"></iconify-icon>
                    </button>
                </div>
            </div>
        `).join('');
    }

    // ── Modal Logic ────────────────────────────────────────────
    window.openEditTanggal = function(key, idx) {
        document.getElementById('editTgl_key').value = key;
        document.getElementById('editTgl_idx').value = idx ?? '';
        const nameWrap = document.getElementById('editTgl_nameWrap');
        const nameInput = document.getElementById('editTgl_name');
        const datesInput = document.getElementById('editTgl_dates');
        const title = document.getElementById('modalTglTitle');

        if (key === 'weekday') {
            title.textContent = 'Edit Weekday';
            nameWrap.classList.add('hidden');
            datesInput.value = TANGGAL_DATA.weekday.dates;
        } else if (key === 'weekend') {
            title.textContent = 'Edit Weekend';
            nameWrap.classList.add('hidden');
            datesInput.value = TANGGAL_DATA.weekend.dates;
        } else {
            if (idx === 'new') {
                title.textContent = 'Tambah Highseason';
                nameWrap.classList.remove('hidden');
                nameInput.value = 'Periode Baru';
                datesInput.value = '';
            } else {
                const h = TANGGAL_DATA.highseason[idx];
                title.textContent = 'Edit Highseason';
                nameWrap.classList.remove('hidden');
                nameInput.value = h.name;
                datesInput.value = h.dates;
            }
        }
        document.getElementById('modalEditTanggal').classList.remove('hidden');
    };

    window.closeModalTanggal = function() {
        document.getElementById('modalEditTanggal').classList.add('hidden');
    };

    window.saveModalTanggal = function() {
        const key = document.getElementById('editTgl_key').value;
        const idx = document.getElementById('editTgl_idx').value;
        const dates = document.getElementById('editTgl_dates').value.trim();

        if (key === 'weekday') {
            TANGGAL_DATA.weekday.dates = dates;
        } else if (key === 'weekend') {
            TANGGAL_DATA.weekend.dates = dates;
        } else {
            const name = document.getElementById('editTgl_name').value.trim();
            if (idx === 'new') {
                TANGGAL_DATA.highseason.push({ name, dates });
            } else {
                TANGGAL_DATA.highseason[parseInt(idx)] = { name, dates };
            }
        }
        
        // Save to backend
        fetch('/admin/tanggal', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(TANGGAL_DATA)
        }).then(res => res.json()).then(data => {
            renderAll();
            closeModalTanggal();
            if (typeof showToast === 'function') showToast('Tanggal berhasil diperbarui.');
        }).catch(err => {
            console.error(err);
            alert('Gagal menyimpan data.');
        });
    };

    window.addHighseason = function() {
        openEditTanggal('highseason', 'new');
    };

    window.deleteHighseason = function(idx) {
        if (!confirm('Yakin ingin menghapus periode ini?')) return;
        TANGGAL_DATA.highseason.splice(idx, 1);
        
        // Save to backend
        fetch('/admin/tanggal', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(TANGGAL_DATA)
        }).then(res => res.json()).then(data => {
            renderHighseason();
            if (typeof showToast === 'function') showToast('Periode berhasil dihapus.', 'lucide:trash-2', 'text-red-400');
        });
    };

    // ── Init ───────────────────────────────────────────────────
    renderAll();
})();
</script>
@endpush
@endsection
