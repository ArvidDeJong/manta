<?php

namespace Darvis\Manta;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Darvis\Manta\Http\Middleware\GetRouteSeo;
use Livewire\Livewire;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MantaServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('route.seo', GetRouteSeo::class);

        // Automatisch alle Livewire componenten registreren
        $this->registerLivewireComponents();
        
        // Registreer het PageListRow Volt component als Blade component
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'manta');
        $this->loadTranslationsFrom(__DIR__ . '/lang', 'manta');

        $this->publishes([
            __DIR__ . '/resources/views' => resource_path('views/vendor/manta'),
            __DIR__ . '/config/manta.php' => config_path('manta.php'),
            __DIR__ . '/config/manta_cms.php' => config_path('manta_cms.php'),
            __DIR__ . '/lang' => resource_path('lang/vendor/manta'),
        ], 'manta-resources');

        $this->publishes([
            __DIR__ . '/../public' => public_path('vendor/manta'),
        ], 'manta-assets');

        $this->loadMigrationsFrom(__DIR__ . '/migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
    }

    /**
     * Registreer alle Livewire componenten in de Livewire directory
     */
    protected function registerLivewireComponents()
    {
        $livewireDir = __DIR__ . '/Livewire';

        if (!File::isDirectory($livewireDir)) {
            return;
        }

        // Expliciete registratie voor PageListRow
        Livewire::component('manta::page.page-list-row', \Darvis\Manta\Livewire\Page\PageListRow::class);

        // Recursief alle PHP bestanden vinden in de Livewire directory
        $files = $this->findPhpFiles($livewireDir);

        foreach ($files as $file) {
            // Bepaal de namespace en klassenaam
            $relativePath = Str::after($file, $livewireDir . '/');
            $className = Str::replaceLast('.php', '', $relativePath);
            $className = str_replace('/', '\\', $className);

            // Volledige klassenaam met namespace
            $fullClassName = 'Darvis\\Manta\\Livewire\\' . $className;

            // Controleer of de klasse bestaat en een Livewire component is
            if (class_exists($fullClassName) && $fullClassName !== \Darvis\Manta\Livewire\Page\PageListRow::class) {
                // Bepaal de component alias
                $alias = Str::kebab(Str::afterLast($className, '\\'));
                $namespace = Str::kebab(Str::beforeLast($className, '\\'));
                $componentName = 'manta::' . strtolower(str_replace('\\', '.', $namespace)) . '.' . $alias;

                // Registreer het component
                Livewire::component($componentName, $fullClassName);
            }
        }
    }

    /**
     * Vind recursief alle PHP bestanden in een directory
     *
     * @param string $directory
     * @return array
     */
    protected function findPhpFiles($directory)
    {
        $files = [];

        foreach (File::allFiles($directory) as $file) {
            if ($file->getExtension() === 'php') {
                $files[] = $file->getPathname();
            }
        }

        return $files;
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/manta.php', 'manta');
        $this->mergeConfigFrom(__DIR__ . '/config/manta_cms.php', 'manta_cms');

        require_once __DIR__ . '/Helpers/helper.php';
    }
}
