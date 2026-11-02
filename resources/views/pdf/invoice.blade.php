<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice Reservasi - {{ $booking->no_pesanan }}</title>
    <style>
        @page {
            /* MARGIN HALAMAN PDF (Berlaku untuk SEMUA halaman: halaman 1, halaman 2, dst) */
            margin-top: 60px;       /* Jarak atas kertas — ubah nilai ini jika ingin margin atas hal 2 lebih besar/kecil */
            margin-bottom: 35px;    /* Jarak bawah kertas */
            margin-left: 45px;      /* Jarak kiri kertas */
            margin-right: 50px;     /* Jarak kanan kertas */
        }

        /* Seluruh elemen PDF menggunakan Sans-Serif standar (Helvetica / Arial) */
        *, body, table, td, th, div, span, p, h1, h2, h3, h4 {
            font-family: Helvetica, Arial, sans-serif;
        }
        body {
            background: #ffffff;
            color: #333;
            margin: 0;
            padding: 0;
            font-size: 12px;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            padding: 0 5px;
        }
        /* INVOICE MAIN TITLE (CENTER) */
        .invoice-main-title {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-main-title h1 {
            margin: 0;
            font-size: 20px;
            color: #3a523a;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-weight: 800;
        }

        /* HEADER */
        .header {
            width: 100%;
            border-bottom: 2px solid #3a523a;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        .header table {
            width: 100%;
        }
        .logo {
            width: 90px;
            height: auto;
        }
        .invoice-meta {
            text-align: right;
            vertical-align: middle;
        }
        .invoice-meta .no-pesanan {
            font-size: 18px;
            font-weight: bold;
            color: #111;
            letter-spacing: 0.3px;
        }
        .invoice-meta .no-pesanan strong {
            font-weight: 900;
            color: #111;
        }
        .invoice-meta .unit-pax {
            font-size: 13px;
            margin-top: 5px;
            font-weight: bold;
            color: #333;
        }

        /* BREAKDOWN HARGA TANGGAL (SEPERTI SS2) */
        .breakdown-box {
            margin-top: 8px;
            margin-bottom: 4px;
            padding-left: 10px;
            border-left: 2.5px solid #2e7d32;
            font-family: Helvetica, Arial, sans-serif;
        }
        .breakdown-table {
            width: 100%;
            border-collapse: collapse;
            font-family: Helvetica, Arial, sans-serif;
        }
        .breakdown-table td {
            padding: 2.5px 0 !important;
            border: none !important;
            font-size: 11px;
            vertical-align: middle;
            font-family: Helvetica, Arial, sans-serif;
        }
        .breakdown-date {
            color: #333;
            font-weight: 500;
            display: inline-block;
            min-width: 85px;
            font-family: Helvetica, Arial, sans-serif;
        }
        .breakdown-label {
            font-weight: bold;
            font-size: 10.5px;
            margin-left: 8px;
            font-family: Helvetica, Arial, sans-serif;
        }
        .breakdown-price {
            text-align: right;
            font-weight: bold;
            color: #333;
            font-family: Helvetica, Arial, sans-serif;
        }

        /* CARD RENCANA MENGINAP */
        .card {
            background: #f8f6f0;
            margin-bottom: 25px;
            padding: 20px;
        }
        .schedule-table {
            width: 100%;
        }
        .schedule-table td {
            vertical-align: top;
        }
        .schedule-label {
            font-size: 11px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .schedule-date {
            font-size: 16px;
            font-weight: bold;
            color: #111;
            margin-bottom: 3px;
        }
        .schedule-time {
            font-size: 11px;
            color: #777;
        }
        .schedule-arrow {
            text-align: center;
            vertical-align: middle;
        }
        
        .reschedule-badge {
            display: inline-block;
            background: #faf5ff;
            color: #8200db;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
            margin-top: 5px;
            border: 1px solid #e9d5ff;
        }
        .reschedule-pending-badge {
            display: inline-block;
            background: #fff3cd;
            color: #856404;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
            margin-top: 5px;
            border: 1px solid #ffeeba;
        }

        /* TABLES */
        .section-title {
            font-size: 14px;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
            border-bottom: 1px solid #eee;
            padding-bottom: 8px;
        }
        
        /* PAYMENT DETAILS */
        .payment-box {
            width: 100%;
            border-collapse: collapse;
        }
        .payment-box td {
            padding: 8px 0;
            vertical-align: top;
            border-bottom: 1px solid #f5f5f5;
        }
        .payment-title {
            font-weight: bold;
            color: #333;
            font-size: 13px;
        }
        .payment-desc {
            color: #777;
            font-size: 11px;
            margin-top: 2px;
        }
        .payment-amount {
            text-align: right;
            font-weight: bold;
            color: #111;
        }
        .payment-total {
            border-bottom: none !important;
            padding-top: 15px !important;
            font-size: 14px;
        }
        .payment-total-label {
            font-weight: bold;
            color: #3a523a;
        }
        .payment-total-amount {
            font-weight: bold;
            color: #a31616ff;
            text-align: right;
            font-size: 16px;
        }

        /* FOOTER */
        .footer-section {
            width: 100%;
            margin-top: 30px;
        }
        .footer-table {
            width: 100%;
        }
        .thanks-msg {
            font-size: 11px;
            color: #555;
            line-height: 1.6;
            width: 60%;
            vertical-align: top;
        }
        .signature-box {
            width: 40%;
            text-align: right;
            vertical-align: bottom;
        }
        .signature-img {
            width: 120px;
            height: auto;
            margin: 10px 0;
        }
        .signature-name {
            font-size: 14px;
            font-weight: bold;
            /* Untuk mengganti warna nama Aldi, ubah hex color di bawah ini */
            color: #000000ff; 
        }
        .signature-title {
            font-size: 11px;
            color: #777;
        }
        
        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-lunas { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .status-belum { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

    </style>
</head>
<body>
    <?php
        // Load Images as Base64 for DOMPDF
        $logoPath = public_path('images/logo-landeuh.png');
        $logoSrc = '';
        if(file_exists($logoPath)){
            $logoSrc = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));
        }

        // Tanda tangan (ganti dengan signature Anda di public/images/signature.png jika ada)
        $signaturePath = public_path('images/signature.png');
        $signatureSrc = '';
        if(file_exists($signaturePath)){
            $signatureSrc = 'data:image/png;base64,' . base64_encode(file_get_contents($signaturePath));
        }

        // Hitung rincian harga (asumsi tambahan anak 75.000/malam, dewasa 100.000/malam)
        $harga_anak = 75000;
        $harga_dewasa = 100000;
        $malam = $booking->malam;
        
        $total_anak = $booking->tambahan_anak * $harga_anak * $malam;
        $total_dewasa = $booking->tambahan_dewasa * $harga_dewasa * $malam;
        
        // Harga kamar murni = Total - (total anak + total dewasa)
        $total_kamar = $booking->total - $total_anak - $total_dewasa;
        
        // Format Rupiah
        function rp($angka) {
            return 'IDR ' . number_format($angka, 0, ',', '.');
        }
        
        // Format Tanggal
        $checkIn = \Carbon\Carbon::parse($booking->check_in_date)->locale('id');
        $checkOut = \Carbon\Carbon::parse($booking->check_out_date)->locale('id');
        $today = \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM YYYY');

        $isCorporate = !is_null($booking->corporate_package_id);
        $unit = $isCorporate ? $booking->corporatePackage : $booking->accommodation;
        $judul = $unit ? $unit->judul : 'Akomodasi';
        $maxOrang = ($isCorporate && !empty($booking->jumlah_pax)) ? $booking->jumlah_pax : ($unit ? $unit->max_orang : '-');
        $slot = $isCorporate ? ($unit->slot ?? 1) : 1;

        // Ambil data DateSetting untuk breakdown malam
        $dateSettings = \App\Models\DateSetting::all();
        $daysIndo = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu'];
        $weekdaySetting = $dateSettings->firstWhere('type', 'weekday');
        $weekendSetting = $dateSettings->firstWhere('type', 'weekend');
        $highseasonSettings = $dateSettings->where('type', 'highseason');

        $weekdayDates = $weekdaySetting && $weekdaySetting->dates ? array_map('trim', explode(',', $weekdaySetting->dates)) : [];
        $weekendDates = $weekendSetting && $weekendSetting->dates ? array_map('trim', explode(',', $weekendSetting->dates)) : [];
        $highseasonDates = [];
        foreach ($highseasonSettings as $hs) {
            if ($hs->dates) {
                foreach (explode(',', $hs->dates) as $dStr) {
                    $trimmed = trim($dStr);
                    if ($trimmed && !in_array($trimmed, $highseasonDates)) {
                        $highseasonDates[] = $trimmed;
                    }
                }
            }
        }

        $nightsBreakdown = [];
        $currentDate = \Carbon\Carbon::parse($booking->check_in_date);
        $hargaWeekday = $unit ? floatval($unit->harga_weekday) : 0;
        $hargaWeekend = $unit ? floatval($unit->harga_weekend) : 0;
        $hargaHighseason = $unit ? floatval($unit->harga_highseason) : 0;

        for ($i = 0; $i < $malam; $i++) {
            $dateStr = $currentDate->format('Y-m-d');
            $dayName = $daysIndo[$currentDate->dayOfWeek];
            
            $price = $hargaWeekday;
            $typeLabel = 'Weekday';
            $color = '#ea580c'; // Orange

            if (in_array($dateStr, $highseasonDates)) {
                $price = $hargaHighseason;
                $typeLabel = 'Highseason';
                $color = '#dc2626'; // Merah
            } elseif (in_array($dateStr, $weekendDates) || in_array($dayName, $weekendDates)) {
                $price = $hargaWeekend;
                $typeLabel = 'Weekend';
                $color = '#2563eb'; // Biru
            } elseif (in_array($dateStr, $weekdayDates) || in_array($dayName, $weekdayDates)) {
                $price = $hargaWeekday;
                $typeLabel = 'Weekday';
                $color = '#ea580c';
            } else {
                if ($currentDate->dayOfWeek === 5 || $currentDate->dayOfWeek === 6) {
                    $price = $hargaWeekend;
                    $typeLabel = 'Weekend';
                    $color = '#2563eb';
                } else {
                    $price = $hargaWeekday;
                    $typeLabel = 'Weekday';
                    $color = '#ea580c';
                }
            }

            if ($isCorporate && !empty($booking->jumlah_pax)) {
                $price = $price * $booking->jumlah_pax;
            }

            $nightsBreakdown[] = [
                'date_formatted' => $currentDate->locale('id')->isoFormat('D MMMM'),
                'label' => $typeLabel,
                'color' => $color,
                'price' => $price
            ];

            $currentDate->addDay();
        }
    ?>

    <div class="container">
        
        <!-- JUDUL ATAS CENTER -->
        <div class="invoice-main-title">
            <h1>INVOICE RESERVASI</h1>
        </div>

        <!-- HEADER -->
        <div class="header">
            <table>
                <tr>
                    <td style="width: 50%; vertical-align: middle;">
                        @if($logoSrc)
                            <img src="{{ $logoSrc }}" class="logo" alt="Landeuh Logo">
                        @else
                            <h2 style="color:#3a523a; margin:0;">LANDEUH VILLAGE</h2>
                        @endif
                    </td>
                    <td class="invoice-meta">
                        <div class="no-pesanan">No. Pemesanan: <strong>{{ $booking->no_pesanan }}</strong></div>
                        <div class="unit-pax">
                            {{ $judul }} ({{ $maxOrang }} Pax)
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- RENCANA MENGINAP -->
        <div class="card">
            <table class="schedule-table">
                <tr>
                    <td style="width: 40%;">
                        <div class="schedule-label" style="color: #28a745;">Check-in</div>
                        <div class="schedule-date">{{ $checkIn->isoFormat('dddd, D MMM YYYY') }}</div>
                        <div class="schedule-time">Dari 14:00 &ndash; 21:00</div>
                        @if($booking->status == 'rescheduled')
                            <div class="reschedule-badge">Reschedule</div>
                        @elseif($booking->status == 'reschedule_pending')
                            <div class="reschedule-pending-badge">Proses Tinjauan Reschedule</div>
                        @endif
                    </td>
                    <td class="schedule-arrow" style="width: 20%;">
                        <div style="font-size: 11px; color: #777; margin-bottom: 5px;">{{ $malam }} Malam</div>
                        <div style="font-family: 'DejaVu Sans', sans-serif; color: #bbb; font-size: 22px; line-height: 1;">&rarr;</div>
                    </td>
                    <td style="width: 40%; text-align: right;">
                        <div class="schedule-label" style="color: #dc3545;">Check-out</div>
                        <div class="schedule-date">{{ $checkOut->isoFormat('dddd, D MMM YYYY') }}</div>
                        <div class="schedule-time">Hingga 12:00</div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- IDENTITAS PEMESAN & TAMU -->
        <div class="section-title">Detail Pemesan & Tamu</div>
        <div style="margin-bottom: 30px;">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 50%; vertical-align: top;">
                        <div style="font-size: 11px; color: #888; margin-bottom: 4px;">PEMESAN</div>
                        <div style="font-weight: bold; font-size: 14px; color: #222;">{{ $booking->pemesan_nama }}</div>
                        <div style="color: #555; margin-top: 5px; font-size: 12px; line-height: 1.4;">
                            Telp: {{ $booking->pemesan_telp }}<br>
                            Email: {{ $booking->pemesan_email }}
                        </div>
                    </td>
                    <td style="width: 50%; vertical-align: top;">
                        <div style="font-size: 11px; color: #888; margin-bottom: 4px;">TAMU</div>
                        <div style="font-weight: bold; font-size: 14px; color: #222;">{{ $booking->nama_tamu }}</div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- RINCIAN PEMBAYARAN -->
        <div class="section-title">Rincian Pembayaran</div>
        <div style="margin-bottom: 30px;">
            <table class="payment-box">
                <!-- Harga Kamar Dasar -->
                <tr>
                    <td colspan="2" style="padding-bottom: 10px;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <tr>
                                <td style="vertical-align: top; border: none; padding: 0;">
                                    <div class="payment-title">{{ $judul }} ({{ $maxOrang }} Pax)</div>
                                    <div class="payment-desc">{{ $slot }} Unit &times; {{ $malam }} Malam</div>
                                </td>
                                <td class="payment-amount" style="vertical-align: top; text-align: right; border: none; padding: 0;">
                                    {{ rp($total_kamar) }}
                                </td>
                            </tr>
                        </table>

                        <!-- Breakdown Tanggal Booking (seperti SS2) -->
                        @if(!empty($nightsBreakdown))
                        <div class="breakdown-box">
                            <table class="breakdown-table">
                                @foreach($nightsBreakdown as $night)
                                <tr>
                                    <td>
                                        <span class="breakdown-date">{{ $night['date_formatted'] }}</span>
                                        <span class="breakdown-label" style="color: {{ $night['color'] }};">{{ $night['label'] }}</span>
                                    </td>
                                    <td class="breakdown-price">
                                        {{ rp($night['price']) }}
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        @endif
                    </td>
                </tr>

                <!-- Tambahan Anak -->
                @if($booking->tambahan_anak > 0)
                <tr>
                    <td>
                        <div class="payment-title">Tambahan Anak</div>
                        <div class="payment-desc">{{ $booking->tambahan_anak }} Orang &times; {{ $malam }} Malam</div>
                    </td>
                    <td class="payment-amount">{{ rp($total_anak) }}</td>
                </tr>
                @endif

                <!-- Tambahan Dewasa -->
                @if($booking->tambahan_dewasa > 0)
                <tr>
                    <td>
                        <div class="payment-title">Tambahan Dewasa</div>
                        <div class="payment-desc">{{ $booking->tambahan_dewasa }} Orang &times; {{ $malam }} Malam</div>
                    </td>
                    <td class="payment-amount">{{ rp($total_dewasa) }}</td>
                </tr>
                @endif
                
                <!-- Metode Pembayaran -->
                <tr>
                    <td style="padding-top: 15px; padding-bottom: 15px; border-bottom: none; vertical-align: middle;">
                        <table style="border-collapse: collapse;">
                            <tr>
                                <td style="color: #666; font-size: 12px; padding: 0; border: none; vertical-align: middle; white-space: nowrap;">
                                    Metode Pembayaran:
                                </td>
                                <td style="padding: 0 0 0 8px; border: none; vertical-align: middle;">
                                    <span style="background: #e9ecef; padding: 4px 10px; border-radius: 4px; font-weight: bold; color: #333; font-size: 12px;">
                                        {{ $booking->metode_pembayaran ?? '-' }}
                                    </span>
                                </td>
                                <td style="padding: 0 0 0 8px; border: none; vertical-align: middle;">
                                    @if($booking->status == 'success' || $booking->status == 'rescheduled' || $booking->status == 'reschedule_pending')
                                        <span style="background: #d4edda; color: #155724; padding: 4px 10px; border-radius: 4px; font-size: 11px; font-weight: bold; border: 1px solid #c3e6cb;">LUNAS</span>
                                    @else
                                        <span style="background: #f8d7da; color: #721c24; padding: 4px 10px; border-radius: 4px; font-size: 11px; font-weight: bold; border: 1px solid #f5c6cb;">BELUM LUNAS</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="border-bottom: none;"></td>
                </tr>

                <!-- Subtotal -->
                <tr>
                    <td class="payment-total payment-total-label">Subtotal</td>
                    <td class="payment-total payment-total-amount">{{ rp($booking->total) }}</td>
                </tr>
            </table>
        </div>

        <!-- FOOTER & SIGNATURE -->
        <div class="footer-section">
            <table class="footer-table">
                <tr>
                    <td class="thanks-msg">
                        <div style="font-size: 11px; font-weight: bold; color: #3a523a; margin-bottom: 4px; margin-top: 10px;">KEBIJAKAN</div>
                        <div style="font-size: 10px; color: #666; line-height: 1.5;">
                            &bull; Pemesanan hanya dapat dijadwalkan ulang (reschedule) dan tidak dapat dibatalkan.<br>
                            &bull; Pembayaran yang telah dilakukan tidak dapat dikembalikan (non-refundable).
                        </div><br><br>

                        <strong style="font-size: 12px; color: #222;">Terima kasih atas pesanan Anda!</strong>
                    </td>
                    <td class="signature-box">
                        <div style="color: #555; margin-bottom: 5px;">Bogor, {{ $today }}</div>
                        
                        @if($signatureSrc)
                            <img src="{{ $signatureSrc }}" class="signature-img" alt="Signature">
                        @else
                            <div style="height: 80px;"></div> <!-- Spacer if no signature image -->
                        @endif

                        <div class="signature-name">Ovy Resiyana</div>
                        <div class="signature-title">Owner Landeuh Village</div>
                    </td>
                </tr>
            </table>
        </div>
        
        <!-- FOOTER ADDRESS BLOCK -->
        <div style="background: #f1e5cc; padding: 15px; text-align: center; color: #555; font-size: 11px; margin-top: 40px">
            <strong style="color: #3a523a; font-size: 12px;">Landeuh Village Riverside</strong><br>
            <div style="margin-top: 4px; line-height: 1.5;">
                Kp. Wangun Landeuh, Karang Tengah, Kec. Babakan Madang, Kabupaten Bogor<br>
                WhatsApp: +62 821-1464-0277 | Email: booking@landeuh.com
            </div>
        </div>

    </div>
</body>
</html>
