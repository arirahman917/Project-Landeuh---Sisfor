import { chromium } from 'playwright-core';
import fs from 'fs';
import path from 'path';

const ASSETS_DIR = path.resolve('./public/midtrans_flow_doc');
const PDF_OUTPUT = path.resolve('./Dokumen_Customer_Flow_Midtrans_LandeuhVillage.pdf');
const PUBLIC_PDF = path.resolve('./public/Dokumen_Customer_Flow_Midtrans_LandeuhVillage.pdf');

function getBase64(filePath) {
    if (!fs.existsSync(filePath)) return '';
    const ext = path.extname(filePath).replace('.', '');
    const data = fs.readFileSync(filePath).toString('base64');
    return `data:image/${ext};base64,${data}`;
}

const logoBase64 = getBase64(path.resolve('./public/images/logo-landeuh.png'));
const img01 = getBase64(path.join(ASSETS_DIR, '01_home_page.png'));
const img02 = getBase64(path.join(ASSETS_DIR, '02_katalog_akomodasi.png'));
const img03 = getBase64(path.join(ASSETS_DIR, '03_detail_reservasi_tamu.png'));
const img04 = getBase64(path.join(ASSETS_DIR, '04_pilih_metode_pembayaran.png'));
const img05 = getBase64(path.join(ASSETS_DIR, '05_midtrans_snap_popup.png'));
const img06 = getBase64(path.join(ASSETS_DIR, '06_midtrans_bca_va_detail.png'));
const img07 = getBase64(path.join(ASSETS_DIR, '07_simulator_inquiry.png'));
const img08 = getBase64(path.join(ASSETS_DIR, '08_simulator_payment_success.png'));
const img09 = getBase64(path.join(ASSETS_DIR, '09_konfirmasi_sukses.png'));

