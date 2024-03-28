<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Page;
use Jeffgreco13\FilamentBreezy\Pages\MyProfilePage ;

class ProfilePage extends MyProfilePage
{
    protected static ?string $navigationGroup = 'Profil';

    protected static ?string $navigationIcon = 'heroicon-o-user';
//
//    protected static string $view = 'filament.pages.my-profile-page';
}
