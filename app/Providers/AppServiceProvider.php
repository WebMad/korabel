<?php

namespace App\Providers;

use App\Http\Controllers\SiteInfoController;
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
        view()->composer('main', function($view)
        {
            $site_infos = SiteInfoController::getInfo();
            $view->with('site_infos', $site_infos);
        });
    }
}
