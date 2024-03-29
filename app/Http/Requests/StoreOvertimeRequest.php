<?php

namespace App\Http\Requests;

use App\Rules\OvertimeDateRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOvertimeRequest extends FormRequest
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
        $employee_id = request()->employee_id;
        return [
            'employee_id' => [
                'required',
                'integer',
                'exists:employees,id'
            ],
            'date' => [
                'required',
                'date',
                new OvertimeDateRule
            ],
            'time_started' => [
                'required',
                'date_format:H:i',
                'before:time_ended'
            ],
            'time_ended' => [
                'required',
                'date_format:H:i',
                'after:time_started'
            ]
        ];
    }
}
