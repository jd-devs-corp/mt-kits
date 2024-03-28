<?php

namespace App\Filament\Admin\Pages;

use Jeffgreco13\FilamentBreezy\Pages\MyProfilePage;

class ProfilePage extends MyProfilePage
{
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationLabel='Mon profil';

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
}
