<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
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
            'fullName' => 'required|min:3|max:25',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
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
            'fullName.required' => 'O campo nome deve ser preenchido!',
            'email.required' => 'O campo e-mail deve ser preenchido!',
            'email.email' => 'O campo e-mail é inválido!',
            'fullName.min' => 'O campo nome deve conter no mínimo 3 caracteres!',
            'email.unique' => 'Este e-mail já está cadastrado!',
            'fullName.max' => 'O campo nome deve conter no máximo 25 caracteres!',
        ];
    }
}
