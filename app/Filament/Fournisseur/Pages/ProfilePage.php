<?php

namespace App\Filament\Fournisseur\Pages;

//use App\Filament\Fournisseur;
use Filament\Pages\Page;
use Jeffgreco13\FilamentBreezy\Pages\MyProfilePage;

class ProfilePage extends MyProfilePage
{
    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?int $navigationSort = 4;

//    protected static string $view = 'filament.clusters.settings.pages.profile-page';
//
//    protected static ?string $cluster = Settings::class;
}
