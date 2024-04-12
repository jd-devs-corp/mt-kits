<?php

namespace App\Filament\Fournisseur\Resources;

use App\Filament\Fournisseur\Resources\UnpayKitResource\Pages;
use App\Filament\Fournisseur\Resources\UnpayKitResource\RelationManagers;
use App\Models\UnpayKit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class UnpayKitResource extends Resource
{
    protected static ?string $model = UnpayKit::class;

    protected static ?string $navigationLabel='Mes kits';

    protected static ?string $navigationGroup='Services';

    protected static ?string $modelLabel= 'Kit';

    protected static ?string $pluralModelLabel= 'Kits';

    protected static ?string $slug = 'mes-kits';

    protected static ?string $navigationIcon = 'heroicon-s-signal-slash';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        $query = UnpayKit::query()->where('user_id', Auth::user()->id);
        return $table
            ->query($query)
            ->columns([
                Tables\Columns\TextColumn::make('kit_number')
                    ->label('N° de kit')
                    ->prefix('KIT')
                    ->numeric(),
                Tables\columns\TextColumn::make('statut')
                    ->badge()
                    ->color(fn($state): string => match ($state) {
                        'Payé' => "success",
                        'Vendu' => 'warning'
                    })
                    ->label('Statut du kit'),
            ])
            ->filters([
                TernaryFilter::make('statut')
                    ->label('Statut du kit')
                    ->placeholder('Mes kits en stock.')
                    ->trueLabel('Tous mes kits')
                    ->falseLabel('Kits Vendu')
                    ->queries(
                        true: fn(Builder $query) => $query, // In this example, we do not want to filter the query when it is blank.
                        false: fn(Builder $query) => $query->where('statut', 'Vendu')->where('user_id', Auth::user()->id),
                        blank: fn(Builder $query) => $query->where('statut', 'Payé'),
                    )
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
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
