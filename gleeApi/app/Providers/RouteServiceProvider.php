<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            $this->mapModuleRoutes();
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }

    // Load All Module routes
    protected function mapModuleRoutes()
    {
        $path = base_path('modules/');
        $pattern = '*'; // All files
        $dirs = glob($path.$pattern);

        foreach ($dirs as $key => $fullpath) {
            list($baseDir, $moduleName) = explode($path, $fullpath);


            $routes_path = "$fullpath/api-routes.php";

            if(file_exists($routes_path))
//                Route::prefix('api')
                    Route::middleware('api')
                    ->namespace("Modules\\$moduleName\Controllers")
                    ->group($routes_path);
        }
    }

    // Load All Module routes
//    protected function mapModuleRoutess()
//    {
//        $path = base_path('modules/');
//        $pattern = '*'; // All files
//        $dirs = glob($path.$pattern);
//
//        foreach ($dirs as $key => $fullpath) {
//            list($baseDir, $moduleName) = explode($path, $fullpath);
//
//            $routes_path = $fullpath.'/Api/routes.php';
//
//            $versionDirs = glob($fullpath.'/Api/'.$pattern);
//
//            foreach ($versionDirs as $versionPath) {
//
//                $routePath = $versionPath.'/routes.php';
//
//                if(file_exists($routePath))
//                    Route::prefix('api')
//                        ->middleware('api')
//                        ->group($routePath);
//            }
//
//        }
//    }
}
