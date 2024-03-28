<?php

namespace App\Filament\Admin\Resources\KitResource\Pages;

use App\Filament\Fournisseur;
use App\Filament\Admin\Resources\KitResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKit extends CreateRecord
{
    protected static string $resource = KitResource::class;

    // protected static ?string $cluster = Settings::class;
}
