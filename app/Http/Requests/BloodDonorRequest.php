<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseFormRequest;

class BloodDonorRequest extends BaseFormRequest
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
            'name' => 'required',
			'dob' => 'nullable|date',
			'blood_group' => 'required',
			'weight_in_kgs' => 'required|integer:min:45',
			'email' => 'nullable|email',
			'mobile_number' => 'required',
			'address' => 'nullable',
			'pincode' => 'nullable',
			'state' => 'nullable',
        ];
    }
}
