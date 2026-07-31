@extends('layouts.admin')
@section('content')

{{-- ============================================================
     PENENTUAN TANGGAL — Weekday / Weekend / Highseason
     ============================================================ --}}

<div id="modalEditTanggal"
    class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 backdrop-blur-sm hidden"
>
    <div class="relative w-full max-w-xl mx-4 bg-[#fdf6e3] rounded-3xl shadow-2xl border border-amber-200/60
                animate-[modalIn_0.25s_ease-out_forwards]" style="font-family:'Georgia',serif;">
        <div class="h-1 w-full rounded-t-3xl bg-gradient-to-r from-amber-400 via-yellow-500 to-amber-600"></div>
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
            
            <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Teks Manual (Opsional)</label>
            <input type="text" id="editTgl_nonDates"
                class="w-full px-4 py-2.5 mb-4 rounded-xl border border-stone-200 bg-white/80 text-stone-800 text-sm
                       focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"
                placeholder="Misal: Jum'at, Sabtu (Pisahkan dengan koma)"/>

            <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Pilih Tanggal</label>
            <div class="mb-5">
                <input type="text" id="editTgl_dates" class="hidden">
                <button type="button" id="btnOpenKalender"
                    class="w-full px-5 py-3.5 rounded-2xl border-2 border-dashed border-amber-300 bg-amber-50/50 hover:bg-amber-100/50 text-amber-700 font-bold flex items-center justify-center gap-2 transition shadow-sm active:scale-[0.98]">
                    <iconify-icon icon="lucide:calendar-plus" class="text-xl"></iconify-icon>
                    Pilih Tanggal
                </button>
            </div>

            <label class="block text-xs font-semibold text-stone-600 mb-1.5 tracking-wider uppercase">Preview Tanggal Terpilih</label>
            <div id="editTgl_preview" class="p-4 rounded-xl bg-white border border-stone-200 min-h-[60px] text-sm text-stone-700">
                <!-- Preview formatDatesGrouped -->
            </div>
        </div>
        <div class="flex items-center justify-end gap-3 px-8 pb-7 pt-2">
            <button onclick="closeModalTanggal()"
                class="px-6 py-2.5 rounded-full text-sm font-semibold text-stone-600 bg-stone-100 hover:bg-stone-200 transition">Batal</button>
            <button onclick="saveModalTanggal()"
                class="px-8 py-2.5 rounded-full text-sm font-bold text-[#fdf6e3] bg-gradient-to-r from-amber-500 to-amber-600
                       hover:from-amber-600 hover:to-amber-700 shadow-lg shadow-amber-900/20 transition-all active:scale-[0.98] flex items-center gap-2">
                <iconify-icon icon="lucide:check" class="text-base"></iconify-icon> Selesai
            </button>
        </div>
    </div>
</div>

{{-- ── MODAL KONFLIK PESANAN ────────────────────────────────────────── --}}
<div id="modalKonflikTanggal"
    class="fixed inset-0 z-[110] flex items-center justify-center bg-black/60 backdrop-blur-sm hidden"
