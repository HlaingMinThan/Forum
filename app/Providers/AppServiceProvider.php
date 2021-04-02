<?php

namespace App\Providers;

use App\Models\Channel;
use Illuminate\Support\Facades\View;
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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //      first way
        // View::composer(["layouts.navigation","threads.create"],function($view){
        //    $view->with('channels',Channel::all());
        // });

        //      second way
        View::share('channels', Channel::all());// that is a little trick // shared to every single view
    }
}
