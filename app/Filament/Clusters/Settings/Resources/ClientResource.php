<?php

namespace App\Filament\Clusters\Settings\Resources;

use App\Filament\Clusters\Settings\Resources\ClientResource\Pages;
use App\Filament\Clusters\Settings\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationGroup = 'Exterieur';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                PhoneInput::make('phone_number')
                    ->countryStatePath('phone_country')
                    ->defaultCountry('CM'),
            ]);
    }

    public static function table(Table $table): Table
    {
        $filteredQuery = Client::whereHas('kits', function ($query) {
        $query->where('user_id', auth()->id());
    });
    return $table
        ->query($filteredQuery)       ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->numeric()
                    ->sortable(),

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
            RelationManagers\KitsRelationManager::class,
        ];
    }

//     public static function getNavigationBadge(): ?string
// {
//     return static::getModel()::count();
// }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'view' => Pages\ViewClient::route('/{record}'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
