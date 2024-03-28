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
            Stat::make('Kits Vendu aujourd\'hui', Kit::query()->whereDate('created_at', today())->count()),
            Stat::make('Reabonnements effectue aujourd\'hui', Reabonnement::query()->whereDate('created_at', today())->count()),
            Stat::make('Kits Vendu au total', Kit::count()),
        ];
    }
}
