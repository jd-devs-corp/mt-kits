<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Mail;
use App\Models\Kit;
use Carbon\Carbon;
use Illuminate\Console\Command;

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
                    $email = $kit->client->email; // Assurez-vous que la relation client est définie dans le modèle Kit
                    $this->sendEmail($email); // Fonction pour envoyer l'email
                }
            }
        }
    }

    public function sendEmail($email)
    {
        Mail::send('emails.fin_abonnement',[], function ($message) use ($email) {
            $message->to($email)
                ->subject('Votre abonnement est sur le point d\'expirer');
        });
    }
}

