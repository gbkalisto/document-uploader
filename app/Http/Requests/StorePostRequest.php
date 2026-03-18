<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title'=>'required|string|max:255',
            'subtitle'=>'nullable|string',
            'body'=>'required',
            'is_published'=>'boolean',
            'published_at'=>'nullable|required|date',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The title field is required.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'subtitle.string' => 'The subtitle must be a string.',
            'body.required' => 'The body field is required.',
            'is_published.boolean' => 'The is published field must be true or false.',
            'published_at.required' => 'The published date field is required.',
            'published_at.date' => 'The published date field must be a valid date.',

        ];
    }
}
