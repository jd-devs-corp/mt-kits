<?php

namespace App\Filament\Fournisseur\Resources\KitResource\Pages;

use App\Filament\Fournisseur;
use App\Filament\Fournisseur\Resources\KitResource;
use App\Models\UnpayKit;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\View\Components\Modal;
use Illuminate\Database\Eloquent\Model;

class ListKits extends ListRecords
{
    protected static string $resource = KitResource::class;

    // protected static ?string $cluster = Settings::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->icon('heroicon-o-plus')
            ->label('Enregistrer une vente')
            ->modalHeading('Enregistrer une vente')
            ->modalIcon('heroicon-s-shopping-bag')
            ->modalSubmitActionLabel("Enregistrer")
            ->extraModalFooterActions([
                // Modal::make('wanda')
            ])
            ->action(function( array $data){
                $unpay_kit = UnpayKit::find($data['unpay_kit_id']);
                $unpay_kit->statut = 'Vendu';
                $unpay_kit->update();
                return static::getModel()::create($data);
            }),
        ];
    }
}
