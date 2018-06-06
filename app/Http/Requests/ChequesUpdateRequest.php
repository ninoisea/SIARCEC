<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChequesUpdateRequest extends FormRequest
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
            'num' => 'required|numeric|digits_between:8,16',
            'beneficiary' => 'required|alfa_space',
            'bank_id' => 'required|numeric',
            'num_box' => 'required_if:state,1',
            'shelf_id' => 'required_if:state,1',
            'box_id' => 'required_if:state,1',
            'folder_id' => 'required_if:state,1',
            'dated_at' => 'required',
            'total' => 'required|numeric',
            'state' => 'required|boolean',
        ];
    }
    
    public function attributes()
    {
        return [
            'num' => 'número',
            'beneficiary' => 'beneficiario',
            'num_box' => 'número de caja',
            'bank_id' => 'banco',
            'shelf_id' => 'archivo',
            'box_id' => 'estante',
            'folder_id' => 'peldaño',
            'dated_at' => 'fecha',
            'total' => 'total',
            'state' => 'estado',
        ];
    }
}
