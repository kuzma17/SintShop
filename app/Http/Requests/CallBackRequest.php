<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CallBackRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', function ($attribute, $value, $fail) {

                $digits = preg_replace('/\D/', '', $value);
                if (strlen($digits) !== 12) {
                    $fail(__('validation.error_format_phone'));
                }
            }],
        ];
    }

    public function messages(): array
    {
        return [
            'phone.required' => 'Введите номер телефона.',
        ];
    }
}
