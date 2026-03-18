<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class DocumentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'min:3',
                'max:100'
            ],
            'document' => [
                'required',
                'file',
                'mimes:pdf,jpg,jpeg,png',
                'max:5120' // 5MB limit
            ],
        ];
    }


    /**
     * Custom messages for better User Experience
     */
    public function messages(): array
    {
        return [
            'document.mimes' => 'Only PDF, JPG, and PNG files are allowed.',
            'document.max'   => 'The file size must not exceed 5MB.',
            'title.required' => 'Please give your document a name (e.g., Aadhar Card).',
        ];
    }
}
