<?php

namespace App\Providers;

use App\Models\Popup;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        $popup = Popup::isEnable()->latest()->first();
        View::composer('user.*', function ($view) use ($popup) {
            $view->with('popup', $popup);
        });
    }
}
