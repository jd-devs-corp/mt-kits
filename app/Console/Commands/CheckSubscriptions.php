<?php

namespace App\Console\Commands;

use App\Models\Reabonnement;
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

                if ($diffEnJours <= 15) {
                    $email = $kit->client->email;
                    // Assurez-vous que la relation client est définie dans le modèle Kit
                    $kitId = $kit->id;
                    $this->sendEmail($email, $dateFinAbonnement); // Fonction pour envoyer l'email
                }
            }
        }
    }

    public function sendEmail($email, $dateFinAbonnement)
    {
//        $dateFinAbonnement = Reabonnement::where('kit_id', $kit)->sortByDesc('date_fin_abonnement')->first()->date_fin_abonnement->format('Y-m-d');


        Mail::send('emails.fin_abonnement', ['dateFinAbonnement' => $dateFinAbonnement], function ($message) use ($email, $dateFinAbonnement) {
            $message->to($email)
                ->subject('Votre abonnement est sur le point d\'expirer');
        });

    }
}

