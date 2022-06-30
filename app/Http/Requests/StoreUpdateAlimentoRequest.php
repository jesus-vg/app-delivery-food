<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateAlimentoRequest extends FormRequest
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
            'categoria_alimento_id' => 'required|exists:categoria_alimentos,id',
            'nombre'                => [
                'required',
                'min:3',
                'string',
                Rule::unique( 'alimentos' )->ignore( $this->route( 'alimento' ) ?? $this->route( 'bebida' ) ),
            ],
            'slug'                  => [
                'required',
                Rule::notIn( ['categoria', 'categorias'] ),
            ],
            'descripcion'           => 'required|min:10|string',
            'imagen'                => 'sometimes|nullable|image|mimes:jpeg,png,jpg|max:5120',
            'precio'                => 'required|numeric|min:1.0',
            'activo'                => 'sometimes|required|in:0,1',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge( [
            'slug'   => str( $this->nombre )->slug(),
            'activo' => $this->activo ? 1 : 0,
        ] );
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'slug.not_in' => 'El nombre no debe tener un valor de categoria o categorias',
        ];
    }
}
