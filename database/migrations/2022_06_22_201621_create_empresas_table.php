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
        Schema::create( 'empresas', function ( Blueprint $table ) {
            $table->id();
            $table->string( 'nombre', 100 );
            $table->string( 'imagen_principal' )->nullable();
            $table->text( 'descripcion' );
            $table->string( 'direccion', 100 ); // Ej. Calle tlaloc
            $table->string( 'colonia', 100 );
            $table->string( 'latitud', 100 );
            $table->string( 'longitud', 100 );
            $table->string( 'telefono', 20 );
            $table->time( 'hora_apertura' );
            $table->time( 'hora_cierre' );
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'empresas' );
    }
};
