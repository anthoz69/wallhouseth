<?php

namespace App\Providers;

use App\Services\KsherPay;
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
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(KsherPay::class, function ($app) {
            // Return an instance of YourService with the required parameter
            return new KsherPay(
                appid: config('app.ksher_appid'),
                privatekey: config('app.ksher_private_key')
            );
        });
    }
}
