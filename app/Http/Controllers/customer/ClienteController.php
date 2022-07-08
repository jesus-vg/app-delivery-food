<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCuentaClienteRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{

    /**
     * Este controlador tiene policy para validar que el usuario pueda haces cambios solo a su misma cuenta
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User            $user
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $this->authorize( 'updateCliente', auth()->user() );

        return view( 'customer.cuenta.edit', [
            'user' => auth()->user(),
        ] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request    $request
     * @param  \App\Models\User            $user
     * @return \Illuminate\Http\Response
     */
    public function update(
        UpdateCuentaClienteRequest $request,
        User $user
    ) {
        $this->authorize( 'updateCliente', $user );

        $validated = $request->validated();
        // La info viene para ser insertado en dos tablas, users y direcciones

        $password    = $user->password;
        $newPassword = $validated['password'] === null ? $password : Hash::make( $validated['password'] );
        // dd( $validated, $password, $newPassword );

        $user->update( [
            'name'     => $validated['name'],
            'telefono' => $validated['telefono'],
            'password' => $newPassword,
        ] );

        // 1ro ubicamos que exista un campo con el id del usuario en la tabla direcciones para no duplicar
        $user->direccion()->updateOrCreate(
            [
                'usuario_id' => $user->id, // campo identificador que debe ser unico
            ],
            [
                'direccion'  => $validated['direccion'],
                'colonia'    => $validated['colonia'],
                'referencia' => $validated['referencia'],
                'latitud'    => $validated['latitud'],
                'longitud'   => $validated['longitud'],
            ]
        );

        return back()->with( 'success', 'Tus datos se han actualizado correctamente' );
    }

    /**
     * Elimina el usuario autenticado mediante axios.
     * Se realiza desde la cuenta del cliente.
     *
     * @param  \App\Models\User            $user
     * @return \Illuminate\Http\Response
     */
    public function destroy( User $user )
    {
        $this->authorize( 'delete', $user );

        abort_unless( auth()->user()->id === $user->id && $this->user()->type === 'cliente', 422 );
        /**
         * TODO: antes de eliminar validar que sea el mismo cliente antuenticado el que quiere eliminar la cueta
         * TODO: Validar que no tenga pedidos en curso
         * TODO: cerrar la seccion del usuario que acaba de eliminar su cuenta y regresarlo al home
         */

        return response()->json( [
            'message' => 'Hubo un problema al eliminar',
        ] );
    }
}
