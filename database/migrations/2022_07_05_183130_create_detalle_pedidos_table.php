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
        Schema::create( 'detalle_pedidos', function ( Blueprint $table ) {
            $table->id();
            $table->unsignedBigInteger( 'pedido_id' );
            $table->unsignedBigInteger( 'alimento_id' );
            $table->decimal( 'precio', 8, 2 );
            $table->unsignedInteger( 'cantidad' );
            $table->timestamps();
            // relaciones
            $table->foreign( 'pedido_id' )->references( 'id' )->on( 'pedidos' );
            $table->foreign( 'alimento_id' )->references( 'id' )->on( 'alimentos' );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'detalle_pedidos' );
    }
};
