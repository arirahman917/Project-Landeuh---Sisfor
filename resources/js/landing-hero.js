document.addEventListener('DOMContentLoaded', () => {
    // Only run this script on the landing/home page (where the hero carousel exists)
    if (!document.getElementById('hero-carousel')) {
        return;
    }

    // 1. Carousel Logic
    const slides = document.querySelectorAll('.slide-item');
    if (slides.length > 0) {
        let currentSlide = 0;
        setInterval(() => {
            slides[currentSlide].classList.remove('opacity-100');
            slides[currentSlide].classList.add('opacity-0');
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].classList.remove('opacity-0');
            slides[currentSlide].classList.add('opacity-100');
        }, 5000); // Change every 5 seconds
    }

    // ---------------------------------------------------------
    // Flatpickr Date Range Picker Initialization
    // ---------------------------------------------------------
    const dateInput = document.getElementById('dateRangePicker');
    if (dateInput) {
        // Daftar contoh hari libur nasional 2026
        const liburNasional = [
            "2026-01-01", "2026-02-17", "2026-02-18", "2026-03-20",
            "2026-04-03", "2026-05-01", "2026-05-14", "2026-05-31",
            "2026-06-01", "2026-08-17", "2026-12-25",
        ];

        // Helper: update check-in / check-out footer inside the calendar popup
        function updateHeroFpFooter(instance, selectedDates) {
            if (!instance || !instance.calendarContainer) return;
            let footer = instance.calendarContainer.querySelector('.fp-custom-footer');
            if (!footer) {
                footer = document.createElement('div');
                footer.className = 'fp-custom-footer';
                footer.style.cssText = 'padding: 8px 12px; background: #f8fafc; border-top: 1px solid #e2e8f0; font-size: 11px; color: #334155; font-weight: 600; display: flex; align-items: center; justify-content: space-between; gap: 8px; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; width: 100%; box-sizing: border-box;';
                footer.innerHTML = `
                    <div style="display:flex; align-items:center; gap:4px;"><span style="color:#059669; font-weight:700;">Check-in:</span> <span class="fp-in-val" style="color:#0f172a; font-weight:700;">Belum dipilih</span></div>
                    <div style="display:flex; align-items:center; gap:4px;"><span style="color:#d97706; font-weight:700;">Check-out:</span> <span class="fp-out-val" style="color:#0f172a; font-weight:700;">Belum dipilih</span></div>
                `;
                instance.calendarContainer.appendChild(footer);
            }
            const inVal = footer.querySelector('.fp-in-val');
            const outVal = footer.querySelector('.fp-out-val');
            const fmtFull = { weekday: 'short', day: 'numeric', month: 'short', year: 'numeric' };

            if (!selectedDates || selectedDates.length === 0) {
                if (inVal) inVal.innerText = 'Belum dipilih';
                if (outVal) outVal.innerText = 'Belum dipilih';
            } else if (selectedDates.length === 1) {
                if (inVal) inVal.innerText = selectedDates[0].toLocaleDateString('id-ID', fmtFull);
                if (outVal) outVal.innerText = 'Pilih Check-out';

                // Highlight check-in date as blue circle
                setTimeout(() => {
                    const days = instance.calendarContainer.querySelectorAll('.flatpickr-day');
                    days.forEach(day => {
                        if (day.dateObj) {
                            const dObj = new Date(day.dateObj); dObj.setHours(0,0,0,0);
                            const sObj = new Date(selectedDates[0]); sObj.setHours(0,0,0,0);
                            if (dObj.getTime() === sObj.getTime()) {
                                day.classList.add('selected', 'startRange');
                                day.style.setProperty('background-color', '#2563eb', 'important');
                                day.style.setProperty('color', '#ffffff', 'important');
                                day.style.setProperty('border-radius', '50%', 'important');
                            }
                        }
                    });
                }, 0);
            } else if (selectedDates.length === 2) {
                if (inVal) inVal.innerText = selectedDates[0].toLocaleDateString('id-ID', fmtFull);
                if (outVal) outVal.innerText = selectedDates[1].toLocaleDateString('id-ID', fmtFull);
            }
        }

        // Format display text for the input field
        function fmtInputDisplay(dates) {
            if (!dates || dates.length === 0) return '';
            const fmt = { weekday: 'short', day: 'numeric', month: 'short', year: 'numeric' };
            if (dates.length === 1) {
                return dates[0].toLocaleDateString('id-ID', fmt);
            }
            return dates[0].toLocaleDateString('id-ID', fmt) + ' - ' + dates[1].toLocaleDateString('id-ID', fmt);
        }

        const fp = flatpickr(dateInput, {
            mode: 'range',
            minDate: 'today',
            dateFormat: 'D, d M Y',
            showMonths: 2,
            locale: 'id',
            closeOnSelect: false,
            defaultDate: [new Date(), new Date(new Date().getTime() + 24 * 60 * 60 * 1000)],
            onReady: function(selectedDates, dateStr, instance) {
                updateHeroFpFooter(instance, selectedDates);
                if (selectedDates.length === 2) {
                    dateInput.value = fmtInputDisplay(selectedDates);
                }
            },
            onOpen: function(selectedDates, dateStr, instance) {
                updateHeroFpFooter(instance, selectedDates);
            },
            onChange: function(selectedDates, dateStr, instance) {
                updateHeroFpFooter(instance, selectedDates);

                if (selectedDates.length === 1) {
                    dateInput.value = fmtInputDisplay(selectedDates);
                } else if (selectedDates.length === 2) {
                    dateInput.value = fmtInputDisplay(selectedDates);
                    setTimeout(() => {
                        if (instance.selectedDates.length === 2 && instance.isOpen) {
                            instance.close();
                        }
                    }, 300);
                }
            },
            onDayCreate: function(dObj, dStr, fp, dayElem) {
                const date = dayElem.dateObj;
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                const formattedDate = `${year}-${month}-${day}`;

                const today = new Date();
                today.setHours(0, 0, 0, 0);
                const isPast = date < today;

                if (date.getDay() === 0 || liburNasional.includes(formattedDate)) {
                    dayElem.style.color = '#e53e3e';
                    dayElem.style.fontWeight = '800';
                    if (isPast) {
                        dayElem.style.opacity = '0.35';
                    }
                }
            }
        });

        // Safe force close for Flatpickr range mode
        document.addEventListener('mousedown', (e) => {
            if (fp.isOpen && fp.calendarContainer) {
                const isInsideCalendar = fp.calendarContainer.contains(e.target);
                const isInsideInput = dateInput.contains(e.target) || e.target === dateInput;
                const wrapper = dateInput.closest('.relative');
                const isInsideWrapper = wrapper ? wrapper.contains(e.target) : false;

                if (!isInsideCalendar && !isInsideInput && !isInsideWrapper) {
                    fp.close();
                }
            }
        });
    }

    // ---------------------------------------------------------
    // Custom Dropdown Logic (Akomodasi & Guest Picker)
    // ---------------------------------------------------------
    
    // Elements - Akomodasi
    const akomodasiContainer = document.getElementById('akomodasiPickerContainer');
    const akomodasiTrigger = document.getElementById('akomodasiPickerTrigger');
    const akomodasiDropdown = document.getElementById('akomodasiPickerDropdown');
    const akomodasiLabel = document.getElementById('akomodasiPickerLabel');
    const akomodasiInput = document.getElementById('jenisAkomodasiInput');
    const akomodasiChevron = document.getElementById('akomodasiPickerChevron');
    const akomodasiOptions = document.querySelectorAll('.akomodasi-opt');

    if (akomodasiTrigger && akomodasiDropdown && akomodasiContainer) {
        // Toggle Dropdown Smoothly
        akomodasiTrigger.addEventListener('click', () => {
            akomodasiDropdown.classList.toggle('opacity-0');
            akomodasiDropdown.classList.toggle('invisible');
            akomodasiDropdown.classList.toggle('translate-y-[-10px]');
            akomodasiChevron.classList.toggle('rotate-180');
        });

        // Option Selection
        akomodasiOptions.forEach(option => {
            option.addEventListener('click', (e) => {
                const value = e.target.getAttribute('data-value');
                akomodasiLabel.textContent = value;
                akomodasiInput.value = value;

                // Close Dropdown
                akomodasiDropdown.classList.add('opacity-0', 'invisible', 'translate-y-[-10px]');
                akomodasiChevron.classList.remove('rotate-180');
            });
        });

        // Close when clicking outside
        document.addEventListener('click', (e) => {
            if (!akomodasiContainer.contains(e.target)) {
                akomodasiDropdown.classList.add('opacity-0', 'invisible', 'translate-y-[-10px]');
                akomodasiChevron.classList.remove('rotate-180');
            }
        });
    }

    // 4. Guest Picker Logic
    const guestPickerContainer = document.getElementById('guestPickerContainer');
    const guestPickerTrigger = document.getElementById('guestPickerTrigger');
    const guestPickerDropdown = document.getElementById('guestPickerDropdown');
    const guestPickerChevron = document.getElementById('guestPickerChevron');
    const guestPickerLabel = document.getElementById('guestPickerLabel');
    const btnSelesaiGuest = document.getElementById('btnSelesaiGuest');

    if (guestPickerTrigger && guestPickerDropdown && guestPickerContainer) {
        // State
        let dewasa = 2; 

        const valDewasa = document.getElementById('valDewasa');
        
        // Ensure UI matches state on load
        if(valDewasa) valDewasa.textContent = dewasa;
        
        const btnDecDewasa = document.getElementById('btnDecDewasa');
        const btnIncDewasa = document.getElementById('btnIncDewasa');

        const updateLabel = () => {
            // Format: X Tamu
            let labelText = `${dewasa} Tamu`;
            if (guestPickerLabel) guestPickerLabel.textContent = labelText;
            
            // Handle disabled states
            if (btnDecDewasa) btnDecDewasa.disabled = dewasa <= 1;
        };

        // Toggle Dropdown Smoothly
        guestPickerTrigger.addEventListener('click', () => {
            guestPickerDropdown.classList.toggle('opacity-0');
            guestPickerDropdown.classList.toggle('invisible');
            guestPickerDropdown.classList.toggle('translate-y-[-10px]');
            if (guestPickerChevron) guestPickerChevron.classList.toggle('rotate-180');
        });

        // Event Listeners for Counters
        if (btnIncDewasa && valDewasa) {
            btnIncDewasa.addEventListener('click', (e) => { e.stopPropagation(); dewasa++; valDewasa.textContent = dewasa; updateLabel(); });
        }
        if (btnDecDewasa && valDewasa) {
            btnDecDewasa.addEventListener('click', (e) => { e.stopPropagation(); if(dewasa > 1) { dewasa--; valDewasa.textContent = dewasa; updateLabel(); } });
        }

        // Close on "Selesai"
        if (btnSelesaiGuest) {
            btnSelesaiGuest.addEventListener('click', () => {
                guestPickerDropdown.classList.add('opacity-0', 'invisible', 'translate-y-[-10px]');
                if (guestPickerChevron) guestPickerChevron.classList.remove('rotate-180');
            });
        }

        // Close when clicking outside
        document.addEventListener('click', (e) => {
            if (!guestPickerContainer.contains(e.target)) {
                guestPickerDropdown.classList.add('opacity-0', 'invisible', 'translate-y-[-10px]');
                if (guestPickerChevron) guestPickerChevron.classList.remove('rotate-180');
            }
        });

        // Initialize
        updateLabel();
    }
});
