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
            "2026-01-01", // Tahun Baru Masehi
            "2026-02-17", // Idul Fitri (Estimasi)
            "2026-02-18", // Idul Fitri (Estimasi)
            "2026-03-20", // Nyepi
            "2026-04-03", // Wafat Isa Almasih
            "2026-05-01", // Hari Buruh
            "2026-05-14", // Kenaikan Isa Almasih
            "2026-05-31", // Waisak
            "2026-06-01", // Hari Lahir Pancasila
            "2026-08-17", // Hari Kemerdekaan RI
            "2026-12-25", // Hari Raya Natal
        ];

        const fp = flatpickr(dateInput, {
            mode: 'range',
            minDate: 'today',
            dateFormat: 'D, d M Y',
            showMonths: 2, // Always render 2 months, CSS will handle vertical stacking on mobile
            locale: 'id', // Indonesian localization
            closeOnSelect: false, // Jangan tutup otomatis setelah pilih range
            defaultDate: [new Date(), new Date(new Date().getTime() + 24 * 60 * 60 * 1000)], // Today to Tomorrow
            onChange: function(selectedDates, dateStr, instance) {
                // Jika sudah pilih check-out (2 tanggal terpilih), tunggu 890 milidetik lalu tutup
                if (selectedDates.length === 2) {
                    setTimeout(() => {
                        // Pastikan masih ada 2 tanggal (user tidak klik lagi)
                        if (instance.selectedDates.length === 2 && instance.isOpen) {
                            instance.close();
                        }
                    }, 290);
                }
            },
            onDayCreate: function(dObj, dStr, fp, dayElem) {
                const date = dayElem.dateObj;
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                const formattedDate = `${year}-${month}-${day}`;

                // Cek apakah tanggal di masa lampau
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                const isPast = date < today;

                // Tanggal Merah: Warnai hari Minggu dan Hari Libur menjadi merah
                if (date.getDay() === 0 || liburNasional.includes(formattedDate)) {
                    dayElem.style.color = '#e53e3e'; // Merah kuat (menimpa default CSS)
                    dayElem.style.fontWeight = '800';
                    
                    if (isPast) {
                        dayElem.style.opacity = '0.35'; // Lebih transparan untuk tanggal lampau
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
