<?php

namespace App\Filament\Admin\Resources\KitResource\Pages;

use App\Filament\Admin\Resources\KitResource;
use App\Filament\Fournisseur;
use App\Models\UnpayKit;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateKit extends CreateRecord
{
    protected static string $resource = KitResource::class;

}
