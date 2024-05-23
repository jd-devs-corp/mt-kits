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
    protected $description = 'Command description';

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
                }
            }
        }
    }

    public function sendEmail($email, $dateSeule, $heureMinute)
    {
        //        $dateFinAbonnement = Reabonnement::where('kit_id', $kit)->sortByDesc('date_fin_abonnement')->first()->date_fin_abonnement->format('Y-m-d');
//        $image = "/images/logo_admin.png";


        Mail::send('emails.fin_abonnement', ['dateSeule' => $dateSeule,'heureMinute'=>$heureMinute], function ($message) use ($email) {
            $message->to($email)
                ->subject('Votre abonnement est sur le point d\'expirer');
        });
    }
}
