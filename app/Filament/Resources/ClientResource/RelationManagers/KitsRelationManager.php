<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KitsRelationManager extends RelationManager
{
    protected static string $relationship = 'kits';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Kits')
            ->columns([
                Tables\Columns\TextColumn::make('kit_number')->label('Numero de kit'),
                Tables\Columns\TextColumn::make('reabonnements.date_abonnement')
                    ->label('Date d\'abonnement'),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Fournisseur'),
                Tables\Columns\TextColumn::make('reabonnements.date_fin_abonnement')
                ->label('Date de fin d\'abonnement'),
                Tables\Columns\TextColumn::make('reabonnements.plan_tarifaire')
                    ->label('Plan Tarifaire'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Tables\Actions\ExportAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\ExportBulkAction::make(),
                ]),
            ]);
    }
}
