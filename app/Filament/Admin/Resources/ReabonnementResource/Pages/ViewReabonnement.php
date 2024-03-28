<?php

namespace App\Filament\Admin\Resources\ReabonnementResource\Pages;

use App\Filament\Admin\Resources\ReabonnementResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewReabonnement extends ViewRecord
{
    protected static string $resource = ReabonnementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
            ->icon('heroicon-o-pencil'),
        ];
    }
}
