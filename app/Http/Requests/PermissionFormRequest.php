<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionFormRequest extends FormRequest
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
            'FaiLe' => [
                'required',
                'date',
            ],
            'DateDebut' => [
                'required',
                'date',
                // 'after_or_equal:now',
            ],
            'DateFin' => [
                'required',
                'date',
                'after_or_equal:now',
                // 'after_or_equal:DateDebut',
            ],
            'Raison' => ['required'],
            'NomOrganisation' => ['required'],
            'Validation' => ['required'],
            'Engagement' => ['required'],
            'Dispositions' => ['required']
        ];
    }

    public function message()
    {
        return [
            'numEmp.required' => 'CIN employe récquis.',
            'NomPrenomDestinateur.required' => 'Nom et Prenom du Destinateur récquis.',
            'PosteDestinateur.required' => 'Poste du Destinateur récquis.',
            'FaiLe.required' => 'Fai Le récquis.',
            'DateDebut.required' => 'Date de Debut récquis.',
            'DateFin.required' => 'Date Fin récquis.',
            'Raison.required' => 'Raison récquis.',
            'NomOrganisation.required' => 'Nom Organisation récquis.',
            'Engagement.required' => 'Engagement récquis.',
            'Dispositions.required' => 'Dispositions récquis.'
        ];
    }
}
