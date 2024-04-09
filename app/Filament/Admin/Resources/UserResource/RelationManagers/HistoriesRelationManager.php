<?php

namespace App\Filament\Admin\Resources\UserResource\RelationManagers;

use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical;

class HistoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'histories';
    protected static ?string $title = 'Historiques';


    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('user_id')
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                ->label('Fournisseur'),
                Tables\Columns\TextColumn::make('admin.name')
                ->label('Payeur')
                ->getStateUsing(fn (Model $record) => User::find($record->admin_id)->name),
                Tables\Columns\TextColumn::make('pay_amount')
                ->label('Montant payé'),
                Tables\Columns\TextColumn::make('pay_method')
                ->label('Méthode de paiement'),
            ]);
    }
}
