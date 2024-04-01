<?php

namespace App\Filament\Admin\Resources;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Filament\Admin\Resources\KitResource\Pages;
use App\Filament\Admin\Resources\KitResource\RelationManagers;
use App\Models\Kit;
use App\Models\UnpayKit;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;


class KitResource extends Resource
{
    protected static ?string $model = Kit::class;
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = 'Kits vendus';

    protected static ?string $navigationGroup = 'Services';
    protected static ?string $slug='kits_vendus';

    protected static ?string $navigationIcon = 'heroicon-s-signal';
    protected static ?string $recordTitleAttribute = 'kit_number';

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
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->label('Nom')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->label('Addresse E-mail')
                            ->required()
                            ->maxLength(255),
                        PhoneInput::make('phone_number')
                            ->label('Numero de telephone')
                            ->countryStatePath('phone_country')
                            ->maxWidth('9')
                            ->onlyCountries(['CM'])
                            ->defaultCountry('CM'),
                    ])
                    ->validationMessages([
                        'required' => 'Ce champ est requis'
                    ])
                    ->required(),
                Forms\Components\Hidden::make('user_id')
                    ->default($user->id),
                /*Forms\Components\Select::make('kit_id')
                    ->required()
                    ->options(UnpayKit::cursor()->filter(function(UnpayKit $kit){
                        return $kit->user_id == null;
                    }))
                    ->label('Numero de kit')
                    ->prefix('KIT')
                    ->validationMessages([
                        'unique' => 'Le numero :attribute est deja enregistré',
                        'max_digits' => 'Trop long, doit avoir 9 chiffres.',
                        'min_digits' => 'Trop court, doit avoir 9 chiffres',
                        'required' => 'Ce champ est requis'
                    ])*/
                Forms\Components\Select::make('unpay_kit_id')
                    ->options(UnpayKit::cursor()->filter(function(UnpayKit $kit){
                        return $kit->statut = 'En stock';
                    })->pluck('kit_number', 'id'))
                    ->searchable()
                    ->label('Numero de kit')
                    ->prefix('KIT')
                    ->validationMessages([
                        'unique' => 'Le kit est deja vendu',
                        'required' => 'Ce champ est requis'
                    ])
                    ->unique(Kit::class, 'unpay_kit_id'),


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
        $query = Kit::query()->leftJoin('reabonnements', 'kits.id', '=', 'reabonnements.kit_id')
            ->select('kits.*')
            ->orderByRaw('reabonnements.date_fin_abonnement = null, reabonnements.date_fin_abonnement ASC');
        return $table
            // ->defaultSort(Kit::query()->with('reabonnements', )->getModels()[0]->id)
            ->query($query)
            ->columns(components: [
                Tables\Columns\TextColumn::make('client.name')
                    ->searchable()
                    ->sortable()
                    ->url(fn(Kit $record): string|null => route('filament.admin.resources.clients.view', $record->client_id))
                    ->searchable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Fournisseur')
                    ->getStateUsing(function ($record) {
                        $user = User::find($record->user_id);
                        if ($user && $user->role == 'fournisseur') {
                            return 'SUP. ' . $user->name;
                        } elseif ($user && $user->role == 'admin') {
                            return 'AD. ' . $user->name;
                        }
                        return null;
                    })
                    ->url(fn(Kit $record): string|null => $record->user_id ? route('filament.admin.resources.users.view', $record->user_id) : null)
                    ->searchable(),
                Tables\Columns\TextColumn::make('unpay_kit.kit_number')
                    ->label('Numero de Kit')
                    ->prefix('KIT')
                    ->searchable(),
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
                        $diffEnJours = $dateFinAbonnementCarbon->diffInDays(now());
                        if ($diffEnJours > 15) {
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
                        'Valide' => 'success',
                        'A terme' => 'warning',
                        'Expiré' => 'danger',
                        'Inactif' => 'gray',
                    })

            ])
            ->filters([
                Filter::make('Valide')
                    ->query(fn(Builder $query): Builder => $query->whereHas('reabonnements', function (Builder $query) {
                        $query->whereDate('date_fin_abonnement', '>', now()->addDays(15));
                    })

                    ),
                Filter::make('A terme')
                    ->query(fn(Builder $query): Builder => $query->whereHas('reabonnements', function (Builder $query) {
                        $query->whereDate('date_fin_abonnement', '<=', now()->addDays(15));
                    })
                    ),
                Filter::make('Expire')
                    ->query(fn(Builder $query): Builder => $query->whereHas('reabonnements', function (Builder $query) {
                        $query->whereDate('date_fin_abonnement', '<', now());
                    })
                    ),
                Filter::make('Inactif')
                    ->query(fn(Builder $query): Builder => $query->whereDoesntHave('reabonnements')
                    ),

            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->icon('heroicon-o-eye'),
                    Tables\Actions\EditAction::make()
                        ->icon('heroicon-o-pencil')
                    ,
                ])
            ])
            ->bulkActions([

                FilamentExportBulkAction::make('Exporter')
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
            \App\Filament\Admin\Resources\KitResource\RelationManagers\ReabonnementsRelationManager::class,
        ];
    }

    public static function getGlobalSearchResultTitle(Model $record): string|Htmlable
    {
        return $record->kit_number;
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['kit_number', 'client.name'];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKits::route('/'),
            // 'create' => Pages\CreateKit::route('/create'),
            'view' => Pages\ViewKit::route('/{record}'),
            'edit' => Pages\EditKit::route('/{record}/edit'),
        ];
    }
}
