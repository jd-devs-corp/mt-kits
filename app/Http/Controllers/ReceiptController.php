<?php

namespace App\Http\Controllers;

use App\Models\Reabonnement;
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
        }, "reçu-{$user->id}.pdf");
    }
    public function generateReceipt($id)
    {
        $abonnement = Reabonnement::findOrFail($id);

        // Génération du contenu du reçu PDF
        $pdf = \App::make('dompdf.wrapper')->setPaper('a4', 'landscape');
        $pdf->loadView('receipts.show', ['abonnement' => $abonnement]);

        // Envoi du PDF à l'utilisateur
        return $pdf->download('recu-' . $abonnement->id . '.pdf');


    }
}
