<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EmpresaUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->type === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nombre'           => [
                'required',
                'string',
                'min:3',
                'max:100',
            ],
            'imagen_principal' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120', // 5MB
            'descripcion' => 'required|string|min:50|max:255', // Ej. Descripción del establecimiento
            'direccion' => 'required|string|min:10|max:255', // Ej. Av. Siempre Viva #123
            'colonia' => 'required|string|min:3|max:255', // Ej. San Pedro
            'latitud' => 'required|numeric|min:-90|max:90', // Ej. -34.912345
            'longitud' => 'required|numeric|min:-180|max:180', // Ej. -34.912345
            'telefono' => 'required|string|min:10|max:25', // Ej. +541123456789
            'hora_apertura' => 'required|date_format:H:i:s', // Ej. 08:00
            'hora_cierre' => 'required|date_format:H:i:s|after:hora_apertura', // Ej. 20:00
        ];
    }
}
