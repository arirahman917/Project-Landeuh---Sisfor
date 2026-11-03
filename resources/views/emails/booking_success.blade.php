
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ (($isReschedule ?? false) || $booking->status === 'rescheduled') ? 'Konfirmasi Perubahan Jadwal (Reschedule)' : 'Konfirmasi Reservasi' }} - Landeuh Village Riverside</title>
</head>

<body style="margin:0;padding:0;background:#f5f5f2;font-family:Arial,Helvetica,sans-serif;color:#26352c;">

@php
    $checkin = \Carbon\Carbon::parse($booking->check_in_date)
        ->locale('id');

    $checkout = \Carbon\Carbon::parse($booking->check_out_date)
        ->locale('id');

    $paymentMethod = trim((string) ($booking->metode_pembayaran ?? ''));

    if ($paymentMethod === '' || strtolower($paymentMethod) === 'pending') {
        $paymentMethod = 'Tidak tercatat';
    }

    $isPaid = in_array($booking->status, ['success', 'rescheduled', 'reschedule_pending']);
    $isRescheduled = ($isReschedule ?? false) || $booking->status === 'rescheduled';
@endphp

<table role="presentation" width="100%" cellpadding="0" cellspacing="0"
       style="background:#f5f5f2;">
<tr>
<td align="center" style="padding:32px 12px;">

<table role="presentation" width="100%" cellpadding="0" cellspacing="0"
       style="max-width:620px;background:#ffffff;border:1px solid #e6e8e2;">

    <!-- LOGO -->
    <tr>
        <td align="center" style="padding:36px 24px 24px;">
            <img
                
