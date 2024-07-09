<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Routing\UrlGenerator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(UrlGenerator $url): void
    {
        Gate::define('create_forms', function(User $user){
            return true;
        });
        Gate::define('admin', function(User $user){
            return true;
        });
        if (config('app.env') !== 'local') {
            $url->forceScheme('https');
        }
    }
}
