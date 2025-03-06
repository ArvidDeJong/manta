<?php

namespace Darvis\Manta;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Darvis\Manta\Http\Middleware\GetRouteSeo;
use Livewire\Livewire;
use Darvis\Manta\Livewire\Staff\StaffLogin;
use Darvis\Manta\Livewire\Staff\StaffPasswordForgot;
use Darvis\Manta\Livewire\Staff\StaffPasswordReset;
use Darvis\Manta\Livewire\Staff\StaffCreate;
use Darvis\Manta\Livewire\Staff\StaffList;
use Darvis\Manta\Livewire\Staff\StaffRead;
use Darvis\Manta\Livewire\Staff\StaffUpdate;
use Darvis\Manta\Livewire\Staff\Config\StaffConfig_default;

class MantaServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('route.seo', GetRouteSeo::class);

        // Register Livewire Components
        Livewire::component('darvis.manta.livewire.staff.staff-login', StaffLogin::class);
        Livewire::component('darvis.manta.livewire.staff.staff-password-forgot', StaffPasswordForgot::class);
        Livewire::component('darvis.manta.livewire.staff.staff-password-reset', StaffPasswordReset::class);
        Livewire::component('darvis.manta.livewire.staff.staff-create', StaffCreate::class);
        Livewire::component('darvis.manta.livewire.staff.staff-list', StaffList::class);
        Livewire::component('darvis.manta.livewire.staff.staff-read', StaffRead::class);
        Livewire::component('darvis.manta.livewire.staff.staff-update', StaffUpdate::class);
        Livewire::component('darvis.manta.livewire.staff.config.staff-config-default', StaffConfig_default::class);

        $this->loadViewsFrom(__DIR__ . '/resources/views', 'manta');

        $this->publishes([
            __DIR__ . '/resources/views' => resource_path('views/vendor/manta'),
            __DIR__ . '/config/manta.php' => config_path('manta.php'),
            __DIR__ . '/config/manta_cms.php' => config_path('manta_cms.php'),
        ], 'manta-resources');

        $this->publishes([
            __DIR__ . '/../public' => public_path('vendor/manta'),
        ], 'manta-assets');

        $this->loadMigrationsFrom(__DIR__ . '/migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
    }

    public function register()
    {

        $this->mergeConfigFrom(__DIR__ . '/config/manta.php', 'manta');
        $this->mergeConfigFrom(__DIR__ . '/config/manta_cms.php', 'manta_cms');

        require_once __DIR__ . '/Helpers/helper.php';
    }
}
