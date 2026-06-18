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

    /**
     * Create a new message instance.
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
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
        $pdfPath = public_path('invoices/Invoice_' . $this->booking->no_pesanan . '.pdf');
        
        if (\Illuminate\Support\Facades\File::exists($pdfPath)) {
            return [
                \Illuminate\Mail\Mailables\Attachment::fromPath($pdfPath)
                        ->as('Invoice_' . $this->booking->no_pesanan . '.pdf')
                        ->withMime('application/pdf'),
            ];
        }

        return [];
    }
}
