<?php

namespace App\Providers;

use Laravel\Lumen\Routing\UrlGenerator;
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
        if($this->app->environment() !== 'local')
        {
            $this->app->singleton(UrlGenerator::class, function ($app) {
                $url = new UrlGenerator($app);
                return $url->forceSchema('https');
            });
        }
    }
}
