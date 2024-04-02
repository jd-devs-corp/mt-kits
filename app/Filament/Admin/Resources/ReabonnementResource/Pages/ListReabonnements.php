<?php

namespace App\Filament\Admin\Resources\ReabonnementResource\Pages;

use App\Filament\Admin\Resources\ReabonnementResource;
use App\Models\Kit;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReabonnements extends ListRecords
{
    protected static string $resource = ReabonnementResource::class;

    protected function getHeaderActions(): array
    {
        return [
           /* \EightyNine\ExcelImport\ExcelImportAction::make()
                ->slideOver()
                ->color("primary")
                ->use(Reabonnement::class),*/
            Actions\CreateAction::make()
            ->icon('heroicon-o-plus')
            ->modalIcon('heroicon-o-document')
            ->modalHeading('Enregistrer un (re-)abonnement')
            ->label('(Re-)Abonner un kit')
            ->action(function (array $data) {
                $kit = Kit::find($data['kit_id']);
//         dump($kit);
                $user = User::find($kit->user_id);

                if ($user && $user->role == "fournisseur") {
                    $user->somme_a_percevoir += ($data['plan_tarifaire'] * ($user->pourcentage * 0.01));
                    $user->update(); // Utilisez la méthode save() pour sauvegarder les modifications
                }

                return static::getModel()::create($data);
            }),
        ];
    }
}
