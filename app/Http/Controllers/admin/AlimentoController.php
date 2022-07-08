<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
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
        $alimentos = Alimento::select(
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
                $q->where( 'tipo_categoria', 'like', 'alimento' );
            } )
            ->with( 'categoria' )
            ->latest()
            ->paginate( 10, ['*'], 'pagina' );

        return view( 'admin.alimentos.index', [
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

        return view( 'admin.alimentos.create', [
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
        abort_unless( $alimento->categoria->tipo_categoria === 'alimento', 404 );

        return response()->json( $alimento );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alimento        $alimento
     * @return \Illuminate\Http\Response
     */
    public function edit( Alimento $alimento )
    {
        abort_unless( $alimento->categoria->tipo_categoria === 'alimento', 404 );

        $categorias = CategoriaAlimento::select( 'id', 'nombre' )
            ->whereTipoCategoria( 'alimento' )
            ->orderByDesc( 'nombre' )
            ->get();

        return view( 'admin.alimentos.edit', [
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
        abort_unless( $alimento->categoria->tipo_categoria === 'alimento', 404 );

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

        return to_route( 'alimentos.edit', $alimento )->with( 'success', 'Datos actualizados correctamente' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alimento        $alimento
     * @return \Illuminate\Http\Response
     */
    public function destroy( Alimento $alimento )
    {
        abort_unless( $alimento->categoria->tipo_categoria === 'alimento', 404 );

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
                'message' => 'No se puede eliminar este registro porque se usa para el historial de ventas',
            ], 422 );
        }
    }
}
