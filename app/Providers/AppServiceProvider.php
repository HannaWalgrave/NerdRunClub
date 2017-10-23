<?php

namespace App\Providers;

use App;
use App\NerdRunClub\Strava;
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
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Strava::class, function(){
            return new Strava(config('services.strava.key'), config('services.strava.secret'));
        });
    }
}
