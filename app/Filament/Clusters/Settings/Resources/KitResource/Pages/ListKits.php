<?php

namespace App\Filament\Clusters\Settings\Resources\KitResource\Pages;

use App\Filament\Clusters\Settings;
use App\Filament\Clusters\Settings\Resources\KitResource;
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
            ->icon('heroicon-o-plus'),
        ];
    }
}
