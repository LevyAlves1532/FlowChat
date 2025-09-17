<?php

namespace App\Http\Requests\Message;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreMessageRequest extends FormRequest
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
            'text' => 'nullable|required_without:image',
            'image' => 'nullable|file|mimes:png,jpg,jpeg|max:500|required_without:text',
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
            'text.required_without' => 'Pelo menos um dos campos deve ser preenchido!',
            'image.required_without' => 'Pelo menos um dos campos deve ser preenchido!',
            'image.file' => 'O campo imagem precisa ser um arquivo!',
            'image.mimes' => 'O campo imagem deve ser uma imagem (png ou jpg)!',
            'image.max' => 'O campo imagem deve deve ter uma imagem de no máximo 500kb!',
        ];
    }
}
