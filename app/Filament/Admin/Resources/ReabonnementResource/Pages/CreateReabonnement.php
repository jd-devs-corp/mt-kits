<?php

namespace App\Filament\Admin\Resources\ReabonnementResource\Pages;

use App\Filament\Admin\Resources\ReabonnementResource;
use App\Models\Kit;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateReabonnement extends CreateRecord
{
    protected static string $resource = ReabonnementResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // $data['user_id'] = auth()->id();

        $kit = Kit::find($data['kit_id']);
        dump($data);
        $user = User::find($kit->user_id);
        if ($user && $user->role == "fournisseur") {
            if($user->somme_a_percevoir == null)
                $user->somme_a_percevoir = 0;
            $user->somme_a_percevoir += ($data['plan_tarifaire'] * ($user->pourcentage * 0.01));
            $user->update(); // Utilisez la méthode save() pour sauvegarder les modifications
        }

        return $data;
    }


    protected function handleRecordCreation(array $data): Model
    {
        $kit = Kit::find($data['kit_id']);
        dump($data);
        $user = User::find($kit->user_id);

        if ($user && $user->role === 'fournisseur') {
            if($user->somme_a_percevoir == null)
                $user->somme_a_percevoir = 0;
            $user->somme_a_percevoir += $data['plan_tarifaire'] * $user->pourcentage;
            $user->update(); // Utilisez la méthode save() pour sauvegarder les modifications
        }

        // Créez le réabonnement après avoir effectué la rémunération de l'utilisateur
        return static::getModel()::create($data);
}
}
