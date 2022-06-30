<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alimento extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'categoria_alimento_id',
        'nombre',
        'slug',
        'descripcion',
        'imagen',
        'precio',
        'activo',
    ];
}
