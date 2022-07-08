<?php

use App\Http\Controllers\AlimentoController;
use App\Http\Controllers\BebidaController;
use App\Http\Controllers\CategoriaAlimentoController;
use App\Http\Controllers\CategoriaBebidaController;
use App\Http\Controllers\ClienteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\ImagenController;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::middleware( ['auth', 'user_admin'] )
    ->group( function () {
        Route::get( '/dashboard', function () {
            return to_route( 'empresa.edit' );
        } )->name( 'dashboard' );

        Route::controller( EmpresaController::class )
            ->prefix( 'empresa' )
            ->group( function () {
                Route::get( '/edit', 'edit' )->name( 'empresa.edit' );
                Route::put( '/{empresa}', 'update' )->name( 'empresa.update' );
            } );

        Route::controller( CategoriaAlimentoController::class )
            ->prefix( 'alimentos/categorias' )
            ->name( 'categoria_alimentos.' )
            ->group( function () {
                Route::get( '/', 'index' )->name( 'index' );
                Route::post( '/', 'store' )->name( 'store' );
                Route::get( '/{categoria:slug}', 'show' )->name( 'show' );
                Route::put( '/{categoria}', 'update' )->name( 'update' );
                Route::delete( '/{categoria}', 'destroy' )->name( 'destroy' );
            } );

        Route::controller( AlimentoController::class )
            ->prefix( 'alimentos' )
            ->name( 'alimentos.' )
            ->group( function () {
                Route::get( '/', 'index' )->name( 'index' );
                Route::get( '/crear', 'create' )->name( 'create' );
                Route::post( '/', 'store' )->name( 'store' );
                Route::get( '/{alimento:slug}/editar', 'edit' )->name( 'edit' );
                Route::put( '/{alimento}', 'update' )->name( 'update' );
                Route::delete( '/{alimento}', 'destroy' )->name( 'destroy' );
            } );

        Route::controller( CategoriaBebidaController::class )
            ->prefix( 'bebidas/categorias' )
            ->name( 'categoria_bebidas.' )
            ->group( function () {
                Route::get( '/', 'index' )->name( 'index' );
                Route::post( '/', 'store' )->name( 'store' );
                Route::get( '/{categoria:slug}', 'show' )->name( 'show' );
                Route::put( '/{categoria}', 'update' )->name( 'update' );
                Route::delete( '/{categoria}', 'destroy' )->name( 'destroy' );
            } );

        Route::controller( BebidaController::class )
            ->prefix( 'bebidas' )
            ->name( 'bebidas.' )
            ->group( function () {
                Route::get( '/', 'index' )->name( 'index' );
                Route::get( '/crear', 'create' )->name( 'create' );
                Route::post( '/', 'store' )->name( 'store' );
                Route::get( '/{bebida:slug}', 'show' )->name( 'show' );
                Route::get( '/{bebida:slug}/editar', 'edit' )->name( 'edit' );
                Route::put( '/{bebida}', 'update' )->name( 'update' );
                Route::delete( '/{bebida}', 'destroy' )->name( 'destroy' );
            } );

        Route::controller( ClienteController::class )
            ->prefix( 'clientes' )
            ->name( 'clientes.' )
            ->group( function () {
                Route::get( '/', 'index' )->name( 'index' );
                Route::get( '/{cliente}', 'show' )->name( 'show' );
                Route::delete( '/{cliente}', 'destroy' )->name( 'destroy' );
            } );

    } );

Route::middleware( ['auth', 'user_cliente'] )
    ->group( function () {
        Route::controller( ClienteController::class )
            ->prefix( 'cuenta' )
            ->name( 'cuenta.' )
            ->group( function () {
                Route::get( '/', 'edit' )->name( 'edit' );
                Route::put( '/{user}', 'update' )->name( 'update' );
                Route::delete( '/{user}', 'destroy' )->name( 'destroy' );
            } );

        // Route::get( '/cuenta', [ClienteController::class, 'edit'] )->name( 'cuenta.edit' );
        // Route::put( '/cuenta/{user}', [ClienteController::class, 'update'] )->name( 'cuenta.update' );
        // Route::delete( '/cuenta/{user}', [ClienteController::class, 'destroy'] )->name( 'cuenta.destroy' );
    } );

require __DIR__ . '/auth.php';

// rutas libres

Route::get( '/', function () {
    return view( 'welcome' );
} );

Route::controller( ImagenController::class )->prefix( 'imagen' )->group( function () {
    Route::get( '/{path?}', 'getImagenMini' )->name( 'imagen.getImagenMini' );
} );

Route::controller( AlimentoController::class )
    ->prefix( 'alimentos' )
    ->group( function () {
        Route::get( '/{alimento:slug}', 'show' )->name( 'alimentos.show' );
    } );
