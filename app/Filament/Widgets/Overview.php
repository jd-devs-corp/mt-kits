<?php

namespace App\Filament\Widgets;

use App\Models\Kit;
use App\Models\Reabonnement;
use App\Models\Client;
use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Overview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            // Stat::make('Kits vendus aujourd\'ui', Kit::query()->where('created_at', today())),
            Stat::make('Kits vendus ', Kit::count()),
            Stat::make('Reabonnements effectues ', Reabonnement::count()),
            Stat::make('Clients abonnes', Client::count()),
            Stat::make('Fournisseurs Agrees',User::query()->where('role', 'fournisseur')->count())
        ];
    }
}
