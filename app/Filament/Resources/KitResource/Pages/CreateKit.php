<?php

namespace App\Filament\Resources\KitResource\Pages;

use App\Filament\Clusters\Settings;
use App\Filament\Resources\KitResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKit extends CreateRecord
{
    protected static string $resource = KitResource::class;

    // protected static ?string $cluster = Settings::class;
}
