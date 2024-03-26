<?php

namespace App\Filament\Resources\KitResource\Pages;

use App\Filament\Clusters\Settings;
use App\Filament\Resources\KitResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKits extends ListRecords
{
    protected static string $resource = KitResource::class;

    // protected static ?string $cluster = Settings::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->icon('heroiocon-o-plus'),
        ];
    }
}
