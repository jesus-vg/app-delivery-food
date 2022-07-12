<?php

use App\Http\Controllers\admin\AlimentoController as AdminAlimentoController;
use App\Http\Controllers\admin\BebidaController as AdminBebidaController;
use App\Http\Controllers\admin\CategoriaAlimentoController;
use App\Http\Controllers\admin\CategoriaBebidaController;
use App\Http\Controllers\admin\ClienteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\EmpresaController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\customer\ClienteController as CustomerController;
use App\Http\Controllers\customer\PedidoController as CustomerPredidoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AlimentoController;
use App\Http\Controllers\BebidaController;


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
    ->prefix( 'admin' )
    ->group( function () {
        Route::get( '/', function () {
            return view( 'admin.index' );
        } )->name( 'admin.dashboard' );

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

        Route::controller( AdminAlimentoController::class )
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

        Route::controller( AdminBebidaController::class )
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
    ->prefix( 'cliente' )
    ->group( function () {
        Route::get( '/', function () {
            return view( 'customer.index' );
        } )->name( 'cliente.dashboard' );

        Route::controller( CustomerController::class )
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

        Route::resource( 'pedidos', CustomerPredidoController::class )
            ->names( 'customer_pedidos' ); // nombre de las rutas ej. vacantes.index, vacantes.create, etc

    } );

require __DIR__ . '/auth.php';

// Ruta para redirijir al usuario a su dasboard respectivo
// util para poder usar el breadcrumb
Route::get( '/dashboard', function () {
    if ( auth()->check() ) {
        switch ( auth()->user()->type ) {
            case 'cliente':
                return to_route( 'cliente.dashboard' )->with( 'greeting', '_' );
                break;
            case 'admin':
                return to_route( 'admin.dashboard' )->with( 'greeting', '_' );
                break;
        }
    }

    return to_route( 'home' );
} )->name( 'dashboard' );

// rutas libres

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contacto', [HomeController::class, 'contacto'])->name('contacto');

Route::controller( ImagenController::class )->prefix( 'imagen' )->group( function () {
    Route::get( '/{path?}', 'getImagenMini' )->name( 'imagen.getImagenMini' );
} );

Route::controller( AlimentoController::class )
    ->prefix( 'alimentos' )
    ->name('guest_alimentos.')
    ->group( function () {
        Route::get( '/', 'index' )->name( 'index' );
        Route::get( '/{alimento:slug}', 'show' )->name( 'show' );
    } );

Route::controller( BebidaController::class )
    ->prefix( 'bebidas' )
    ->name( 'guest_bebidas.' )
    ->group( function () {
        Route::get( '/', 'index' )->name( 'index' );
        Route::get( '/{bebida:slug}', 'show' )->name( 'show' );
    } );
