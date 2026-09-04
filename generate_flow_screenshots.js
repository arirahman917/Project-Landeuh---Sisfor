import { chromium } from 'playwright-core';
import fs from 'fs';
import path from 'path';

const OUTPUT_DIR = path.resolve('./public/midtrans_flow_doc');

if (!fs.existsSync(OUTPUT_DIR)) {
    fs.mkdirSync(OUTPUT_DIR, { recursive: true });
}

async function run() {
    console.log("=== MEMULAI REKAM CUSTOMER FLOW MIDTRANS ===");
    const browser = await chromium.launch({
        executablePath: 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe',
        headless: false,
        args: ['--disable-blink-features=AutomationControlled', '--start-maximized']
    });

    const context = await browser.newContext({
        viewport: { width: 1366, height: 768 },
        userAgent: 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36'
    });

    const page = await context.newPage();

    // 1. Home Page
    console.log("[1/8] Membuka Home Page https://landeuhvillage.com ...");
    await page.goto('https://landeuhvillage.com', { waitUntil: 'networkidle', timeout: 60000 });
    await page.waitForTimeout(3000);
    await page.screenshot({ path: path.join(OUTPUT_DIR, '01_home_page.png') });
    console.log("-> Screenshot 01_home_page.png tersimpan");

    // 2. Halaman Katalog Akomodasi
    console.log("[2/8] Membuka Katalog Akomodasi https://landeuhvillage.com/akomodasi ...");
    await page.goto('https://landeuhvillage.com/akomodasi', { waitUntil: 'networkidle', timeout: 60000 });
    await page.waitForTimeout(3000);
    await page.screenshot({ path: path.join(OUTPUT_DIR, '02_katalog_akomodasi.png') });
    console.log("-> Screenshot 02_katalog_akomodasi.png tersimpan");

    // 3. Form Overview & Reservasi Cabin 1 (5 Sept - 6 Sept 2026)
    console.log("[3/8] Membuka Form Overview Cabin 1 (Check-in 5 Sept 2026, 1 malam) ...");
    await page.goto('https://landeuhvillage.com/reservasi/overview/1?checkin=2026-09-05&malam=1', { waitUntil: 'networkidle', timeout: 60000 });
    await page.waitForTimeout(2000);

    // Isi data pemesan
    console.log("Mengisi formulir data tamu...");
    await page.fill('#namaLengkap', 'Ari Rahman');
    await page.fill('#noHp', '085795016378');
    await page.fill('#email', 'arryrahmand5@gmail.com');

    // Checklist Untuk Saya Sendiri
    const chkSaya = await page.$('#chkUntukSaya');
    if (chkSaya) {
        const isChecked = await chkSaya.isChecked();
        if (!isChecked) await chkSaya.check();
    }

    // Checklist Kebijakan Reservasi
    const chkKebijakan = await page.$('#chkKebijakan');
    if (chkKebijakan) {
        await chkKebijakan.check();
    }

    await page.waitForTimeout(1500);
    await page.screenshot({ path: path.join(OUTPUT_DIR, '03_detail_reservasi_tamu.png') });
    console.log("-> Screenshot 03_detail_reservasi_tamu.png tersimpan");

    // 4. Lanjut ke Pembayaran
    console.log("[4/8] Mengklik 'Lanjutkan ke Pembayaran' ...");
    await page.click('#btnLanjutkan');

    // Tunggu navigasi ke halaman metode pembayaran
    await page.waitForURL(url => url.pathname.includes('/reservasi/metode-pembayaran'), { timeout: 30000 });
    await page.waitForTimeout(2000);

    // Pilih BCA Virtual Account
    console.log("Memilih metode BCA Virtual Account...");
    // Buka accordion virtual account jika belum terbuka
    const vaHeader = await page.$('#row-va .pay-method-header');
    if (vaHeader) {
        const isOpen = await page.$eval('#row-va', el => el.classList.contains('open'));
        if (!isOpen) {
            await vaHeader.click();
            await page.waitForTimeout(500);
        }
    }
    
    // Klik radio BCA Virtual Account
    const radioBca = await page.$('#radio-bca-virtual-account');
    if (radioBca) {
        await radioBca.click();
    }
    await page.waitForTimeout(1000);

    await page.screenshot({ path: path.join(OUTPUT_DIR, '04_pilih_metode_pembayaran.png') });
    console.log("-> Screenshot 04_pilih_metode_pembayaran.png tersimpan");

    // 5. Klik Bayar & Buka Popup Midtrans Snap
    console.log("[5/8] Mengklik tombol 'Bayar' untuk memunculkan Midtrans Snap...");
    await page.click('.pay-btn');

    // Tunggu iframe Snap muncul di DOM
    await page.waitForSelector('#snap-midtrans', { timeout: 30000 });
    await page.waitForTimeout(4000); // beri waktu iframe snap merender isinya

    await page.screenshot({ path: path.join(OUTPUT_DIR, '05_midtrans_snap_popup.png') });
    console.log("-> Screenshot 05_midtrans_snap_popup.png tersimpan");

    // 6. Di dalam Snap Frame: Klik BCA Virtual Account untuk memunculkan Nomor VA
    console.log("[6/8] Membuka rincian VA di dalam popup Midtrans Snap...");
    const snapFrame = page.frameLocator('#snap-midtrans');
    
    // Klik BCA virtual account di dalam iframe snap
    try {
        const bcaBtn = snapFrame.locator('text=BCA virtual account').first();
        await bcaBtn.waitFor({ timeout: 10000 });
        await bcaBtn.click();
        await page.waitForTimeout(3000);
    } catch (e) {
        console.log("Catatan: Mencoba selector alternatif di Snap iframe:", e.message);
        try {
            await snapFrame.locator('.payment-page-item, [href*="bca_va"]').first().click();
            await page.waitForTimeout(3000);
        } catch (e2) {}
    }

    await page.screenshot({ path: path.join(OUTPUT_DIR, '06_midtrans_bca_va_detail.png') });
    console.log("-> Screenshot 06_midtrans_bca_va_detail.png tersimpan");

    // Ekstrak nomor VA dari dalam frame jika ada
    let vaNumber = '';
    try {
        const vaTextEl = snapFrame.locator('#va-number, .va-number, [data-testid="va-number"]').first();
        if (await vaTextEl.count() > 0) {
            vaNumber = (await vaTextEl.innerText()).trim();
        } else {
            // fallback cari angka berurutan di dalam teks frame
            const bodyText = await snapFrame.locator('body').innerText();
            const match = bodyText.match(/(\d{10,20})/);
            if (match) vaNumber = match[1];
        }
    } catch (e) {
        console.log("Gagal membaca nomor VA otomatis:", e.message);
    }
    console.log("Nomor Virtual Account yang didapat:", vaNumber);

    // Ambil Booking No dari URL atau sessionStorage
    const bookingNo = await page.evaluate(() => sessionStorage.getItem('res_booking_no') || '');
    console.log("Booking No:", bookingNo);

    // 7. Buka Midtrans Simulator di tab baru
    let simSuccess = false;
    if (vaNumber) {
        console.log("[7/8] Membuka Midtrans Simulator BCA VA https://simulator.sandbox.midtrans.com/bca/va/index ...");
        const simPage = await context.newPage();
        await simPage.goto('https://simulator.sandbox.midtrans.com/bca/va/index', { waitUntil: 'networkidle', timeout: 30000 });
        await simPage.fill('#inputMerchantId', vaNumber);
        await simPage.waitForTimeout(1000);
        await simPage.click('input[value="Inquire"]');
        await simPage.waitForTimeout(3000);

        await simPage.screenshot({ path: path.join(OUTPUT_DIR, '07_simulator_inquiry.png') });
        console.log("-> Screenshot 07_simulator_inquiry.png tersimpan");

        // Klik Pay
        console.log("Mengklik 'Pay' di simulator...");
        const payBtn = await simPage.$('input[value="Pay"]');
        if (payBtn) {
            await payBtn.click();
            await simPage.waitForTimeout(3000);
            await simPage.screenshot({ path: path.join(OUTPUT_DIR, '08_simulator_payment_success.png') });
            console.log("-> Screenshot 08_simulator_payment_success.png tersimpan");
            simSuccess = true;
        }
        await simPage.close();
    } else {
        console.log("Nomor VA tidak terdeteksi otomatis, mengambil screenshot simulator template...");
        const simPage = await context.newPage();
        await simPage.goto('https://simulator.sandbox.midtrans.com/bca/va/index', { waitUntil: 'networkidle', timeout: 30000 });
        await simPage.screenshot({ path: path.join(OUTPUT_DIR, '07_simulator_inquiry.png') });
        await simPage.close();
    }

    // 8. Beralih ke Halaman Konfirmasi Sukses
    console.log("[8/8] Membuka Halaman Konfirmasi Pembayaran Berhasil ...");
    const confirmUrl = `https://landeuhvillage.com/reservasi/konfirmasi?booking_no=${bookingNo}&status=success`;
    await page.goto(confirmUrl, { waitUntil: 'networkidle', timeout: 60000 });
    await page.waitForTimeout(3000);

    await page.screenshot({ path: path.join(OUTPUT_DIR, '09_konfirmasi_sukses.png') });
    console.log("-> Screenshot 09_konfirmasi_sukses.png tersimpan");

    await browser.close();
    console.log("=== SEMUA SCREENSHOT BERHASIL DIAMBIL ===");
}

run().catch(err => {
    console.error("Terjadi error saat menjalankan skrip:", err);
    process.exit(1);
});
