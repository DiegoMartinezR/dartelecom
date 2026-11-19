<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'slug', 
        'subtitle', 
        'icono', 
        'descripcion_breve', 
        'descripcion_extensa', 
        'imagen_principal',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_image',
        'visible'
    ];

    /**
     * Relación con los subservicios
     */
    public function subServices()
    {
        return $this->hasMany(SubService::class);
    }
}
