<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|max:255|unique:users',
            'last_name' => 'required|alfa_space|max:255',
            'name' => 'required|alfa_space|max:255',
            'num_id' => 'required|numeric|exr_ced|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'email'     => 'correo',
            'last_name' => 'apellido',
            'name'      => 'nombre',
            'num_id'    => 'cedula',
            'password'  => 'contraseña',
            'role_id'    => 'rol',
        ];
    }
}
