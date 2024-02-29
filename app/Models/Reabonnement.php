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

    public function kit(): BelongsTo{
        return $this->belongsTo(Kit::class);
    }


public static function booted()
{
    static::created(function ($reabonnement) {
        // Obtenez le kit associé au réabonnement
        $kit = $reabonnement->kit;

        // Obtenez l'utilisateur associé au kit
        $user = $kit->user;

        $pourcent = $user->pourcentage/100;


        // Calculez le montant à donner à l'utilisateur
        $montant = ($reabonnement->plan_tarifaire * $pourcent);

        dump($montant);

        $user->somme_a_percevoir += $montant;
        $user->save();
    });
}

}
