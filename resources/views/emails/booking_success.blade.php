<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>E-Ticket Reservasi Landeuh Village Riverside</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; line-height: 1.6; padding: 20px;">

    <h2 style="color: #3a523a;">Konfirmasi Reservasi - Landeuh Village Riverside</h2>
    <h3 style="color: #555;">No. Pemesanan: {{ $booking->no_pesanan }}</h3>

    <p>Halo <strong>{{ $booking->pemesan_nama }}</strong>,</p>
    
    <p>Terima kasih telah melakukan pemesanan di <strong>Landeuh Village Riverside</strong>. Pembayaran Anda telah kami verifikasi dengan sukses. Silakan temukan E-Ticket / Invoice Anda pada lampiran PDF di email ini.</p>

    <div style="margin: 20px 0; padding: 15px; border: 1px solid #dfd4be; background-color: #fcf8ee; max-width: 500px;">
        <h4 style="margin-top: 0;">Ringkasan Pesanan</h4>
        <ul style="list-style: none; padding: 0; margin: 0;">
            <li style="margin-bottom: 5px;"><strong>Akomodasi:</strong> {{ $booking->accommodation->judul ?? 'Akomodasi' }}</li>
            <li style="margin-bottom: 5px;"><strong>Check-in:</strong> {{ \Carbon\Carbon::parse($booking->check_in_date)->locale('id')->isoFormat('dddd, D MMMM Y') }}</li>
            <li style="margin-bottom: 5px;"><strong>Check-out:</strong> {{ \Carbon\Carbon::parse($booking->check_out_date)->locale('id')->isoFormat('dddd, D MMMM Y') }}</li>
            <li style="margin-bottom: 5px;"><strong>Durasi:</strong> {{ $booking->malam }} Malam</li>
            <li style="margin-bottom: 5px;"><strong>Tamu:</strong> {{ $booking->nama_tamu }}</li>
            <li><strong>Total Harga:</strong> IDR {{ number_format($booking->total, 0, ',', '.') }} ({{ $booking->status == 'success' ? 'LUNAS' : 'PENDING' }})</li>
        </ul>
    </div>

    <h4>Petunjuk Check-in</h4>
    <ul>
        <li>Tunjukkan invoice terlampir atau sebutkan nomor pemesanan <strong>{{ $booking->no_pesanan }}</strong> saat Check-in.</li>
        <li>Waktu Check-in dimulai pukul <strong>14.00 WIB</strong> dan Check-out maksimal pukul <strong>12.00 WIB</strong> hari berikutnya.</li>
        <li>Harap membawa kartu identitas (KTP/Passport) yang sah.</li>
    </ul>

    <p style="margin-top: 30px; font-size: 0.9em; color: #777;">
        Jika Anda memiliki pertanyaan, hubungi kami via WhatsApp: <strong>085795016378</strong><br>
        Tim Landeuh Village Riverside
    </p>

</body>
</html>
