<?php

namespace App\Filament\Admin\Resources\UserResource\RelationManagers;

use App\Models\Kit;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KitRelationManager extends RelationManager
{
    protected static string $relationship = 'kits';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Define form fields if needed
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kit_number')
                    ->label('Numéro de kit'),
                Tables\Columns\TextColumn::make('localisation'),
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
                        } else {
                            return 'Inactif';
                        }
                    })
                    ->default('Inactif')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Valide' => 'success',
                        'A terme' => 'warning',
                        'Expiré' => 'danger',
                        'Inactif' => 'gray',
                    })
            ])
            ->filters([
                //
            ])
            ->headerActions([
            ])
            ->actions([
            ])
            ->query(function (Builder $query) {
                // Filter kits related to the current user
                $query->where('user_id', auth()->id());
            })
            ;
    }
    public static function canViewForRecord(Model $ownerRecord, string $pageClass): bool
    {
        // Vérifie si le propriétaire de l'enregistrement est un utilisateur
        if ($ownerRecord instanceof User) {
            // Vérifie si l'utilisateur a le rôle 'admin'
            return $ownerRecord->role !== 'admin';
        }

        // Par défaut, retourne vrai
        return true;
    }
}
