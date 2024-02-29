<?php

namespace App\Filament\Clusters\Settings\Resources\ClientResource\RelationManagers;

use App\Tables\Columns\StatusColumn;
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
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Kits')
            ->columns([
                Tables\Columns\TextColumn::make('kit_number')->label('Numero de kit'),
                StatusColumn::make('Statut')
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
