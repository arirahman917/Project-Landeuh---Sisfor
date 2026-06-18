<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Resi {{ $booking->no_pesanan }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background: #ffffff;
            padding: 0;
            margin: 0;
            color: #333;
        }
        .receipt {
            max-width: 100%;
            margin: 0 auto;
            background: #fff;
        }
        .receipt-header {
            background: #3a523a;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .receipt-header h1 {
            font-size: 18px;
            font-weight: bold;
            margin: 0 0 5px 0;
        }
        .receipt-header p {
            font-size: 12px;
            opacity: 0.8;
            margin: 0;
        }
        .receipt-logo {
            text-align: center;
            margin-bottom: 15px;
        }
        .receipt-status {
            text-align: center;
            padding: 20px 15px 10px;
        }
        .badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
        }
        .badge-success {
            background: #d4edda;
            color: #155724;
        }
        .badge-failed {
            background: #f8d7da;
            color: #721c24;
        }
        .receipt-amount {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #222;
            padding: 10px 0 20px;
        }
        .receipt-body {
            padding: 0 20px 20px;
        }
        .section {
            margin-bottom: 15px;
        }
        .section-title {
            font-size: 12px;
            font-weight: bold;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            padding-bottom: 5px;
            border-bottom: 1px solid #eee;
        }
        .row {
            width: 100%;
            font-size: 13px;
            padding: 4px 0;
            display: table;
        }
        .row .label {
            display: table-cell;
            color: #666;
            width: 50%;
        }
        .row .value {
            display: table-cell;
            color: #222;
            font-weight: bold;
            text-align: right;
            width: 50%;
        }
        .receipt-footer {
            text-align: center;
            padding: 15px;
            background: #f1e5cc;
            font-size: 11px;
            color: #666;
            margin-top: 20px;
        }
        .divider {
            border: none;
            border-top: 1px dashed #ddd;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="receipt-header">
            <!-- Cannot use external image URL easily in dompdf without allow_url_fopen, using text fallback or base64 if needed. We'll stick to text for reliability -->
            <h1>Landeuh Village Riverside</h1>
            <p>Reservation Receipt</p>
            <p style="margin-top:5px; font-size:11px">No. Pemesanan: <strong>{{ $booking->no_pesanan }}</strong></p>
        </div>

        <div class="receipt-status">
            @if($booking->status == 'success')
                <div class="badge badge-success">Pembayaran Berhasil</div>
            @else
                <div class="badge badge-failed">Menunggu Pembayaran / Gagal</div>
            @endif
        </div>
        
        <div class="receipt-amount">
            IDR {{ number_format($booking->total, 0, ',', '.') }}
        </div>

        <div class="receipt-body">
            <div class="section">
                <div class="section-title">Detail Akomodasi</div>
                <div class="row">
                    <span class="label">Akomodasi</span>
                    <span class="value">{{ $booking->accommodation->judul ?? 'Akomodasi' }}</span>
                </div>
                <div class="row">
                    <span class="label">Check-in</span>
                    <span class="value">{{ \Carbon\Carbon::parse($booking->check_in_date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</span>
                </div>
                <div class="row">
                    <span class="label">Check-out</span>
                    <span class="value">{{ \Carbon\Carbon::parse($booking->check_out_date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</span>
                </div>
                <div class="row">
                    <span class="label">Durasi</span>
                    <span class="value">{{ $booking->malam }} malam</span>
                </div>
                <div class="row">
                    <span class="label">Tamu</span>
                    <span class="value">{{ $booking->accommodation->max_orang ?? '' }} Dewasa</span>
                </div>
            </div>

            <div class="section">
                <div class="section-title">Identitas Pemesan</div>
                <div class="row">
                    <span class="label">Nama</span>
                    <span class="value">{{ $booking->pemesan_nama }}</span>
                </div>
                <div class="row">
                    <span class="label">Telepon</span>
                    <span class="value">{{ $booking->pemesan_telp }}</span>
                </div>
                <div class="row">
                    <span class="label">Email</span>
                    <span class="value">{{ $booking->pemesan_email }}</span>
                </div>
                <div class="row">
                    <span class="label">Nama Tamu</span>
                    <span class="value">{{ $booking->nama_tamu }}</span>
                </div>
            </div>

            <div class="section">
                <div class="section-title">Pembayaran</div>
                <div class="row">
                    <span class="label">Metode Pembayaran</span>
                    <span class="value">{{ $booking->metode_pembayaran ?? '-' }}</span>
                </div>
                <div class="row">
                    <span class="label">Status</span>
                    <span class="value" style="color: {{ $booking->status == 'success' ? '#27ae60' : '#c0392b' }}">{{ $booking->status == 'success' ? 'Lunas' : 'Belum Lunas' }}</span>
                </div>
            </div>

            <div class="section">
                <div class="section-title">Kebijakan</div>
                <div style="font-size:11px; color:#555; line-height:1.5">
                    • Pemesanan ini tidak dapat diubah.<br>
                    • Pemesanan tidak ada refund jika Anda membatalkannya.
                </div>
            </div>
            
            <hr class="divider">
            <div style="text-align:center; font-size:11px; color:#999; margin-top:10px">
                Dicetak pada {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY HH:mm') }}
            </div>
        </div>

        <div class="receipt-footer">
            <strong>Landeuh Village Riverside</strong><br>
            Jl. Raya Ciwidey - Patengan, Bandung, Jawa Barat<br>
            WhatsApp: 085795016378 | Email: hello@landeuh.com
        </div>
    </div>
</body>
</html>
