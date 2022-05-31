<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseFormRequest;

class OPDScheduleRequest extends BaseFormRequest
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
            'opd_category_id' => 'required|exists:opd_categories,id',
            'doctor_name' => 'required',
			'doctor_qualifications' => 'nullable',
			'gender' => 'nullable',
			'contact_number_1' => 'nullable',
			'contact_number_2' => 'nullable',
			'address' => 'nullable',
			'pincode' => 'nullable',
			'state' => 'nullable',
			'hospital_name' => 'nullable',
			'schedules' => 'required',
        ];
    }
}
