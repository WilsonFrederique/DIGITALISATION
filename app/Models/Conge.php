<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conge extends Model
{
    // ================= Primary Key =====================
    protected $primaryKey = 'numConge';

    // ================= Type Primary Key ================
    protected $keyType = 'string';

    // ===== One to Many Inverse : (0,1) ou (1,1) ========
    public function employes(): BelongsTo
    {
        return $this->belongsTo(Employe::class);
    }

    protected $fillable = [
        'numConge',
        'numEmp',
        'nbrjr',
        'dateDemande',
        'motif'
    ];

    use HasFactory;
}
