<?php

namespace App\Rules;
use App\Property;
use Illuminate\Contracts\Validation\Rule;

class ContractRuler implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $property = Property::find($value);
        return !$property->contract()->count();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Propriedade só pode pertencer a um contrato.';
    }
}
