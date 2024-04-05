<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use App\Http\Responses\CustomLogoutResponse;
use Filament\Http\Responses\Auth\LogoutResponse;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        // ...

        $this->app->bind(LogoutResponse::class, CustomLogoutResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(){
        view()->composer('filament.supplier.logo', function ($view) {
            $theme = \Cookie::get();

            $view->with('theme', $theme);
        });
        // DB::connection()->getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
        Model::unguard();

        FilamentAsset::register([
            Js::make('jquery', 'https://code.jquery.com/jquery-3.6.0.min.js'),
            Js::make('custom-script', __DIR__ . '/../../resources/js/custom.js'),
        ]);
    }
}
