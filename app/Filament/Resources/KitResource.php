<?php

namespace App\Filament\Resources;

use App\Filament\Clusters\Settings;
use App\Filament\Resources\KitResource\Pages;
use App\Filament\Resources\KitResource\RelationManagers;
use App\Models\Kit;
use App\Models\User;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KitResource extends Resource
{
    protected static ?string $model = Kit::class;

    protected static ?string $navigationGroup = 'Exterieur';

    protected static ?string $navigationIcon = 'heroicon-o-wifi';

    // protected static ?string $cluster = Settings::class;

    public static function form(Form $form): Form
    {
        $user = Auth::user();
        return $form
            ->schema([
                Forms\Components\Select::make('client_id')
                    ->label('Proprietaire')
                    ->relationship('client','name')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->label('nom')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->label('Addresse E-mail')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone_number')
                            ->tel()
                            ->label('Numero de telephone')
                            ->required()
                            ->numeric(),
                    ])
                    ->required(),
                Forms\Components\Hidden::make('user_id')
                    ->visibleOn('view')
                    ->default($user->role == 'fournisseur' ? $user->id : null),
                Forms\Components\TextInput::make('kit_number')
                    ->required()
                    ->label('Numero de kit')
                    ->maxLength(255),
                Forms\Components\TextInput::make('localisation')
                    ->required()
                    ->label('Localisation')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('client.name')
                    ->label('Proprietaire')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->sortable()
                    ->label('Fournisseur')
                    ->searchable(),

                Tables\Columns\TextColumn::make('kit_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('localisation')
                    ->searchable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\ExportBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
            RelationManagers\ReabonnementsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKits::route('/'),
            'create' => Pages\CreateKit::route('/create'),
            'view' => Pages\ViewKit::route('/{record}'),
            'edit' => Pages\EditKit::route('/{record}/edit'),
        ];
    }
}
