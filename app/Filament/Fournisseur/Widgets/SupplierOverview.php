<?php

namespace App\Filament\Fournisseur\Widgets;

use App\Models\Client;
use App\Models\Kit;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SupplierOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            //
            Stat::make('Client(s) agrees', Client::query()->whereHas('kits', function ($query) {
                $query->where('user_id', auth()->id());
            })->count()),
            Stat::make('Kits Vendu aujourd\'hui',Kit::query()->where('user_id', auth()->id())
                ->whereDate('created_at', today())->count()),
            Stat::make('Kits Vendu au total',Kit::query()->where('user_id', auth()->id())
                ->count()),

        ];
    }
}
