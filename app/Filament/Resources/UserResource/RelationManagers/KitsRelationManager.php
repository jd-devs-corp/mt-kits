<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
//use App\Actions\Star;
//use App\Actions\ResetStars;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KitsRelationManager extends RelationManager
{
    protected static string $relationship = 'kits';

    public function form(Form $form): Form
    {
        $user = Auth::getUser();
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
                Forms\Components\TextInput::make('user_id')

                    ->default($user && $user->role == 'fournisseur'? $user->id : ''),
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('kits')
            ->columns([
                Tables\Columns\TextColumn::make('kit_number')->label('Numero du kit'),
                Tables\Columns\TextColumn::make('client.name')
                    ->label('Proprietaire'),
                Tables\Columns\TextColumn::make('reabonnements.date_fin_abonnement')
                    ->label('Date de fin d\'abonnement'),
                Tables\Columns\TextColumn::make('reabonnements.plan_tarifaire')
                    ->label('Plan Tarifaire')
                    ->prefix('$'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ExportAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\ExportBulkAction::make(),
                ]),
            ]);
    }
}
