<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'phone'=>'nullable|numeric|digits:10',
            'address'=>'nullable|string',
            'dob'=>'nullable|date',
            'profile_picture'=>'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
        ];
    }
}
