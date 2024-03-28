<?php

namespace App\Filament\Admin\Resources\KitResource\RelationManagers;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ReabonnementsRelationManager extends RelationManager
{
    protected static string $relationship = 'reabonnements';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DateTimePicker::make('date_abonnement')
                    ->required()
                    ->label('Date de debut'),
                Forms\Components\DateTimePicker::make('date_fin_abonnement')
                    ->required()
                    ->label('Date de fin'),
                Forms\Components\TextInput::make('plan_tarifaire')
                    ->required()
                    ->suffix('Fcfa')
                    ->numeric(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('description')
            ->columns([
                Tables\Columns\TextColumn::make('date_abonnement')
                ->label('Date de debut')
                ->date(),
                Tables\Columns\TextColumn::make('date_fin_abonnement')
                ->label('Date de fin')
                ->date( ),
                Tables\Columns\TextColumn::make('plan_tarifaire')
                ->money('XAF'),
                Tables\Columns\TextColumn::make('kit.kit_number')
                ->label('Numero de kit')
                ->prefix('KIT'),
                Tables\Columns\TextColumn::make('statut')
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
                        if ($diffEnJours >= 20) {
                            return 'Valide';
                        } elseif ($diffEnJours <= 15) {
                            return 'A terme';
                        } elseif ($diffEnJours <= 3) {
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
                        'Inactif' => 'light',
                    })


            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                ->icon('heroicon-o-plus'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                ->icon('heroicon-o-eye'),
                Tables\Actions\EditAction::make()
                ->icon('heroicon-o-pencil'),
//                Tables\Actions\ExportAction::make(),
            ])
            ->bulkActions([
                FilamentExportBulkAction::make('export'),
            ]);
    }
}
