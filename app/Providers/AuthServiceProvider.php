<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Client;
use App\Models\Kit;
use App\Policies\ClientPolicy;
use App\Policies\KitPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
        Kit::class => KitPolicy::class,
        Client::class => ClientPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
