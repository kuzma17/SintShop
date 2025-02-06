<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user() && auth()->user()->hasRole('admin');
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
            'login' => ['required', 'string', 'max:255'],

            // Условная валидация для пароля
            'password' => [
                'nullable', // Поле может быть пустым
                'string',
                'min:8',
                'confirmed', // Валидация подтверждения пароля, если пароль заполнен
            ],

            // Валидация подтверждения пароля
            'password_confirmation' => [
                'nullable', // Поле может быть пустым
                'string',
                'min:8',
            ],
        ];
    }
}
