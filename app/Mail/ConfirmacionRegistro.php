<?php

namespace App\Mail;

use App\Models\Registration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ConfirmacionRegistro extends Mailable
{
    use Queueable, SerializesModels;

    public string $verificacionUrl;

    public string $qrImageData;

    public string $logoImageData;

    public function __construct(public Registration $registration)
    {
        $this->registration->loadMissing('invitationToken');

        $this->verificacionUrl = route('verificacion.show', $this->registration->invitationToken->token);

        $this->qrImageData = (string) QrCode::format('png')->size(250)->generate($this->verificacionUrl);

        $this->logoImageData = file_get_contents(public_path('images/itas_icono.png'));
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmacion de registro - El Amor es un Delirio',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.confirmacion-registro',
        );
    }
}
