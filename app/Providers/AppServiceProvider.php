<?php

namespace App\Providers;

use App\Adpaters\Implementation\MetsSms;
use App\Adpaters\Implementation\VictoryLinkSms;
use App\Adpaters\ISMSGateway;
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

        //laravel container
        //Ioc container

        //dependency manager

        $this->app->bind(ISMSGateway::class, VictoryLinkSms::class);

        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
