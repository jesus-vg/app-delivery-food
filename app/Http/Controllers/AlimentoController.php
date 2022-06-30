<?php

namespace App\Http\Controllers;

use App\Models\Alimento;
use App\Models\CategoriaAlimento;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreUpdateAlimentoRequest;
use Exception;

class AlimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $alimentos = Alimento::select(
        //     'id',
        //     'categoria_alimento_id',
        //     'nombre',
        //     'slug',
        //     'descripcion',
        //     'imagen',
        //     'precio',
        //     'activo',
        //     'created_at',
        //     'updated_at' )
        //     ->where( function ( $query ) {
        //         $query->select( 'tipo_categoria' )
        //             ->from( 'categoria_alimentos' )
        //             ->whereColumn( 'categoria_alimentos.id', 'alimentos.categoria_alimento_id' )
        //             ->limit( 1 );
        //     }, 'alimento' )
        //     ->latest()
        //     ->paginate( 10, ['*'], 'pagina' );

        // https://laravel.com/docs/9.x/queries#left-join-right-join-clause
        $alimentos = Alimento::join(
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
            ->where( 'categoria_alimentos.tipo_categoria', 'alimento' )
            ->latest()
            ->paginate( 10, ['*'], 'pagina' );
        // dd( $alimentos );
        // dd( $alimentos );

        // throwException($e);

        return view( 'alimentos.index', [
            'alimentos' => $alimentos,
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
            ->whereTipoCategoria( 'alimento' )
            ->orderByDesc( 'nombre' )
            ->get();

        return view( 'alimentos.create', [
            'alimento'   => new Alimento(),
            'categorias' => $categorias,
        ] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAlimentoRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store( StoreUpdateAlimentoRequest $request )
    {
        // dd( $request->all() );
        $validated = $request->validated();

        $alimento = Alimento::create( [
            ...$validated,
            'imagen' => '',
        ] );

        $pathImagen = '';

        // validamos que existe el campo imagen
        if ( array_key_exists( 'imagen', $validated ) ) {
            // guardamos la imagen en el disco public
            $pathImagen = $validated['imagen']->store( 'alimentos/' . $alimento->id, 'public' );

            // aplicamos el filtro para redimensionar la imagen
            Image::make( public_path( 'storage/' . $pathImagen ) )->fit( 800, 500, function ( $constraint ) {
                $constraint->upsize();
            } )->save();
        } else {
            $pathImagen = $alimento->imagen;
        }

        $alimento->update( [
            'imagen' => $pathImagen,
        ] );

        return to_route( 'alimentos.edit', $alimento );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alimento        $alimento
     * @return \Illuminate\Http\Response
     */
    public function show( Alimento $alimento )
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alimento        $alimento
     * @return \Illuminate\Http\Response
     */
    public function edit( Alimento $alimento )
    {
        $categorias = CategoriaAlimento::select( 'id', 'nombre' )
            ->whereTipoCategoria( 'alimento' )
            ->orderByDesc( 'nombre' )
            ->get();

        return view( 'alimentos.edit', [
            'alimento'   => $alimento,
            'categorias' => $categorias,
        ] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAlimentoRequest $request
     * @param  \App\Models\Alimento                     $alimento
     * @return \Illuminate\Http\Response
     */
    public function update(
        StoreUpdateAlimentoRequest $request,
        Alimento $alimento
    ) {
        // dd( $request->all() );
        // dd( $alimento );
        $validated = $request->validated();

        $pathImagen = '';

        // validamos que existe el campo imagen
        if ( array_key_exists( 'imagen', $validated ) ) {
            // guardamos la imagen en el disco public
            $pathImagen = $validated['imagen']->store( 'alimentos/' . $alimento->id, 'public' );

            // aplicamos el filtro para redimensionar la imagen
            Image::make( public_path( 'storage/' . $pathImagen ) )->fit( 800, 500, function ( $constraint ) {
                $constraint->upsize();
            } )->save();

            // Eliminamos la imagen anterior si existe
            if ( $alimento->imagen && Storage::disk( 'public' )->exists( $alimento->imagen ) ) {
                Storage::disk( 'public' )->delete( $alimento->imagen );
            }
        } else {
            $pathImagen = $alimento->imagen;
        }

        $alimento->update( [
            ...$validated,
            'imagen' => $pathImagen,
        ] );

        return to_route( 'alimentos.edit', $alimento );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alimento        $alimento
     * @return \Illuminate\Http\Response
     */
    public function destroy( Alimento $alimento )
    {
        try {
            $alimento->delete();

            // Eliminamos el directorio de las imagenes
            if ( Storage::disk( 'public' )->exists( 'alimentos/' . $alimento->id ) ) {
                Storage::disk( 'public' )->deleteDirectory( 'alimentos/' . $alimento->id );
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
