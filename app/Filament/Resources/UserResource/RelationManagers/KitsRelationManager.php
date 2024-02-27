<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Actions\Star;
use App\Actions\ResetStars;
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
                Forms\Components\TextInput::make('localisation')
                    ->required()
                    ->label('Localisation')
                    ->maxLength(255),

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
