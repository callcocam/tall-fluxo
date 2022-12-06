<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Fluxo\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

class RouteServiceProvider extends ServiceProvider
{

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
       
        $this->routes(function () {
            
            Route::prefix('api')
                ->middleware(['api','auth:sanctum'])
                ->namespace($this->namespace)
                ->group(__DIR__.'/../../routes/api.php');

            if (Schema::hasTable('fluxos')) {
                Route::
                // prefix(config('tall.multitenancy.prefix','admin'))
                // ->middleware([
                middleware([
                    'web',
                    'auth:sanctum',
                    config('jetstream.auth_session'),
                    'verified'
                ])->namespace($this->namespace)
                    ->group(__DIR__.'/../../routes/web.php');
            }
         
        });
    }

}
