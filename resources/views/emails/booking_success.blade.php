<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Ticket Reservasi Landeuh Village Riverside</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #F8EDD8;
            color: #333333;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid #dfd4be;
        }
        .header {
            background-color: #3a523a;
            color: #ffffff;
            padding: 30px;
            text-align: center;
            position: relative;
        }
        .header h1 {
            font-size: 20px;
            margin: 10px 0 0 0;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .header p {
            margin: 5px 0 0 0;
            font-size: 13px;
            opacity: 0.85;
        }
        .logo {
            font-size: 24px;
            font-weight: 800;
            letter-spacing: 2px;
        }
        .status-badge {
            display: inline-block;
            background-color: #27ae60;
            color: #ffffff;
            font-size: 12px;
            font-weight: 700;
            padding: 6px 16px;
            border-radius: 20px;
            margin-top: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .content {
            padding: 30px;
        }
        .greeting {
            font-size: 16px;
            margin-bottom: 20px;
            line-height: 1.5;
        }
        .ticket-box {
            background-color: #fcf8ee;
            border: 1px dashed #c2b59b;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
        }
        .ticket-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 14px;
            line-height: 1.4;
        }
        .ticket-row:last-child {
            margin-bottom: 0;
            border-top: 1px solid #dfd4be;
            padding-top: 12px;
            font-weight: bold;
        }
        .ticket-label {
            color: #666666;
            font-weight: 500;
        }
        .ticket-value {
            color: #333333;
            font-weight: 700;
            text-align: right;
        }
        .grid-dates {
            display: table;
            width: 100%;
            margin-bottom: 25px;
            border-collapse: collapse;
        }
        .date-col {
            display: table-cell;
            width: 50%;
            background-color: #f1e5cc;
            padding: 15px;
            border: 1px solid #dfd4be;
            text-align: center;
        }
        .date-col.left {
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
        }
        .date-col.right {
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
        }
        .date-title {
            font-size: 11px;
            text-transform: uppercase;
            color: #27ae60;
            font-weight: 700;
            margin-bottom: 5px;
        }
        .date-title.checkout {
            color: #c0392b;
        }
        .date-val {
            font-size: 14px;
            font-weight: 700;
            color: #333333;
        }
        .date-time {
            font-size: 11px;
            color: #777777;
            margin-top: 3px;
        }
        .section-title {
            font-size: 14px;
            font-weight: 800;
            color: #3a523a;
            margin: 25px 0 10px 0;
            text-transform: uppercase;
            border-left: 3px solid #3a523a;
            padding-left: 8px;
        }
        .info-list {
            margin: 0;
            padding-left: 20px;
            font-size: 13px;
            color: #555555;
            line-height: 1.6;
        }
        .info-list li {
            margin-bottom: 6px;
        }
        .footer {
            background-color: #fcf8ee;
            padding: 25px;
            text-align: center;
            font-size: 12px;
            color: #777777;
            border-top: 1px solid #dfd4be;
            line-height: 1.5;
        }
        .footer a {
            color: #3a523a;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    {{-- Header --}}
    <div class="header">
        <div class="logo">LANDEUH VILLAGE</div>
        <h1>E-Ticket Reservasi</h1>
        <p>No. Pemesanan: {{ $booking->no_pesanan }}</p>
        <span class="status-badge">Lunas</span>
    </div>

    {{-- Content --}}
    <div class="content">
        <div class="greeting">
            Halo <strong>{{ $booking->pemesan_nama }}</strong>,<br>
            Terima kasih telah melakukan pemesanan di <strong>Landeuh Village Riverside</strong>. Pembayaran Anda telah kami verifikasi dengan sukses. Berikut adalah rincian e-ticket reservasi Anda:
        </div>

        {{-- Detail Tanggal --}}
        <div class="grid-dates">
            <div class="date-col left">
                <div class="date-title">Check-in</div>
                <div class="date-val">{{ \Carbon\Carbon::parse($booking->check_in_date)->locale('id')->isoFormat('D MMMM Y') }}</div>
                <div class="date-time">Dari 14.00 WIB</div>
            </div>
            <div class="date-col right">
                <div class="date-title checkout">Check-out</div>
                <div class="date-val">{{ \Carbon\Carbon::parse($booking->check_out_date)->locale('id')->isoFormat('D MMMM Y') }}</div>
                <div class="date-time">Sebelum 12.00 WIB</div>
            </div>
        </div>

        {{-- Box Rincian --}}
        <div class="section-title">Rincian Reservasi</div>
        <div class="ticket-box">
            <div class="ticket-row">
                <span class="ticket-label">Tipe Akomodasi</span>
                <span class="ticket-value">{{ $booking->accommodation->judul }}</span>
            </div>
            <div class="ticket-row">
                <span class="ticket-label">Durasi Menginap</span>
                <span class="ticket-value">{{ $booking->malam }} Malam</span>
            </div>
            <div class="ticket-row">
                <span class="ticket-label">Nama Tamu</span>
                <span class="ticket-value">{{ $booking->nama_tamu }}</span>
            </div>
            <div class="ticket-row">
                <span class="ticket-label">Tambahan Dewasa</span>
                <span class="ticket-value">{{ $booking->tambahan_dewasa }} Pax</span>
            </div>
            <div class="ticket-row">
                <span class="ticket-label">Tambahan Anak</span>
                <span class="ticket-value">{{ $booking->tambahan_anak }} Pax</span>
            </div>
            <div class="ticket-row">
                <span class="ticket-label">Metode Pembayaran</span>
                <span class="ticket-value">{{ $booking->metode_pembayaran }}</span>
            </div>
            <div class="ticket-row">
                <span class="ticket-label">Total Pembayaran</span>
                <span class="ticket-value" style="color: #c0392b; font-size: 16px;">IDR {{ number_format($booking->total, 0, ',', '.') }}</span>
            </div>
        </div>

        {{-- Petunjuk Check-in --}}
        <div class="section-title">Petunjuk Check-in</div>
        <ul class="info-list">
            <li>Harap tunjukkan e-ticket email ini atau nomor pemesanan <strong>{{ $booking->no_pesanan }}</strong> saat tiba di front office.</li>
            <li>Waktu Check-in dimulai pukul <strong>14.00 WIB</strong> dan Check-out maksimal pukul <strong>12.00 WIB</strong> hari berikutnya.</li>
            <li>Harap membawa kartu identitas (KTP/Passport) yang sah sesuai nama pemesan.</li>
            <li>Untuk bantuan atau konfirmasi lokasi lebih lanjut, Anda dapat menghubungi tim kami via WhatsApp.</li>
        </ul>
    </div>

    {{-- Footer --}}
    <div class="footer">
        <strong>Landeuh Village Riverside</strong><br>
        Riverside Nature Lodge & Glamping<br>
        Butuh bantuan? Hubungi <a href="https://wa.me/6281512345678" target="_blank">Layanan Pelanggan WhatsApp</a>
    </div>
</div>

</body>
</html>