const htmlContent = `<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Customer Flow Transaksi - Landeuh Village Riverside (Midtrans Integration)</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1f2937;
            background: #ffffff;
            font-size: 9pt;
            line-height: 1.5;
        }

        @page {
            size: A4 portrait;
            margin: 10mm 12mm 12mm 12mm;
        }

        .page {
            page-break-after: always;
            position: relative;
            padding-bottom: 10px;
        }

        .page:last-child {
            page-break-after: avoid;
        }

        /* Header Bar */
        .doc-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid #2e4a32;
            padding-bottom: 8px;
            margin-bottom: 14px;
        }

        .doc-header-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .doc-header-left img {
            height: 38px;
            object-fit: contain;
        }

        .doc-header-titles h1 {
            font-size: 13pt;
            font-weight: 800;
            color: #2e4a32;
            letter-spacing: -0.3px;
        }

        .doc-header-titles p {
            font-size: 8pt;
            color: #6b7280;
            font-weight: 600;
        }

        .doc-header-badge {
            background: #eef7ee;
            border: 1px solid #c2e0c6;
            color: #2e4a32;
            padding: 4px 10px;
            border-radius: 9999px;
            font-size: 7.5pt;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Metadata Banner */
        .meta-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 8px;
            background: #fdfaf3;
            border: 1px solid #ebdcc5;
            border-radius: 8px;
            padding: 10px 12px;
            margin-bottom: 14px;
        }

        .meta-item {
            display: flex;
            flex-direction: column;
        }

        .meta-item .label {
            font-size: 7pt;
            color: #78716c;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.3px;
        }

        .meta-item .val {
            font-size: 8.5pt;
            color: #292524;
            font-weight: 700;
            margin-top: 2px;
        }

        /* Flow Overview Steps */
        .flow-stepper {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 6px;
            margin-bottom: 14px;
        }

        .flow-step-box {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 8px 10px;
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }

        .step-num-badge {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #2e4a32;
            color: #ffffff;
            font-size: 8pt;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .step-info .step-title {
            font-size: 7.8pt;
            font-weight: 700;
            color: #1f2937;
        }

        .step-info .step-sub {
            font-size: 6.8pt;
            color: #6b7280;
        }

        /* Step Card Container */
        .step-card {
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            background: #ffffff;
            padding: 12px 14px;
            margin-bottom: 12px;
            page-break-inside: avoid;
        }

        .step-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 8px;
            border-bottom: 1px solid #f3f4f6;
            padding-bottom: 6px;
        }

        .step-tag-wrapper {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .step-pill {
            background: #2e4a32;
            color: #ffffff;
            font-size: 7.5pt;
            font-weight: 800;
            padding: 2px 8px;
            border-radius: 4px;
        }

        .step-name {
            font-size: 10pt;
            font-weight: 800;
            color: #111827;
        }

        .step-url {
            font-size: 7pt;
            color: #4b5563;
            background: #f3f4f6;
            padding: 2px 8px;
            border-radius: 4px;
            font-family: monospace;
        }

        .step-desc-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 8px;
            font-size: 8pt;
        }

        .desc-col strong {
            color: #2e4a32;
            display: inline-block;
            margin-bottom: 2px;
        }

        .desc-col p, .desc-col ul {
            color: #374151;
        }

        .desc-col ul {
            margin-left: 14px;
            margin-top: 2px;
        }

        .step-img-box {
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            overflow: hidden;
            background: #f9fafb;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            text-align: center;
        }

        .step-img-box img {
            width: 100%;
            max-height: 275px;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }

        /* Two Image Layout for related steps */
        .two-img-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .two-img-grid .step-img-box img {
            max-height: 230px;
        }

        .img-caption {
            font-size: 6.8pt;
            color: #6b7280;
            padding: 3px 6px;
            background: #f3f4f6;
            border-top: 1px solid #e5e7eb;
            font-weight: 600;
        }

        /* Summary Table */
        .summary-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 7.5pt;
            margin-top: 10px;
            margin-bottom: 12px;
        }

        .summary-table th {
            background: #2e4a32;
            color: #ffffff;
            font-weight: 700;
            padding: 6px 8px;
            text-align: left;
        }

        .summary-table td {
            padding: 6px 8px;
            border-bottom: 1px solid #e5e7eb;
            color: #374151;
        }

        .summary-table tr:nth-child(even) {
            background: #f9fafb;
        }

        .badge-success {
            background: #dcfce7;
            color: #15803d;
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: 700;
            font-size: 6.8pt;
            display: inline-block;
        }

        .badge-info {
            background: #e0f2fe;
            color: #0369a1;
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: 700;
            font-size: 6.8pt;
            display: inline-block;
        }

        /* Footer */
        .doc-footer {
            margin-top: 12px;
            padding-top: 8px;
            border-top: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 7pt;
            color: #9ca3af;
        }
    </style>
</head>
<body>

    <!-- ==================== PAGE 1 ==================== -->
    <div class="page">
        <div class="doc-header">
            <div class="doc-header-left">
                ${logoBase64 ? `<img src="${logoBase64}" alt="Logo">` : ''}
                <div class="doc-header-titles">
                    <h1>DOKUMEN FLOW TRANSAKSI (CUSTOMER JOURNEY)</h1>
                    <p>Integrasi Payment Gateway Midtrans Snap &bull; Landeuh Village Riverside</p>
                </div>
            </div>
            <div class="doc-header-badge">Sandbox Verification</div>
        </div>

        <div class="meta-grid">
            <div class="meta-item">
                <span class="label">Nama Merchant</span>
                <span class="val">Landeuh Village Riverside</span>
            </div>
            <div class="meta-item">
                <span class="label">Website Live</span>
                <span class="val">landeuhvillage.com</span>
            </div>
            <div class="meta-item">
                <span class="label">Metode Pembayaran</span>
                <span class="val">BCA Virtual Account</span>
            </div>
            <div class="meta-item">
                <span class="label">Simulasi Unit / Total</span>
                <span class="val">Cabin 1 &bull; IDR 1.600.000</span>
            </div>
        </div>

        <div class="flow-stepper">
            <div class="flow-step-box">
                <div class="step-num-badge">1</div>
                <div class="step-info">
                    <div class="step-title">Buka Website</div>
                    <div class="step-sub">Home & Katalog Unit</div>
                </div>
            </div>
            <div class="flow-step-box">
                <div class="step-num-badge">2</div>
                <div class="step-info">
                    <div class="step-title">Reservasi Unit</div>
                    <div class="step-sub">Data Tamu & Tanggal</div>
                </div>
            </div>
            <div class="flow-step-box">
                <div class="step-num-badge">3</div>
                <div class="step-info">
                    <div class="step-title">Midtrans Snap</div>
                    <div class="step-sub">Popup & Nomor VA</div>
                </div>
            </div>
            <div class="flow-step-box">
                <div class="step-num-badge">4</div>
                <div class="step-info">
                    <div class="step-title">Pembayaran Sukses</div>
                    <div class="step-sub">Simulator & E-Ticket</div>
                </div>
            </div>
        </div>

        <!-- STEP 1 -->
        <div class="step-card">
            <div class="step-card-header">
                <div class="step-tag-wrapper">
                    <span class="step-pill">LANGKAH 1</span>
                    <span class="step-name">Mengakses Halaman Utama (Home Page)</span>
                </div>
                <span class="step-url">https://landeuhvillage.com</span>
            </div>
            <div class="step-desc-grid">
                <div class="desc-col">
                    <strong>Aksi Pelanggan (Customer Action):</strong>
                    <p>Pelanggan membuka alamat website resmi <code>landeuhvillage.com</code> melalui peramban (browser). Pengguna dapat melihat informasi penginapan, navigasi menu, dan bilah pencarian ketersediaan kamar.</p>
                </div>
                <div class="desc-col">
                    <strong>Tampilan Sistem (System Output):</strong>
                    <p>Website menampilkan <i>hero section</i> Landeuh Village Riverside, filter pencarian tanggal menginap, serta menu navigasi menuju katalog Akomodasi.</p>
                </div>
            </div>
            <div class="step-img-box">
                <img src="${img01}" alt="Home Page">
                <div class="img-caption">Gambar 1: Tampilan Halaman Beranda (Home Page) landeuhvillage.com</div>
            </div>
        </div>

        <div class="doc-footer">
            <span>Dokumen Verifikasi Payment Gateway Midtrans &bull; Landeuh Village Riverside</span>
            <span>Halaman 1 dari 4</span>
        </div>
    </div>

    <!-- ==================== PAGE 2 ==================== -->
    <div class="page">
        <div class="doc-header">
            <div class="doc-header-left">
                ${logoBase64 ? `<img src="${logoBase64}" alt="Logo">` : ''}
                <div class="doc-header-titles">
                    <h1>PROSES PEMILIHAN AKOMODASI & DATA TAMU</h1>
                    <p>Langkah 2 & 3: Katalog Unit hingga Formulir Pemesanan</p>
                </div>
            </div>
            <div class="doc-header-badge">Booking Flow</div>
        </div>

        <!-- STEP 2 -->
        <div class="step-card">
            <div class="step-card-header">
                <div class="step-tag-wrapper">
                    <span class="step-pill">LANGKAH 2</span>
                    <span class="step-name">Memilih Unit Akomodasi (Cabin 1)</span>
                </div>
                <span class="step-url">https://landeuhvillage.com/akomodasi</span>
            </div>
            <div class="step-desc-grid">
                <div class="desc-col">
                    <strong>Aksi Pelanggan:</strong>
                    <p>Pelanggan memilih menu "Akomodasi" untuk melihat daftar kamar yang tersedia, kemudian memilih unit <strong>Cabin 1</strong>.</p>
                </div>
                <div class="desc-col">
                    <strong>Tampilan Sistem:</strong>
                    <p>Menampilkan foto unit, kapasitas (maks. 4 dewasa), fasilitas kamar, harga sewa (IDR 1.600.000 untuk Weekend), dan tombol reservasi.</p>
                </div>
            </div>
            <div class="step-img-box">
                <img src="${img02}" alt="Katalog Akomodasi">
                <div class="img-caption">Gambar 2: Halaman Katalog Akomodasi menampilkan unit Cabin 1</div>
            </div>
        </div>

        <!-- STEP 3 -->
        <div class="step-card">
            <div class="step-card-header">
                <div class="step-tag-wrapper">
                    <span class="step-pill">LANGKAH 3</span>
                    <span class="step-name">Mengisi Data Tamu & Verifikasi Tanggal Menginap</span>
                </div>
                <span class="step-url">https://landeuhvillage.com/reservasi/overview/1?checkin=2026-09-05&malam=1</span>
            </div>
            <div class="step-desc-grid">
                <div class="desc-col">
                    <strong>Aksi Pelanggan:</strong>
                    <ul>
                        <li>Memilih tanggal: Check-in <strong>5 Sept 2026</strong> & Check-out <strong>6 Sept 2026</strong> (1 malam).</li>
                        <li>Mengisi Nama Lengkap (Ari Rahman), WhatsApp (085795016378), dan Email.</li>
                        <li>Menyetujui Kebijakan Reservasi, lalu klik <strong>"Lanjutkan"</strong>.</li>
                    </ul>
                </div>
                <div class="desc-col">
                    <strong>Tampilan Sistem:</strong>
                    <p>Sistem memvalidasi ketersediaan slot unit di database, mengunci harga total IDR 1.600.000, serta membuat nomor pemesanan baru (No. Pesanan).</p>
                </div>
            </div>
            <div class="step-img-box">
                <img src="${img03}" alt="Form Data Tamu">
                <div class="img-caption">Gambar 3: Formulir Pengisian Identitas Tamu & Rincian Harga Reservasi</div>
            </div>
        </div>

        <div class="doc-footer">
            <span>Dokumen Verifikasi Payment Gateway Midtrans &bull; Landeuh Village Riverside</span>
            <span>Halaman 2 dari 4</span>
        </div>
    </div>

    <!-- ==================== PAGE 3 ==================== -->
    <div class="page">
        <div class="doc-header">
            <div class="doc-header-left">
                ${logoBase64 ? `<img src="${logoBase64}" alt="Logo">` : ''}
                <div class="doc-header-titles">
                    <h1>INTEGRASI MIDTRANS SNAP (PAYMENT MODAL)</h1>
                    <p>Langkah 4, 5, & 6: Pemilihan Metode Pembayaran & Popup Snap</p>
                </div>
            </div>
            <div class="doc-header-badge">Midtrans Snap</div>
        </div>

        <!-- STEP 4 -->
        <div class="step-card">
            <div class="step-card-header">
                <div class="step-tag-wrapper">
                    <span class="step-pill">LANGKAH 4</span>
                    <span class="step-name">Memilih Metode Pembayaran di Website</span>
                </div>
                <span class="step-url">https://landeuhvillage.com/reservasi/metode-pembayaran/1</span>
            </div>
            <div class="step-desc-grid">
                <div class="desc-col">
                    <strong>Aksi Pelanggan:</strong>
                    <p>Pelanggan memilih opsi <strong>"BCA Virtual Account"</strong> pada daftar metode pembayaran dan mengklik tombol <strong>"Bayar"</strong>.</p>
                </div>
                <div class="desc-col">
                    <strong>Respon Sistem:</strong>
                    <p>Frontend mengirim permintaan pembuatan Snap Token ke server backend Laravel melalui endpoint <code>/reservasi/get-snap-token</code>.</p>
                </div>
            </div>
            <div class="step-img-box">
                <img src="${img04}" alt="Pilih Metode Pembayaran">
                <div class="img-caption">Gambar 4: Halaman Pemilihan Metode Pembayaran (BCA Virtual Account dipilih)</div>
            </div>
        </div>

        <!-- STEP 5 & 6 (TWO COLUMN) -->
        <div class="step-card">
            <div class="step-card-header">
                <div class="step-tag-wrapper">
                    <span class="step-pill">LANGKAH 5 & 6</span>
                    <span class="step-name">Muncul Popup Midtrans Snap & Nomor Virtual Account</span>
                </div>
                <span class="step-url">SDK: app.sandbox.midtrans.com/snap/snap.js</span>
            </div>
            <div class="step-desc-grid">
                <div class="desc-col">
                    <strong>Langkah 5 (Tampil Popup Midtrans Snap):</strong>
                    <p>Fungsi <code>window.snap.pay(token)</code> berhasil memunculkan modal Midtrans Snap resmi dengan rincian merchant Landeuh Village Riverside dan nominal tagihan Rp 1.600.000.</p>
                </div>
                <div class="desc-col">
                    <strong>Langkah 6 (Nomor VA Diterbitkan):</strong>
                    <p>Pelanggan mengklik Bank BCA, Midtrans menampilkan nomor Virtual Account resmi serta panduan cara pembayaran (ATM BCA, KlikBCA, m-BCA).</p>
                </div>
            </div>
            <div class="two-img-grid">
                <div class="step-img-box">
                    <img src="${img05}" alt="Popup Midtrans Snap">
                    <div class="img-caption">Gambar 5: Modal Midtrans Snap resmi tampil di halaman</div>
                </div>
                <div class="step-img-box">
                    <img src="${img06}" alt="Nomor BCA VA">
                    <div class="img-caption">Gambar 6: Nomor BCA Virtual Account siap dibayarkan</div>
                </div>
            </div>
        </div>

        <div class="doc-footer">
            <span>Dokumen Verifikasi Payment Gateway Midtrans &bull; Landeuh Village Riverside</span>
            <span>Halaman 3 dari 4</span>
        </div>
    </div>

    <!-- ==================== PAGE 4 ==================== -->
    <div class="page">
        <div class="doc-header">
            <div class="doc-header-left">
                ${logoBase64 ? `<img src="${logoBase64}" alt="Logo">` : ''}
                <div class="doc-header-titles">
                    <h1>SIMULASI PEMBAYARAN & KONFIRMASI SUKSES</h1>
                    <p>Langkah 7, 8, & 9: Simulasi Sandbox & Halaman Konfirmasi</p>
                </div>
            </div>
            <div class="doc-header-badge">Settlement Complete</div>
        </div>

        <!-- STEP 7 & 8 (MIDTRANS SIMULATOR) -->
        <div class="step-card">
            <div class="step-card-header">
                <div class="step-tag-wrapper">
                    <span class="step-pill">LANGKAH 7 & 8</span>
                    <span class="step-name">Simulasi Pembayaran di Midtrans Simulator Sandbox</span>
                </div>
                <span class="step-url">https://simulator.sandbox.midtrans.com/bca/va/index</span>
            </div>
            <div class="step-desc-grid">
                <div class="desc-col">
                    <strong>Langkah 7 (Inquiry Nomor VA):</strong>
                    <p>Nomor VA dimasukkan ke simulator. Sistem menampilkan inquiry: Nama <strong>Ari Rahman</strong> dan tagihan <strong>IDR 1.600.000,00</strong>.</p>
                </div>
                <div class="desc-col">
                    <strong>Langkah 8 (Eksekusi Bayar / Pay):</strong>
                    <p>Tombol "Pay" diklik. Simulator menampilkan status <strong>"Simulated payment is successful"</strong> dan mengirim notifikasi webhook/callback.</p>
                </div>
            </div>
            <div class="two-img-grid">
                <div class="step-img-box">
                    <img src="${img07}" alt="Inquiry Simulator">
                    <div class="img-caption">Gambar 7: Inquiry Tagihan Virtual Account di Simulator</div>
                </div>
                <div class="step-img-box">
                    <img src="${img08}" alt="Payment Success Simulator">
                    <div class="img-caption">Gambar 8: Status Pembayaran Berhasil di Simulator</div>
                </div>
            </div>
        </div>

        <!-- STEP 9 (CONFIRMATION SUCCESS) -->
        <div class="step-card">
            <div class="step-card-header">
                <div class="step-tag-wrapper">
                    <span class="step-pill">LANGKAH 9</span>
                    <span class="step-name">Halaman Konfirmasi Reservasi & E-Ticket (Berhasil)</span>
                </div>
                <span class="step-url">https://landeuhvillage.com/reservasi/konfirmasi?status=success</span>
            </div>
            <div class="step-desc-grid">
                <div class="desc-col">
                    <strong>Hasil Akhir Sistem:</strong>
                    <p>Status pesanan diubah menjadi <strong>success</strong> di database. Layar menampilkan halaman konfirmasi "Pembayaran Berhasil", No. Pemesanan, rincian Cabin 1, dan tombol <strong>"Unduh PDF"</strong> untuk mengunduh invoice/e-ticket.</p>
                </div>
                <div class="desc-col">
                    <strong>Pengiriman Otomatis:</strong>
                    <p>Sistem secara otomatis mengirimkan Invoice PDF resmi ke alamat email pemesan (<code>arryrahmand5@gmail.com</code>) dan pesan konfirmasi WhatsApp.</p>
                </div>
            </div>
            <div class="step-img-box">
                <img src="${img09}" alt="Konfirmasi Berhasil">
                <div class="img-caption">Gambar 9: Halaman Konfirmasi Pembayaran Berhasil & E-Ticket Siap Diunduh</div>
            </div>
        </div>

        <!-- SUMMARY TABLE -->
        <table class="summary-table">
            <thead>
                <tr>
                    <th style="width: 10%">Tahap</th>
                    <th style="width: 28%">Halaman / Endpoint</th>
                    <th style="width: 27%">Aksi Pengguna</th>
                    <th style="width: 25%">Respon Sistem</th>
                    <th style="width: 10%">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>01</strong></td>
                    <td><code>landeuhvillage.com/</code></td>
                    <td>Buka beranda & pilih menu</td>
                    <td>Menampilkan profil & katalog unit</td>
                    <td><span class="badge-info">Normal</span></td>
                </tr>
                <tr>
                    <td><strong>02</strong></td>
                    <td><code>/reservasi/overview/1</code></td>
                    <td>Input data tamu (Ari Rahman)</td>
                    <td>Validasi slot tanggal & buat booking</td>
                    <td><span class="badge-info">Pending</span></td>
                </tr>
                <tr>
                    <td><strong>03</strong></td>
                    <td><code>/reservasi/metode-pembayaran</code></td>
                    <td>Pilih BCA VA & klik "Bayar"</td>
                    <td>Request Snap Token ke server</td>
                    <td><span class="badge-info">Pending</span></td>
                </tr>
                <tr>
                    <td><strong>04</strong></td>
                    <td><code>Midtrans Snap Modal</code></td>
                    <td>Pilih Bank BCA di popup</td>
                    <td>Menerbitkan Nomor Virtual Account</td>
                    <td><span class="badge-info">Waiting VA</span></td>
                </tr>
                <tr>
                    <td><strong>05</strong></td>
                    <td><code>Midtrans Simulator</code></td>
                    <td>Inquiry & Bayar Nomor VA</td>
                    <td>Transaksi settled di Sandbox</td>
                    <td><span class="badge-success">Paid</span></td>
                </tr>
                <tr>
                    <td><strong>06</strong></td>
                    <td><code>/reservasi/konfirmasi</code></td>
                    <td>Menerima konfirmasi pembayaran</td>
                    <td>E-Ticket terbit, kirim Email & WhatsApp</td>
                    <td><span class="badge-success">Success</span></td>
                </tr>
            </tbody>
        </table>

        <div class="doc-footer">
            <span>Dokumen Verifikasi Payment Gateway Midtrans &bull; Landeuh Village Riverside</span>
            <span>Halaman 4 dari 4 &bull; Selesai</span>
        </div>
    </div>

</body>
</html>
`;

