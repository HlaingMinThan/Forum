<?php

namespace App\Providers;

use App\Models\Channel;
use App\Models\Thread;
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
        View::composer(['layouts.navigation', 'threads.create'], function ($view) {
            $view->with('channels', Channel::all());
        });
        View::composer(['components.threads.TrendingThreads', 'threads.index'], function ($view) {
            $view->with('trendingThreads', Thread::getTrendingThreads());
        });
    }
}
