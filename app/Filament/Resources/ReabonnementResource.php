<?php

namespace App\Filament\Resources;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use App\Filament\Resources\ReabonnementResource\Pages;
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
                                    ->initialCountry('CM'),
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('kit_number')
                            ->required()
                            ->label('Numero de kit')
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
                    ]),

                Forms\Components\DateTimePicker::make('date_abonnement')
                    ->required()
                    ->default(now())
                ,
                Forms\Components\DateTimePicker::make('date_fin_abonnement')
                    ->required()
                    //   ->minDate(now()->addMonth())
                    ->default(now()->addMonth()),
                Forms\Components\TextInput::make('plan_tarifaire')
                    ->required()
                    ->suffix('Fcfa')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kit.kit_number')
                    ->label('Numero de kit')
                    ->prefix('N° ')
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_abonnement')
                    ->date()
                    ->label('Date de debut')
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_fin_abonnement')
                    ->date()
                    ->label('Date de fin')
                    ->sortable(),
                Tables\Columns\TextColumn::make('plan_tarifaire')
                    ->numeric()
                    ->money('XAF')
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('generate_receipt')
                    ->label('Telecharger le reçu')
                    ->icon('heroicon-o-receipt-refund')
                    // ->label('Waoh')
                    ->action(function(Reabonnement $record, array $data){
                        return redirect(url('admin/receipt/generate',$record->id));
                    })
                    // ->url(route('receipts.generate', function(User $record, array $data){
                    //     return intval($record->id);
// }
//                     )),
                // Tables\Actions\EditAction::make(),
            ])
            /*->headerActions([
                FilamentExportHeaderAction::make('export')
            ])*/
            ->bulkActions([
                FilamentExportBulkAction::make('export'),
            ]);
    }

    protected function getTableHeaderActions(): array
    {
        return [
            // ExportHeaderAction::make('Export'),
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
