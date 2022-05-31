<?php
namespace App\Http\Requests\ExternalApp;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseFormRequest extends FormRequest
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
	 * [failedValidation [Overriding the event validator for custom error response]]
	 * @param  Validator $validator [description]
	 * @return [object][object of various validation errors]
	 */
	public function failedValidation(Validator $validator)
	{
		//write your bussiness logic here otherwise it will give same old JSON response
		throw new HttpResponseException(response()->json(["message" => $validator->errors()->first()], 422));
	}
}
