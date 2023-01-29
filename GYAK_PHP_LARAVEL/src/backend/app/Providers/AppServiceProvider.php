<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Stancl\Tenancy\Middleware\InitializeTenancyByPath;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        Passport::ignoreMigrations();
        Passport::routes(null, [ 'middleware' => [ InitializeTenancyByPath::class ] ]);
    }

    public function boot()
    {
        Passport::loadKeysFrom(base_path(config('passport.key_path')));
    }
}
