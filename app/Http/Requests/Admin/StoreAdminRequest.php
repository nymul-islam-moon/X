<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
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
            'first_name' => ['required', 'max:20', 'string'],
            'last_name' => ['required', 'max:20', 'string'],
            'email' => ['required', 'email', 'max:255', 'unique:admins,email'],
            'phone' => ['required', 'max:12, unique:admins,phone'],
            'status' => ['required', 'in:active,inactive']
        ];
    }
}
