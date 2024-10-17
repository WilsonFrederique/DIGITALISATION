<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPersonnelFormRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed', // Le mot de passe doit être confirmé
        ];
    }

    public function messages()
    {
        return [
            'current_password.required' => 'Le mot de passe actuel est requis.',
            'new_password.required' => 'Le nouveau mot de passe est requis.',
            'new_password.confirmed' => 'Le nouveau mot de passe et sa confirmation ne correspondent pas.',
            'new_password.min' => 'Le nouveau mot de passe doit contenir au moins 8 caractères.',
        ];
    }
}
