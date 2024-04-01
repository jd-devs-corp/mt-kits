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

    // protected static ?string $cluster = Settings::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $unpay_kit = UnpayKit::find($data['unpay_kit_id']);
        $unpay_kit->statut = 'Vendu';
        if($unpay_kit->user_id == null){
            $unpay_kit->user_id = Auth::user()->id;
        }
        $unpay_kit->update();
        return $data;
    }
}
