<?php

namespace App\Http\Controllers;

use App\Models\Alimento;
use App\Models\CategoriaAlimento;
use App\Models\Empresa;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // $alimentos          = Alimento::select();
        // $bebidas            = 4;
        // $categoriasAlimento = CategoriaAlimento::select();
        // $categoriasBebida   = CategoriaAlimento::select();

        return view( 'welcome', [
            'alimentos'          => [],
            // 'alimentos'          => $alimentos,
            'bebidas'            => [],
            // 'bebidas'            => $bebidas,
            'categoriasAlimento' => [],
            // 'categoriasAlimento' => $categoriasAlimento,
            'categoriasBebida'   => [],
            // 'categoriasBebida'   => $categoriasBebida,
        ] );
    }

    public function contacto()
    {
        // la info de la empresa viene desde DatosEmpresaProvider

        return view( 'guest.empresa.contacto');
    }
}
