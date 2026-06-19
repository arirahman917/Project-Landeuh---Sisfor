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

    /**
     * Create a new message instance.
     */
    public function __construct(Booking $booking, $pdfContent = null)
    {
        $this->booking = $booking;
        $this->pdfContent = $pdfContent;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'E-Ticket Konfirmasi Reservasi - Landeuh Village Riverside [' . $this->booking->no_pesanan . ']',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.booking_success',
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
