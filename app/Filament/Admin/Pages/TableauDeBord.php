<?php

namespace App\Filament\Admin\Pages;

use App\Filament\Widgets\Overview;
use Filament\Pages\Dashboard;
use Filament\Pages\Page;

class TableauDeBord extends Dashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.admin.pages.tableau-de-bord';

    protected static ?string $title = 'Tableau de Bord';

    protected ?string $subheading = 'Bienvenue a vous';


    protected function getHeaderWidgets(): array
    {
        return [
            Overview::class,
        ];
    }


}
