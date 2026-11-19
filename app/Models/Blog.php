<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['category_post_id', 'titulo', 'descripcion', 'extracto', 'imagen', 'visible', 'destacado', 'slug', 'meta_title', 'meta_description', 'meta_keywords', 'meta_image'];


    // app/Models/Blog.php
    public function category()
    {
        return $this->belongsTo(CategoryPost::class, 'category_post_id'); // Especificar la clave foránea
    }


    /*public static function boot()
    {
        parent::boot();

        static::deleted(function ($article) {
            $article->tags()->detach();
        });
    }*/
}
