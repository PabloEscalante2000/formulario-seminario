<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin: 0; padding: 0; background-color: #f5f5f4; font-family: Arial, Helvetica, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f5f5f4; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                    {{-- Logo --}}
                    <tr>
                        <td style="background-color: #ffffff; padding: 25px 30px 15px; text-align: center;">
                            <img src="{{ $message->embedData($logoImageData, 'itas-logo.png') }}" alt="ITAS" width="80" style="display: block; margin: 0 auto;">
                        </td>
                    </tr>

                    {{-- Header --}}
                    <tr>
                        <td style="background-color: #000000; padding: 30px; text-align: center;">
                            <h1 style="color: #DAA520; margin: 0; font-size: 22px; font-weight: bold;">Registro confirmado</h1>
                        </td>
                    </tr>

                    {{-- Body --}}
                    <tr>
                        <td style="padding: 30px;">
                            <p style="color: #000000; font-size: 16px; margin: 0 0 20px;">
                                Hola <strong>{{ $registration->nombre }}</strong>,
                            </p>

                            <p style="color: #333333; font-size: 16px; margin: 0 0 25px;">
                                Tu asistencia al lanzamiento del libro <strong style="color: #BA4826;">El Amor es un Delirio</strong> ha sido confirmada exitosamente.
                            </p>

                            {{-- Detalles del evento --}}
                            <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #fdf8f0; border-left: 4px solid #DAA520; border-radius: 4px; margin-bottom: 25px;">
                                <tr>
                                    <td style="padding: 20px;">
                                        <p style="color: #DAA520; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 15px; font-weight: bold;">Detalles del evento</p>
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="color: #666666; font-size: 14px; padding: 5px 0;">Fecha:</td>
                                                <td style="color: #000000; font-size: 14px; padding: 5px 0; font-weight: bold;">27 de marzo</td>
                                            </tr>
                                            <tr>
                                                <td style="color: #666666; font-size: 14px; padding: 5px 0;">Hora:</td>
                                                <td style="color: #000000; font-size: 14px; padding: 5px 0; font-weight: bold;">7:00 p.m.</td>
                                            </tr>
                                            <tr>
                                                <td style="color: #666666; font-size: 14px; padding: 5px 0;">Lugar:</td>
                                                <td style="color: #000000; font-size: 14px; padding: 5px 0; font-weight: bold;">Hotel Los Delfines - Miraflores</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            {{-- Registration details --}}
                            <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f5f5f4; border-radius: 8px; margin-bottom: 25px;">
                                <tr>
                                    <td style="padding: 20px;">
                                        <p style="color: #666666; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 15px; font-weight: bold;">Datos de tu registro</p>

                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="color: #666666; font-size: 14px; padding: 5px 0;">Nombre:</td>
                                                <td style="color: #000000; font-size: 14px; padding: 5px 0; font-weight: bold;">{{ $registration->nombre }} {{ $registration->apellido }}</td>
                                            </tr>
                                            <tr>
                                                <td style="color: #666666; font-size: 14px; padding: 5px 0;">Correo:</td>
                                                <td style="color: #000000; font-size: 14px; padding: 5px 0;">{{ $registration->correo }}</td>
                                            </tr>
                                            <tr>
                                                <td style="color: #666666; font-size: 14px; padding: 5px 0;">Acompañantes:</td>
                                                <td style="color: #000000; font-size: 14px; padding: 5px 0;">{{ $registration->numero_acompanantes }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            {{-- QR Code --}}
                            <table width="100%" cellpadding="0" cellspacing="0" style="text-align: center; margin-bottom: 25px;">
                                <tr>
                                    <td align="center" style="padding: 20px;">
                                        <p style="color: #000000; font-size: 14px; font-weight: bold; margin: 0 0 15px;">Presenta este código QR en la entrada del evento</p>
                                        <img src="{{ $message->embedData($qrImageData, 'qr-code.png') }}" alt="Codigo QR" width="250" height="250" style="display: block; margin: 0 auto;">
                                    </td>
                                </tr>
                            </table>

                            {{-- Fallback link --}}
                            <p style="color: #666666; font-size: 13px; text-align: center; margin: 0;">
                                Si no puedes ver el código QR, visita este enlace:
                                <a href="{{ $verificacionUrl }}" style="color: #DAA520;">{{ $verificacionUrl }}</a>
                            </p>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="background-color: #000000; padding: 20px; text-align: center;">
                            <p style="color: #DAA520; font-size: 12px; margin: 0;">El Amor es un Delirio</p>
                            <p style="color: #999999; font-size: 11px; margin: 5px 0 0;">Este correo fue enviado automáticamente. No responder a este mensaje.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
