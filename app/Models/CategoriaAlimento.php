<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaAlimento extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'nombre',
        'slug',
        'activo',
        'tipo_categoria'
    ];
}
