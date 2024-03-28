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
            Stat::make('Reabonnements effectues ', Reabonnement::count()),
            Stat::make('Clients abonnes', Client::count()),
            Stat::make('Fournisseurs Agrees',User::query()->where('role', 'fournisseur')->where('is_active', true)->count())
        ];
    }
}
