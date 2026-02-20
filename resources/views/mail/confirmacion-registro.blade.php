<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin: 0; padding: 0; background-color: #f1f5f9; font-family: Arial, Helvetica, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f1f5f9; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                    {{-- Header --}}
                    <tr>
                        <td style="background-color: #1e293b; padding: 30px; text-align: center;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 22px; font-weight: bold;">Registro confirmado</h1>
                        </td>
                    </tr>

                    {{-- Body --}}
                    <tr>
                        <td style="padding: 30px;">
                            <p style="color: #334155; font-size: 16px; margin: 0 0 20px;">
                                Hola <strong>{{ $registration->nombre }}</strong>,
                            </p>

                            <p style="color: #334155; font-size: 16px; margin: 0 0 25px;">
                                Tu asistencia al lanzamiento del libro ha sido confirmada exitosamente.
                            </p>

                            {{-- Registration details --}}
                            <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f8fafc; border-radius: 8px; padding: 20px; margin-bottom: 25px;">
                                <tr>
                                    <td style="padding: 20px;">
                                        <p style="color: #64748b; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 15px; font-weight: bold;">Datos de tu registro</p>

                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="color: #64748b; font-size: 14px; padding: 5px 0;">Nombre:</td>
                                                <td style="color: #1e293b; font-size: 14px; padding: 5px 0; font-weight: bold;">{{ $registration->nombre }} {{ $registration->apellido }}</td>
                                            </tr>
                                            <tr>
                                                <td style="color: #64748b; font-size: 14px; padding: 5px 0;">Correo:</td>
                                                <td style="color: #1e293b; font-size: 14px; padding: 5px 0;">{{ $registration->correo }}</td>
                                            </tr>
                                            <tr>
                                                <td style="color: #64748b; font-size: 14px; padding: 5px 0;">Acompañantes:</td>
                                                <td style="color: #1e293b; font-size: 14px; padding: 5px 0;">{{ $registration->numero_acompanantes }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            {{-- QR Code --}}
                            <table width="100%" cellpadding="0" cellspacing="0" style="text-align: center; margin-bottom: 25px;">
                                <tr>
                                    <td align="center" style="padding: 20px;">
                                        <p style="color: #334155; font-size: 14px; font-weight: bold; margin: 0 0 15px;">Presenta este codigo QR en la entrada del evento</p>
                                        <img src="{{ $message->embedData($qrImageData, 'qr-code.png') }}" alt="Codigo QR" width="250" height="250" style="display: block; margin: 0 auto;">
                                    </td>
                                </tr>
                            </table>

                            {{-- Fallback link --}}
                            <p style="color: #64748b; font-size: 13px; text-align: center; margin: 0;">
                                Si no puedes ver el codigo QR, visita este enlace:
                                <a href="{{ $verificacionUrl }}" style="color: #2563eb;">{{ $verificacionUrl }}</a>
                            </p>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="background-color: #f8fafc; padding: 20px; text-align: center; border-top: 1px solid #e2e8f0;">
                            <p style="color: #94a3b8; font-size: 12px; margin: 0;">Este correo fue enviado automaticamente. No responder a este mensaje.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
