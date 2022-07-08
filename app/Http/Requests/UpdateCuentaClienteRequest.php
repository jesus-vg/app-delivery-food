<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCuentaClienteRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'              => 'required|min:5|max:50',
            'password'          => 'sometimes|nullable|min:8|max:20',
            'confirmedPassword' => 'sometimes|same:password',
            // Ej. Av. Siempre Viva #123 o Calle niños heroes
            'direccion'         => 'required|string|min:3|max:150',
            'colonia'           => 'required|string|min:3|max:150',
            'referencia'        => 'required|string|min:3|max:150',
            // Ej. -34.912345
            'latitud'           => 'required|numeric|min:-90|max:90',
            'longitud'          => 'required|numeric|min:-180|max:180',
            // Ej. +541123456789
            'telefono'          => 'required|string|min:10|max:20',
        ];
    }
}
