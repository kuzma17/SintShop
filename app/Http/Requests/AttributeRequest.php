<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AttributeRequest extends FormRequest
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
        $rule = [
            'name_ru' => ['required', 'string', 'max:255'],
            'name_ua' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('attributes')->ignore($this->id)],
        ];

//
//        if ($this->request->get('values')){
//            $rule['string_ru'] = ['required', 'string', 'max:255'];
//            $rule['string_ua'] = ['required', 'string', 'max:255'];
//        }

        return $rule;
    }

}
