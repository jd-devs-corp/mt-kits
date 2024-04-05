<?php

namespace App\Http\Controllers;

use App\Models\Reabonnement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use App\Models\User;

class ReceiptController extends Controller
{
    public function downloadReceipt($userId)
    {
        $user = User::findOrFail($userId);
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('receipt', ['user' => $user])->render());
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $user->update(['somme_a_percevoir' => 0]);
        return response()->streamDownload(function () use ($dompdf) {
            echo $dompdf->output();
        }, "reçu-".now()->format('d/m/y H:i').".pdf");
    }
    public function generateReceipt($id)
    {

        $abonnement = Reabonnement::findOrFail($id);
        $dateFin=Carbon::parse($abonnement->date_fin_abonnement);
        $dureeMois = $dateFin->diffInMonths($abonnement->date_abonnement);
        $dateDebut=Carbon::parse($abonnement->date_abonnement)->format('d/m/y');
        // Génération du contenu du reçu PDF
        $pdf = \App::make('dompdf.wrapper')->setPaper('A4', 'landscape');
        $pdf->loadView('receipts.show', [
            'abonnement' => $abonnement,
            'dureeMois' => $dureeMois,
            'dateDebut' => $dateDebut
        ])->setOptions(['defaultFont' => 'sans-serif']);;

        // Envoi du PDF à l'utilisateur
        return $pdf->download('reçu-' . now()->format('d/m/y H:i') . '.pdf');


    }
}
