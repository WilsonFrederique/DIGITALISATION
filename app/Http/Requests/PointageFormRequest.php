<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PointageFormRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'numEmp' => ['required'],
            'datePointage' => ['required'],
            'pointage' => ['required']
        ];
    }

    public function message()
    {
        return [
            'numEmp.required' => 'CIN employe récquis.',
            'datePointage.required' => 'Date Pointage récquis.',
            'pointage.required' => 'Pointage employe récquis.'
        ];
    }
}
