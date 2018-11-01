<?php

namespace App\Providers;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

class ElasticsearchServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Client::class, function() {


            $hosts = [
                'https://elastic:43YSKv29RNRURDa6XqR3H90n@ba1e2a5961a84002bde6223cdd16d822.sa-east-1.aws.found.io:9243'
            
            ];

            return ClientBuilder::create()->setHosts($hosts)->build();
        });
    }
}
