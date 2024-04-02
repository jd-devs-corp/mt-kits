<?php

namespace App\Filament\Fournisseur\Resources;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Filament\Fournisseur\Resources\ClientResource\Pages;
use App\Filament\Fournisseur\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use libphonenumber\PhoneNumberType;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;
use Ysfkaya\FilamentPhoneInput\Tables\PhoneColumn;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationGroup = 'Services';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->validationMessages([
                        'max_digits' => 'Trop long, doit avoir 9 chiffres.',
                        'required' => 'Ce champ est requis'
                    ])
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->unique(Client::class, 'email')
                    ->required()
                    ->validationMessages([
                        'unique' => 'Le numero :attribute est deja enregistré',
                        'max_digits' => 'Trop long.',
                        'required' => 'Ce champ est requis'
                    ])
                    ->maxLength(255),
                    PhoneInput::make('phone_number')
                        ->label('Numéro de téléphone')
                        ->countryStatePath('phone_country')
                        ->required()
                        ->validateFor('CM', PhoneNumberType::MOBILE, true)
                        ->validationMessages([
                            'phone' => 'Le numero doit avoir 9 chiffres.',
                            'required' => 'Ce champ est requis'
                        ])
                        ->maxWidth(9)
                        ->onlyCountries(['CM'])
                        ->initialCountry('CM'),
            ]);
    }

    public static function table(Table $table): Table
    {
        $filteredQuery = Client::whereHas('kits', function ($query) {
        $query->where('user_id', auth()->id());
    });
    return $table
        ->query($filteredQuery)
        ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Nom'),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->label('Adresse E-mail'),
            PhoneColumn::make('phone_number')
                ->label('Numéro de téléphone')
                ->displayFormat(PhoneInputNumberType::NATIONAL)
                ->countryColumn('phone_country'),

        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\ViewAction::make()
            ->icon('heroicon-o-eye'),
            // Tables\Actions\EditAction::make(),
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

//     public static function getNavigationBadge(): ?string
// {
//     return static::getModel()::count();
// }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            // 'create' => Pages\CreateClient::route('/create'),
            'view' => Pages\ViewClient::route('/{record}'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
