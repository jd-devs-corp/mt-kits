<?php

namespace App\Filament\Fournisseur\Resources\KitResource\Pages;

use App\Filament\Fournisseur;
use App\Filament\Fournisseur\Resources\KitResource;
use App\Models\UnpayKit;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateKit extends CreateRecord
{
    protected static string $resource = KitResource::class;

    

    // protected static ?string $cluster = Settings::class;
}
