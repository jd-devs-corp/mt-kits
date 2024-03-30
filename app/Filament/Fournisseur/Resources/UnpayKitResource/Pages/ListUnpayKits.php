<?php

namespace App\Filament\Fournisseur\Resources\UnpayKitResource\Pages;

use App\Filament\Fournisseur\Resources\UnpayKitResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUnpayKits extends ListRecords
{
    protected static string $resource = UnpayKitResource::class;

    protected function getHeaderActions(): array
    {
        return [
          ];
    }
}
