<?php

namespace App\Filament\Admin\Resources\UserResource\Pages;

use App\Filament\Admin\Resources\UserResource;
use App\Models\History;
use App\Models\User;
use Closure;
use Filament\Actions;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Facade;

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
            //Action pour payer simuler un paiement de fournisseur
            Actions\Action::make('generateReceipt')
                ->label('Payer')
                ->icon('heroicon-s-banknotes')
                ->form([
                        Hidden::make('user_id')
                        ->default(fn($record) => $record->id),
                        TextInput::make('pay_amount')
                            ->label('Montant payé')
                            ->required()
                            ->rules( [
                               fn(Get $get) : Closure => function(string $attribute, $value, Closure $fail) use ($get){
                                    $record = User::find($get('user_id')) ;
                                    if($value > $record->somme_a_percevoir){
                                            $fail('Le montant entre est trop grand.');
                                        }
                                    }
                            ]),
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
                    $data['admin_id'] = Facades\Auth::user()->id;

                    $dateSeule = now();
                    $email =$record->email;

                    $this->sendEmail($email,$dateSeule, $data['pay_amount'], $data['pay_method']);

                    return History::create($data);
                })
                ->visible(function (User $record) {
                    return $record->role === 'fournisseur';
                })
                ->disabled(function (User $record) {
                    return $record->somme_a_percevoir < 50;
                }),
        ];


    }
    //Methode d'envoi de mail
    public function sendEmail($email, $dateSeule, $montant, $methode)
    {
        Facades\Mail::send('emails.payment', ['dateSeule' => $dateSeule, 'montant' => $montant, 'methode' => $methode,], function ($message) use ($email, $dateSeule) {
            $message->to($email)
                ->subject('Paiement effectue');
        });
    }
}
