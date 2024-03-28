<?php

namespace App\Filament\Resources\UnpayKitResource\Pages;

use App\Filament\Resources\UnpayKitResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUnpayKit extends EditRecord
{
    protected static string $resource = UnpayKitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
