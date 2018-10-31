<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\Routing\Generator\UrlGenerator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        if(env('REDIRECT_HTTPS')){
            $url->formatSchema('https');
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if(env('REDIRECT_HTTPS')){
           $this->app['request']->server->set('HTTPS',true);
        }
    }
}
