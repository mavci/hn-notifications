<?php

namespace App\Providers;

use App\Services\HN;
use App\Services\Pushover;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('pushover', function () {
            return new Pushover();
        });

        $this->app->bind('hn', function () {
            return new HN();
        });
    }
}
