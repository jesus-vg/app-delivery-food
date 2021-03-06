<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
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
        $bebidas = Alimento::select(
            'id',
            'categoria_alimento_id',
            'nombre',
            'slug',
            'descripcion',
            'imagen',
            'precio',
            'activo',
            'created_at',
            'updated_at' )
            ->whereHas( 'categoria', function ( $q ) {
                $q->where( 'tipo_categoria', 'like', 'bebida' );
            } )
            ->with( 'categoria' )
            ->latest()
            ->paginate( 10, ['*'], 'pagina' );

        return view( 'admin.bebidas.index', [
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

        return view( 'admin.bebidas.create', [
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
        abort_unless( $bebida->categoria->tipo_categoria === 'bebida', 404 );

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
        abort_unless( $bebida->categoria->tipo_categoria === 'bebida', 404 );

        $categorias = CategoriaAlimento::select( 'id', 'nombre' )
            ->whereTipoCategoria( 'bebida' )
            ->orderByDesc( 'nombre' )
            ->get();

        return view( 'admin.bebidas.edit', [
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
        abort_unless( $bebida->categoria->tipo_categoria === 'bebida', 404 );

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
        abort_unless( $bebida->categoria->tipo_categoria === 'bebida', 404 );

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
                'message' => 'No se puede eliminar este registro porque se usa para el historial de ventas',
            ], 422 );
        }

    }
}
