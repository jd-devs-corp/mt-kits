<?php

namespace App\Filament\Admin\Resources\ReabonnementResource\Pages;

use App\Filament\Admin\Resources\ReabonnementResource;
use App\Mail\ReabonnementConfirmed;
use App\Models;
use Carbon\Carbon;
use DateTime;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Mail;

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
                    $kit = Models\Kit::find($data['kit_id']);
//         dump($kit);
                    $user = Models\User::find($kit->user_id);
                    $client = Models\Client::find($kit->client_id);
                    $reabonnement=Models\Reabonnement::where('kit_id',$data['kit_id'])->first();
                    $email = $client->email;
                    if ($user && $user->role == "fournisseur") {
                        $user->somme_a_percevoir += ($data['plan_tarifaire'] * ($user->pourcentage * 0.01));
                        $user->update(); // Utilisez la méthode save() pour sauvegarder les modifications
                    }
                    if ($client) {
                        $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', now());
                        $date = $dateTime->format('Y-m-d');
                        $heureMinute = $dateTime->format('H:i');
                    }
                    Mail::send('emails.reabonnement', ['reabonnement' => $reabonnement, 'heureMinute' => $heureMinute], function ($message) use ($email, $date, $heureMinute) {
                        $message->to($email)
                            ->subject('Votre abonnement a bien été activé.');
                    });
                    return static::getModel()::create($data);
                }),
        ];
    }


}
