<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
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
            'name_ru' => ['required', 'string', 'max:255'],
            'name_ua' => ['required', 'string', 'max:255'],
            'content_ru' => ['required', 'string'],
            'content_ua' => ['required', 'string'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('posts')->ignore($this->id),],
        ];
    }
}
