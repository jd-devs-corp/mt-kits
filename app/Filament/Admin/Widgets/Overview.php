<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Client;
use App\Models\Reabonnement;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Overview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Réabonnement(s) éffectué(s) ', Reabonnement::count()),
            Stat::make('Clients abonné(s)', Client::count()),
            Stat::make('Fournisseur(s) Agrée(s)',User::query()->where('role', 'fournisseur')->where('is_active', true)->count())
        ];
    }
}
