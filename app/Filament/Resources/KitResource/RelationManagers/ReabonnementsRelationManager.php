<?php

namespace App\Filament\Resources\KitResource\RelationManagers;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
//use App\Tables\Columns\StatusColumn;

class ReabonnementsRelationManager extends RelationManager
{
    protected static string $relationship = 'reabonnements';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('date_abonnement')
                    ->required()
                    ->default(now()),
                Forms\Components\DatePicker::make('date_fin_abonnement')
                    ->required()
                    ->minDate(now()),
                Forms\Components\TextInput::make('plan_tarifaire')
                    ->required()
                    ->numeric(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('description')
            ->columns([
                Tables\Columns\TextColumn::make('date_abonnement'),
                Tables\Columns\TextColumn::make('date_fin_abonnement'),
                Tables\Columns\TextColumn::make('plan_tarifaire'),
                Tables\Columns\TextColumn::make('kit.kit_number'),
                /*StatusColumn::make('Statut')
                    ->badge()
                    ->color('success')*/
                /* Tables\Columns\TextColumn::make('status')
                 ->badge()*/
                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->getStateUsing(function ($record) {
                        $dateFinAbonnement = $record->date_fin_abonnement;

                        // Si la date de fin d'abonnement est nulle, l'abonnement est inactif
                        if ($dateFinAbonnement === null) {
                            return 'Inactif';
                        }

                        // Convertir la date de fin d'abonnement en objet Carbon
                        $dateFinAbonnementCarbon = Carbon::parse($dateFinAbonnement);

                        // Calculer la différence en jours entre la date de fin d'abonnement et la date actuelle
                        $diffEnJours = $dateFinAbonnementCarbon->diffInDays(now());

                        // Déterminer la couleur et le texte du badge en fonction de la différence en jours
                        if ($diffEnJours >= 30) {
                            return 'Valide';
                        } elseif ($diffEnJours >= 15) {
                            return 'A terme';
                        } else {
                            return 'Expiré';
                        }
                    })
                    ->default('Inactif')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Valide' => 'success',
                        'A terme' => 'warning',
                        'Expiré' => 'danger',
                        'Inactif' => 'light',
                    })


            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
//                Tables\Actions\ExportAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\ExportBulkAction::make(),
                ]),
            ]);
    }
}
