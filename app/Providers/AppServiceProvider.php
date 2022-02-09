<?php

namespace App\Providers;

use Google\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Client::class, function () {
            $client = new Client();

            $config = config('services.google');
            $client->setClientId($config['id']);
            $client->setClientSecret($config['secret']);
            $client->setRedirectUri($config['redirect_url']);

            return $client;
        });
    }

    public function boot()
    {
    }
}
