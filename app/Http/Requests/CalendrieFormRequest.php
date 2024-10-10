<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalendrieFormRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Titre' => ['required'],
            'Description' => ['required'],
            'DateDebu' => ['required'],
            'DateFin' => ['required'],
            'TimeDebu' => ['nullable'], 
            'TimeFin' => ['nullable']
        ];
    }

    public function messages()
    {
        return [
            'Titre.required' => 'Le titre est requis.',
            'Description.required' => 'La description est requise.',
            'DateDebu.required' => 'La date de début est requise.',
            'DateFin.required' => 'La date de fin est requise.'
        ];
    }
}
