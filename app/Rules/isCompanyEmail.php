<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class isCompanyEmail implements Rule
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
        return in_array($value, array('stevenmtune@gmail.com','steven@verticalbookingusa.com'));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Email address was not approved.';
    }
}
