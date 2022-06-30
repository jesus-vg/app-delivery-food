<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    /**
     * @param  Request $request
     * @return mixed
     */
    public function getImagenMini(
        Request $request,
        $path = ''
    ) {
        $path = str_replace( '-', '/', $path );
        // dd( $path );

        if ( !$path ||
            !in_array( pathinfo( $path, PATHINFO_EXTENSION ), ['jpeg', 'png', 'jpg', 'gif', 'svg'] ) ||
            !file_exists( public_path( 'storage/' . $path ) ) ) {
            $stream = Image::make( public_path( 'storage/img/nube-de-error-404.gif' ) )->stream( 'gif' );

            return response( $stream )->header( 'Content-Type', 'image/gif' );
        }

        $stream = Image::make( public_path( 'storage/' . $path ) )->stream( 'jpg', 20 );

        return response( $stream )->header( 'Content-Type', 'image/jpeg' );

    }
}
