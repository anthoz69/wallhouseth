<?php

namespace App\Providers;

use App;
use App\Models\Popup;
use App\View\CartComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Cart;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (! App::runningInConsole()) {
            $popup = Popup::isEnable()->latest()->first();
            View::composer('layouts.header', CartComposer::class);
            View::composer([
                'user.*',
            ], function ($view) use ($popup) {
                $view->with('popup', $popup);
            });

            View::composer([
                'layouts.header',
                'layouts.footer',
            ], App\View\CategoryComposer::class);
        }
    }
}
