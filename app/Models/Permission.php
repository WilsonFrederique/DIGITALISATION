<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    // ===== One to Many Inverse : (0,1) ou (1,1) ========
    public function employes(): BelongsTo
    {
        return $this->belongsTo(Employe::class);
    }

    protected $fillable = [
        'numEmp',
        'NomPrenomDestinateur',
        'PosteDestinateur',
        'FaiLe',
        'DateDebut',
        'DateFin',
        'Raison',
        'NomOrganisation',
        'Engagement',
        'Dispositions'
    ];

    use HasFactory;
}
