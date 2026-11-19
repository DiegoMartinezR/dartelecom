<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hemos recibido tu consulta | DarTelecom</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f6f9; font-family: 'Segoe UI', Arial, sans-serif; color: #334155;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #f4f6f9; padding: 30px 15px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" max-width="640" style="max-width: 640px; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.06); border: 1px solid #e2e8f0;" cellspacing="0" cellpadding="0" border="0">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background-color: #0E1D42; padding: 32px 30px; text-align: center; border-bottom: 4px solid #ED1B2F;">
                            <a href="{{ $appUrl ?? url('/') }}" target="_blank" style="text-decoration: none; display: inline-block;">
                                <img src="{{ ($appUrl ?? url('/')) . '/images/img/logo/DarTelecom.png' }}" alt="DarTelecom" style="max-height: 50px; width: auto; border: 0;" />
                            </a>
                            <h2 style="color: #ffffff; font-size: 22px; font-weight: 700; margin: 16px 0 4px 0; letter-spacing: -0.3px;">
                                ¡Gracias por contactarnos!
                            </h2>
                            <p style="color: #94a3b8; font-size: 14px; margin: 0;">
                                Hemos recibido tu consulta exitosamente
                            </p>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 30px;">
                            <p style="font-size: 16px; line-height: 1.6; color: #1e293b; margin: 0 0 16px 0;">
                                Estimado(a) <strong>{{ $data['full_name'] ?? 'Cliente' }}</strong>,
                            </p>
                            <p style="font-size: 14px; line-height: 1.6; color: #475569; margin: 0 0 20px 0;">
                                Queremos confirmarte que recibimos tu mensaje. Un asesor especializado de <strong>DarTelecom</strong> se pondrá en contacto contigo a la brevedad para brindarte toda la información y cotización que requieres para tu proyecto o red.
                            </p>

                            <!-- Summary Card -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; margin-bottom: 24px;">
                                <tr>
                                    <td colspan="2" style="padding: 14px 20px; background-color: #f1f5f9; border-bottom: 1px solid #e2e8f0; font-weight: 700; font-size: 13px; color: #0E1D42; text-transform: uppercase;">
                                        Resumen de tu solicitud
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 20px; border-bottom: 1px solid #e2e8f0; width: 35%; font-weight: 600; font-size: 13px; color: #64748b;">
                                        Empresa:
                                    </td>
                                    <td style="padding: 12px 20px; border-bottom: 1px solid #e2e8f0; font-size: 14px; color: #1e293b;">
                                        {{ $data['company'] ?? 'N/D' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 20px; border-bottom: 1px solid #e2e8f0; font-weight: 600; font-size: 13px; color: #64748b;">
                                        Interés:
                                    </td>
                                    <td style="padding: 12px 20px; border-bottom: 1px solid #e2e8f0; font-size: 14px; color: #ED1B2F; font-weight: 600;">
                                        {{ $data['service_product'] ?? 'Comprar equipos' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 20px; font-weight: 600; font-size: 13px; color: #64748b; vertical-align: top;">
                                        Tu consulta:
                                    </td>
                                    <td style="padding: 12px 20px; font-size: 14px; color: #334155; line-height: 1.5;">
                                        {{ $data['message'] ?? 'Sin detalle adicional' }}
                                    </td>
                                </tr>
                            </table>

                            <!-- Direct WhatsApp CTA -->
                            <div style="background-color: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 12px; padding: 20px; text-align: center; margin-bottom: 24px;">
                                <p style="color: #166534; font-size: 14px; font-weight: 600; margin: 0 0 10px 0;">
                                    ¿Deseas atención inmediata o cotización urgente?
                                </p>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $general->whatsapp ?? '51908931873') }}" target="_blank" style="display: inline-block; background-color: #25D366; color: #ffffff; text-decoration: none; padding: 12px 28px; border-radius: 8px; font-weight: 700; font-size: 14px;">
                                    💬 Chatear con un Asesor por WhatsApp
                                </a>
                            </div>

                            <p style="font-size: 13px; color: #64748b; margin: 0; line-height: 1.5;">
                                También puedes visitarnos en <strong>{{ $general->address ?? 'Av. Francisco Lazo 1777' }} - {{ $general->district ?? 'Lince' }}, {{ $general->city ?? 'Lima' }}</strong>.
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 20px 30px; text-align: center; font-size: 12px; color: #94a3b8;">
                            &copy; {{ date('Y') }} <strong>DarTelecom Perú</strong>. Todos los derechos reservados.<br>
                            Especialistas en equipamiento de telecomunicaciones e infraestructura de red para operadores ISP.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
