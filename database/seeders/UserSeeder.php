<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Pipeline\Hub;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table( 'users' )->insert( [
            'name'              => 'Jesus Villegas gonzalez',
            'email'             => 'jesus@gmail.com',
            'email_verified_at' => now(),
            'password'          => Hash::make( 12345678 ),
            'remember_token'    => Str::random( 10 ),
            'type'              => 'admin',
            'created_at'        => now(),
            'updated_at'        => now(),
        ] );

        DB::table( 'users' )->insert( [
            'name'              => 'Chucho',
            'email'             => 'chucho@gmail.com',
            'email_verified_at' => now(),
            'password'          => Hash::make( 12345678 ),
            'remember_token'    => Str::random( 10 ),
            'type'              => 'cliente',
            'created_at'        => now(),
            'updated_at'        => now(),
        ] );
    }
}
