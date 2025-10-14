<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->routes(function () {
            // 👇 Aquí definimos tus rutas API
            Route::prefix('api')
                ->middleware('api')
                ->group(base_path('routes/api.php'));

            // 👇 Y aquí las rutas web normales
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
