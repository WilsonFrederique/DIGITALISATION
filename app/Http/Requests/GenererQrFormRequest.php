<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenererQrFormRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'numEmp' => ['required'],
            'imageqr' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'numEmp.required' => 'Le CIN de l\'employé est requis.',
            'imageqr.required' => 'Le code QR est requis.',
        ];
    }

}
