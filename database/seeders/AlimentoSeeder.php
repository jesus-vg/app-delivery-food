<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AlimentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table( 'alimentos' )->insert( [
            'categoria_alimento_id' => 1,
            'nombre'                => 'Pollo a la parrilla',
            'slug'                  => Str::slug( 'Pollo a la parrilla' ),
            'descripcion'           => 'Pollo a la parrilla con salsa de tomate',
            'precio'                => 27.90,
            'activo'                => true,
            'created_at'            => now(),
            'updated_at'            => now(),
        ] );
        DB::table( 'alimentos' )->insert( [
            'categoria_alimento_id' => 1,
            'nombre'                => 'Cerveza corona 373ml',
            'slug'                  => Str::slug( 'Cerveza corona 373ml' ),
            'descripcion'           => 'Cerveza corona 373ml lata 1pz',
            'precio'                => 33.50,
            'activo'                => true,
            'created_at'            => now(),
            'updated_at'            => now(),
        ] );
        DB::table( 'alimentos' )->insert( [
            'categoria_alimento_id' => 1,
            'nombre'                => 'Jarra con agua de tamarindo 2L',
            'slug'                  => Str::slug( 'Jarra con agua de tamarindo 2L' ),
            'descripcion'           => 'Jarra con agua de tamarindo 2L',
            'precio'                => 27.90,
            'activo'                => true,
            'created_at'            => now(),
            'updated_at'            => now(),
        ] );
        DB::table( 'alimentos' )->insert( [
            'categoria_alimento_id' => 1,
            'nombre'                => 'Camarones al mojo de ajo',
            'slug'                  => Str::slug( 'Camarones al mojo de ajo' ),
            'descripcion'           => 'Platillo con camarones al mojo de ajo con salsa de tomate',
            'precio'                => 179.90,
            'activo'                => true,
            'created_at'            => now(),
            'updated_at'            => now(),
        ] );
    }
}