>
    <div class="relative w-full max-w-2xl mx-4 bg-white rounded-3xl shadow-2xl border border-stone-200
                animate-[modalIn_0.25s_ease-out_forwards]" style="font-family:'Georgia',serif;">
        <div class="h-1.5 w-full rounded-t-3xl bg-red-500"></div>
        <div class="flex items-center justify-between px-8 pt-6 pb-0">
            <div>
                <h2 class="text-xl font-bold text-stone-800 tracking-tight">Tabrakan Pesanan Ditemukan</h2>
                <p class="text-xs text-stone-400 mt-0.5">Selesaikan konflik pesanan di bawah ini sebelum melanjutkan.</p>
            </div>
            <button onclick="closeConflictModal()" class="p-2 rounded-xl text-stone-400 hover:bg-stone-100 hover:text-stone-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        
        <div class="px-8 py-5 max-h-[60vh] overflow-y-auto">
            <div class="p-3 bg-red-50 text-red-700 rounded-xl border border-red-200 text-xs font-semibold mb-4 flex items-start gap-2">
                <iconify-icon icon="lucide:triangle-alert" class="text-base shrink-0 mt-0.5"></iconify-icon>
                <p class="leading-relaxed">Tanggal yang dipilih memiliki pesanan aktif. Silakan reschedule/hubungi tamu terlebih dahulu.</p>
            </div>
            <div id="conflictList" class="space-y-3">
                <!-- Conflict items will be rendered dynamically here -->
            </div>
        </div>

        <div class="flex items-center justify-between gap-3 px-8 pb-7 pt-4 border-t border-stone-100 bg-stone-50 rounded-b-3xl">
            <span class="text-xs text-stone-500 font-medium" id="conflictCountLabel">Tersisa 0 bentrokan</span>
            <div class="flex items-center gap-3">
                <button onclick="closeConflictModal()"
                    class="px-6 py-2.5 rounded-full text-sm font-semibold text-stone-600 bg-white border border-stone-200 hover:bg-stone-50 transition">Batal</button>
                <button id="btnForceProceedConflict" disabled onclick="saveAfterConflictsCleared()"
                    class="px-8 py-2.5 rounded-full text-sm font-bold text-white bg-stone-400 cursor-not-allowed transition-all shadow-sm">
                    Simpan & Terapkan
                </button>
            </div>
        </div>
    </div>
</div>

