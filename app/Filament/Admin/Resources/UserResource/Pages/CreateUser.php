<?php

namespace App\Filament\Admin\Resources\UserResource\Pages;

use App\Filament\Admin\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected static ?string $title = 'Nouvel Utilisateur';

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if ($data['role'] == 'admin') {
            $data['pourcentage'] = null;
            $data['somme_a_percevoir'] = null;

        }
        if($data['role'] == 'fournisseur'){
            $data['somme_a_percevoir'] = 0;
        }
        return $data;
    }
}
