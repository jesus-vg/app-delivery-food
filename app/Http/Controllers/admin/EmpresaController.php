<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmpresaUpdateRequest;
use App\Models\Empresa;

class EmpresaController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empresa         $empresa
     * @return \Illuminate\Http\Response
     */
    public function show( Empresa $empresa )
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empresa         $empresa
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $empresa = Empresa::select(
            'id',
            'nombre',
            'imagen_principal',
            'descripcion',
            'direccion',
            'colonia',
            'latitud',
            'longitud',
            'telefono',
            'hora_apertura',
            'hora_cierre' )
            ->whereId( 1 )
            ->first(); // que nos devuelva solo un elemento y no un array con get()

        return view( 'admin.empresa.edit', [
            'empresa' => $empresa,
        ] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request    $request
     * @param  \App\Models\Empresa         $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(
        EmpresaUpdateRequest $request,
        Empresa $empresa
    ) {
        $validated = $request->validated();
        // dd( $validated );
        $empresa->update( $validated );

        return to_route( 'empresa.edit', [
            'empresa' => $empresa,
        ] )->with( 'success', 'Los datos de la empresa han sido actualizados' );
    }
}
