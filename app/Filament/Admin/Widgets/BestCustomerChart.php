<?php

namespace App\Filament\Admin\Widgets;

use App\Models;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class BestCustomerChart extends ChartWidget
{
    protected static ?string $heading = 'Stats d\'achat de kits de ce mois.';

    protected function getData(): array
    {
        $orders = Models\Kit::select('client_id', DB::raw('count(*) as total'))
            ->whereMonth('created_at', date('m'))
            ->groupBy('client_id')
            ->orderBy('total', 'desc')
            ->get();

            // dd($orders);
        // Préparer les données pour le graphique
        $labels = [];
        $data = [];

        // $labels[0]=null;
        foreach ($orders as $order) {
            $labels[] = $order->client->name; // Assurez-vous que la relation customer est définie dans le modèle Order
            $data[] = $order->total;
        }


        return [
            'datasets' =>[
                [
                'label' => 'Nombre de kits',
                "data" => $data ,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
