<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'nombre',
        'imagen_principal',
        'descripcion',
        'direccion',
        'colonia',
        'latitud',
        'longitud',
        'telefono',
        'hora_apertura',
        'hora_cierre',
    ];
}
