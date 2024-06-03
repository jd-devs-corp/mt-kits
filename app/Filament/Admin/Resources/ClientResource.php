<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Client;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use libphonenumber\PhoneNumberType;
use Illuminate\Support\Facades\Http;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\Tables\PhoneColumn;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;
use App\Filament\Admin\Resources\ClientResource\Pages;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Filament\Admin\Resources\ClientResource\RelationManagers;

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
                    ->validationMessages([
                        'max_digits' => 'Trop long.',
                        'required' => 'Ce champ est requis'
                    ])
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->validationMessages([
                        'unique' => 'L\'email est deja enregistré',
                        'max_digits' => 'Trop long.',
                        'required' => 'Ce champ est requis'
                    ])
                    ->maxLength(255),
                PhoneInput::make('phone_number')
                    ->label('Numéro de téléphone')
                    ->countryStatePath('phone_country')
                    ->required()
                    ->startsWith([
                            '+23762',
                            '+23765',
                            '+23766',
                            '+23767',
                            '+23768',
                            '+23769'
                        ]
                    )
                    ->unique(ignoreRecord: true)
                    ->validateFor("CM", PhoneNumberType::MOBILE, true)
                    ->validationMessages([
                        'phone' => 'Le numero doit avoir 9 chiffres.',
                        'starts_with' => 'Le numero est invalide',
                        'required' => 'Ce champ est requis'
                    ])
                    ->onlyCountries(['CM'])
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
                    ->displayFormat(PhoneInputNumberType::INTERNATIONAL)
                    ->countryColumn('phone_country'),

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
                    Tables\Actions\Action::make('contacter')
                        ->action(function($record){
                            $contact = $record->phone_number;
                            $contact = str_replace(' ', '', $contact);
                            $contact = "+237$contact";
                            $contact = mb_convert_encoding($contact, 'UTF-8', 'UTF-8');
                            $response = Http::withHeaders([
                                'Content-Type' => 'application/json',
                                'x-api-key' => 'tb-c4f39110-f1fb-495f-8ef6-867829645239'
                            ])->post('https://toolbox-jxa3.onrender.com/api/sms/send', [
                                'recipient' => $contact,
                                'message' => "Votre abonnement est sur le point d'expirer.\n N'oubliez pas de renouveler votre abonnement avant le $---, pour eviter toute interruption"
                            ]);

                            // Pour obtenir le corps de la réponse sous forme de chaîne
                            $body = $response->body();
                            dump(  $body, $contact, $response);
                        })
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