{{-- ── MAIN CONTENT ───────────────────────────────────────────── --}}
<div class="bg-[#fdf6e3]/80 backdrop-blur-sm rounded-2xl border border-amber-200/60 shadow-sm overflow-hidden">

    {{-- ── WEEKDAY ─────────────────────────────────────────── --}}
    <div class="flex flex-col gap-3 px-5 sm:px-8 py-5 border-b border-amber-200/40" id="rowWeekday">
        <div class="flex justify-between items-center">
            <span class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-bold text-white bg-[#3a523a] shadow-sm">
                Weekday
            </span>
            <button onclick="openEditTanggal('weekday')"
                class="w-9 h-9 rounded-lg bg-amber-400 hover:bg-amber-500 text-white flex items-center justify-center transition shadow-sm active:scale-95">
                <iconify-icon icon="lucide:pencil" class="text-base"></iconify-icon>
            </button>
        </div>
        <div class="bg-white rounded-xl border border-stone-200 px-5 py-4 text-sm text-stone-700 leading-relaxed min-h-[60px]" id="weekdayContent">
            Minggu, Senin, Selasa, Rabu, Kamis
        </div>
    </div>

    {{-- ── WEEKEND ─────────────────────────────────────────── --}}
    <div class="flex flex-col gap-3 px-5 sm:px-8 py-5 border-b border-amber-200/40" id="rowWeekend">
        <div class="flex justify-between items-center">
            <span class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-bold text-white bg-amber-500 shadow-sm">
                Weekend
            </span>
            <button onclick="openEditTanggal('weekend')"
                class="w-9 h-9 rounded-lg bg-amber-400 hover:bg-amber-500 text-white flex items-center justify-center transition shadow-sm active:scale-95">
                <iconify-icon icon="lucide:pencil" class="text-base"></iconify-icon>
            </button>
        </div>
        <div class="bg-white rounded-xl border border-stone-200 px-5 py-4 text-sm text-stone-700 leading-relaxed min-h-[60px]" id="weekendContent">
            —
        </div>
    </div>

    {{-- ── HIGHSEASON ──────────────────────────────────────── --}}
    <div class="px-5 sm:px-8 py-6">
        <div class="flex justify-between items-center mb-5">
            <span class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-bold text-white bg-red-500 shadow-sm">
                Highseason
            </span>
            <button onclick="addHighseason()"
                class="flex items-center gap-1.5 px-4 py-2 rounded-lg text-xs font-bold text-[#fdf6e3]
                       bg-gradient-to-r from-[#2d4a2d] to-[#3d6b3d] hover:from-[#3d6b3d] hover:to-[#4a824a]
                       shadow-md transition-all active:scale-[0.98]">
                <iconify-icon icon="lucide:plus" class="text-sm"></iconify-icon> Tambah Periode
            </button>
        </div>
        <div id="highseasonList" class="flex flex-col gap-6"></div>
    </div>

    {{-- ── LIBUR LANDEUH ───────────────────────────────────── --}}
    <div class="px-5 sm:px-8 py-6 border-t border-amber-200/40">
        <div class="flex justify-between items-center mb-5">
            <span class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-bold text-white bg-stone-600 shadow-sm">
                Libur Landeuh (Global)
            </span>
            <button onclick="addLiburLandeuh()"
                class="flex items-center gap-1.5 px-4 py-2 rounded-lg text-xs font-bold text-[#fdf6e3]
                       bg-gradient-to-r from-[#2d4a2d] to-[#3d6b3d] hover:from-[#3d6b3d] hover:to-[#4a824a]
                       shadow-md transition-all active:scale-[0.98]">
                <iconify-icon icon="lucide:plus" class="text-sm"></iconify-icon> Tambah Periode Libur
            </button>
        </div>
        <div id="liburLandeuhList" class="flex flex-col gap-6"></div>
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
        ],
        libur_landeuh: [
            @foreach($liburLandeuh as $ll)
            { name: `{!! addslashes($ll->name) !!}`, dates: `{!! addslashes($ll->dates) !!}` },
            @endforeach
        ]
    };

    // ── Date Formatter ──────────────────────────────────────────
    function formatDatesGrouped(datesString) {
        if (!datesString) return '<span class="text-stone-400 italic">Kosong</span>';

        const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        const monthColors = [
            "bg-orange-100 text-orange-800 border-orange-200",   // Jan
            "bg-yellow-100 text-yellow-800 border-yellow-200",   // Feb
            "bg-emerald-100 text-emerald-800 border-emerald-200",// Mar
            "bg-sky-100 text-sky-800 border-sky-200",           // Apr
            "bg-pink-100 text-pink-800 border-pink-200",         // Mei
            "bg-indigo-100 text-indigo-800 border-indigo-200",   // Jun
            "bg-rose-100 text-rose-800 border-rose-200",         // Jul
            "bg-purple-100 text-purple-800 border-purple-200",   // Aug
            "bg-teal-100 text-teal-800 border-teal-200",         // Sep
            "bg-cyan-100 text-cyan-800 border-cyan-200",         // Oct
            "bg-fuchsia-100 text-fuchsia-800 border-fuchsia-200",// Nov
            "bg-blue-100 text-blue-800 border-blue-200"          // Dec
        ];

        let dates = datesString.split(',').map(s => s.trim()).filter(s => s);
        let parsedDates = [];
        let nonDates = [];
        
        dates.forEach(dStr => {
            let parts = dStr.split('-');
            if (parts.length === 3) {
                let y = parseInt(parts[0], 10);
                let m = parseInt(parts[1], 10);
                let d = parseInt(parts[2], 10);
                if (!isNaN(y) && !isNaN(m) && !isNaN(d)) {
                    parsedDates.push({ str: dStr, y: y, m: m, d: d, time: new Date(y, m-1, d).getTime() });
                } else {
                    nonDates.push(dStr);
                }
            } else {
                nonDates.push(dStr);
            }
        });

        let html = '<div class="flex flex-wrap gap-2.5">';
        
        if (nonDates.length > 0) {
            html += `<span class="inline-flex items-baseline px-3 py-1.5 rounded-xl text-sm font-bold border shadow-sm bg-stone-100 text-stone-700 border-stone-200">
                        ${nonDates.join(', ')}
                     </span>`;
        }

        if (parsedDates.length > 0) {
            parsedDates.sort((a, b) => a.time - b.time);

            let groups = {};
            parsedDates.forEach(pd => {
                let key = `${pd.y}-${pd.m}`;
                if (!groups[key]) groups[key] = { y: pd.y, m: pd.m, days: [] };
                if (!groups[key].days.includes(pd.d)) {
                    groups[key].days.push(pd.d);
                }
            });

            for (let key in groups) {
                let g = groups[key];
                g.days.sort((a, b) => a - b);
                let ranges = [];
                let start = g.days[0];
                let end = g.days[0];

                for (let i = 1; i < g.days.length; i++) {
                    if (g.days[i] === end + 1) {
                        end = g.days[i];
                    } else {
                        ranges.push(start === end ? `${start}` : `${start}-${end}`);
                        start = g.days[i];
                        end = g.days[i];
                    }
                }
                ranges.push(start === end ? `${start}` : `${start}-${end}`);

                let monthName = monthNames[g.m - 1];
                let colorClass = monthColors[g.m - 1] || "bg-stone-100 text-stone-700 border-stone-200";

                html += `<span class="inline-flex items-baseline gap-1.5 px-3 py-1.5 rounded-xl text-sm font-bold border shadow-sm ${colorClass}">
                            <span>${monthName} ${ranges.join(', ')}</span>
                            <span class="opacity-70 font-bold text-[11px] tracking-wider">${g.y}</span>
                         </span>`;
            }
        }

        html += '</div>';
        return html;
    }

    // ── Render ──────────────────────────────────────────────────
    function renderAll() {
        document.getElementById('weekdayContent').innerHTML = formatDatesGrouped(TANGGAL_DATA.weekday.dates);
        document.getElementById('weekendContent').innerHTML = formatDatesGrouped(TANGGAL_DATA.weekend.dates);
        renderHighseason();
        renderLiburLandeuh();
    }

    function renderHighseason() {
        const list = document.getElementById('highseasonList');
        list.innerHTML = TANGGAL_DATA.highseason.map((h, i) => `
            <div class="flex flex-col gap-3">
                <div class="flex items-center justify-between">
                    <div class="text-sm font-extrabold text-stone-700 tracking-wide">
                        ${i+1}. ${h.name}
                    </div>
                    <div class="flex items-center gap-2">
                        <button onclick="openEditTanggal('highseason', ${i})"
                            class="w-9 h-9 rounded-lg bg-amber-400 hover:bg-amber-500 text-white flex items-center justify-center transition shadow-sm active:scale-95">
                            <iconify-icon icon="lucide:pencil" class="text-base"></iconify-icon>
                        </button>
                        <button onclick="deleteHighseason(${i})"
                            class="w-9 h-9 rounded-lg bg-red-500 hover:bg-red-600 text-white flex items-center justify-center transition shadow-sm active:scale-95">
                            <iconify-icon icon="lucide:trash-2" class="text-base"></iconify-icon>
                        </button>
                    </div>
                </div>
                <div class="bg-white rounded-xl border border-stone-200 px-5 py-4 text-sm text-stone-700 leading-relaxed border-l-4 border-l-red-500 min-h-[60px]">
                    ${formatDatesGrouped(h.dates)}
                </div>
            </div>
        `).join('');
    }

    function renderLiburLandeuh() {
        const list = document.getElementById('liburLandeuhList');
        if (!list) return;
        list.innerHTML = (TANGGAL_DATA.libur_landeuh || []).map((ll, i) => `
            <div class="flex flex-col gap-3">
                <div class="flex items-center justify-between">
                    <div class="text-sm font-extrabold text-stone-700 tracking-wide">
                        ${i+1}. ${ll.name}
                    </div>
                    <div class="flex items-center gap-2">
                        <button onclick="openEditTanggal('libur_landeuh', ${i})"
                            class="w-9 h-9 rounded-lg bg-amber-400 hover:bg-amber-500 text-white flex items-center justify-center transition shadow-sm active:scale-95">
                            <iconify-icon icon="lucide:pencil" class="text-base"></iconify-icon>
                        </button>
                        <button onclick="deleteLiburLandeuh(${i})"
                            class="w-9 h-9 rounded-lg bg-red-500 hover:bg-red-600 text-white flex items-center justify-center transition shadow-sm active:scale-95">
                            <iconify-icon icon="lucide:trash-2" class="text-base"></iconify-icon>
                        </button>
                    </div>
                </div>
                <div class="bg-white rounded-xl border border-stone-200 px-5 py-4 text-sm text-stone-700 leading-relaxed border-l-4 border-l-stone-500 min-h-[60px]">
                    ${formatDatesGrouped(ll.dates)}
                </div>
            </div>
        `).join('');
    }

    // ── Modal Logic ────────────────────────────────────────────
    function updatePreview() {
        let nonDates = document.getElementById('editTgl_nonDates').value.trim();
        let dates = document.getElementById('editTgl_dates').value.trim();
        let combined = [nonDates, dates].filter(s => s).join(', ');
        document.getElementById('editTgl_preview').innerHTML = formatDatesGrouped(combined);
    }

    document.getElementById('editTgl_nonDates').addEventListener('input', updatePreview);

    window.openEditTanggal = function(key, idx) {
        document.getElementById('editTgl_key').value = key;
        document.getElementById('editTgl_idx').value = idx ?? '';
        const nameWrap = document.getElementById('editTgl_nameWrap');
        const nameInput = document.getElementById('editTgl_name');
        const title = document.getElementById('modalTglTitle');

        let datesStr = '';

        if (key === 'weekday') {
            title.textContent = 'Edit Weekday';
            nameWrap.classList.add('hidden');
            datesStr = TANGGAL_DATA.weekday.dates;
        } else if (key === 'weekend') {
            title.textContent = 'Edit Weekend';
            nameWrap.classList.add('hidden');
            datesStr = TANGGAL_DATA.weekend.dates;
        } else if (key === 'highseason') {
            if (idx === 'new') {
                title.textContent = 'Tambah Highseason';
                nameWrap.classList.remove('hidden');
                nameInput.value = 'Periode Baru';
                datesStr = '';
            } else {
                const h = TANGGAL_DATA.highseason[idx];
                title.textContent = 'Edit Highseason';
                nameWrap.classList.remove('hidden');
                nameInput.value = h.name;
                datesStr = h.dates;
            }
        } else if (key === 'libur_landeuh') {
            if (idx === 'new') {
                title.textContent = 'Tambah Libur Landeuh';
                nameWrap.classList.remove('hidden');
                nameInput.value = 'Libur Lebaran/Tahun Baru';
                datesStr = '';
            } else {
                const ll = TANGGAL_DATA.libur_landeuh[idx];
                title.textContent = 'Edit Libur Landeuh';
                nameWrap.classList.remove('hidden');
                nameInput.value = ll.name;
                datesStr = ll.dates;
            }
        }
        
        let parts = datesStr.split(',').map(s => s.trim()).filter(s => s);
        let datesArr = [];
        let nonDatesArr = [];
        parts.forEach(p => {
            if (/^\d{4}-\d{2}-\d{2}$/.test(p)) datesArr.push(p);
            else nonDatesArr.push(p);
        });
        
        document.getElementById('editTgl_nonDates').value = nonDatesArr.join(', ');
        
        if (window.editFp) window.editFp.destroy();
        window.editFp = flatpickr("#btnOpenKalender", {
            mode: "multiple",
            defaultDate: datesArr,
            position: "auto center",
            onChange: function(selectedDates, dateStr, instance) {
                document.getElementById('editTgl_dates').value = dateStr;
                updatePreview();
            }
        });
        updatePreview();

        document.getElementById('modalEditTanggal').classList.remove('hidden');
    };

    window.closeModalTanggal = function() {
        if (window.editFp) { window.editFp.close(); window.editFp.destroy(); window.editFp = null; }
        document.getElementById('modalEditTanggal').classList.add('hidden');
    };

    let pendingSaveCallback = null;

    window.saveModalTanggal = function() {
        const key = document.getElementById('editTgl_key').value;
        const idx = document.getElementById('editTgl_idx').value;
        
        let nonDates = document.getElementById('editTgl_nonDates').value.trim();
        let pickedDates = document.getElementById('editTgl_dates').value.trim();
        const dates = [nonDates, pickedDates].filter(s => s).join(', ');

        const proceedSave = () => {
            if (key === 'weekday') {
                TANGGAL_DATA.weekday.dates = dates;
            } else if (key === 'weekend') {
                TANGGAL_DATA.weekend.dates = dates;
            } else if (key === 'highseason') {
                const name = document.getElementById('editTgl_name').value.trim();
                if (idx === 'new') {
                    TANGGAL_DATA.highseason.push({ name, dates });
                } else {
                    TANGGAL_DATA.highseason[parseInt(idx)] = { name, dates };
                }
            } else if (key === 'libur_landeuh') {
                const name = document.getElementById('editTgl_name').value.trim();
                if (idx === 'new') {
                    TANGGAL_DATA.libur_landeuh.push({ name, dates });
                } else {
                    TANGGAL_DATA.libur_landeuh[parseInt(idx)] = { name, dates };
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

        if (key === 'libur_landeuh') {
            // Check conflicts
            fetch('/admin/tanggal/check-conflicts', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ dates: dates })
            })
            .then(res => res.json())
            .then(data => {
                if (data.conflicts && data.conflicts.length > 0) {
                    showConflictModal(data.conflicts, dates, proceedSave);
                } else {
                    proceedSave();
                }
            })
            .catch(err => {
                console.error(err);
                alert('Gagal memeriksa konflik pesanan.');
            });
        } else {
            proceedSave();
        }
    };

    // ── Conflict Modal Logic ───────────────────────────────────
    window.showConflictModal = function(conflicts, datesStr, onClearCallback) {
        pendingSaveCallback = onClearCallback;
        window.currentConflictDates = datesStr;

        renderConflictsList(conflicts);

        document.getElementById('modalKonflikTanggal').classList.remove('hidden');
    };

    window.closeConflictModal = function() {
        document.getElementById('modalKonflikTanggal').classList.add('hidden');
        pendingSaveCallback = null;
    };

    window.saveAfterConflictsCleared = function() {
        if (pendingSaveCallback) {
            const cb = pendingSaveCallback;
            closeConflictModal();
            cb();
        }
    };

    function renderConflictsList(conflicts) {
        const container = document.getElementById('conflictList');
        const proceedBtn = document.getElementById('btnForceProceedConflict');
        const countLabel = document.getElementById('conflictCountLabel');

        function fmtDate(d) { if (!d) return d; const p = d.split('-'); return p.length === 3 ? `${p[2]}-${p[1]}-${p[0]}` : d; }

        countLabel.textContent = `Tersisa ${conflicts.length} bentrokan`;

        if (conflicts.length === 0) {
            container.innerHTML = `
                <div class="text-center py-6 text-emerald-600 bg-emerald-50 rounded-2xl border border-emerald-200">
                    <iconify-icon icon="lucide:check-circle" class="text-3xl mb-2"></iconify-icon>
                    <p class="text-sm font-bold">Semua konflik telah terselesaikan!</p>
                    <p class="text-xs text-emerald-700 mt-1">Anda sekarang dapat menerapkan periode libur ini.</p>
                </div>
            `;
            proceedBtn.disabled = false;
            proceedBtn.className = 'px-8 py-2.5 rounded-full text-sm font-bold text-white bg-[#3a523a] hover:bg-[#2c402c] transition-all shadow';
            return;
        }

        proceedBtn.disabled = true;
        proceedBtn.className = 'px-8 py-2.5 rounded-full text-sm font-bold text-white bg-stone-400 cursor-not-allowed transition-all shadow-sm';

        container.innerHTML = conflicts.map(p => {
            const cleanPhone = p.pemesanTelp.replace(/^0/, '62').replace(/[-+\s]/g, '');
            const waMsg = encodeURIComponent(`Halo Kak ${p.pemesanNama}, kami dari Landeuh Village. Mengenai pemesanan Kakak dengan nomor #${p.noPesanan} untuk akomodasi ${p.akomodasi} pada tanggal ${fmtDate(p.checkin)} s.d ${fmtDate(p.checkout)}, kami ingin menginfokan bahwa terdapat agenda libur kawasan pada tanggal tersebut. Apakah boleh kami bantu untuk reschedule ke tanggal alternatif? Terima kasih.`);
            const waUrl = `https://wa.me/${cleanPhone}?text=${waMsg}`;

            return `
                <div class="p-4 rounded-2xl border border-stone-200 bg-stone-50 flex flex-col gap-3">
                    <div class="flex justify-between items-start">
                        <div>
                            <span class="text-[10px] font-bold text-white bg-red-500 px-2 py-0.5 rounded shadow-sm uppercase">${p.noPesanan}</span>
                            <h4 class="text-sm font-bold text-stone-800 mt-1.5">${p.pemesanNama} <span class="font-normal text-xs text-stone-500">(${p.pemesanTelp})</span></h4>
                            <p class="text-xs text-stone-600 mt-1">Unit: <strong>${p.akomodasi}</strong> · Jadwal: <strong>${fmtDate(p.checkin)} &rarr; ${fmtDate(p.checkout)}</strong></p>
                        </div>
                        <div class="flex gap-2">
                            <a href="${waUrl}" target="_blank" class="px-3 py-1.5 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-xs flex items-center gap-1 transition shadow-sm">
                                <iconify-icon icon="lucide:message-square"></iconify-icon> WA
                            </a>
                            <button id="btn-resched-trigger-${p.id}" onclick="initConflictItemReschedule(${p.id}, '${p.checkin}', '${p.checkout}', ${p.accommodation_id}, ${p.corporate_package_id}, ${p.is_corporate})" class="px-3 py-1.5 rounded-xl bg-amber-500 hover:bg-amber-600 text-white font-bold text-xs flex items-center gap-1 transition shadow-sm">
                                <iconify-icon icon="lucide:calendar-range"></iconify-icon> Reschedule
                            </button>
                        </div>
                    </div>
                    
                    <div id="resched-form-${p.id}" class="hidden p-3 rounded-xl bg-white border border-stone-200/80 mt-1 flex flex-col gap-3 animate-[modalIn_0.2s_ease-out]">
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-bold text-stone-600">Pilih Tanggal Baru:</span>
                            <input type="text" id="resched-input-${p.id}" class="hidden">
                            <button type="button" id="btn-dates-picker-${p.id}" class="px-3 py-1.5 border border-stone-300 rounded-lg text-xs font-semibold text-stone-700 bg-stone-50 hover:bg-stone-100 flex items-center gap-1.5 transition">
                                <iconify-icon icon="lucide:calendar"></iconify-icon> Pilih Tanggal Check-in & Check-out
                            </button>
                        </div>
                        <div class="flex justify-end gap-2">
                            <button onclick="document.getElementById('resched-form-${p.id}').classList.add('hidden')" class="px-3 py-1.5 rounded-lg text-xs font-bold bg-stone-100 text-stone-600 hover:bg-stone-200 transition">Batal</button>
                            <button id="btn-resched-save-${p.id}" disabled onclick="saveConflictItemReschedule(${p.id})" class="px-3 py-1.5 rounded-lg text-xs font-bold bg-stone-300 text-stone-500 cursor-not-allowed transition">Simpan Tanggal</button>
                        </div>
                    </div>
                </div>
            `;
        }).join('');
    }

    window.initConflictItemReschedule = function(bookingId, checkin, checkout, accomId, pkgId, isCorp) {
        const startOrig = new Date(checkin);
        const endOrig = new Date(checkout);
        const origNights = Math.round((endOrig - startOrig) / (1000 * 60 * 60 * 24));
        window[`origNights_${bookingId}`] = origNights;

        const form = document.getElementById(`resched-form-${bookingId}`);
        form.classList.toggle('hidden');
        if (form.classList.contains('hidden')) return;

        const input = document.getElementById(`resched-input-${bookingId}`);
        const btn = document.getElementById(`btn-dates-picker-${bookingId}`);
        const saveBtn = document.getElementById(`btn-resched-save-${bookingId}`);

        const targetId = isCorp ? pkgId : accomId;

        fetch(`/reservasi/booked-dates/${targetId}?exclude_booking_id=${bookingId}&is_corporate=${isCorp ? 1 : 0}`)
        .then(res => res.json())
        .then(data => {
            const disabledDates = data.booked_dates || [];

            if (window[`fp_resched_${bookingId}`]) window[`fp_resched_${bookingId}`].destroy();

            window[`fp_resched_${bookingId}`] = flatpickr(input, {
                mode: 'range',
                minDate: 'today',
                positionElement: btn,
                disable: [
                    function(date) {
                        let y = date.getFullYear();
                        let m = String(date.getMonth() + 1).padStart(2, '0');
                        let d = String(date.getDate()).padStart(2, '0');
                        let dateStr = `${y}-${m}-${d}`;

                        const fpInstance = window[`fp_resched_${bookingId}`];
                        const selected = (fpInstance && fpInstance.selectedDates) ? fpInstance.selectedDates : [];

                        if (selected && selected.length === 1) {
                            const start = new Date(selected[0]);
                            start.setHours(0, 0, 0, 0);

                            const cur = new Date(date);
                            cur.setHours(0, 0, 0, 0);

                            if (cur <= start) {
                                return true;
                            }

                            for (let dt = new Date(start); dt < cur; dt.setDate(dt.getDate() + 1)) {
                                let sy = dt.getFullYear();
                                let sm = String(dt.getMonth() + 1).padStart(2, '0');
                                let sd = String(dt.getDate()).padStart(2, '0');
                                let sStr = `${sy}-${sm}-${sd}`;
                                if (disabledDates.includes(sStr)) {
                                    return true;
                                }
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
                            saveBtn.className = 'px-3 py-1.5 rounded-lg text-xs font-bold bg-stone-300 text-stone-500 cursor-not-allowed transition';
                        } else {
                            saveBtn.disabled = false;
                            saveBtn.className = 'px-3 py-1.5 rounded-lg text-xs font-bold bg-green-600 text-white hover:bg-green-700 transition shadow-sm';
                        }
                    } else {
                        saveBtn.disabled = true;
                        saveBtn.className = 'px-3 py-1.5 rounded-lg text-xs font-bold bg-stone-300 text-stone-500 cursor-not-allowed transition';
                    }
                }
            });

            window[`fp_resched_${bookingId}`].jumpToDate(checkin);

            btn.onclick = function(e) {
                e.stopPropagation();
                window[`fp_resched_${bookingId}`].toggle();
            };

            setTimeout(() => {
                window[`fp_resched_${bookingId}`].open();
            }, 50);
        })
        .catch(err => {
            console.error(err);
            alert('Gagal mengambil tanggal ketersediaan.');
        });
    };

    window.saveConflictItemReschedule = function(bookingId) {
        const input = document.getElementById(`resched-input-${bookingId}`);
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

        const saveBtn = document.getElementById(`btn-resched-save-${bookingId}`);
        saveBtn.disabled = true;
        saveBtn.innerHTML = '<iconify-icon icon="lucide:loader-2" class="animate-spin text-sm"></iconify-icon>';

        fetch('/admin/pesanan/force-reschedule', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
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
                recheckConflictsAfterReschedule();
            } else {
                alert('Gagal memindahkan jadwal: ' + data.message);
                saveBtn.disabled = false;
                saveBtn.innerHTML = 'Simpan Tanggal';
            }
        })
        .catch(err => {
            console.error(err);
            alert('Terjadi kesalahan jaringan.');
            saveBtn.disabled = false;
            saveBtn.innerHTML = 'Simpan Tanggal';
        });
    };

    function recheckConflictsAfterReschedule() {
        const dates = window.currentConflictDates;
        fetch('/admin/tanggal/check-conflicts', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ dates: dates })
        })
        .then(res => res.json())
        .then(data => {
            renderConflictsList(data.conflicts);
        })
        .catch(err => {
            console.error(err);
            alert('Gagal menyegarkan daftar bentrokan.');
        });
    }

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

    window.addLiburLandeuh = function() {
        openEditTanggal('libur_landeuh', 'new');
    };

    window.deleteLiburLandeuh = function(idx) {
        if (!confirm('Yakin ingin menghapus periode libur ini?')) return;
        TANGGAL_DATA.libur_landeuh.splice(idx, 1);
        
        // Save to backend
        fetch('/admin/tanggal', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(TANGGAL_DATA)
        }).then(res => res.json()).then(data => {
            renderLiburLandeuh();
            if (typeof showToast === 'function') showToast('Periode libur berhasil dihapus.', 'lucide:trash-2', 'text-red-400');
        });
    };

    // ── Init ───────────────────────────────────────────────────
    renderAll();

    // Pastikan flatpickr tertutup jika di-klik di luarnya
    document.addEventListener('click', function(e) {
        if (window.editFp && window.editFp.isOpen) {
            const btn = document.getElementById('btnOpenKalender');
            const cal = window.editFp.calendarContainer;
            if (btn && cal && !btn.contains(e.target) && !cal.contains(e.target)) {
                window.editFp.close();
            }
        }
    });
})();
</script>
@endpush
@endsection
