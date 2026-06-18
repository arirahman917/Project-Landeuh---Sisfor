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
        } else {
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

    window.saveModalTanggal = function() {
        const key = document.getElementById('editTgl_key').value;
        const idx = document.getElementById('editTgl_idx').value;
        
        let nonDates = document.getElementById('editTgl_nonDates').value.trim();
        let pickedDates = document.getElementById('editTgl_dates').value.trim();
        const dates = [nonDates, pickedDates].filter(s => s).join(', ');

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
