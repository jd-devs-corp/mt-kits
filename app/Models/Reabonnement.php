<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reabonnement extends Model
{
    use HasFactory;

    protected $fillable = [
        'kit_id',
        'date_debut_abonnement',
        'date_fin_abonnement',
        'plan_tarifaire',
    ];

    public function kit(): BelongsTo
    {
        return $this->belongsTo(Kit::class, 'kit_id');
    }
}
