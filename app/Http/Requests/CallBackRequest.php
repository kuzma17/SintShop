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
            'phone' => ['required', 'regex:/^\+38 \(\d{3}\) \d{3} \d{2} \d{2}$/']
        ];
    }

    public function messages(): array
    {
        return [
            'phone.required' => 'Введите номер телефона.',
            'phone.regex' => 'Неверный формат номера телефона.', // Кастомное сообщение
        ];
    }
}
