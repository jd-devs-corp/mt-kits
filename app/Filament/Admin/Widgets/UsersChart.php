<?php

namespace App\Filament\Admin\Widgets;

use App\Filament\Admin\Resources\ClientResource;
use App\Models;
use Filament\Tables;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use FontLib\Table\Type\name;
use Illuminate\Contracts\Database\Eloquent\Builder;

class UsersChart extends BaseWidget
{
    use InteractsWithPageFilters;
    protected function getStats(): array
    {
        return [
            Stat::make(
                label: 'Meilleur fournisseur du mois:',
                value:( Models\User::query()
                    ->select('users.name', 'users.id')
                    ->with('kits')
                    ->leftJoin('kits', 'kits.user_id', 'users.id')
                    // ->rightJoin("reabonnements", 'reabonnements.kit_id', 'kits.id')
                    ->whereDate('kits.created_at', '>=', now()->startOfMonth())
                    ->whereDate('kits.created_at', '<=', now()->endOfMonth())
                    // ->orderBy('kits_count', 'desc')
                    ->where('role', 'fournisseur')
                    ->where('is_active', true)
                    ->first()->name ?? ''),
            ),
            Stat::make(
                label: 'Meilleur client du mois:',
                value: (Models\Client::query()
                    ->select('clients.name', 'clients.id')
                    ->withCount('kits')
                    ->leftJoin('kits', 'kits.client_id', 'clients.id')
                    ->orderBy('kits_count', 'desc')
                    ->whereDate('kits.created_at', '>=', now()->startOfMonth())
                    ->whereDate('kits.created_at', '<=', now()->endOfMonth())
                    ->first()->name??''),
            ),
            Stat::make(
                label: 'Nombre de kits en stock',
                value: Models\UnpayKit::where('statut', 'En stock')
                    ->count()
            )

        ];
    }

}
