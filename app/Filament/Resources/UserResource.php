<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Filament\Resources\UserResource\RelationManagers\KitsRelationManager;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables\Grouping\Group;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

//use Svg\Tag\Group;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Administration';

    protected static ?string $navigationLabel = 'Gerants';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nom')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('surname')
                    ->label('Prenom')
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label('Addresse E-mail')
                    ->email()
                    ->required()
                    ->maxLength(255),
                PhoneInput::make('phone_number')
                    ->label('Numéro de téléphone')
                    ->countryStatePath('phone_country')
                    ->defaultCountry('CM'),
                Forms\Components\Select::make('role')
                    ->label('Rôle')
                    ->required()
                    ->options([
                        'fournisseur' => 'fournisseur',
                        'admin' => 'admin'
                    ]),
                Forms\Components\ToggleButtons::make('status')
                    ->label('Statut de l\'utilisateur')
                    ->options([
                        true => 'Actif',
                        false => 'Inactif'
                    ])
                    ->icons([
                        true => 'heroicon-o-check-badge',
                        false => 'heroicon-o-x-circle'
                    ])
                    ->colors([
                        true => 'success',
                        false => 'danger'
                    ])
                    ->inline()
                    ->default(true),

                Forms\Components\DateTimePicker::make('email_verified_at')
                    ->label('Vérifié le')
                    ->visibleOn('view'),

                Forms\Components\TextInput::make('pourcentage')
                    ->label('Pourcentage de commission')
                    ->numeric(),
                Forms\Components\TextInput::make('somme_a_percevoir')
                    ->numeric(),
                // ->visibleOn('view'),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->hiddenOn('view')
                    ->label('Mot de passe')
                    ->required()
                    ->maxLength(255)
                    ->default('new123'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('role')
                    ->searchable(),
                Tables\Columns\IconColumn::make('status')
                    ->label('Statut de compte')
                    ->boolean()
//                ->badge()
                ,
                Tables\Columns\TextColumn::make('pourcentage')
                    ->suffix(' %')
                    ->searchable(),
            ])
            ->defaultGroup( Group::make('status')
                ->label('Utilisateur actif'))
            ->groupingSettingsHidden()
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
