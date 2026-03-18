<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDocumentRequest extends FormRequest
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
                // Ensures the value is one of your predefined types
                'in:Aadhar Card Front,Aadhar Card Back,Pan Card,Ration Card,Voter Id,Driving License',
            ],
            'document' => [
                'nullable', // Perfect for Update!
                'file',
                'mimes:pdf,jpg,jpeg,png',
                'max:5120',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'title.in' => 'Please select a valid document type from the list.',
            'document.mimes' => 'Only PDF, JPG, and PNG files are allowed.',
            'document.max'   => 'The file size must not exceed 5MB.',
            'title.required' => 'Please select a document type.',
        ];
    }
}
