<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginFormRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'numEmp' => ['required', 'string', 'max:255'], // Ajoutez des règles pour numEmp
            'email' => ['required', 'email', 'unique:users'], // Assurez-vous que l'email est unique
            'password' => ['required', 'min:6'],
        ];
    }

    public function messages()
    {
        return [
            'numEmp.required' => 'Le numéro CIN est requis.',
            'email.required' => 'L\'adresse e-mail est requise.',
            'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
            'password.required' => 'Le mot de passe est requis.',
        ];
    }
}
