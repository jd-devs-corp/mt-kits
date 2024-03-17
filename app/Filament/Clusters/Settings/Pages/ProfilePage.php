<?php

namespace App\Filament\Clusters\Settings\Pages;

use App\Filament\Clusters\Settings;
use Filament\Pages\Page;
use Jeffgreco13\FilamentBreezy\Pages\MyProfilePage;

class ProfilePage extends MyProfilePage
{
    protected static ?string $navigationIcon = 'heroicon-o-user';

//    protected static string $view = 'filament.clusters.settings.pages.profile-page';
//
//    protected static ?string $cluster = Settings::class;
}
