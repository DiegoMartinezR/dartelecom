<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class General extends Model
{
    use HasFactory;

    protected $fillable = ['address', 'inside', 'district', 'city', 'country', 'cellphone','office_phone', 'email', 'facebook', 'instagram','youtube','linkedin', 'twitter', 'tiktok', 'whatsapp','whatsapp2', 'support_one', 'support_two',  'form_email', 'business_hours', 'schedule', 'mensaje_whatsapp', 'aboutus', 'mapa', 'meta_title', 'meta_description', 'meta_keywords', 'meta_image'];


    public function categoria()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Obtener lista limpia de correos destinatarios para notificaciones de contacto al administrador.
     * Soporta múltiples correos separados por comas, punto y coma, espacios o saltos de línea.
     *
     * @return array
     */
    public function getNotificationEmails(): array
    {
        $destinatarios = [];

        // 1. Revisar si hay correos configurados en form_email (campo específico para alertas de formularios)
        if (!empty($this->form_email)) {
            $emails = preg_split('/[,\s;]+/', $this->form_email, -1, PREG_SPLIT_NO_EMPTY);
            foreach ($emails as $email) {
                $email = trim($email);
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $destinatarios[] = $email;
                }
            }
        }

        // 2. Si no hay correos válidos en form_email, usar el email principal de la empresa
        if (empty($destinatarios) && !empty($this->email)) {
            $emails = preg_split('/[,\s;]+/', $this->email, -1, PREG_SPLIT_NO_EMPTY);
            foreach ($emails as $email) {
                $email = trim($email);
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $destinatarios[] = $email;
                }
            }
        }

        // 3. Fallback por defecto si no hubiera ninguno configurado
        if (empty($destinatarios)) {
            $destinatarios[] = 'ventas@dartelecom.pe';
        }

        return array_values(array_unique($destinatarios));
    }
}
