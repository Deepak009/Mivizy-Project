<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseFormRequest;

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
            'note' => 'nullable',
        ];
    }
}
