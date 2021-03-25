<?php

namespace App\Rules;

use App\Inspections\Spam;
use Exception;
use Illuminate\Contracts\Validation\Rule;

class SpamFree implements Rule
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
        try{
            return !(new Spam)->detect($value);//if there is spam it'll return false
        }
        catch(Exception $e){
            return false;//if there is spam it'll throw exception
        }
        // return (new Spam)->detect($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'we don\'t allow spam';
    }
}
