<?php

namespace App\Filament\Admin\Resources\UserResource\Pages;

use App\Filament\Admin\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->icon('heroicon-o-plus')
            ->label('Ajouter un gerant')
            ->modalHeading('Ajouter un admin/fournisseur')
            ->modalIcon('heroicon-o-users')
            ->action(function(array $data){
                if ($data['role'] == 'admin') {
                    $data['pourcentage'] = null;
                    $data['somme_a_percevoir'] = null;

                }
                if($data['role'] == 'fournisseur'){
                    $data['somme_a_percevoir'] = 0;
                }
                return static::getModel()::create($data);
            }),
        ];
    }
    protected static ?string $title = 'Utilisateurs';

}
