<?php

namespace App\Filament\Fournisseur\Resources\ClientResource\Pages;

use App\Filament\Fournisseur\Resources\ClientResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClient extends EditRecord
{
    protected static string $resource = ClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
            ->icon('heroicon-o-eye'),
        ];
    }
}
