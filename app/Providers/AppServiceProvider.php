<?php

namespace App\Providers;

use App\Services\Crypt\CryptInterface;
use App\Services\Crypt\CryptService;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CryptInterface::class, function (Application $app) {
            // for future change encryption method as you want
            return new CryptService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
