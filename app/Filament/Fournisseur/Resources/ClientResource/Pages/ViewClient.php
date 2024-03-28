<?php

namespace App\Filament\Fournisseur\Resources\ClientResource\Pages;

use App\Filament\Fournisseur\Resources\ClientResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewClient extends ViewRecord
{
    protected static string $resource = ClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
            ->icon('heroicon-o-pencil'),
        ];
    }
}
