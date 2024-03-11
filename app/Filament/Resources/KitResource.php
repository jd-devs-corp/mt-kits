<?php

namespace App\Filament\Resources;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Filament\Clusters\Settings;
use App\Filament\Resources\KitResource\Pages;
use App\Filament\Resources\KitResource\RelationManagers;
use App\Models\Kit;
use App\Models\Reabonnement;
use App\Models\User;
use App\Tables\Columns\StatusColumn;
use Carbon\Carbon;
use Faker\Provider\ar_EG\Text;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Column;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Grouping\Group;
use PhpOffice\PhpSpreadsheet\Calculation\Web;

class KitResource extends Resource
{
    protected static ?string $model = Kit::class;

    protected static ?string $navigationGroup = 'Extérieur';

    protected static ?string $navigationIcon = 'heroicon-o-wifi';

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
                            ->initialCountry('CM'),
                    ])
                    ->required(),
                Forms\Components\Hidden::make('user_id')
                    ->visibleOn('view')
                    ->default($user->role == 'fournisseur' ? $user->id : null),
                Forms\Components\TextInput::make('kit_number')
                    ->required()
                    ->label('Numero de kit')
                    ->prefix('N° ')
                    ->maxLength(255),

                Forms\Components\Select::make('localisation')
                    ->searchable()
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

        return $table
            ->columns(components: [
                Tables\Columns\TextColumn::make('client.name')
                    ->label('Proprietaire')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Fournisseur')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('kit_number')
                    ->label('Numero de Kit')
                    ->prefix('N° ')
                    ->searchable(),
                Tables\Columns\TextColumn::make('localisation')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->sortable()
                    ->getStateUsing(function ($record) {
                        $kitNumber = $record->kit_number;

                        $kit = Kit::where('kit_number', $kitNumber)->with('reabonnements')->first();


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
                        }
                        else{
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
                        $query->whereDate('date_fin_abonnement', '<', now()->addDays(0));
                    })
                ),
                Filter::make('Inactif')
                    ->query(fn(Builder $query): Builder => $query->whereDoesntHave('reabonnements')
                )
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                FilamentExportBulkAction::make('Exporter'),
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
