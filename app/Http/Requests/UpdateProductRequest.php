<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'sku'         => [
                'required',
                'string',
                Rule::unique('products', 'sku')->ignore($this->id),
            ],
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:1',
            'image' => 'nullable|image|mimes:png,jpg,webp|max:2048',
            'is_active' => 'nullable|boolean'
        ];
    }
}
