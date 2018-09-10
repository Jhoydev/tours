<?php

namespace App\Providers;

use Carbon\Carbon;
use DebugBar\DebugBar;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Carbon::setLocale(config('app.locale'));
        view()->composer('layouts.form.roles', function ($view){
            $view->with('roles', \App\User::getRoles())->with('permissions',\App\User::getPermissions());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
