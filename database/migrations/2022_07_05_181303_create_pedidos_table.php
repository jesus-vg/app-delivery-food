<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'pedidos', function ( Blueprint $table ) {
            $table->id();
            $table->unsignedBigInteger( 'usuario_id' );
            $table->decimal( 'total', 8, 2 );
            $table->tinyInteger( 'estado' )->default(0);
            // 0 en carrito,
            // 1 el usuario confirma y solicita el pedido (el usuario podrá cancelar el pedido) IMPORTANTE VALIDAR LA HORA Y CIERRE DE SERVICIO
            // 2 la empresa confirma su pedido y empieza a prepararlo (comprobar el estado del pedido, que el cliente no haya cancelado)
            // 3 en camino
            // 4 entregado
            // 5 cancelado
            $table->string('descripcion', 200); // por si se cancela, escribir el motivo
            $table->timestamps();
            // relaciones
            $table->foreign( 'usuario_id' )->references( 'id' )->on( 'users' );

        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'pedidos' );
    }
};
