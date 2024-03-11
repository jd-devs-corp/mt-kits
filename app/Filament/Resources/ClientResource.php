<?php

namespace App\Filament\Resources;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Tables\Grouping\Group;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;
use Ysfkaya\FilamentPhoneInput\Tables\PhoneColumn;
use Ysfkaya\FilamentPhoneInput\Infolists\PhoneEntry;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationGroup = 'Extérieur';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function infolists(Infolist $infolist): Infolist
    {
        return $infolist
            ->columns([
                Infolists\Components\TextEntry::make('name'),
                Tables\Columns\TextColumn::make('email'),
                PhoneEntry::make('phone')
                    ->displayFormat(PhoneInputNumberType::NATIONAL)
                    ->badge()
                    ->color('success')
                    ->countryColumn('phone_country'),
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nom(s) et prénom(s)')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                PhoneInput::make('phone_number')
                    ->label('Numéro de téléphone')
                    ->countryStatePath('phone_country')
                    ->required()
                    ->maxWidth('9')
                    ->defaultCountry('CM'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')#
                ->label('Nom(s)')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Adresse mail')
                    ->searchable(),
                PhoneColumn::make('phone_number')
                    ->label('Numéro de téléphone')
                    ->displayFormat(PhoneInputNumberType::NATIONAL)
                    ->countryColumn('phone_country'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d-m-Y H:m:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                FilamentExportBulkAction::make('Exporter')
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
            RelationManagers\KitsRelationManager::class,
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'view' => Pages\ViewClient::route('/{record}'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
