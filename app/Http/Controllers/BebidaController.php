<?php

namespace App\Http\Controllers;

use App\Models\Bebida;
use App\Http\Requests\StoreUpdateAlimentoRequest;
use Intervention\Image\Facades\Image;
use App\Models\Alimento;
use App\Models\CategoriaAlimento;
use Exception;
use Illuminate\Support\Facades\Storage;

class BebidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bebidas = Alimento::join(
            'categoria_alimentos',
            'alimentos.categoria_alimento_id',
            '=',
            'categoria_alimentos.id' )
            ->select(
                'alimentos.id',
                'alimentos.categoria_alimento_id',
                'alimentos.nombre',
                'alimentos.slug',
                'alimentos.descripcion',
                'alimentos.imagen',
                'alimentos.precio',
                'alimentos.activo',
                'alimentos.created_at',
                'alimentos.updated_at',
                'categoria_alimentos.nombre as nombre_categoria' ) // ponemos un alias a la columna
            ->where( 'categoria_alimentos.tipo_categoria', 'bebida' ) // solo los alimentos de tipo bebida
            ->latest()
            ->paginate( 10, ['*'], 'pagina' );

        return view( 'bebidas.index', [
            'bebidas' => $bebidas,
        ] );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = CategoriaAlimento::select( 'id', 'nombre' )
            ->whereTipoCategoria( 'bebida' )
            ->orderByDesc( 'nombre' )
            ->get();

        return view( 'bebidas.create', [
            'bebida'     => new Alimento(),
            'categorias' => $categorias,
        ] );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateAlimentoRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store( StoreUpdateAlimentoRequest $request )
    {
        // dd( $request->all() );
        $validated = $request->validated();

        $bebida = Alimento::create( [
            ...$validated,
            'imagen' => '',
        ] );

        $pathImagen = '';

        // validamos que existe el campo imagen
        if ( array_key_exists( 'imagen', $validated ) ) {
            // guardamos la imagen en el disco public
            $pathImagen = $validated['imagen']->store( 'bebidas/' . $bebida->id, 'public' );

            // aplicamos el filtro para redimensionar la imagen
            Image::make( public_path( 'storage/' . $pathImagen ) )->fit( 800, 500, function ( $constraint ) {
                $constraint->upsize();
            } )->save();
        } else {
            $pathImagen = $bebida->imagen;
        }

        $bebida->update( [
            'imagen' => $pathImagen,
        ] );

        return to_route( 'bebidas.edit', $bebida );

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alimento        $bebida
     * @return \Illuminate\Http\Response
     */
    public function show( Alimento $bebida )
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alimento        $bebida
     * @return \Illuminate\Http\Response
     */
    public function edit( Alimento $bebida )
    {
        $categorias = CategoriaAlimento::select( 'id', 'nombre' )
            ->whereTipoCategoria( 'bebida' )
            ->orderByDesc( 'nombre' )
            ->get();

        return view( 'bebidas.edit', [
            'bebida'     => $bebida,
            'categorias' => $categorias,
        ] );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBebidaRequest $request
     * @param  \App\Models\Alimento                   $bebida
     * @return \Illuminate\Http\Response
     */
    public function update(
        StoreUpdateAlimentoRequest $request,
        Alimento $bebida
    ) {
        $validated = $request->validated();

        $pathImagen = '';

        // validamos que existe el campo imagen
        if ( array_key_exists( 'imagen', $validated ) ) {
            // guardamos la imagen en el disco public
            $pathImagen = $validated['imagen']->store( 'bebidas/' . $bebida->id, 'public' );

            // aplicamos el filtro para redimensionar la imagen
            Image::make( public_path( 'storage/' . $pathImagen ) )->fit( 800, 500, function ( $constraint ) {
                $constraint->upsize();
            } )->save();

            // Eliminamos la imagen anterior si existe
            if ( $bebida->imagen && Storage::disk( 'public' )->exists( $bebida->imagen ) ) {
                Storage::disk( 'public' )->delete( $bebida->imagen );
            }
        } else {
            $pathImagen = $bebida->imagen;
        }

        $bebida->update( [
            ...$validated,
            'imagen' => $pathImagen,
        ] );

        return to_route( 'bebidas.edit', $bebida );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alimento        $bebida
     * @return \Illuminate\Http\Response
     */
    public function destroy( Alimento $bebida )
    {
        try {
            $bebida->delete();

            // Eliminamos el directorio de las imagenes
            if ( Storage::disk( 'public' )->exists( 'bebidas/' . $bebida->id ) ) {
                Storage::disk( 'public' )->deleteDirectory( 'bebidas/' . $bebida->id );
            }

            return response()->json( [
                'success' => 'Eliminado correctamente',
            ] );
        } catch ( Exception $e ) {

            return response()->json( [
                'error' => 'No se puede eliminar este registro porque se usa para el historial de ventas',
            ], 403 );
        }

    }
}
