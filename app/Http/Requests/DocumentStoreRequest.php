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
                'in:Aadhar Card Front,Aadhar Card Back,Pan Card,Ration Card,Voter Id,Driving License,Registration Id,Admit Card,Q Paper,A Paper',
            ],
            'document' => [
                'required',
                'file',
                'mimes:pdf',
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
            'document.mimes' => 'Only PDF is allowed.',
            'document.max'   => 'The file size must not exceed 5MB.',
            'title.required' => 'Please choose your document a name (e.g., Aadhar Card).',
        ];
    }
}
