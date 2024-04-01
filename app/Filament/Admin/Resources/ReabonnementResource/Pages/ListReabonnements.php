<?php

namespace App\Filament\Admin\Resources\ReabonnementResource\Pages;

use App\Filament\Admin\Resources\ReabonnementResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReabonnements extends ListRecords
{
    protected static string $resource = ReabonnementResource::class;

    protected function getHeaderActions(): array
    {
        return [
           /* \EightyNine\ExcelImport\ExcelImportAction::make()
                ->slideOver()
                ->color("primary")
                ->use(Reabonnement::class),*/
            Actions\CreateAction::make()
            ->icon('heroicon-o-plus')
            ->modalIcon('heroicon-o-document')
            ->modalHeading('Enregistrer un (re-)abonnement')
            ->label('(Re-)Abonner un kit'),
        ];
    }
}
