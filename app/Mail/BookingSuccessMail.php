<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Data booking.
     */
    public $booking;
    public $pdfContent;
    public $isReschedule;

    /**
     * Create a new message instance.
     */
    public function __construct(Booking $booking, $pdfContent = null, bool $isReschedule = false)
    {
        $this->booking = $booking;
        $this->pdfContent = $pdfContent;
        $this->isReschedule = $isReschedule || $booking->status === 'rescheduled';
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = $this->isReschedule
            ? 'E-Ticket Konfirmasi Perubahan Jadwal (Reschedule) - Landeuh Village Riverside [' . $this->booking->no_pesanan . ']'
            : 'E-Ticket Konfirmasi Reservasi - Landeuh Village Riverside [' . $this->booking->no_pesanan . ']';

        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.booking_success',
            with: [
                'booking' => $this->booking,
                'isReschedule' => $this->isReschedule,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        if ($this->pdfContent) {
            return [
                \Illuminate\Mail\Mailables\Attachment::fromData(fn() => $this->pdfContent, 'Invoice_' . $this->booking->no_pesanan . '.pdf')
                        ->withMime('application/pdf'),
            ];
        }

        return [];
    }
}
