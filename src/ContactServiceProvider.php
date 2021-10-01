<?php

namespace Lakm\Contact;

use Illuminate\Support\ServiceProvider;
use Lakm\Contact\Commands\lakmInitContactUs;

class ContactServiceProvider extends ServiceProvider
{

    public function boot()
    {
//        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/views', 'contact');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/lakm/contact'),
        ], 'lakm/contact');
        $this->publishes([
            __DIR__.'/views' => resource_path('views/vendor/contact'),
        ], 'lakm/contact');
        $this->publishes([
            __DIR__.'/config/contactUs.php' => config_path('contactUs.php')
        ], 'lakm/contact');


        if ($this->app->runningInConsole()) {
            $this->commands([
                lakmInitContactUs::class
            ]);
        }
    }

    public function register()
    {
        $this->app->register(EventServiceProvider::class);

        $this->mergeConfigFrom(__DIR__.'/config/contactUs.php', 'contactUs');

    }
}