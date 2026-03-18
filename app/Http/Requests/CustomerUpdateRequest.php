<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerUpdateRequest extends FormRequest
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
        // Safely get the ID from the route
        $userParam = $this->route('customer') ?? $this->route('user');

        $userId = $userParam instanceof \App\Models\User
            ? $userParam->id
            : $userParam;

        return [
            'name' => 'required|string|max:50',
            'is_active'=>'required|boolean',
            'email' => [
                'required', // Fixed: was 'request'
                'email',
                'max:255',
                Rule::unique('users')->ignore($userId)
            ],
            'password' => 'nullable|confirmed|min:8',
            'phone' => 'nullable|numeric|digits:10',
            'address' => 'nullable|string',
            'dob' => 'nullable|date',
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
        ];
    }
}
