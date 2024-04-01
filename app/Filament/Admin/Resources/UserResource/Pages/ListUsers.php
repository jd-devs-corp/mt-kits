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
            ->modalIcon('heroicon-o-users'),
        ];
    }
    protected static ?string $title = 'Utilisateurs';

}
