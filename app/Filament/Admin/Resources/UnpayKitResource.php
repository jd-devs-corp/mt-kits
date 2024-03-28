<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UnpayKitResource\Pages;
use App\Filament\Resources\UnpayKitResource\RelationManagers;
use App\Models\UnpayKit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UnpayKitResource extends Resource
{
    protected static ?string $model = UnpayKit::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUnpayKits::route('/'),
            'create' => Pages\CreateUnpayKit::route('/create'),
            'view' => Pages\ViewUnpayKit::route('/{record}'),
            'edit' => Pages\EditUnpayKit::route('/{record}/edit'),
        ];
    }
}
