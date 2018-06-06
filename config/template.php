<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Versión
    |------------------------------------------------- ------------------------
    |
    | Muestra la versión de la aplicación en el pie de página del tablero. Esta
    | no está en la referencia del paquete real, esta es la versión de
    | la aplicación que estás construyendo es.
    |
    */

    'version' => '0.0.1',

    /*
    |--------------------------------------------------------------------------
    | Inscripción abierta
    |------------------------------------------------- ------------------------
    |
    | Elija si los nuevos usuarios / administradores pueden registrarse.
    | Esto mostrará el botón Registrar en el menú y permitirá el acceso al
    | Funciones de registro en AuthController.
    |
    | Por defecto, el registro está abierto solo en localhost.
    */
    'registration_open' => env('REGISTRATION_OPEN', false),

    /*
    |--------------------------------------------------------------------------
    | Logos del Menu
    |--------------------------------------------------------------------------
    */
    'logo_lg'   => '<img src="/images/logo_grande2.png" style="height: 33px;" alt="logo">',
    'logo_xs' => '<img src="/images/logo_pequeno.png" alt="logo" height="60px" style="    margin-left: 15px;">',

    /*
    |--------------------------------------------------------------------------
    | Créditos de pie de página
    |------------------------------------------------- ------------------------
    |
    | Por defecto, esto se usará para los derechos de autor en el interior de la
    | Panel de administrador. Esto también dará como resultado el año actual,
    | de modo que el copyrightse mantiene actualizado.
    |
    */

    'credits' => '<a href="#">Instituto Universitario de Tecnologia de Maracaibo</a>',

];
