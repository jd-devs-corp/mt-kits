<?php

namespace App\Providers\Filament;

use Awcodes\Overlook\OverlookPlugin;
use Awcodes\Overlook\Widgets\OverlookWidget;
use Filament\Forms\Components\FileUpload;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use Swis\Filament\Backgrounds\FilamentBackgroundsPlugin;
use Swis\Filament\Backgrounds\ImageProviders\MyImages;
use App\Filament\Clusters\Settings\Pages\ProfilePage;

class FournisseurPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('fournisseur')
            ->path('supplier')
            ->login()
//            ->profile(Pages\Auth\EditProfile::class)
//            ->registration()
            ->passwordReset()
            ->emailVerification()
            ->colors([
                'danger' => Color::Rose,
                'gray' => Color::Gray,
                'info' => Color::Blue,
                'primary' => Color::hex('#3b82f6'),
                'success' => Color::Stone,
                'warning' => Color::Orange,
            ])
            ->discoverResources(in: app_path('Filament/Fournisseur/Resources'), for: 'App\\Filament\\Fournisseur\\Resources')
            ->discoverPages(in: app_path('Filament/Fournisseur/Pages'), for: 'App\\Filament\\Fournisseur\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverClusters(in: app_path('Filament/Clusters'), for: 'App\\Filament\\Clusters')
            ->discoverWidgets(in: app_path('Filament/Fournisseur/Widgets'), for: 'App\\Filament\\Fournisseur\\Widgets')

            ->plugins([
                OverlookPlugin::make()
                    ->icons([
                        'heroicon-o-users' => \App\Filament\Resources\ClientResource::class,
                        'heroicon-o-wifi' => \App\Filament\Resources\KitResource::class,
                    ])
            ])
            ->widgets([
//                Widgets\AccountWidget::class,
//                 Widgets\FilamentInfoWidget::class,
//                OverlookWidget::class


            ])
            ->brandLogo(fn() => view('filament.supplier.logo'))
            ->brandName('Fournisseur')
            ->favicon(asset('images/logo_supplier.png'))
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ], isPersistent: true)
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([
                BreezyCore::make()
                    ->passwordUpdateRules(
                        rules: [Password::default()->mixedCase()->uncompromised(3)], // you may pass an array of validation rules as well. (default = ['min:8'])
                        requiresCurrentPassword: true // when false, the user can update their password without entering their current password. (default = true)
                    )
                    ->avatarUploadComponent(fn() => FileUpload::make('avatar_url')->disk('public'))
                    ->myProfile(
                        shouldRegisterUserMenu: true,
                        shouldRegisterNavigation: true,
                        hasAvatars: true,
                        slug: 'profil',
                        navigationGroup: 'Paramètres',
                    )
                    ->customMyProfilePage(ProfilePage::class),
                FilamentBackgroundsPlugin::make()
                    ->imageProvider(
                        MyImages::make()
                            ->directory('images/swisnl/filament-backgrounds/curated-by-swis')
                    )

            ])
            ->plugins([
                FilamentBackgroundsPlugin::make()
                    ->imageProvider(
                        MyImages::make()
                            ->directory('images/swisnl/filament-backgrounds/curated-by-swis')
                    )
            ]);
    }
}
