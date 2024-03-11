<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
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
        return $data;
    }
}
