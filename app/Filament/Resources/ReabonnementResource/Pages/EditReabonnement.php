<?php

namespace App\Filament\Resources\ReabonnementResource\Pages;

use App\Filament\Resources\ReabonnementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReabonnement extends EditRecord
{
    protected static string $resource = ReabonnementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
