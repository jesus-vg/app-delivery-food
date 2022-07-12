<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use App\Http\Requests\customer\StorePedidoRequest;
use App\Http\Requests\customer\UpdatePedidoRequest;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user    = auth()->user();
        $pedidos = Pedido::select( 'id', 'usuario_id', 'total', 'estado', 'descripcion', 'created_at', 'updated_at' )
            ->whereUsuarioId( $user->id )
            ->latest()
            ->paginate( 10, ['*'], 'pagina' );

        return view( 'customer.pedidos.index', [
            'pedidos' => $pedidos,
        ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePedidoRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store( StorePedidoRequest $request )
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pedido          $pedido
     * @return \Illuminate\Http\Response
     */
    public function show( Pedido $pedido )
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pedido          $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit( Pedido $pedido )
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePedidoRequest $request
     * @param  \App\Models\Pedido                     $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(
        UpdatePedidoRequest $request,
        Pedido $pedido
    ) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedido          $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy( Pedido $pedido )
    {
        //
    }
}
