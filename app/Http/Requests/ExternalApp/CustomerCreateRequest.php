<?php

namespace App\Http\Requests\ExternalApp;

use App\Http\Requests\ExternalApp\BaseFormRequest;

class CustomerCreateRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "status" => 'required|boolean',
            "external_app_id" => "required|unique:customers,external_app_id",
            "name" => "required",
            "country_code" => "required|size:2",
            "phone_number" => "required|size:10|unique:customers|unique:users",
            "email" => "required|email|unique:customers|unique:users",
            "date_of_birth" => "required|date_format:Y-m-d"
        ];
    }

    /**
     * To customize the validation message
     *
     * @return array
     */
    public function messages()
    {
        return [
			"external_app_id.required" => "The external_app_id field is required.",
			"external_app_id.unique" => "The external_app_id field is already taken.",
            "country_code.required" => "The country_code field is required.",
			"country_code.size" => "The country_code field must be 2 characters long.",
			"phone_number.required" => "The phone_number field is required.",
			"phone_number.size" => "The phone_number field must be 10 characters long.",
			"date_of_birth.required" => "The date_of_birth field is required.",
			"date_of_birth.date_format" => "The date_of_birth field formar must be YYYY-MM-DD.",
        ];
	}

}
