<?php

namespace App\Rules;

use App\Models\Overtime;
use Illuminate\Contracts\Validation\Rule;

class OvertimeDateRule implements Rule
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
        return !Overtime::where('date',$value)->where('employee_id',request()->employee_id)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Employee has data on this date '.request()->date;
    }
}
