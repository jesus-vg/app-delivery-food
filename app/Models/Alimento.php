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

    /**
     * Relacionamos el alimento con una categoria.
     * Relacion de 1 : N
     */
    public function categoria(){
        return $this->hasOne(CategoriaAlimento::class, 'id', 'categoria_alimento_id');
    }
}
