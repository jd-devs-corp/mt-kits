<?php

namespace App\Filament\Resources\KitResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PhpParser\Node\Stmt\Return_;

class ReabonnementsRelationManager extends RelationManager
{
    protected static string $relationship = 'reabonnements';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DateTimePicker::make('date_abonnement')
                    ->required()
                    ->default(now()),
                Forms\Components\DateTimePicker::make('date_fin_abonnement')
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
                Tables\Columns\TextColumn::make('statut')
                // ->value(function(){
                //     return 'deux';
                // }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
