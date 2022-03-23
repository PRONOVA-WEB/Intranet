<?php

namespace App\Http\Requests\Rrhh;

use Illuminate\Foundation\Http\FormRequest;

class storeUser extends FormRequest
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
            'id'              => 'unique:users|required',
            'dv'              => 'required',
            'name'            => 'required',
            'fathers_family'  => 'required',
            'mothers_family'  => 'required',
            'email'           => 'required|unique:users|email:rfc,dns',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'id.required'             => '"ID" es requerido.',
            'id.unique'               => 'Ya existe otro usuario con este ID.',
            'name.required'           => 'Campo nombre es requerido',
            'fathers_family.required' => 'Campo apellido paterno es requerido',
            'mothers_family.required' => 'Campo apellido materno es requerido',
            'email.required'          => 'Campo email es requerido',
            'email.email'             => '"Email" debe tener formato de email.',
            'email.unique'            => 'Ya existe otro usuario con este Email.',
        ];
    }
}
