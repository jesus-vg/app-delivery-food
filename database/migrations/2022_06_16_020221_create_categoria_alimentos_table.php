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
        Schema::create( 'categoria_alimentos', function ( Blueprint $table ) {
            $table->id();
            $table->string( 'nombre', 50 )->unique();
            $table->string( 'slug', 100 )->unique();
            $table->string( 'tipo_categoria', 50 ); // alimento - bebida
            $table->boolean( 'activo' )->default( true ); // usar esto para mostrar o no alimentos de una categoria
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
        Schema::dropIfExists( 'categoria_alimentos' );
    }
};
