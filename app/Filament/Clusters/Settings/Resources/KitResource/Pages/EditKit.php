<?php

namespace App\Filament\Clusters\Settings\Resources\KitResource\Pages;

use App\Filament\Clusters\Settings;
use App\Filament\Resources\KitResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKit extends EditRecord
{
    protected static string $resource = KitResource::class;
    // protected static ?string $cluster = Settings::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
