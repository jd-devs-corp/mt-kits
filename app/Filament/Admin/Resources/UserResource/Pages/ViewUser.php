<?php

namespace App\Filament\Admin\Resources\UserResource\Pages;

use App\Filament\Admin\Resources\UserResource;
use App\Models\History;
use App\Models\User;
use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Auth;

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
                ->form(
                /*return Modal::make()
                    ->title('Effectuer le paiement')*/
                    [
                        TextInput::make('pay_amount')
                            ->label('Montant payé')
                            ->required(),
                        Select::make('pay_method')
                            ->label('Méthode de paiement')
                            ->options([
                                'cash' => 'Cash',
                                'card' => 'Carte',
                                'cheque' => 'Chèque',
                                'transfer' => 'Virement',
                            ])
                            ->required(),
                    ])
                ->action(function (User $record, array $data) {
                    // Mettre à jour la colonne somme_a_percevoir
                    $record->somme_a_percevoir -= $data['pay_amount'];
                    $record->save();

                    // Enregistrer l'historique du paiement
                    History::create([
                        'supplier_id' => $record->id,
                        'user_id' => Auth::user()->id,
                        'pay_amount' => $data['pay_amount'],
                        'pay_method' => $data['pay_method'],
                    ]);

                    // Rediriger vers la page de l'utilisateur
                    return redirect()->to('/admin/users/' . $record->id);
                })
                ->visible(function (User $record) {
                    return $record->role === 'fournisseur';
                })
                ->disabled(function (User $record) {
                    return $record->somme_a_percevoir < 5;
                }),
        ];
    }
}
