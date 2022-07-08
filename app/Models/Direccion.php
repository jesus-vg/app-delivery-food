<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

    protected $table ="direcciones";

    /**
     * @var array
     */
    protected $fillable = [
        // 'usuario_id',
        'direccion',
        'colonia',
        'referencia',
        'latitud',
        'longitud',
    ];
}
