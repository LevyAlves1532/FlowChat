<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ChangePasswordUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'currentPassword' => 'required|min:8|max:16',
            'newPassword' => 'required|min:8|max:16',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'currentPassword.required' => 'O campo senha atual deve ser preenchido!',
            'newPassword.required' => 'O campo nova senha deve ser preenchido!',
            'currentPassword.min' => 'O campo senha atual deve conter no mínimo 8 caracteres!',
            'newPassword.min' => 'O campo nova senha deve conter no mínimo 8 caracteres!',
            'currentPassword.max' => 'O campo senha atual deve conter no máximo 16 caracteres!',
            'newPassword.max' => 'O campo nova senha deve conter no máximo 16 caracteres!',
        ];
    }
}
