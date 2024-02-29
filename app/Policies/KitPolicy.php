<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Kit;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class KitPolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        // Par défaut, refuser l'accès
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Kit $kit): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        // Si l'utilisateur est un fournisseur, vérifier s'il peut accéder au client
        if ($user->role === 'fournisseur') {
            // Parcourir les kits du client et vérifier s'il y a correspondance avec l'utilisateur

                if ($kit->user_id === $user->id) {
                    return true;
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
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, kit $kit): bool
    {
        //
        if ($kit->user_id == $user->id || $user->role=='admin') {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, kit $kit): bool
    {
        //
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, kit $kit): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, kit $kit): bool
    {
        //
        return false;
    }

    public function list(User $user, Kit $kit) : bool {

        if ($user->role === 'admin') {
            return true;
        }

        // Si l'utilisateur est un fournisseur
        if ($user->role === 'fournisseur') {
            // Récupérer tous les kits associés à l'utilisateur
            $kits = $user->kits;

            // Vérifier si l'utilisateur est associé à au moins un kit
            if ($kits->isNotEmpty()) {
                // Parcourir les kits pour vérifier s'ils appartiennent à l'utilisateur
                foreach ($kits as $kit) {
                    if ($kit->user_id === $user->id) {
                        // Si au moins un kit appartient à l'utilisateur, autoriser l'accès
                        return true;
                    }
                }
            }
        }

        // Par défaut, refuser l'accès
        return false;

    }
}
