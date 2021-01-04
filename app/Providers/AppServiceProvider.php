<?php

namespace App\Providers;

use App\Youtube\YouTubeServices;
use Inertia\Inertia;
use Illuminate\Support\Facades\Session;
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
        Inertia::share('flash', function(){
            return [
                'success' => Session::get('success'),
            ];
        });

        $this->app->singleton('App\Youtube\YouTubeServices', function(){
            return new YouTubeServices(env('YOUTUBE_API_KEY'));
        });
    }

}
