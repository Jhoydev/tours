<?php

namespace App\Providers;

use Carbon\Carbon;
use DebugBar\DebugBar;
use Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Validator;

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
        Validator::extendImplicit('current_password', function($attribute, $value, $parameters, $validator){
            return Hash::check($value, auth()->user()->password);
        },'Grave error');

        view()->composer('layouts.form.roles', function ($view){
            $view->with('roles', \App\User::getRoles())->with('permissions',\App\User::getPermissions());
        });
        view()->composer('viewComposers.input_country', function ($view){
            $view->with('country', \App\Country::where('id',47)->pluck('name','id'));
        });
        view()->composer('viewComposers.input_document_type', function ($view){
            $view->with('document_type', \App\DocumentType::all()->pluck('name','id'));
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
