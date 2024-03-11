<?php

namespace App\Http\Controllers;

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
}
