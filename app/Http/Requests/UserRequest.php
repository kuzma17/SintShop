<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string'],
            'phone' => ['required'],
            //'email' => ['nullable','email']
        ];

        if ($this->request->get('delivery_id') && $this->request->get('delivery_id') == 2){

            $rules['delivery_address'] = ['required', 'string'];
        }

        return $rules;
    }
}