async function generatePdf() {
    console.log("=== MEMBUAT DOKUMEN PDF CUSTOMER FLOW ===");
    const htmlPath = path.resolve('./customer_flow_template.html');
    fs.writeFileSync(htmlPath, htmlContent, 'utf8');
    console.log("Template HTML tersimpan di:", htmlPath);

    const browser = await chromium.launch({
        executablePath: 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe',
        headless: true
    });

    const page = await browser.newPage();
    await page.goto(`file://${htmlPath}`, { waitUntil: 'networkidle', timeout: 30000 });
    await page.waitForTimeout(2000);

    console.log("Mencetak PDF dengan Chromium...");
    await page.pdf({
        path: PDF_OUTPUT,
        format: 'A4',
        printBackground: true,
        margin: {
            top: '8mm',
            bottom: '8mm',
            left: '10mm',
            right: '10mm'
        }
    });

    // Buat salinan di folder public agar bisa diunduh langsung lewat web
    fs.copyFileSync(PDF_OUTPUT, PUBLIC_PDF);

    await browser.close();
    console.log("=== DOKUMEN PDF BERHASIL DIBUAT ===");
    console.log("File PDF tersimpan di:", PDF_OUTPUT);
    console.log("Salinan Publik tersimpan di:", PUBLIC_PDF);
}

generatePdf().catch(err => {
    console.error("Gagal membuat PDF:", err);
    process.exit(1);
});
