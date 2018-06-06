<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Schema::defaultStringLength(191);
        \Carbon::setLocale(config('app.locale'));

        /**
         * validacion por expresion regular de una cedula de identidad.
         * de 6 a 8 caracteres
         * y solo numeros del 0 al 9
         */
        \Validator::extend('exr_ced', function($attribute, $value)
        {
            if ($value[0] == '0') return false;
            return preg_match('/^([0-9]{5,10})$/', $value);
        }, 'El campo :attribute es incorrecto');

        /**
         * Comprueba que sea la contraseña actual del usuario autentificado.
         */
        \Validator::extend('current_password', function($attribute, $value)
        {
            return \Hash::check($value, \Auth::user()->password);
        }, 'El campo :attribute no coincide con su contraseña actual.');

        \Validator::extend('image64', function ($attribute, $value, $parameters, $validator) {
            $type = explode('/', explode(':', substr($value, 0, strpos($value, ';')))[1])[1];
            if (in_array($type, $parameters)) {
                return true;
            }
            return false;
        });

        \Validator::replacer('image64', function($message, $attribute, $rule, $parameters) {
            return str_replace(':values',join(",",$parameters),$message);
        });

        
        /**
         * Verifiva el campo solo tenga letras y espacios.
         */
        \Validator::extend('alfa_space', function($attribute, $value)
        {
            if ($value[0] == '') return false;
            return preg_match('/.([a-zA-Z])$/', $value);
            return false;
        }, 'No debe poseer caracteres especiales ni números.');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
