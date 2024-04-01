<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Kit;
use App\Models\Reabonnement;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class KitsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Kit(s) Vendu(s) aujourd\'hui', Kit::query()->whereDate('created_at', today())->count()),
            Stat::make('Réabonnement(s) effectu(é) aujourd\'hui', Reabonnement::query()->whereDate('created_at', today())->count()),
            Stat::make('Kit(s) Vendu(s) au total', Kit::count()),
        ];
    }
}
