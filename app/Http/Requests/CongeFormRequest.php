<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CongeFormRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'numConge' => ['required'],
            'numEmp' => ['required'],
            'nbrjr' => ['required'],
            'dateDemande' => ['required'],
            'motif' => ['required']
        ];
    }

    public function message()
    {
        return [
            'numConge.required' => 'Numéro Conge employe récquis.',
            'numEmp.required' => 'CIN employe récquis.',
            'nbrjr.required' => 'Nombre de jour récquis.',
            'dateDemande.required' => 'Date Demande employe récquis.',
            'motif.required' => 'motif employe récquis.'
        ];
    }
}
