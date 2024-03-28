<?php

namespace App\Filament\Admin\Resources\KitResource\Pages;

use App\Filament\Fournisseur;
use App\Filament\Admin\Resources\KitResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKit extends EditRecord
{
    protected static string $resource = KitResource::class;
    // protected static ?string $cluster = Settings::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
            ->icon('heroicon-o-eye'),
            // Actions\DeleteAction::make(),
        ];
    }
}
