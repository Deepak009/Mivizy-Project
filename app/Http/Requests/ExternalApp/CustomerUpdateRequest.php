<?php

namespace App\Http\Requests\ExternalApp;

use App\Services\CustomerService;
use App\Http\Requests\ExternalApp\BaseFormRequest;

class CustomerUpdateRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $customer_service = app(CustomerService::class);
        $customer = $customer_service->findByExternalAppId($this->ext_app_id);
        $user_id = optional($customer)->user_id ?? null;
        return [
            "status" => 'required|boolean',
            "name" => "required",
            "country_code" => "required|size:2",
            "phone_number" => "required|size:10|unique:customers,phone_number," . $this->ext_app_id . ",external_app_id|unique:users,phone_number," . $user_id . ",id",
            "email" => "required|email|unique:customers,email," . $this->ext_app_id . ",external_app_id|unique:users,email," . $user_id . ",id",
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
            "country_code.required" => "The country_code field is required.",
			"country_code.size" => "The country_code field must be 2 characters long.",
			"phone_number.required" => "The phone_number field is required.",
			"phone_number.size" => "The phone_number field must be 10 characters long.",
			"date_of_birth.required" => "The date_of_birth field is required.",
			"date_of_birth.date_format" => "The date_of_birth field formar must be YYYY-MM-DD.",
        ];
	}

}
