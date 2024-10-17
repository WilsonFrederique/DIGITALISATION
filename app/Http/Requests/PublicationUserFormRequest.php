<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublicationUserFormRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'numEmp' => ['required'],
            'txtPartage' => ['required'],
            'imgPartage' => ['required']
        ];
    }

    public function message()
    {
        return [
            'numEmp.required' => 'CIN employe récquis.',
            'txtPartage.required' => 'txtPartage récquis.',
            'imgPartage.required' => 'imgPartage récquis.'
        ];
    }
}
