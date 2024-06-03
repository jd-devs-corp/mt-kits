<?php

namespace App\Console\Commands;

use DateTime;
use Carbon\Carbon;
use App\Models\Kit;
use App\Models\Reabonnement;
use Illuminate\Console\Command;
use function Laravel\Prompts\error;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class CheckSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:subscriptions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Serve to check if a subscription is about to expire and send an email to the client';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $kits = Kit::with('reabonnements')->get();
        foreach ($kits as $kit) {
            $dateFinAbonnement = $kit->reabonnements->sortByDesc('date_fin_abonnement')->first()->date_fin_abonnement ?? null;
            if ($dateFinAbonnement !== null) {
                $dateFinAbonnementCarbon = Carbon::parse($dateFinAbonnement);
                $diffEnJours = $dateFinAbonnementCarbon->diffInDays(now());
                if ($diffEnJours <= 15 && $diffEnJours >= 0) {
                    $email = $kit->client->email;
                    // Assurez-vous que la relation client est définie dans le modèle Kit
                    // $this->info($kit->unpay_kit->kit_number);
                    // $this->info($kit->client->pnone);
                    $kitId = $kit->id;
                    $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $dateFinAbonnement);
                    $dateSeule = $dateTime->format('Y-m-d');
                    $heureMinute = $dateTime->format('H:i');
                    $this->sendEmail($email, $dateSeule, $heureMinute); // Fonction pour envoyer l'email
                    $contact = $kit->client->phone_number;
                    $this->sendMessage($contact, $dateSeule); // Fonction pour envoyer le message
                }
            }
        }
    }

    public function sendEmail($email, $dateSeule)
    {
        Mail::send('emails.fin_abonnement', ['dateSeule' => $dateSeule,], function ($message) use ($email, $dateSeule) {
            $message->to($email)
                ->subject('Votre abonnement est sur le point d\'expirer');
        });
    }

    public function sendMessage($contact, $dateSeule){
        $contact = str_replace(' ', '', $contact);
        $contact = "+237$contact";
        $contact = mb_convert_encoding($contact, 'UTF-8', 'UTF-8');
        Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-api-key' => env('SMS_API_KEY')
        ])->post('https://toolbox-jxa3.onrender.com/api/sms/send', [
            'recipient' => $contact,
            'message' => "Votre abonnement est sur le point d'expirer.\n N'oubliez pas de renouveler votre abonnement avant le $dateSeule, pour eviter toute interruption"
        ]);

        // $body = $response->body();
        // dump(  $body, $contact, $response);
    }
}