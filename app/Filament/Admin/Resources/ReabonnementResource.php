<?php

namespace App\Filament\Admin\Resources;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Filament\Admin\Resources\ReabonnementResource\Pages;
use App\Models\Kit;
use App\Models\Reabonnement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class ReabonnementResource extends Resource
{
    protected static ?string $model = Reabonnement::class;
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationGroup = 'Services';
    protected static ?string $navigationLabel = 'Abonnements';

    protected static ?string $navigationIcon = 'heroicon-o-book-open';


    public static function form(Form $form): Form
    {
        $user = Auth::user();
        return $form
            ->schema([
                Forms\Components\Select::make('kit_id')
                    ->required()
                    ->options(Kit::cursor()->pluck('unpay_kit.kit_number', 'id'))
                    ->prefix('KIT')
                    ->searchable()
                    ->validationMessages([
                        'required' => 'Ce champ est requis'
                    ])
                    ->label('Numero de kit')
                    ->preload(),

                Forms\Components\DateTimePicker::make('date_abonnement')
                    ->required()
                    ->validationMessages([
                        'required' => 'Ce champ est requis'
                    ])
                    ->default(now())
                ,
                Forms\Components\DateTimePicker::make('date_fin_abonnement')
                    ->required()
                    ->validationMessages([
                        'required' => 'Ce champ est requis'
                    ])
                    ->default(now()->addMonth()),
                Forms\Components\TextInput::make('plan_tarifaire')
                    ->required()
                    ->suffix('FCFA')
                    ->numeric()
                    ->validationMessages([
                        'required' => 'Ce champ est requis'
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kit.unpay_kit.kit_number')
                    ->label('Numero de kit')
                    ->prefix('KIT')
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_abonnement')
                    ->date()
                    ->label('Date de debut')
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_fin_abonnement')
                    ->date()
                    ->label('Date de fin')
                    ->sortable(),
                Tables\Columns\TextColumn::make('plan_tarifaire')
                    ->numeric()
                    ->money('XAF')
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->icon('heroicon-o-eye'),
                    Tables\Actions\Action::make('generate_receipt')
                        ->label('Telecharger le reçu')
                        ->icon('heroicon-o-receipt-refund')
                        ->openUrlInNewTab()
                        // ->label('Waoh')
                        ->action(function (Reabonnement $record, array $data) {
                            return redirect(url('admin/receipt/generate', $record->id));
                        })
                ])
            ])
            ->bulkActions([
                FilamentExportBulkAction::make('export'),
            ]);
    }

    protected function getTableHeaderActions(): array
    {
        return [
            // ExportHeaderAction::make('Export'),
        ];
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
            // 'create' => Pages\CreateReabonnement::route('/create'),
            'view' => Pages\ViewReabonnement::route('/{record}'),
            'edit' => Pages\EditReabonnement::route('/{record}/edit'),
        ];
    }
}
