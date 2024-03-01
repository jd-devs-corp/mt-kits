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
use App\Tables\Columns\StatusColumn;

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
                StatusColumn::make('Statut')
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
