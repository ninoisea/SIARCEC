<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => 'required|alfa_space|min:3|max:35',
            'last_name' => 'required|alfa_space|max:255',
            'email' => 'required|email|max:255',
            'num_id' => 'required|numeric|exr_ced',
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
            'role_id'    => 'rol',
        ];
    }
}