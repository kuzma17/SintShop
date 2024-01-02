<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageRequest extends FormRequest
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
            'title_ru' => ['required', 'string', 'max:255'],
            'title_ua' => ['required', 'string', 'max:255'],
            'content_ru' => ['required', 'string'],
            'content_ua' => ['required', 'string'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('categories')->ignore($this->id),],
        ];
    }
}
