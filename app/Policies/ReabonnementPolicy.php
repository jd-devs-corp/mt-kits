<?php

namespace App\Policies;

use App\Models\Reabonnement;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReabonnementPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Reabonnement $reabonnement): bool
    {
        //
        if ($user->role === 'admin') {
            return true;
        }

        // Si l'utilisateur est un fournisseur, vérifier s'il peut accéder au client
        if ($user->role === 'fournisseur') {
            // Parcourir les kits du client et vérifier s'il y a correspondance avec l'utilisateur
            foreach ($reabonnement->kits as $kit) {
                if ($kit->user_id === $user->id) {
                    return true;
                }
            }
        }

        // Par défaut, refuser l'accès
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        if ($user->role === 'admin') {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Reabonnement $reabonnement): bool
    {
        //
        if ($user->role === 'admin') {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Reabonnement $reabonnement): bool
    {
        //
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Reabonnement $reabonnement): bool
    {
        //
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Reabonnement $reabonnement): bool
    {
        //
        return false;
    }
}
