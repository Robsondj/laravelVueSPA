<?php

namespace App\Http\Requests;
 
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ContractRuler;
use App\Rules\DocumentRuler;
 
class ContractValidator extends FormRequest
{ 
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'property_id' => ['required', new ContractRuler],
            'person_type' => ['required'],
            'document' => ['required', new DocumentRuler],
            'contractor_email' => ['required','email'],
            'contractor_name' => ['required','min:3','max:100']
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
    		'property_id.required'  => 'Propriedade é obrigatório.',
            'person_type.required'  => 'Tipo de pessoa é obrigatório.',
            'document.required'  => 'CPF/CPNJ é obrigatório.',
    		'contractor_email.required' => 'Email do contratante é obrigatório.',
            'contractor_email.email' => 'Email do contratante deve ser válido.',
            'contractor_name.required'  => 'Nome do contratante é obrigatório.',
    		'contractor_name.min'  => 'Nome do contratante deve conter no mínimo 3 caracteres.'
    	];
    }
}