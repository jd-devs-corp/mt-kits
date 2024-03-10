<?php

namespace App\Http\Controllers;

use App\Models\Reabonnement;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
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
