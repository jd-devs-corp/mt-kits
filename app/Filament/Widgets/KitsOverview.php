<?php

namespace App\Filament\Widgets;

use App\Models\Kit;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class KitsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Kits Vendu aujourd\'hui', Kit::query()->where('created_at', today())->count()),
            // Stat::make('Kits Vendu ce mois', Kit::query()->where('created_at', now()->month())->count()),
            Stat::make('Kits Vendu au total', Kit::count()),
        ];
    }
}
