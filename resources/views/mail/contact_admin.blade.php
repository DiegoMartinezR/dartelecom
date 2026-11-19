<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Consulta de Contacto | DarTelecom</title>
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
                            <h2 style="color: #ffffff; font-size: 20px; font-weight: 700; margin: 16px 0 0 0; letter-spacing: -0.3px;">
                                Nueva Solicitud de Contacto
                            </h2>
                            <p style="color: #94a3b8; font-size: 13px; margin: 4px 0 0 0;">
                                Canal: <strong>{{ $data['source'] ?? 'Formulario Web' }}</strong>
                            </p>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 30px;">
                            <p style="font-size: 15px; line-height: 1.6; color: #1e293b; margin: 0 0 20px 0;">
                                Hola <strong>Equipo de DarTelecom</strong>, se ha recibido una nueva solicitud de contacto a través de la plataforma web. A continuación los detalles:
                            </p>

                            <!-- Data Card -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; margin-bottom: 24px;">
                                <tr>
                                    <td style="padding: 16px 20px; border-bottom: 1px solid #e2e8f0; width: 35%; font-weight: 600; font-size: 13px; color: #64748b; text-transform: uppercase;">
                                        Cliente:
                                    </td>
                                    <td style="padding: 16px 20px; border-bottom: 1px solid #e2e8f0; font-size: 15px; font-weight: 700; color: #0E1D42;">
                                        {{ $data['full_name'] ?? 'No especificado' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 16px 20px; border-bottom: 1px solid #e2e8f0; font-weight: 600; font-size: 13px; color: #64748b; text-transform: uppercase;">
                                        Empresa:
                                    </td>
                                    <td style="padding: 16px 20px; border-bottom: 1px solid #e2e8f0; font-size: 15px; font-weight: 600; color: #0E1D42;">
                                        {{ $data['company'] ?? 'No especificado' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 16px 20px; border-bottom: 1px solid #e2e8f0; font-weight: 600; font-size: 13px; color: #64748b; text-transform: uppercase;">
                                        Correo electrónico:
                                    </td>
                                    <td style="padding: 16px 20px; border-bottom: 1px solid #e2e8f0; font-size: 14px; color: #0284c7;">
                                        <a href="mailto:{{ $data['email'] ?? '' }}" style="color: #0284c7; text-decoration: underline; font-weight: 600;">
                                            {{ $data['email'] ?? 'No especificado' }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 16px 20px; border-bottom: 1px solid #e2e8f0; font-weight: 600; font-size: 13px; color: #64748b; text-transform: uppercase;">
                                        Teléfono / WhatsApp:
                                    </td>
                                    <td style="padding: 16px 20px; border-bottom: 1px solid #e2e8f0; font-size: 14px; font-weight: 600; color: #15803d;">
                                        @if(!empty($data['phone']))
                                            <a href="https://wa.me/51{{ preg_replace('/[^0-9]/', '', $data['phone']) }}" target="_blank" style="color: #15803d; text-decoration: none; display: inline-flex; align-items: center;">
                                                📱 {{ $data['phone'] }} (Abrir WhatsApp)
                                            </a>
                                        @else
                                            No especificado
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 16px 20px; border-bottom: 1px solid #e2e8f0; font-weight: 600; font-size: 13px; color: #64748b; text-transform: uppercase;">
                                        Ciudad / Región:
                                    </td>
                                    <td style="padding: 16px 20px; border-bottom: 1px solid #e2e8f0; font-size: 14px; color: #334155;">
                                        📍 {{ $data['city'] ?? 'No especificado' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 16px 20px; border-bottom: 1px solid #e2e8f0; font-weight: 600; font-size: 13px; color: #64748b; text-transform: uppercase;">
                                        Interés / Servicio:
                                    </td>
                                    <td style="padding: 16px 20px; border-bottom: 1px solid #e2e8f0; font-size: 14px; font-weight: 600; color: #ED1B2F;">
                                        🎯 {{ $data['service_product'] ?? 'Comprar equipos' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding: 20px;">
                                        <div style="font-weight: 600; font-size: 13px; color: #64748b; text-transform: uppercase; margin-bottom: 8px;">
                                            Mensaje o Detalle del Proyecto:
                                        </div>
                                        <div style="background-color: #ffffff; border: 1px solid #cbd5e1; border-radius: 8px; padding: 16px; font-size: 14px; line-height: 1.6; color: #1e293b; white-space: pre-wrap;">{{ $data['message'] ?? 'Sin mensaje' }}</div>
                                    </td>
                                </tr>
                            </table>

                            <!-- Telemetry & Origin -->
                            @if(!empty($data['ip']) || !empty($data['device']) || !empty($data['client_system']))
                            <div style="background-color: #f1f5f9; border-radius: 8px; padding: 12px 16px; margin-bottom: 24px; font-size: 12px; color: #64748b;">
                                <strong>Datos de Conexión:</strong> 
                                IP: {{ $data['ip'] ?? 'N/D' }} | 
                                Dispositivo: {{ $data['device'] ?? 'N/D' }} | 
                                Sistema: {{ $data['client_system'] ?? 'N/D' }}
                            </div>
                            @endif

                            <!-- Action Buttons -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td align="center" style="padding-top: 10px;">
                                        @if(!empty($data['email']))
                                        <a href="mailto:{{ $data['email'] }}?subject=Respuesta a su consulta en DarTelecom" style="display: inline-block; background-color: #0E1D42; color: #ffffff; text-decoration: none; padding: 12px 24px; border-radius: 8px; font-weight: 600; font-size: 14px; margin: 4px;">
                                            ✉️ Responder por Correo
                                        </a>
                                        @endif
                                        @if(!empty($data['phone']))
                                        <a href="https://wa.me/51{{ preg_replace('/[^0-9]/', '', $data['phone']) }}" target="_blank" style="display: inline-block; background-color: #25D366; color: #ffffff; text-decoration: none; padding: 12px 24px; border-radius: 8px; font-weight: 600; font-size: 14px; margin: 4px;">
                                            💬 Contactar por WhatsApp
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 20px 30px; text-align: center; font-size: 12px; color: #94a3b8;">
                            Este mensaje fue generado automáticamente por el sitio web oficial de <strong>DarTelecom Perú</strong>.<br>
                            &copy; {{ date('Y') }} DarTelecom. Todos los derechos reservados.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
