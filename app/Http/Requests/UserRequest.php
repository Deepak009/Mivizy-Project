<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseFormRequest;

class UserRequest extends BaseFormRequest
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
        $id = request('user');

        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone_number' => 'required|unique:users,phone_number,'.$id,
            'status'=> 'present',
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'The given email address has already been taken.',
            'phone_number.unique' => 'The given phone number has already been taken.'
        ];
    }
}
