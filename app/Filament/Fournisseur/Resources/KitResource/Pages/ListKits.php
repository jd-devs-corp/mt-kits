<?php

namespace App\Filament\Fournisseur\Resources\KitResource\Pages;

use App\Filament\Fournisseur;
use App\Filament\Fournisseur\Resources\KitResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKits extends ListRecords
{
    protected static string $resource = KitResource::class;

    // protected static ?string $cluster = Settings::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->icon('heroicon-o-plus')
            ->label('Enregistrer une vente')
            ->modalHeading('Enregistrer une vente')
            ->modalIcon('heroicon-s-signal'),
        ];
    }
}
