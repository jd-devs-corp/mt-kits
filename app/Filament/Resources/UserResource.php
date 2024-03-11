<?php

namespace App\Filament\Resources;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables\Grouping\Group;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

//use Svg\Tag\Group;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Filament\Resources\Pages\ListRecords;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Administration';

    protected static ?string $navigationLabel = 'Gerants';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nom')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label('Adresse E-mail')
                    ->email()
                    ->required()
                    ->maxLength(255),
                PhoneInput::make('phone_number')
                    ->label('Numéro de téléphone')
                    ->countryStatePath('phone_country')
                    ->initialCountry('CM'),
                Forms\Components\Select::make('role')
                    ->label('Rôle')
                    ->required()
                    ->options([
                        'fournisseur' => 'fournisseur',
                        'admin' => 'admin'
                    ]),
                Forms\Components\ToggleButtons::make('is_active')
                    ->label('Statut de l\'utilisateur')
                    ->options([
                        true => 'Actif',
                        false => 'Inactif'
                    ])
                    ->icons([
                        true => 'heroicon-o-check-badge',
                        false => 'heroicon-o-x-circle'
                    ])
                    ->colors([
                        true => 'success',
                        false => 'danger'
                    ])
                    ->inline()
                    ->default(true),

                Forms\Components\DateTimePicker::make('email_verified_at')
                    ->label('Vérifié le')
                    ->visibleOn('view'),

                Forms\Components\TextInput::make('pourcentage')
                    ->label('Pourcentage de commission')
                    ->suffix('%')
                    ->numeric(),
                Forms\Components\TextInput::make('somme_a_percevoir')
                     ->visibleOn('view')
                    ->suffix(' FCFA')
                    ->label('Montant a percevoir')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading('Aucun utilisateur')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nom(s)')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Adresse mail')
                    ->copyable()
                    ->copyMessage('Email address copied')
                    ->copyMessageDuration(1500)
                    ->searchable(),
                Tables\Columns\TextColumn::make('role')
                    ->label('Rôle')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Statut de compte')
                    ->boolean(),
                Tables\Columns\TextColumn::make('pourcentage')
                    ->label('Commission')
                    ->suffix(' %')
                    ->searchable(),
            ])
            ->defaultGroup(Group::make('is_active')
                ->label('État de compte')
                ->collapsible()
                ->getTitleFromRecordUsing(fn($record) => $record->is_active ? 'Actif' : 'Inactif')
            )
            ->groups(
                ['role']
            )
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                /*Tables\Actions\Action::make('generateReceipt')
                    ->label('Payer')
                    ->icon('heroicon-s-banknotes')
                    ->action(function (User $record) {
                        return redirect()->to('/download-receipt/' . $record->id);
                    }),*/
                /* Tables\Actions\EditAction::make(),
                 EditAction::make('Payer')
                     ->mutateRecordDataUsing(function (array $data): array {
                         $data['user_id'] = auth()->id();

                         return $data;
                     })*/
            ])
            ->bulkActions([
                FilamentExportBulkAction::make('Exporter')
                /*Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),*/
            ]);
    }


    public static function getRelations(): array
    {
        return [
            //
            // RelationManagers\KitsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
