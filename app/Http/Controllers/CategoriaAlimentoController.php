<?php

namespace App\Http\Controllers;

use App\Models\CategoriaAlimento;
use App\Http\Requests\UpdateStoreCategoriaAlimentoRequest;
use Illuminate\Database\QueryException;

class CategoriaAlimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = CategoriaAlimento::select( 'id', 'nombre', 'slug', 'activo', 'created_at' )
            ->whereTipoCategoria( 'alimento' )
            ->latest()
            ->paginate( 10, ['*'], 'pagina' );

        return view( 'categorias_alimentos.index', [
            'categorias' => $categorias,
        ] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStoreCategoriaAlimentoRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store( UpdateStoreCategoriaAlimentoRequest $request )
    {
        $validated = $request->validated();
        // dd($validated);

        CategoriaAlimento::create( [
            ...$validated,
        ] );

        return to_route( 'categoria_alimentos.index' )->with( 'success', 'Categoría agregada correctamente' );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoriaAlimento $categoriaAlimento
     * @return \Illuminate\Http\Response
     */
    public function show( CategoriaAlimento $categoriaAlimento )
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStoreCategoriaAlimentoRequest $request
     * @param  \App\Models\CategoriaAlimento                          $categoriaAlimento
     * @return \Illuminate\Http\Response
     */
    public function update(
        UpdateStoreCategoriaAlimentoRequest $request,
        CategoriaAlimento $categoria
    ) {
        $validated = $request->validated();

        // dd($categoria);
        if ( $categoria->tipo_categoria !== 'alimento' ) {
            return response()->json( [
                'message' => 'No se pueden hacer cambios a este registro porque no pertenece a esta sección',
            ], 422 );
        }

        $categoria->update( $validated );

        return response()->json( [
            'ok'        => 'Datos actualizados',
            'categoria' => $categoria,
        ] );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoriaAlimento $categoriaAlimento
     * @return \Illuminate\Http\Response
     */
    public function destroy( CategoriaAlimento $categoria )
    {
        // dd($categoria);
        if ( $categoria->tipo_categoria !== 'alimento' ) {
            return response()->json( [
                'message' => 'No se puede eliminar este registro porque no pertenece a esta sección',
            ], 422 );
        }

        try {
            $categoria->delete();

            return response()->json( [
                'success' => 'Eliminado correctamente',
            ] );
        } catch ( QueryException $e ) {
            return response()->json( [
                'message' => 'No se puede eliminar este registro porque tiene relación con algunos alimentos registrados',
            ], 422 );
        }

    }
}
