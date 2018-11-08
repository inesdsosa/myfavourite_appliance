<?php

namespace myFavouriteAppliance\Providers;

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
        $this->app->bind(
            'myFavouriteAppliance\Source\SourceInterface',
            'myFavouriteAppliance\Source\SourceWebScrapting'
        );
    }
}
