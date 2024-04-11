<?php

namespace App\Filament\Admin\Widgets;

use App\Models;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class BestSupplierChart extends ChartWidget
{
    protected static ?string $heading = 'Stats de vente des kits des fournisseurs';

    protected static string $color = 'success';

    protected static ?string $pollingInterval = '1s';

    protected function getData(): array
    {
        $orders = Models\Kit::select('kits.user_id', DB::raw('count(*) as total'))
            ->join('users', 'kits.user_id', 'users.id')
            ->whereMonth('kits.created_at', date('m'))
            ->where("users.role", 'fournisseur')
            ->groupBy('kits.user_id')
            ->get();
            // dd($orders);
        // Préparer les données pour le graphique
        $labels = [];
        $data = [];

        // $labels[0]=null;
        foreach ($orders as $order) {
            $labels[] = $order->user->name; // Assurez-vous que la relation customer est définie dans le modèle Order
            $data[] = $order->total;
        }


        return [
            'datasets' =>[
                [
                    'label'=> 'Nombre de kits',
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
