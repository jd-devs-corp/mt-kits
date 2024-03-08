<?php

namespace App\Filament\Resources\ReabonnementResource\Pages;

use App\Filament\Resources\ReabonnementResource;
use App\Models\Kit;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateReabonnement extends CreateRecord
{
    protected static string $resource = ReabonnementResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // $data['user_id'] = auth()->id();

        $kit = Kit::find($data['kit_id']);
        // dump($data);
        $user = User::find($kit->user_id);

        if ($user->isFournisseur) {
            $user->somme_a_percevoir += ($data['plan_tarifaire'] * ($user->pourcentage/100));
            $user->save(); // Utilisez la méthode save() pour sauvegarder les modifications
        }

        return $data;
    }


//     protected function handleRecordCreation(array $data): Model
//     {
//         $kit = Kit::find($data['kit_id']);
//         dump($data);
//         $user = User::find($kit->user_id);

//         if ($user && $user->role === 'fournisseur') {
//             $user->somme_a_percevoir += $data['plan_tarifaire'] * $user->pourcentage;
//             $user->save(); // Utilisez la méthode save() pour sauvegarder les modifications
//         }

//         // Créez le réabonnement après avoir effectué la rémunération de l'utilisateur
//         return static::getModel()::create($data);
// }
}
