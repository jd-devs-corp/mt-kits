<?php

namespace App\Filament\Admin\Resources;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Filament\Admin\Resources\ClientResource\Pages;
use App\Filament\Admin\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;
use Ysfkaya\FilamentPhoneInput\Tables\PhoneColumn;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;
    protected static ?int $navigationSort=3;
    protected static ?string $navigationLabel='Nos clients';

    protected static ?string $navigationGroup = 'Services';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

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
                    ->maxWidth(9)
                    ->initialCountry('CM'),

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
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->icon('heroicon-o-eye')
                    ->color('primary'),
                    Tables\Actions\EditAction::make()
                        ->icon('heroicon-o-pencil')
                    ->color('info'),
                ])
            ])
            ->bulkActions([
                FilamentExportBulkAction::make('Exporter')
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
            \App\Filament\Admin\Resources\ClientResource\RelationManagers\KitsRelationManager::class,
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Admin\Resources\ClientResource\Pages\ListClients::route('/'),
            // 'create' => Pages\CreateClient::route('/create'),
            'view' => \App\Filament\Admin\Resources\ClientResource\Pages\ViewClient::route('/{record}'),
            'edit' => \App\Filament\Admin\Resources\ClientResource\Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
