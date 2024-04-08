<?php

namespace App\Filament\Fournisseur\Resources;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Filament\Fournisseur;
use App\Filament\Fournisseur\Resources\KitResource\Pages;
use App\Filament\Fournisseur\Resources\KitResource\RelationManagers;
use App\Models\Client;
use App\Models\Kit;
use App\Models\Reabonnement;
use App\Models\UnpayKit;
use App\Models\User;
use Carbon\Carbon;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use libphonenumber\PhoneNumberType;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class KitResource extends Resource
{
    protected static ?string $model = Kit::class;
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = 'Kits vendus';

    protected static ?string $navigationGroup = 'Services';
    protected static ?string $slug = 'kits_vendus';

    protected static ?string $navigationIcon = 'heroicon-s-signal';

    // protected static ?string $cluster = Settings::class;

    public static function form(Form $form): Form
    {
        $user = Auth::user();
        return $form
            ->schema([
                Forms\Components\Select::make('client_id')
                    ->label('Proprietaire')
                    ->relationship('client', 'name')
                    ->searchable()
                    // ->preload()
                    ->createOptionModalHeading('Ajouter un client')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->label('Nom')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->label('Addresse E-mail')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->validationMessages([
                                'required' => 'Ce champ est requis',
                                'unique' => 'L\'email est unique '
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
                            ->rules([

                            ])
                            ->unique(table: Client::class, column: 'phone_number')
                            ->validateFor("CM", PhoneNumberType::MOBILE, true)
                            ->validationMessages([
                                'phone' => 'Le numero doit avoir 9 chiffres.',
                                'starts_with' => 'Le numero est invalide',
                                'required' => 'Ce champ est requis'
                            ])
                            ->onlyCountries(['CM'])
                            ->initialCountry('CM'),
                    ])
                    ->validationMessages([
                        'required' => 'Ce champ est requis'
                    ])
                    ->required(),
                Forms\Components\Hidden::make('user_id')
                    ->default($user->id),
                Forms\Components\Select::make('unpay_kit_id')
                    ->required()
                    ->label('Numero de kit')
                    ->options(UnpayKit::cursor()->where('user_id', Auth::user()->id)->where("statut", 'Payé')->pluck('kit_number', 'id'))
                    ->prefix('KIT')
//                    ->hiddenOn('edit')
                    ->validationMessages([
                        'required' => 'Ce champ est requis'
                    ]),
                Forms\Components\Select::make('localisation')
                    ->searchable()
                    ->validationMessages([
                        'required' => 'Ce champ est requis'
                    ])
                    ->required()
                    ->placeholder('Veuillez selectionner une ville')
                    ->options([
                        'Abong-Mbang' => 'Abong-Mbang',
                        'Akonolinga' => 'Akonolinga',
                        'Ambam' => 'Ambam',
                        'Bafang' => 'Bafang',
                        'Bafia' => 'Bafia',
                        'Bafoussam' => 'Bafoussam',
                        'Bali' => 'Bali',
                        'Bamenda' => 'Bamenda',
                        'Bamendjou' => 'Bamendjou',
                        'Bandjoun' => 'Bandjoun',
                        'Bangangté' => 'Bangangté',
                        'Bangem' => 'Bangem',
                        'Banyo' => 'Banyo',
                        'Batouri' => 'Batouri',
                        'Bertoua' => 'Bertoua',
                        'Bélabo' => 'Bélabo',
                        'Buea' => 'Buea',
                        'Dizangué' => 'Dizangué',
                        'Douala' => 'Douala',
                        'Dschang' => 'Dschang',
                        'Ébolowa' => 'Ébolowa',
                        'Éseka' => 'Éseka',
                        'Fontem' => 'Fontem',
                        'Foumban' => 'Foumban',
                        'Foumbot' => 'Foumbot',
                        'Fundong' => 'Fundong',
                        'Garoua' => 'Garoua',
                        'Guider' => 'Guider',
                        'Kousséri' => 'Kousséri',
                        'Kribi' => 'Kribi',
                        'Kumba' => 'Kumba',
                        'Limbe' => 'Limbe',
                        'Loum' => 'Loum',
                        'Mamfé' => 'Mamfé',
                        'Maroua' => 'Maroua',
                        'Mbalmayo' => 'Mbalmayo',
                        'Mbanga' => 'Mbanga',
                        'Mbouda' => 'Mbouda',
                        'Meiganga' => 'Meiganga',
                        'Melong' => 'Melong',
                        'Mfou' => 'Mfou',
                        'Mokolo' => 'Mokolo',
                        'Mora' => 'Mora',
                        'Mutengene' => 'Mutengene',
                        'Nanga Eboko' => 'Nanga Eboko',
                        'Ngaoundéré' => 'Ngaoundéré',
                        'Nkongsamba' => 'Nkongsamba',
                        'Ntui' => 'Ntui',
                        'Obala' => 'Obala',
                        'Poli' => 'Poli',
                        'Sangmélima' => 'Sangmélima',
                        'Tchollire' => 'Tchollire',
                        'Wum' => 'Wum',
                        'Yaoundé' => 'Yaoundé',
                        'Yagoua' => 'Yagoua',
                        'Yokadouma' => 'Yokadouma',
                    ])


            ]);
    }


    public static function table(Table $table): Table
    {
        $latestReabonnements = Reabonnement::select('kit_id')
            ->selectRaw('MAX(date_fin_abonnement) as latest_date_fin_abonnement')
            ->groupBy('kit_id');

        $query = Kit::query()
            ->leftJoin('unpay_kits', 'kits.unpay_kit_id', '=', 'unpay_kits.id')
            ->select('kits.*')
            ->leftjoinSub($latestReabonnements, 'latest_reabonnements', function ($join) {
                $join->on('kits.id', '=', 'latest_reabonnements.kit_id');
            })
            ->orderBy('latest_reabonnements.latest_date_fin_abonnement', 'ASC');

        return $table
            ->query($query)
            ->columns([
                Tables\Columns\TextColumn::make('client.name')
                    ->label('Proprietaire')
                    ->sortable()
                    ->url(fn(Kit $record): string|null => route('filament.fournisseur.resources.clients.view', $record->client_id))
                    ->searchable(),
                Tables\Columns\TextColumn::make('unpay_kit.kit_number')
                    ->searchable()
                    ->label('Numero de kit'),
                Tables\Columns\TextColumn::make('localisation')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->getStateUsing(function ($record) {
                        $kitNumber = $record->unpay_kit_id;

                        $kit = Kit::where('unpay_kit_id', $kitNumber)->with('reabonnements')->first();


                        $dateFinAbonnement = $kit->reabonnements->sortByDesc('date_fin_abonnement')->first()->date_fin_abonnement ?? null;
                        if ($dateFinAbonnement === null) {
                            return 'Inactif';
                        }
                        $dateFinAbonnementCarbon = Carbon::parse($dateFinAbonnement);

                        // Calculer la différence en jours entre la date de fin d'abonnement et la date actuelle
                        $diffEnJours = $dateFinAbonnementCarbon->diffInDays(now());

                        // Déterminer la couleur et le texte du badge en fonction de la différence en jours
                        if ($diffEnJours >= 20) {
                            return 'Valide';
                        } elseif ($diffEnJours <= 15) {
                            return 'A terme';
                        } elseif ($diffEnJours < 1) {
                            return 'Expiré';
                        } else {
                            return 'Inactif';
                        }
                    })
                    ->default('Inactif')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Valide' => 'primary',
                        'A terme' => 'warning',
                        'Expiré' => 'danger',
                        'Inactif' => 'gray',
                    })

            ])
            ->filters([
                Filter::make('Valide')
                    ->query(
                        fn(Builder $query): Builder => $query->whereHas('reabonnements', function (Builder $query) {
                            $query->whereDate('date_fin_abonnement', '>', now()->addDays(15));
                        })

                    ),
                Filter::make('A terme')
                    ->query(
                        fn(Builder $query): Builder => $query->whereHas('reabonnements', function (Builder $query) {
                            $query->whereDate('date_fin_abonnement', '<=', now()->addDays(15));
                        })
                    ),
                Filter::make('Expire')
                    ->query(
                        fn(Builder $query): Builder => $query->whereHas('reabonnements', function (Builder $query) {
                            $query->whereDate('date_fin_abonnement', '<', now()->addDays(0));
                        })
                    ),
                Filter::make('Inactif')
                    ->query(
                        fn(Builder $query): Builder => $query->whereDoesntHave('reabonnements')
                    )
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->icon('heroicon-o-eye'),
                    Tables\Actions\EditAction::make()
                        ->icon('heroicon-o-pencil'),
                ])
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                FilamentExportBulkAction::make('export'),
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
            // 'create' => Pages\CreateKit::route('/create'),
            // 'view' => Pages\ViewKit::route('/{record}'),
            // 'edit' => Pages\EditKit::route('/{record}/edit'),
        ];
    }
}
