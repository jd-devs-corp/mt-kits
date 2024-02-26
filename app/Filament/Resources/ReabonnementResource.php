<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReabonnementResource\Pages;
use App\Filament\Resources\ReabonnementResource\RelationManagers;
use App\Models\Reabonnement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReabonnementResource extends Resource
{
    protected static ?string $model = Reabonnement::class;

    protected static ?string $navigationGroup = 'Extérieur';

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function getNavigationBadge(): ?string
{
    return static::getModel()::count();
}

    public static function form(Form $form): Form
    {
        $user = Auth::user();
        return $form
            ->schema([
                Forms\Components\Select::make('kit_id')
                    ->required()
                    ->relationship('kits', 'kit_number')
                    ->searchable()
                    ->label('Numero de kit')
                    ->preload()
                    ->createOptionForm([
                        Forms\Components\Select::make('client_id')
                    ->label('Proprietaire')
                    ->relationship('client','name')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
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
                    ])
                    ->required(),
                Forms\Components\TextInput::make('fournisseur_id')
                    ->disabled()
                    ->numeric()
                    ->default($user && $user->role == 'fournisseur'? $user->id : ''),
                Forms\Components\TextInput::make('kit_number')
                    ->required()
                    ->label('Numero de kit')
                    ->maxLength(255),
                Forms\Components\TextInput::make('localisation')
                    ->required()
                    ->label('Localisation')
                    ->maxLength(255),
                    ]),
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
                    ->sortable(),

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
