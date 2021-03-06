<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseFormRequest;

class FoodRequest extends BaseFormRequest
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
            'name' => 'required|unique:foods,name',
			'type' => 'required',
			'use_for.*' => 'required',
        ];
    }
}
