<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriaAlimentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table( 'categoria_alimentos' )->insert( [
            'nombre'         => 'Cervezas',
            'slug'           => Str::slug( 'Cervezas' ),
            'tipo_categoria' => 'bebida',
        ] );

        DB::table( 'categoria_alimentos' )->insert( [
            'nombre'         => 'Agua frescas',
            'slug'           => Str::slug( 'Agua frescas' ),
            'tipo_categoria' => 'bebida',
        ] );

        DB::table( 'categoria_alimentos' )->insert( [
            'nombre'         => 'Quesadillas',
            'slug'           => Str::slug( 'Quesadillas' ),
            'tipo_categoria' => 'alimento',
        ] );

        DB::table( 'categoria_alimentos' )->insert( [
            'nombre'         => 'Sopas',
            'slug'           => Str::slug( 'Sopas' ),
            'tipo_categoria' => 'alimento',
        ] );

        DB::table( 'categoria_alimentos' )->insert( [
            'nombre'         => 'Mariscos',
            'slug'           => Str::slug( 'Mariscos' ),
            'tipo_categoria' => 'alimento',
        ] );

        DB::table( 'categoria_alimentos' )->insert( [
            'nombre'         => 'Refrescos',
            'slug'           => Str::slug( 'Refrescos' ),
            'tipo_categoria' => 'bebida',
        ] );

        DB::table( 'categoria_alimentos' )->insert( [
            'nombre'         => 'Jugos',
            'slug'           => Str::slug( 'Jugos' ),
            'tipo_categoria' => 'bebida',
        ] );

        DB::table( 'categoria_alimentos' )->insert( [
            'nombre'         => 'Té',
            'slug'           => Str::slug( 'Té' ),
            'tipo_categoria' => 'bebida',
        ] );

        DB::table( 'categoria_alimentos' )->insert( [
            'nombre'         => 'Comida rápida',
            'slug'           => Str::slug( 'Comida rápida' ),
            'tipo_categoria' => 'alimento',
        ] );

        DB::table( 'categoria_alimentos' )->insert( [
            'nombre'         => 'Aguas',
            'slug'           => Str::slug( 'Aguas' ),
            'tipo_categoria' => 'bebida',
        ] );

    }
}
