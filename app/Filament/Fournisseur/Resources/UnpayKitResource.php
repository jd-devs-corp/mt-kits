<?php

namespace App\Filament\Fournisseur\Resources;

use App\Filament\Fournisseur\Resources\UnpayKitResource\Pages;
use App\Filament\Fournisseur\Resources\UnpayKitResource\RelationManagers;
use App\Models\UnpayKit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class UnpayKitResource extends Resource
{
    protected static ?string $model = UnpayKit::class;

    protected static ?string $navigationIcon = 'heroicon-s-signal-slash';
    protected static ?string $navigationLabel = 'Nos kits';
    protected static ?string $modelLabel='Kit';
    protected static ?string $pluralModelLabel='Kits en stock';

    protected static ?string $navigationGroup = 'Services';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        $query = UnpayKit::query()->whereDoesntHave('kit')->where('user_id', Auth::user()->id);
        return $table
            ->query($query)
            ->columns([
                Tables\Columns\TextColumn::make('kit_number')
                    ->prefix('KIT')
                    ->numeric()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([

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
            // 'create' => Pages\CreateUnpayKit::route('/create'),
            // 'view' => Pages\ViewUnpayKit::route('/{record}'),
            // 'edit' => Pages\EditUnpayKit::route('/{record}/edit'),
        ];
    }
}
