<?php

namespace Recca0120\Elfinder;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    protected $namespace = 'Recca0120\Elfinder\Http\Controllers';

    protected $prefix = 'elfinder';

    protected $router;

    public function boot(Router $router)
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'elfinder');
        $this->publishAssets();
        $this->bootRoutes($router);
    }

    public function register()
    {
        // require __DIR__.'/../php/elFinderConnector.class.php';
        // require __DIR__.'/../php/elFinder.class.php';
        // require __DIR__.'/../php/elFinderVolumeDriver.class.php';
        // require __DIR__.'/../php/elFinderVolumeLocalFileSystem.class.php';
        // require __DIR__.'/../php/elFinderVolumeMySQL.class.php';
        // require __DIR__.'/../php/elFinderVolumeFTP.class.php';
        // require __DIR__.'/../php/elFinderVolumeDropbox.class.php';

        if (! defined('ELFINDER_IMG_PARENT_URL')) {
            define('ELFINDER_IMG_PARENT_URL', asset('vendor/elfinder'));
        }
    }

    protected function bootRoutes($router)
    {
        if ($this->app->routesAreCached() === false) {
            $group = $router->group([
                'namespace' => $this->namespace,
                'as' => 'elfinder::',
                'prefix' => $this->prefix,
            ], function () {
                require __DIR__.'/Http/routes.php';
            });
        }
    }

    protected function publishAssets()
    {
        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/elfinder'),
        ], 'views');

        $this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/elfinder'),
        ], 'public');
    }
}
