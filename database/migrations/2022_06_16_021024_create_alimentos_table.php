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
        Schema::create( 'alimentos', function ( Blueprint $table ) {
            $table->id();
            $table->unsignedBigInteger( 'categoria_alimento_id' );
            $table->string( 'nombre', 100 )->unique();
            $table->string( 'slug', 150 )->unique();
            $table->string( 'descripcion' );
            $table->string( 'imagen' )->nullable();
            $table->decimal( 'precio', 8, 2 );
            $table->boolean( 'activo' )->default( true ); // usar esto para mostrar o no un alimento
            $table->timestamps();
            // relaciones
            $table->foreign( 'categoria_alimento_id' )->references( 'id' )->on( 'categoria_alimentos' );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'alimentos' );
    }
};
