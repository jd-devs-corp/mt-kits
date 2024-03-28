<?php

namespace App\Filament\Clusters\Settings\Resources\KitResource\RelationManagers;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReabonnementsRelationManager extends RelationManager
{
    protected static string $relationship = 'reabonnements';

    // public function form(Form $form): Form
    // {
    //     return $form
    //         ->schema([
    //             Forms\Components\DatePicker::make('date_abonnement')
    //                 ->required()
    //                 ->default(now()),
    //             Forms\Components\DatePicker::make('date_fin_abonnement')
    //                 ->required()
    //                 ->minDate(now()),
    //             Forms\Components\TextInput::make('plan_tarifaire')
    //                 ->required()
    //                 ->numeric(),
    //         ]);
    // }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('description')
            ->columns([
                Tables\Columns\TextColumn::make('kit.kit_number')
                ->label('Numero de kit')
                ->prefix('KIT'),
                Tables\Columns\TextColumn::make('date_abonnement')
                ->label('Date de debut'),
                Tables\Columns\TextColumn::make('date_fin_abonnement')
                ->label('Date de fin'),
                Tables\Columns\TextColumn::make('plan_tarifaire')
                ->money('XAF'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->icon('heroicon-o-pencil'),
                // Tables\Actions\ExportAction::make(),
            ])
            ->bulkActions([
                FilamentExportBulkAction::make('export'),
            ]);
    }
}
