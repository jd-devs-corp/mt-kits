<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UnpayKitResource\Pages;
use App\Filament\Admin\Resources\UnpayKitResource\RelationManagers;
use App\Models\UnpayKit;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UnpayKitResource extends Resource
{
    protected static ?string $model = UnpayKit::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Nos kits';
    protected static ?string $modelLabel='Kit';
    protected static ?string $pluralModelLabel='Nos kits en stock';

    protected static ?string $navigationGroup = 'Services';
    protected static ?int $navigationSort = 1;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                Tables\Actions\BulkAction::make('Acheter')
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
                            $record->update();
                        }

                    }),
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
            'index' => Pages\ListUnpayKits::route('/'),
            'create' => Pages\CreateUnpayKit::route('/create'),
            'view' => Pages\ViewUnpayKit::route('/{record}'),
            'edit' => Pages\EditUnpayKit::route('/{record}/edit'),
        ];
    }
}
