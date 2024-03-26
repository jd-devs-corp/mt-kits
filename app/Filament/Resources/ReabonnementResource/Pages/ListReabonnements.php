<?php

namespace App\Filament\Resources\ReabonnementResource\Pages;

use App\Filament\Resources\ReabonnementResource;
use App\Imports\Reabonnement;
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
            ->icon('heroiocon-o-plus'),
        ];
    }
}
