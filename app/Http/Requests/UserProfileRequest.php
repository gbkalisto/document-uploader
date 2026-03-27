<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        // $userId = $this->route('user')?->id ?? $this->route('user');
        $userId = $this->route('user')?->id ?? $this->route('user') ?? auth()->id();
        return [
            'name' => 'required|string|max:50',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($userId)
            ],
            'aadhar_last_four_digit' => 'required|numeric|digits:4',
            'phone' => 'nullable|numeric|digits:10',
            'address' => 'nullable|string',
            'dob' => 'nullable|date',
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
        ];
    }
}
