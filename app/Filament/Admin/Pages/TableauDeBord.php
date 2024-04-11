<?php

namespace App\Filament\Admin\Pages;

use App\Filament\Admin\Widgets;
use Filament\Pages\Dashboard;

class TableauDeBord extends Dashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.admin.pages.tableau-de-bord';

    protected static ?string $title = 'Tableau de Bord';



    protected function getHeaderWidgets(): array
    {
        return [
            Widgets\BestCustomerChart::class,
            Widgets\BestSupplierChart::class,
            Widgets\KitsOverview::class,
            Widgets\Overview::class,
            Widgets\UsersChart::class,

        ];
    }


}
