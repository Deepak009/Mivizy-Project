<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\BaseFormRequest;

class SignInRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "country_code" => "required|numeric",
			"phone_number" => "required|regex:/(^([0-9]{10,10})$)/u",
			"otp" => "required|numeric|digits:6",
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
            'phone_number.regex' => 'Phone number must be valid one',
        ];
    }
}
