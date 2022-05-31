<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseFormRequest;

class DieticianRequest extends BaseFormRequest
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
        $id = request('dietician') ? request('dietician')->user_id : false;

        return [
            'user.name' => 'required',
            'user.email' => 'required|email|unique:users,email,'.$id,
            'user.phone_number' => 'required|unique:users,phone_number,'.$id,
            'user.status'=> 'present',
            'degree' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'user.email.unique' => 'The given email address has already been taken.',
            'user.phone_number.unique' => 'The given phone number has already been taken.'
        ];
    }
}
