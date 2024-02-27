<?php

namespace App\Filament\Resources\ReabonnementResource\Pages;

use App\Filament\Resources\ReabonnementResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewReabonnement extends ViewRecord
{
    protected static string $resource = ReabonnementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
