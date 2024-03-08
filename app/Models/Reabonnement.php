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

    public function kit(): BelongsTo
    {
        return $this->belongsTo(Kit::class, 'kit_id');
    }

//     public static function booted()
//     {
//         static::created(function ($reabonnement) {
//             if (!$reabonnement->wasRecentlyCreated) {
//                 return;
//             }

//             // Récupération du kit associé au réabonnement
//             $kit = $reabonnement->kit;

//             // Récupération de l'utilisateur associé au kit
//             $user = $kit->user;

//             // Vérification de l'existence de l'utilisateur
//             if ($user === null) {
//                 // Log une erreur ou lancez une exception
// //                \Log::error('Utilisateur associé au kit introuvable.');
//                 return;
//             }

//             // Calcul du pourcentage à partir de la base de données
//             $pourcentage = DB::table('users')->where('id', $kit->id)->value('pourcentage');

//             // Calcul du montant à verser à l'utilisateur
//             $reabonnementMontant = $reabonnement->plan_tarifaire * ($pourcentage / 100);

//             // Mise à jour du montant à percevoir de l'utilisateur
//             $user->somme_a_percevoir += $reabonnementMontant;
//             $user->save();
//         });
    // }
}
