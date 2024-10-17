<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageProfilUserFormRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'numEmp' => ['required'],
            'imgProfil' => ['required']
        ];
    }

    public function message()
    {
        return [
            'numEmp.required' => 'CIN employe récquis.',
            'imgProfil.required' => 'Profil récquis.'
        ];
    }
}
