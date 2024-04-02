<?php

namespace App\Filament\Admin\Resources\KitResource\Pages;

use App\Filament\Admin\Resources\KitResource;
use App\Models\UnpayKit;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListKits extends ListRecords
{
    protected static string $resource = KitResource::class;

    // protected static ?string $cluster = Settings::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->icon('heroicon-o-plus')
            ->label('Enregistrer un achat')
            ->modalHeading('Enregistrer un achat')
            ->modalIcon('heroicon-o-shopping-bag')
            ->action(function(array $data){
                $unpay_kit = UnpayKit::find($data['unpay_kit_id']);
                $unpay_kit->statut = 'Vendu';
                $unpay_kit->user_id = Auth::user()->id;
                $unpay_kit->update();
                return static::getModel()::create($data);
            }),
        ];
    }
}
