<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStoreCategoriaAlimentoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // el usuario debe estar logueado y ser de tipo admin para hacer CRUD en las categorias
        // return auth()->check() && $this->user()->type === 'admin';
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
            'nombre'         => [
                'required',
                'min:3',
                'string',
                Rule::unique( 'categoria_alimentos' )->ignore( $this->route( 'categoria' ) ),
            ],
            'slug'           => [
                'required',
                Rule::notIn( ['categoria', 'categorias'] ), // La categoria no debe llamarse así
            ],
            'activo'         => 'sometimes|required|in:0,1',
            'tipo_categoria' => 'required', // aunque no se mande desde el formulario, es necesario validarlo para
            // que se incluya en el request (este campo se agrega en esta clase, ver metodo prepareForValidation )
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
            'slug'           => str( $this->nombre )->slug(),
            // en tipo_categoria establecemos que unicamente sea de tipo alimento o bebida
            'tipo_categoria' => request()->routeIs( 'categoria_alimentos.*' ) ? 'alimento' : 'bebida',
            'activo'         => $this->activo ? 1 : 0,
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
