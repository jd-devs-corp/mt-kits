<?php

namespace App\Console\Commands;

use App\Models\Reabonnement;
use DateTime;
use Illuminate\Support\Facades\Mail;
use App\Models\Kit;
use Carbon\Carbon;
use Illuminate\Console\Command;
use function Laravel\Prompts\error;

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

                if ($diffEnJours <= 15 && $diffEnJours > 0) {
                    $email = $kit->client->email;
                    // Assurez-vous que la relation client est définie dans le modèle Kit
                    $kitId = $kit->id;
                    $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $dateFinAbonnement);
                    $dateSeule = $dateTime->format('Y-m-d');
                    $heureMinute = $dateTime->format('H:i');
                    $this->sendEmail($email, $dateSeule, $heureMinute); // Fonction pour envoyer l'email
                    $contact = $kit->client->phone_country.''.$kit->client->phone_number;
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
        $curl = curl_init();

                curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://toolbox-jxa3.onrender.com/api/sms/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>"{
                    'recipient': '$contact',
                    'message': 'Votre abonnement est sur le point d'expirer.\n N'oubliez pas de renouveler votre abonnement avant le $dateSeule, pour eviter toute interruption'
                }",
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'x-api-key: '.env('SMS_API_KEY')
                ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                dump( $response);
    }
}
