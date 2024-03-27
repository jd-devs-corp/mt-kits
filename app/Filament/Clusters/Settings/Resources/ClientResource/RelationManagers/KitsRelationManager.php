<?php

namespace App\Filament\Clusters\Settings\Resources\ClientResource\RelationManagers;

use App\Models\Kit;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

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
                PhoneInput::make('phone_number')
                    ->label('Numéro de téléphone')
                    ->countryStatePath('phone_country')
                    ->required()
                    ->maxWidth('9')
                    ->initialCountry('CM'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Kits')
            ->columns([
                Tables\Columns\TextColumn::make('kit_number')
                    ->prefix('KIT-')
                    ->searchable()
                    ->sortable()
                    ->label('Numero de kit'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->getStateUsing(function ($record) {
                        $kitNumber = $record->kit_number;

                        $kit = Kit::where('kit_number', $kitNumber)->with('reabonnements')->first();


                        $dateFinAbonnement = $kit->reabonnements->sortByDesc('date_fin_abonnement')->first()->date_fin_abonnement ?? null;
                        if ($dateFinAbonnement === null) {
                            return 'Inactif';
                        }
                        $dateFinAbonnementCarbon = Carbon::parse($dateFinAbonnement);
                        $diffEnJours = $dateFinAbonnementCarbon->diffInDays(now());
                        if ($diffEnJours > 15) {
                            return 'Valide';
                        } elseif ($diffEnJours <= 15) {
                            return 'A terme';
                        } elseif ($diffEnJours < 1) {
                            return 'Expiré';
                        }
                        else{
                            return 'Inactif';
                        }
                    })
                    ->default('Inactif')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Valide' => 'primary',
                        'A terme' => 'warning',
                        'Expiré' => 'danger',
                        'Inactif' => 'gray',
                    })
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
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