src="https://lh3.googleusercontent.com/a/ACg8ocLs87fJugeV99-Adw7-bFUJh0IgyFiIuxDUVxLXVOxjz-U3Nt4=s360-c-no"
                alt="Landeuh Village Riverside"
                width="100"
                style="width:100px;max-width:100%;height:auto;display:block;margin:0 auto;border:0;"
            >
        </td>
    </tr>

    <!-- HEADER -->
    <tr>
        <td align="center" style="padding:0 28px 24px;">
            <h1 style="margin:0;color:#2d4938;font-size:24px;line-height:1.35;font-weight:700;">
                {{ $isRescheduled ? 'Jadwal Reservasi Diperbarui' : 'Reservasi Dikonfirmasi' }}
            </h1>

            <p style="margin:8px 0 0;font-size:14px;color:#777f77;">
                Landeuh Village Riverside
            </p>

            @if($isRescheduled)
                <div style="display:inline-block;margin-top:12px;padding:6px 16px;background:#f3e8ff;border:1px solid #d8b4fe;color:#6b21a8;font-size:12px;font-weight:700;border-radius:9999px;letter-spacing:0.5px;">
                    ✓ PERUBAHAN JADWAL DISETUJUI
                </div>
            @endif
        </td>
    </tr>

    <tr>
        <td style="padding:0 32px;">
            <div style="border-top:1px solid #e6e8e2;"></div>
        </td>
    </tr>

    <!-- INTRO -->
    <tr>
        <td style="padding:28px 32px 20px;">
            <p style="margin:0 0 14px;font-size:15px;line-height:1.7;">
                Halo <strong>{{ $booking->pemesan_nama }}</strong>,
            </p>

            @if($isRescheduled)
                <p style="margin:0;font-size:14px;line-height:1.8;color:#4e5b51;">
                    Pengajuan reschedule untuk pesanan <strong>{{ $booking->no_pesanan }}</strong> di <strong>Landeuh Village Riverside</strong> telah <strong>DISETUJUI</strong> dan berhasil diperbarui.
                    Mohon gunakan rincian jadwal terbaru di bawah ini sebagai acuan saat kedatangan Anda.
                    E-Ticket / Invoice terbaru telah kami lampirkan dalam format PDF pada email ini.
                </p>
            @else
                <p style="margin:0;font-size:14px;line-height:1.8;color:#4e5b51;">
                    Terima kasih telah melakukan reservasi di
                    <strong>Landeuh Village Riverside</strong>.
                    Pembayaran Anda telah kami verifikasi dan
                    reservasi Anda telah dikonfirmasi.
                    E-Ticket / Invoice tersedia pada lampiran PDF email ini.
                </p>
            @endif
        </td>
    </tr>

    <!-- BOOKING NUMBER -->
    <tr>
        <td style="padding:6px 32px 24px;">
            <p style="margin:0 0 6px;font-size:11px;letter-spacing:1px;color:#7c867e;font-weight:700;">
                NOMOR RESERVASI
            </p>

            <p style="margin:0;font-size:17px;font-weight:700;color:#2d4938;">
                {{ $booking->no_pesanan }}
            </p>
        </td>
    </tr>

    <!-- CHECK-IN & CHECK-OUT -->
    <tr>
        <td style="padding:0 32px 28px;">

            <table role="presentation" width="100%" cellpadding="0" cellspacing="0"
                   style="background:#f1f5f0;border:1px solid #e0e8de;">
                <tr>
                    <td width="50%" valign="top"
                        style="padding:20px 16px;border-right:1px solid #d9e3d7;">

                        <p style="margin:0 0 10px;font-size:11px;font-weight:700;letter-spacing:1px;color:{{ $isRescheduled ? '#6b21a8' : '#66816c' }};">
                            {{ $isRescheduled ? 'CHECK-IN BARU' : 'CHECK-IN' }}
                        </p>

                        <p style="margin:0 0 6px;font-size:17px;line-height:1.4;font-weight:700;color:#294b38;">
                            {{ $checkin->isoFormat('dddd, D MMMM Y') }}
                        </p>

                        <p style="margin:4px 0 0;font-size:12px;color:#738076;">
                            Mulai pukul
                        </p>
						
						<p style="margin:0;font-size:14px;font-weight:700;color:#294b38;">
                            14.00 WIB
                        </p>
                    </td>

                    <td width="50%" valign="top"
                        style="padding:20px 16px;">

                        <p style="margin:0 0 10px;font-size:11px;font-weight:700;letter-spacing:1px;color:{{ $isRescheduled ? '#6b21a8' : '#816666' }};">
                            {{ $isRescheduled ? 'CHECK-OUT BARU' : 'CHECK-OUT' }}
                        </p>

                        <p style="margin:0 0 6px;font-size:17px;line-height:1.4;font-weight:700;color:#4b2929;">
                            {{ $checkout->isoFormat('dddd, D MMMM Y') }}
                        </p>

                        <p style="margin:4px 0 0;font-size:12px;color:#807373;">
                            Maksimal pukul
                        </p>
						
						<p style="margin:0;font-size:14px;font-weight:700;color:#4b2929;">
                            12.00 WIB
                        </p>
                    </td>
                </tr>
            </table>

        </td>
    </tr>

    <!-- SUMMARY -->
    <tr>
        <td style="padding:0 32px 12px;">
            <h2 style="font-size:17px;line-height:1.4;margin:0;color:#2d4938;">
                Ringkasan Reservasi
            </h2>
        </td>
    </tr>

    <tr>
        <td style="padding:0 32px 28px;">

            <table role="presentation" width="100%" cellspacing="0" cellpadding="0"
                   style="border-collapse:collapse;font-size:14px;">

                <tr>
                    <td style="padding:13px 0;border-bottom:1px solid #e9ebe7;color:#778078;width:40%;">
                        Akomodasi
                    </td>
                    <td align="right" style="padding:13px 0;border-bottom:1px solid #e9ebe7;color:#26352c;font-weight:600;">
                        {{ $booking->accommodation ? $booking->accommodation->judul : ($booking->corporatePackage ? $booking->corporatePackage->judul : 'Akomodasi') }}
                    </td>
                </tr>

                <tr>
                    <td style="padding:13px 0;border-bottom:1px solid #e9ebe7;color:#778078;">
                        Durasi
                    </td>
                    <td align="right" style="padding:13px 0;border-bottom:1px solid #e9ebe7;font-weight:600;">
                        {{ $booking->malam }} Malam
                    </td>
                </tr>

                <tr>
                    <td style="padding:13px 0;border-bottom:1px solid #e9ebe7;color:#778078;">
                        Nama Tamu
                    </td>
                    <td align="right" style="padding:13px 0;border-bottom:1px solid #e9ebe7;font-weight:600;">
                        {{ $booking->nama_tamu }}
                    </td>
                </tr>

                <tr>
                    <td style="padding:13px 0;border-bottom:1px solid #e9ebe7;color:#778078;">
                        Metode Pembayaran
                    </td>
                    <td align="right" style="padding:13px 0;border-bottom:1px solid #e9ebe7;font-weight:600;">
                        {{ $paymentMethod }}
                    </td>
                </tr>

                <tr>
                    <td style="padding:18px 0 5px;color:#294b38;font-weight:700;">
                        Total Pembayaran
                    </td>
                    <td align="right" style="padding:18px 0 5px;font-size:19px;color:#294b38;font-weight:700;">
                        Rp{{ number_format($booking->total, 0, ',', '.') }}
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td align="right" style="padding:3px 0 0;font-size:12px;font-weight:700;">
                        @if($isRescheduled)
                            <span style="color:#6b21a8;">RESCHEDULE - LUNAS</span>
                        @else
                            <span style="color:{{ $isPaid ? '#39764d' : '#dc3545' }};">
                                {{ $isPaid ? 'LUNAS' : 'MENUNGGU PEMBAYARAN' }}
                            </span>
                        @endif
                    </td>
                </tr>

            </table>

        </td>
    </tr>

    <!-- BUTTON DOWNLOAD INVOICE -->
    <tr>
        <td align="center" style="padding:0 32px 28px;">
            <a href="{{ url('/invoice/' . $booking->no_pesanan . '/download') }}"
               style="display:inline-block;padding:12px 24px;background:#2d4938;color:#ffffff;text-decoration:none;font-size:13px;font-weight:700;border-radius:6px;letter-spacing:0.5px;">
                Unduh E-Ticket / Invoice PDF
            </a>
            <p style="margin:8px 0 0;font-size:12px;color:#777f77;">
                (Dokumen E-Ticket / Invoice PDF terbaru juga terlampir langsung pada email ini)
            </p>
        </td>
    </tr>

    <!-- INSTRUCTIONS -->
    <tr>
        <td style="padding:0 32px 28px;">

            <div style="border-top:1px solid #e6e8e2;padding-top:24px;">

                <h2 style="font-size:17px;margin:0 0 14px;color:#2d4938;">
                    Informasi Check-in
                </h2>

                <p style="font-size:14px;line-height:1.8;color:#4e5b51;margin:0 0 10px;">
                    1. Tunjukkan E-Ticket / Invoice terlampir atau sebutkan nomor reservasi
                    <strong>{{ $booking->no_pesanan }}</strong> kepada petugas saat kedatangan.
                </p>

                <p style="font-size:14px;line-height:1.8;color:#4e5b51;margin:0 0 10px;">
                    2. Check-in dimulai pukul <strong>14.00 WIB</strong> dan check-out
                    maksimal pukul <strong>12.00 WIB</strong> pada tanggal jadwal {{ $isRescheduled ? 'terbaru' : '' }} yang tercantum di atas.
                </p>

                <p style="font-size:14px;line-height:1.8;color:#4e5b51;margin:0;">
                    3. Harap membawa kartu identitas yang sah (KTP / Paspor).
                </p>

            </div>

        </td>
    </tr>

    <!-- FOOTER -->
    <tr>
        <td align="center" style="padding:26px 32px;background:#f6f7f4;border-top:1px solid #e6e8e2;">

            <p style="margin:0 0 10px;font-size:13px;color:#737f75;">
                Membutuhkan bantuan terkait reservasi?
            </p>

            <a href="https://wa.me/6285779012797"
               style="display:inline-block;padding:11px 
20px;background:#2d4938;color:#ffffff;text-decoration:none;font-size:13px;font-weight:700;">
                Hubungi via WhatsApp
            </a>

            <p style="margin:12px 0 22px;font-size:13px;color:#4e5b51;">
                0857-7901-2797
            </p>

            <p style="margin:0;font-size:12px;color:#8b948c;">
                Landeuh Village Riverside
            </p>

            <p style="margin:5px 0 0;font-size:11px;color:#9aa49a;">
                Email ini dikirim secara otomatis untuk konfirmasi reservasi Anda.
            </p>

        </td>
    </tr>

</table>

</td>
</tr>
</table>

</body>
</html>

