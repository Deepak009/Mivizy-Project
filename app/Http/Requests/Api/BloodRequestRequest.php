<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;
use App\Http\Requests\Api\BaseFormRequest;

class BloodRequestRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()?true:false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
			'blood_group' =>  ['required', Rule::in(BLOODGROUPS)],
			'number_of_unit' => 'required',
			'mobile_number' => 'required|regex:/(^([0-9]{10,10})$)/u',
			'patient_name' => 'required',
			'patient_age' => 'nullable',
			'hospital_name' => 'nullable',
			'purpose' => 'nullable',
			'address' => 'nullable',
			'state' => 'nullable',
			'pincode' => 'nullable',
        ];
    }

	/**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'mobile_number.regex' => 'Mobile number must be valid one',
        ];
    }
}
