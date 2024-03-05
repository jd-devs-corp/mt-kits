<?php

namespace App\Filament\Resources;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use App\Filament\Resources\ReabonnementResource\Pages;
use App\Filament\Resources\ReabonnementResource\RelationManagers;
use App\Models\Kit;
use App\Models\Reabonnement;
use App\Models\User;
use Illuminate\Support\Carbon;
use Filament\Forms\Set;
use Filament\Forms;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Form;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Relations\Relation;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class ReabonnementResource extends Resource
{
    protected static ?string $model = Reabonnement::class;

    protected static ?string $navigationGroup = 'Extérieur';

    protected static ?string $navigationIcon = 'heroicon-o-book-open';


    public static function form(Form $form): Form
    {
        $user = Auth::user();
        return $form
            ->schema([
                Forms\Components\Select::make('kit_id')
                    ->required()
                    ->relationship('kit', 'kit_number')
                    ->searchable()
                    ->label('Numero de kit')
                    ->preload()
                    ->createOptionForm([
                        Forms\Components\Select::make('client_id')
                            ->label('Proprietaire')
                            ->relationship('client', 'name')
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
                                PhoneInput::make('phone_number')
                                    ->countryStatePath('phone_country')
                                    ->defaultCountry('CM'),
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('fournisseur_id')
                            ->disabled()
                            ->numeric()
                            ->default($user && $user->role == 'fournisseur' ? $user->id : ''),
                        Forms\Components\TextInput::make('kit_number')
                            ->required()
                            ->label('Numero de kit')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('localisation')
                            ->required()
                            ->label('Localisation')
                            ->maxLength(255),
                    ]),

                Forms\Components\DateTimePicker::make('date_abonnement')
                    ->required()
                    ->default(now())
                ,
                /* Forms\Components\Select::make('duree_abonnement')
                     ->options([
                         '1' => '1 mois',
                         '2' => '2 mois',
                         '3' => '3 mois',
                         '4' => '4 mois',
                         '5' => '5 mois',
                         '6' => '6 mois',
                         '7' => '7 mois',
                         '8' => '8 mois',
                         '9' => '9 mois',
                         '10' => '10 mois',
                         '11' => '11 mois',
                         '12' => '12 mois',
                     ])
                     ->live()
 //                    ->notIn(self::$model)
                     ->default(1), */
                Forms\Components\DateTimePicker::make('date_fin_abonnement')
                    ->required()
                    /*->datalist([
                        now()->addMonth(),
                        now()->addMonth(),
                        now()->addMonth(),
                        now()->addMonth(),
                        now()->addMonth(),
                        now()->addMonth(),
                        now()->addMonth(),
                    ])*/
//                    ->minDate(now()->addMonth())
                    ->default(now()->addMonth()),
                Forms\Components\TextInput::make('plan_tarifaire')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kit.kit_number')
                    ->label('Numero de kit')
                    ->sortable(),
                Tables\Columns\TextColumn::make('kit.client.name')
                    ->label('Proprietaire')
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_abonnement')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_fin_abonnement')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('plan_tarifaire')
                    ->numeric()
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
            ])
            /*->headerActions([
                FilamentExportHeaderAction::make('export')
            ])*/
            ->bulkActions([
                FilamentExportBulkAction::make('export'),
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    protected function afterCreateOrUpdate(ComponentContainer $container, $record): void
    {
        parent::afterCreateOrUpdate($container, $record);

        $container->getComponent('date_abonnement')->on('change', function ($value) use ($container) {
            $startDate = $value;
            $duration = $container->getComponent('duree_abonnement')->getValue();

            if ($startDate && $duration) {
                $endDate = Carbon::parse($startDate)->addMonths($duration);
                $container->getComponent('date_fin_abonnement')->setValue($endDate->toDateString());
            }
        });

        $container->getComponent('duree_abonnement')->on('change', function ($value) use ($container) {
            $startDate = $container->getComponent('date_abonnement')->getValue();
            $duration = $value;

            if ($startDate && $duration) {
                $endDate = Carbon::parse($startDate)->addMonths($duration);
                $container->getComponent('date_fin_abonnement')->setValue($endDate->toDateString());
            }
        });
    }

    protected function getTableHeaderActions(): array
    {
        return [
            FilamentExportHeaderAction::make('Export'),
        ];
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
            'index' => Pages\ListReabonnements::route('/'),
            'create' => Pages\CreateReabonnement::route('/create'),
            'view' => Pages\ViewReabonnement::route('/{record}'),
            'edit' => Pages\EditReabonnement::route('/{record}/edit'),
        ];
    }
}
