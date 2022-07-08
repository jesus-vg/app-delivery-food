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
        Schema::create( 'direcciones', function ( Blueprint $table ) {
            $table->id();
            $table->unsignedBigInteger( 'usuario_id' );
            $table->string( 'direccion', 150 );
            $table->string( 'colonia', 150 );
            $table->string( 'referencia', 150 );
            $table->string( 'latitud' );
            $table->string( 'longitud' );
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
        Schema::dropIfExists( 'direcciones' );
    }
};
