<?php

namespace Aldif\LaravelKirimemail;

use Illuminate\Support\ServiceProvider;
use Aldif\LaravelKirimemail\Services\AuthModule;
use Aldif\LaravelKirimemail\Services\ListModule;


class LaravelKirimEmailProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {   
        // $this->app->bind('kirimemail', function () {

        //     return new ListModule();
        // });
        $this->app->bind('kirimemail', function () {

            return new AuthModule();
        });

        
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->publishes([
            __DIR__.'/config/kirimemail.php' =>  config_path('kirimemail.php'),
         ], 'config');
    }
}
