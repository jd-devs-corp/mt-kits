<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    protected static ?string $title = 'Utilisateur';

    protected ?string $subheading = 'Toutes les informations concernant un utilisateur';

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->icon('heroicon-s-pencil'),
            Actions\Action::make('generateReceipt')
                ->label('Payer')
                ->icon('heroicon-s-banknotes')
                ->action(function (User $record) {
                    return redirect()->to('/download-receipt/' . $record->id);
                })
                ->visible(function (User $record) {
                    return $record->role === 'fournisseur';
                })
                ->disabled(function (User $record) {
                    return $record->somme_a_percevoir < 500;
                }),
        ];
    }
}
