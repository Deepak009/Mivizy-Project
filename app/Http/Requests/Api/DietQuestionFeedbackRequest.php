<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\BaseFormRequest;

class DietQuestionFeedbackRequest extends BaseFormRequest
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
        return [
            'question_set_id' => "required|exists:question_sets,id",
            'feedback' => "required"
        ];
    }
}
