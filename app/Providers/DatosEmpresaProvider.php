<?php

namespace App\Providers;

use App\Models\Empresa;
use DateTime;
use Illuminate\Support\ServiceProvider;

class DatosEmpresaProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer( '*', function ( $view ) {
            $infoEmpresa = Empresa::findOrFail( 1 );

            $horaApertura = ( new DateTime( date( 'Y-m-d' ) . ' ' . $infoEmpresa->hora_apertura ) )->format( 'g:i a' );
            $horaCierre   = ( new DateTime( date( 'Y-m-d' ) . ' ' . $infoEmpresa->hora_cierre ) )->format( 'g:i a' );

            // $view->with( 'infoEmpresa', $infoEmpresa, $horaApertura, $horaCierre] );
            $view->with( [
                'infoEmpresa'  => $infoEmpresa,
                'horaApertura' => $horaApertura,
                'horaCierre'   => $horaCierre,
            ] );
        } );
        //
    }
}
