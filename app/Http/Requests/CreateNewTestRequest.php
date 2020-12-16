<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\AtLeastOneKeyIs;

class CreateNewTestRequest extends FormRequest
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
        $var = count($this->get('questions')) - 1;

        return [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'passRate' => 'integer|nullable|max:' . (string)$var,
            'timeLimit' => 'integer|max:120|nullable',
            'tags' => 'array|nullable',
            'tags.*' => 'nullable|string',
            'questions' => 'array|min:5|required',
            'questions.*' => 'required|array',
            'questions.*.question' => 'required|string',
            'questions.*.answers' => ['required','array', new AtLeastOneKeyIs('isCorrect', true)],
            'questions.*.answers.*.answer' => 'required|string',
            'questions.*.answers.*.isCorrect' => 'required|bool',
        ];

    }
}

