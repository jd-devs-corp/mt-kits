<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Reabonnement;

class UserObserver
{
    public function created(User $user)
    {
        if ($user->kit) { // Vérifier l'existence du kit
            $somme_a_percevoir = $user->kit->plan_tarifaire * $user->pourcentage / 100;

            // Mettre à jour la somme à percevoir
            $user->somme_a_percevoir = $somme_a_percevoir;
            $user->save();
        }
    }


    public function updated(User $user)
    {
        // Si le kit ou le pourcentage a changé, recalculer la somme à percevoir
        if ($user->isDirty('kit_id') || $user->isDirty('pourcentage')) {
            $somme_a_percevoir = $user->kit->plan_tarifaire * $user->pourcentage / 100;

            // Mettre à jour la somme à percevoir
            $user->somme_a_percevoir = $somme_a_percevoir;
            $user->save();
        }
    }
}
