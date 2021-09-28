<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BloodRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'code' => 'required',
            'codeICD' => 'required',
            'categories_id' => 'array'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Please fill the title.',
            'code.required' => 'Please fill the code.',
            'codeICD.required' => 'Please fill the codeICD.',
        ];
    }
}
