<?php

namespace App\Tables\Columns;

use Filament\Tables\Columns\Column;

class StatusColumn extends Column
{
    protected string $view = 'tables.columns.status-column';
    
    // public function render(): \Illuminate\Contracts\View\View
    // {
    //     // Votre logique pour déterminer le statut de l'abonnement
    //     $record = $this->record;
    //     $dateFinAbonnement = strtotime($record['date_fin_abonnement']);
    //     $now = strtotime(now());

    //     if ($dateFinAbonnement < $now) {
    //         // Date dépassée (Noir)
    //         return view('status.expired');
    //     } elseif ($dateFinAbonnement - $now < 14 * 24 * 60 * 60) {
    //         // Moins de deux semaines restantes (Rouge)
    //         return view('status.expiring_soon');
    //     } else {
    //         // Encore valide (Vert)
    //         return view('status.valid');
    //     }
    // }
}
