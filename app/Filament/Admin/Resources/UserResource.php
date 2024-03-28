<?php

namespace App\Filament\Admin\Resources;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Filament\Admin\Resources\UserResource\RelationManagers\KitRelationManager;
use App\Filament\Resources\UserResource\Pages;
use App\Models\Kit;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
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
                Forms\Components\TextInput::make('email')
                    ->label('Adresse E-mail')
                    ->email()
                    ->required()
                    ->maxLength(255),
                PhoneInput::make('phone_number')
                    ->label('Numéro de téléphone')
                    ->countryStatePath('phone_country')
                    ->required()
                    ->maxWidth('9')
                    ->onlyCountries(['CM'])
                    ->defaultCountry('CM'),
                Forms\Components\Select::make('role')
                    ->label('Rôle')
                    ->required()
                    ->options([
                        'fournisseur' => 'fournisseur',
                        'admin' => 'admin'
                    ]),
                Forms\Components\ToggleButtons::make('is_active')
                    ->label('Statut de l\'utilisateur')
                    ->required()
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
                    // ->visibleOn('view')
                    ,

                Forms\Components\TextInput::make('pourcentage')
                    ->label('Pourcentage de commission')
                    ->suffix('%')
                    ->numeric(),
                Forms\Components\TextInput::make('somme_a_percevoir')
                     ->visibleOn('view')
                    ->suffix(' FCFA')
                    ->label('Montant a percevoir'),
                Forms\Components\TextInput::make('password')
                    ->default('new123')
                ->visibleOn('create'),
            ]);
    }

    public static function table(Table $table): Table
    {
        $query= User::query()->OrderBy('is_active', 'DESC');
        return $table
            ->query($query)
            ->emptyStateHeading('Aucun utilisateur')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nom(s)')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Adresse mail')
                    ->copyable()
                    ->copyMessage('Email address copied')
                    ->copyMessageDuration(1500)
                    ->searchable(),
                Tables\Columns\TextColumn::make('role')
                    ->label('Rôle')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Statut de compte')
                    ->boolean(),
                    Tables\Columns\TextColumn::make('status')
                    ->label('Nbre de kits vendu')
                    ->getStateUsing(function($record){
                        if($record->role == 'fournisseur'){
                            $id = $record->id;
                            $number_of_kits = Kit::where('user_id', $id)->count();
                            return $number_of_kits;
                        }
                        return null;
                    }),
                Tables\Columns\TextColumn::make('pourcentage')
                    ->label('Commission')
                    ->suffix(' %')
                    ->searchable(),
            ])

            ->filters([
                TernaryFilter::make('is_active')
                        ->label('Statut de compte')
                        ->placeholder('Tous les utilisateurs')
                        ->trueLabel('Utilisateurs actifs')
                        ->falseLabel('Utilisateurs inactifs')
                        ->queries(
                            true: fn (Builder $query) => $query->where('is_active',  true),
                            false: fn (Builder $query) => $query->where('is_active', false),
                            blank: fn (Builder $query) => $query, // In this example, we do not want to filter the query when it is blank.
                        )
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->icon('heroicon-o-eye'),
                    Tables\Actions\EditAction::make()
                    ->icon('heroicon-o-pencil'),
                ])
            ])
            ->bulkActions([
                FilamentExportBulkAction::make('Exporter')
                /*Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),*/
            ]);
    }


    public static function getRelations(): array
    {
        return [
            //
             KitRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Admin\Resources\UserResource\Pages\ListUsers::route('/'),
            // 'create' => Pages\CreateUser::route('/create'),
            'view' => \App\Filament\Admin\Resources\UserResource\Pages\ViewUser::route('/{record}      '),
            'edit' => \App\Filament\Admin\Resources\UserResource\Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
