<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReabonnementResource\Pages;
use App\Filament\Resources\ReabonnementResource\RelationManagers;
use App\Models\Kit;
use App\Models\Reabonnement;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Tables\Columns\ColorColumn;
use App\Tables\Columns\StatusColumn;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReabonnementResource extends Resource
{
    protected static ?string $model = Reabonnement::class;

    protected static ?string $navigationGroup = 'Exterieur';

    protected static ?string $navigationIcon = 'heroicon-o-book-open';



    public static function form(Form $form): Form
    {
        $user = Auth::user();
        return $form
            ->schema([
                Forms\Components\Select::make('kit_id')
                    ->required()
                    ->relationship('kit', 'kit_number')
                    ->searchable()
                    ->label('Numero de kit')
                    ->preload(),
                Forms\Components\DatePicker::make('date_abonnement')
                    ->required()
                    ->default(today()),
                Forms\Components\DatePicker::make('date_fin_abonnement')
                    ->required()
                    ->minDate(today()->addMonth()),
                Forms\Components\TextInput::make('plan_tarifaire')
                    ->required()
                    ->numeric(),
            ])
            ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kit.kit_number')
                    ->label('Numero de kit')
                    ->sortable(),
                Tables\Columns\TextColumn::make('kit.client.name')
                    ->label('Proprietaire')
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_abonnement')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_fin_abonnement')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('plan_tarifaire')
                    ->numeric()
                    ->prefix('$')
                    ->sortable(),
                StatusColumn::make('Statut')

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // $data['user_id'] = auth()->id();

        $kit = Kit::find($data['kit_id']);
        // dump($data);
        $user = User::find($kit->user_id);

        if ($user && $user->role === 'fournisseur') {
            $user->somme_a_percevoir += $data['plan_tarifaire'] * $user->pourcentage;
            $user->save(); // Utilisez la méthode save() pour sauvegarder les modifications
        }

        return $data;
    }



    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReabonnements::route('/'),
            'create' => Pages\CreateReabonnement::route('/create'),
            'view' => Pages\ViewReabonnement::route('/{record}'),
            'edit' => Pages\EditReabonnement::route('/{record}/edit'),
        ];
    }
}
