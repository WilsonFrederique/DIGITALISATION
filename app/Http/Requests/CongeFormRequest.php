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
            'numEmp' => ['required'],
            'numSup' => ['required'],
            'Annee' => ['required'],
            'Mois' => ['required'],
            'FaiLe' => ['required'],
            'NbrJours' => ['required', 'integer', 'min:1'],
            'CumulAnnuel' => ['nullable'], // Facultatif
            'Solde' => ['nullable'],       // Facultatif
            'DateDebut' => ['required'],
            'DateFin' => ['required'],
            'Motif' => ['required'],
            'NomOrganisation' => ['required'],
            'Validation' => ['required'],
            'Description' => ['required']
        ];
    }

}
