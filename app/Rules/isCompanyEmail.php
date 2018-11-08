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
        $authEmailArr = explode(",", env('AUTHORIZED_EMAILS'));
        return in_array($value, $authEmailArr);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Email address was not approved';
    }
}
