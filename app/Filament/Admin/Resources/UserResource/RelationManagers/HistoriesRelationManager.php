<?php

namespace App\Filament\Admin\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HistoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'histories';



    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('user_id')
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                ->label('Utilisateur'),
                Tables\Columns\TextColumn::make('supplier.name')
                ->label('Fournisseur'),
                Tables\Columns\TextColumn::make('pay_amount')
                ->label('Montant payé'),
                Tables\Columns\TextColumn::make('pay_method')
                ->label('Méthode de paiement'),
            ]);
    }
}
