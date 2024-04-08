<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UnpayKitResource\Pages;
use App\Filament\Admin\Resources\UnpayKitResource\RelationManagers;
use App\Models\Kit;
use App\Models\UnpayKit;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UnpayKitResource extends Resource
{
    protected static ?string $model = UnpayKit::class;

    protected static ?string $navigationIcon = 'heroicon-s-signal-slash';
    protected static ?string $navigationLabel = 'Nos kits';
    protected static ?string $slug = 'kits_en_stock';
    protected static ?string $modelLabel = 'Kit';
    protected static ?string $pluralModelLabel = 'Nos kits en stock';

    protected static ?string $navigationGroup = 'Services';
    protected static ?int $navigationSort = 1;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kit_number')
                    ->required()
                    ->numeric()
                    ->maxLength(9)
                    ->minLength(9)
                    ->placeholder('Entrer le code à 9 chiffres')
                    ->validationMessages([
                        'unique' => 'Le numero de kit est deja enregistré',
                        'max_digits' => 'Trop long, doit avoir 9 chiffres.',
                        'min_digits' => 'Trop court, doit avoir 9 chiffres',
                        'required' => 'Ce champ est requis'
                    ])
                    ->prefix('KIT')
                    ->unique(UnpayKit::class, 'kit_number'),
                // Forms\Components\Hidden::make('user_id')
                        // ->default(null)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kit_number')
                    ->prefix('KIT'),
                Tables\columns\TextColumn::make('statut')
                    ->badge()
                    ->color(fn($state): string => match ($state) {
                        'En stock' => 'success',
                        'Payé' => "info",
                        'Vendu' => 'warning'
                    }),
                Tables\Columns\TextColumn::make('user.name')
                ->label('Fournisseur')
                ->getStateUsing(function ($record) {
                    $user = User::find($record->user_id);
                    if ($user && $user->role == 'fournisseur') {
                        return 'SUP. ' . $user->name;
                    } elseif ($user && $user->role == 'admin') {
                        return 'AD. ' . $user->name;
                    }
                    return null;
                })
                // ->visibleFrom('')
                ->url(fn(UnpayKit $record): string|null => $record->user_id ? route('filament.admin.resources.users.view', $record->user_id) : null)

            ])
            ->filters([
                TernaryFilter::make('Statut')
                    ->label('Statut du kit')
                    ->placeholder('Kits en stock')
                    ->trueLabel('Tous les kits')
                    ->falseLabel('Kits deja achete')
                    ->queries(
                        false: fn(Builder $query) => $query->where('statut', 'Vendu'),
                        true: fn(Builder $query) => $query,
                        blank: fn(Builder $query) => $query->where('statut', 'En stock') // In this example, we do not want to filter the query when it is blank.
                    )
            ])
            ->actions([
                //Tables\Actions\ActionGroup::make([
                  //  Tables\Actions\ViewAction::make()
                    //    ->icon('heroicon-o-eye'),
                    //Tables\Actions\EditAction::make()
                  //  ->icon('heroicon-o-pencil'),
                //])
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('Fournir')
                        ->icon('heroicon-o-banknotes')
                        ->deselectRecordsAfterCompletion()
                        ->requiresConfirmation()
                        ->form([
                            Forms\Components\Select::make('user_id')
                                ->label('Fournisseur')
                                ->options(User::cursor()->filter(function (User $user) {
                                    return $user->role == 'fournisseur' && $user->is_active;
                                })->pluck('name', 'id'))
                                ->required(),
                        ])
                        ->action(function (Collection $records, array $data) {
                            foreach ($records as $record) {
                                $record->user_id = $data['user_id'];
                                $record->statut = 'Payé';
                                $record->update();

                            }

                        }),

            ])
            ->checkIfRecordIsSelectableUsing(
                function (Model $record): bool{
                    if($record->statut == "En stock")
                        return true;
                    return false;
                },
            );
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
            'index' => Pages\ListUnpayKits::route('/'),
            // 'create' => Pages\CreateUnpayKit::route('/create'),
            //'view' => Pages\ViewUnpayKit::route('/{record}'),
            //'edit' => Pages\EditUnpayKit::route('/{record}/edit'),
        ];
    }
}
