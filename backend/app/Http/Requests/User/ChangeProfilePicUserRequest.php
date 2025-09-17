<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ChangeProfilePicUserRequest extends FormRequest
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
            'profilePic' => 'required|file|mimes:png,jpg,jpeg|max:500',
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
            'profilePic.required' => 'O campo foto de perfil deve ser preenchido!',
            'profilePic.file' => 'O campo foto de perfil precisa ser um arquivo!',
            'profilePic.mimes' => 'O campo foto de perfil deve ser uma imagem (png ou jpg)!',
            'profilePic.max' => 'O campo foto de perfil deve deve ter uma imagem de no máximo 500kb!',
        ];
    }
}
