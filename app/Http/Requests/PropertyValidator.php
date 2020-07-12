<?php

namespace App\Http\Requests;
 
use Illuminate\Foundation\Http\FormRequest;
 
class PropertyValidator extends FormRequest
{ 
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'owner_email' => ['required','email'],
            'street' => ['required'],
            'neighborhood' => ['required','min:3','max:100'],
            'city' => ['required','min:3','max:100'],
            'state' => ['required','min:2','max:2']
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
    		'owner_email.required' => 'Email é obrigatório.',
            'owner_email.email' => 'Email deve ser válido.',
    		'street.required'  => 'Rua é obrigatório.',
            'neighborhood.required'  => 'Bairro é obrigatório.',
    		'neighborhood.min'  => 'Bairro deve conter no mínimo 3 caracteres.',
            'neighborhood.max'  => 'Bairro deve conter no máximo 100 caracteres.',
            'city.required'  => 'Cidade é obrigatório.',
            'city.min'  => 'Cidade deve conter no mínimo 3 caracteres.',
            'city.max'  => 'Cidade deve conter no máximo 100 caracteres.',
            'state.required'  => 'Estado é obrigatório.',
            'state.min'  => 'Estado deve conter no mínimo 2 caracteres.',
            'state.max'  => 'Estado deve conter no máximo 2 caracteres.',
    	];
    }
}