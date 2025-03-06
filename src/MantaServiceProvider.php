<?php

namespace Darvis\Manta;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Darvis\Manta\Http\Middleware\GetRouteSeo;

class MantaServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('route.seo', GetRouteSeo::class);

        $this->loadViewsFrom(__DIR__.'/Views', 'manta');

        $this->publishes([
            __DIR__.'/Views' => resource_path('views/vendor/manta'),
            __DIR__.'/config/manta.php' => config_path('manta.php'),
        ], 'manta-resources');

        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/manta'),
        ], 'manta-assets');

        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/manta.php', 'manta');

        require_once __DIR__.'/Helpers/helper.php';
    }
}