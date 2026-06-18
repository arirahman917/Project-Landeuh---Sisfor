<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2>Halo, {{ $booking->pemesan_nama }}</h2>
    <p>Terima kasih telah melakukan pemesanan di <strong>Landeuh Village Riverside</strong>.</p>
    
    @if($booking->status == 'success')
    <p>Pembayaran Anda untuk pesanan <strong>{{ $booking->no_pesanan }}</strong> telah berhasil diverifikasi. Pesanan Anda kini berstatus <strong>LUNAS</strong>.</p>
    @else
    <p>Pesanan Anda <strong>{{ $booking->no_pesanan }}</strong> telah kami terima, namun masih berstatus belum lunas/gagal.</p>
    @endif
    
    <p>Berikut adalah detail singkat pesanan Anda:</p>
    <ul>
        <li><strong>Akomodasi:</strong> {{ $booking->accommodation->judul ?? 'Akomodasi' }}</li>
        <li><strong>Check-in:</strong> {{ \Carbon\Carbon::parse($booking->check_in_date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</li>
        <li><strong>Durasi:</strong> {{ $booking->malam }} Malam</li>
        <li><strong>Check-out:</strong> {{ \Carbon\Carbon::parse($booking->check_out_date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</li>
        <li><strong>Metode Pembayaran:</strong> {{ $booking->metode_pembayaran ?? '-' }}</li>
    </ul>

    <div style="background-color: #f9f9f9; border-left: 4px solid #ff9800; padding: 15px; margin: 20px 0;">
        <p style="margin-top: 0; color: #d84315;"><strong>Kebijakan Pemesanan:</strong></p>
        <ul style="margin-bottom: 0; padding-left: 20px; color: #555;">
            <li>Pemesanan ini tidak dapat diubah (No Reschedule).</li>
            <li>Pemesanan tidak dapat dikembalikan (No Refund) jika Anda membatalkannya.</li>
        </ul>
    </div>

    <p>Bersama email ini, kami juga melampirkan file PDF E-Ticket / Invoice Anda. Silakan tunjukkan E-Ticket tersebut saat proses Check-in.</p>
    
    <p>Jika Anda memiliki pertanyaan, jangan ragu untuk membalas pesan ini atau hubungi kami di WhatsApp: 085795016378.</p>
    
    <br>
    <p>Salam hangat,<br>
    <strong>Tim Landeuh Village Riverside</strong></p>
</body>
</html>
