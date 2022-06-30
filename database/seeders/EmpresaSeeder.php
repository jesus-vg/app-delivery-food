<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table( 'empresas' )->insert( [
            'id'               => 1,
            'nombre'           => 'Miscelanea san juanito',
            'imagen_principal' => '',
            'descripcion'      => 'lorem ipsum dolor sit amet, consectetur adipis',
            'direccion'        => 'lorem ipsum dolor sit amet',
            'colonia'          => 'lorem ipsum dolor sit amet',
            'latitud'          => '17.54591000000005',
            'longitud'         => '-98.57582999999994',
            'telefono'         => '7573874590',
            'hora_apertura'    => '08:00:00',
            'hora_cierre'      => '17:00:00',
            'created_at'       => now(),
            'updated_at'       => now(),
        ] );
    }
}
