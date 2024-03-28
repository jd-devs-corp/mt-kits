<?php

namespace App\Filament\Admin\Resources\ReabonnementResource\Pages;

use App\Filament\Admin\Resources\ReabonnementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReabonnement extends EditRecord
{
    protected static string $resource = ReabonnementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
            ->icon('heroicon-o-plus'),
            // Actions\DeleteAction::make(),
        ];
    }
}
