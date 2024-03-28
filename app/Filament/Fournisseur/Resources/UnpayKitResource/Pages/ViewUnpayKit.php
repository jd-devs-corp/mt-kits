<?php

namespace App\Filament\Fournisseur\Resources\UnpayKitResource\Pages;

use App\Filament\Fournisseur\Resources\UnpayKitResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewUnpayKit extends ViewRecord
{
    protected static string $resource = UnpayKitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
