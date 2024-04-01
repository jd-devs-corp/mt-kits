<?php

namespace App\Filament\Admin\Resources\UnpayKitResource\Pages;

use App\Filament\Admin\Resources\UnpayKitResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUnpayKits extends ListRecords
{
    protected static string $resource = UnpayKitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-o-plus')
                ->label('Enregistrer un kit')
                ->modalIcon('heroicon-s-signal-slash')
                ->modalHeading("Enregistrer un kit"),
        ];
    }
}
