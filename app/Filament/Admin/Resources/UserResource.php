<?php

namespace App\Filament\Admin\Resources;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Filament\Admin\Resources\UserResource\RelationManagers\HistoriesRelationManager;
use App\Filament\Admin\Resources\UserResource\RelationManagers\KitRelationManager;
use App\Filament\Admin\Resources\UserResource\Pages;
use App\Models\Kit;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use libphonenumber\PhoneNumberType;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Filament\Tables\Columns\IconColumn;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?int $navigationSort = 6;

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
                    ->validationMessages([
                        'max_digits' => 'Trop long.',
                        'min_digits' => 'Trop court.',
                        'required' => 'Ce champ est requis'
                    ])
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label('Adresse E-mail')
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->required()
                    ->validationMessages([
                        'unique' => 'cet adresse mail est deja enregistré',
                        'max_digits' => 'Trop long.',
                        'min_digits' => 'Trop court',
                        'required' => 'Ce champ est requis'
                    ])
                    ->maxLength(255),
                    PhoneInput::make('phone_number')
                    ->label('Numéro de téléphone')
                    ->countryStatePath('phone_country')
                    ->required()
                    ->startsWith([
                            '+23762',
                            '+23765',
                            '+23766',
                            '+23767',
                            '+23768',
                            '+23769'
                        ]
                    )
                    ->unique(ignoreRecord: true)
                    ->validateFor("CM", PhoneNumberType::MOBILE, true)
                    ->validationMessages([
                        'phone' => 'Le numero doit avoir 9 chiffres.',
                        'starts_with' => 'Le numero est invalide',
                        'required' => 'Ce champ est requis'
                    ])
                    ->onlyCountries(['CM'])
                    ->initialCountry('CM'),
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
                    ->visibleOn('view')
                ,

                Forms\Components\TextInput::make('pourcentage')
                    ->label('Pourcentage de commission')
                    ->suffix('%')
                    ->numeric()
                    ->maxLength(2)
                    ->maxValue('50')
                    ->validationMessages([
                        'max_digits' => 'Trop long, doit avoir 2 chiffres.',
                        'min_digits' => 'Trop court, doit avoir 2 chiffres'
                    ])
                    ->minValue(1)
                ,
                Forms\Components\TextInput::make('somme_a_percevoir')
                    ->visibleOn('view')
                    ->suffix(' FCFA')
                    ->label('Montant a percevoir'),
                Forms\Components\TextInput::make('password')
                    ->default('newmtkits')
                    ->password()
                    ->maxLength(8)
                    ->validationMessages([
                        'max' => [
                            'string' => 'Trop long, doit avoir 8 caracteres.',
                        ],
                        'min' => [
                            'string' => 'Trop court, doit avoir 8 caracteres'
                        ]
                    ])
                    ->revealable()
                    ->visibleOn('create'),
            ]);
    }

    public static function table(Table $table): Table
    {
        $query = User::query()->OrderBy('is_active', 'DESC');
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
                    ->alignCenter()
                    ->searchable(),
                Tables\Columns\TextColumn::make('is_active')
                    ->label('Statut de compte')
                    ->badge()
                    ->getStateUsing(function ($record) {
                        $id = $record->id;
                        $is_active = User::where('id', $id)->first();
                        if ($is_active->is_active == 1) {
                            return 'Actif';
                        }
                        return 'Inactif';
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'Actif' => 'success',
                        'Inactif' => 'danger',
                    })
                    ->icon(fn(string $state): string => match ($state) {
                        'Actif' => 'heroicon-o-check-badge',
                        'Inactif' => 'heroicon-o-x-circle',
                    })
                    ->alignCenter()
                    ->searchable()
                    ->sortable()
                    ->disabled(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Nbre de kits vendu')
                    ->alignCenter()
                    ->getStateUsing(function ($record) {
                        $id = $record->id;
                        $number_of_kits = Kit::where('user_id', $id)->count();
                        return $number_of_kits;

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
                        true: fn(Builder $query) => $query->where('is_active', true),
                        false: fn(Builder $query) => $query->where('is_active', false),
                        blank: fn(Builder $query) => $query // In this example, we do not want to filter the query when it is blank.
                    ),
                TernaryFilter::make('role')
                    ->label('Role de l\'utilisateur')
                    ->placeholder('Tous les utilisateurs')
                    ->trueLabel('Administrateur | Employés')
                    ->falseLabel('Fournisseurs')
                    ->queries(
                        true: fn(Builder $query) => $query->where('role', 'admin'),
                        false: fn(Builder $query) => $query->where('role', 'fournisseur'),
                        blank: fn(Builder $query) => $query // In this example, we do not want to filter the query when it is blank.
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
//            KitRelationManager::class,
            HistoriesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            // 'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
