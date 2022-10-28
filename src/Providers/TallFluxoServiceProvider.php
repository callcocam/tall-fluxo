<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Fluxo\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Str;

use Symfony\Component\Finder\Finder;

class TallFluxoServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    { 
        include_once __DIR__ . '/../../helpers.php';
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/tall-fluxo.php','tall-fluxo'
        );
        // if ($this->app->runningInConsole()) {
          
        // }
    
        $this->publishMigrations();
        $this->loadMigrations();
        $this->publishViews();
        
        $this->configureDynamicComponent(dirname(__DIR__,2));

        
        if (class_exists(Livewire::class)) {
            //ADMIN FLUXO
            Livewire::component( 'tall::admin.fluxo.list-component', \Tall\Fluxo\Http\Livewire\Admin\Fluxo\ListComponent::class);
            Livewire::component( 'tall::admin.fluxo.edit-component', \Tall\Fluxo\Http\Livewire\Admin\Fluxo\EditComponent::class);
            Livewire::component( 'tall::admin.fluxo.create-component', \Tall\Fluxo\Http\Livewire\Admin\Fluxo\CreateComponent::class);
            Livewire::component( 'tall::admin.fluxo.show-component', \Tall\Fluxo\Http\Livewire\Admin\Fluxo\ShowComponent::class);
            Livewire::component( 'tall::admin.fluxo.delete-component', \Tall\Fluxo\Http\Livewire\Admin\Fluxo\DeleteComponent::class);
            Livewire::component( 'tall::admin.fluxo.order-component', \Tall\Fluxo\Http\Livewire\Admin\Fluxo\OrderComponent::class);
            
            Livewire::component( 'tall::admin.fluxo.fields.list-component', \Tall\Fluxo\Http\Livewire\Admin\Fluxo\Fields\ListComponent::class);
            Livewire::component( 'tall::admin.fluxo.fields.edit-component', \Tall\Fluxo\Http\Livewire\Admin\Fluxo\Fields\EditComponent::class);
            Livewire::component( 'tall::admin.fluxo.fields.create-component', \Tall\Fluxo\Http\Livewire\Admin\Fluxo\Fields\CreateComponent::class);
            Livewire::component( 'tall::admin.fluxo.fields.show-component', \Tall\Fluxo\Http\Livewire\Admin\Fluxo\Fields\ShowComponent::class);
            Livewire::component( 'tall::admin.fluxo.fields.delete-component', \Tall\Fluxo\Http\Livewire\Admin\Fluxo\Fields\DeleteComponent::class);
            Livewire::component( 'tall::admin.fluxo.fields.order-component', \Tall\Fluxo\Http\Livewire\Admin\Fluxo\Fields\OrderComponent::class);
            
            Livewire::component( 'tall::admin.fluxos.fields.attributes.edit-component', \Tall\Fluxo\Http\Livewire\Admin\Fluxo\Fields\Attributes\EditComponent::class);
            Livewire::component( 'tall::admin.fluxos.fields.attributes.create-component', \Tall\Fluxo\Http\Livewire\Admin\Fluxo\Fields\Attributes\CreateComponent::class);
            
            Livewire::component( 'tall::admin.fluxos.fields.options.edit-component', \Tall\Fluxo\Http\Livewire\Admin\Fluxo\Fields\Options\EditComponent::class);
            Livewire::component( 'tall::admin.fluxos.fields.options.create-component', \Tall\Fluxo\Http\Livewire\Admin\Fluxo\Fields\Options\CreateComponent::class);
            
            Livewire::component( 'tall::admin.fluxos.fields.db.edit-component', \Tall\Fluxo\Http\Livewire\Admin\Fluxo\Fields\Db\EditComponent::class);
            Livewire::component( 'tall::admin.fluxos.fields.db.create-component', \Tall\Fluxo\Http\Livewire\Admin\Fluxo\Fields\Db\CreateComponent::class);

            Livewire::component( 'tall::admin.fluxo.etapas.create-component', \Tall\Fluxo\Http\Livewire\Admin\Fluxo\Etapas\CreateComponent::class);
            Livewire::component( 'tall::admin.fluxo.etapas.edit-component', \Tall\Fluxo\Http\Livewire\Admin\Fluxo\Etapas\EditComponent::class);
            
            Livewire::component( 'tall::admin.fluxo.etapas.items.create-component', \Tall\Fluxo\Http\Livewire\Admin\Fluxo\Etapas\Items\CreateComponent::class);
            Livewire::component( 'tall::admin.fluxo.etapas.items.edit-component', \Tall\Fluxo\Http\Livewire\Admin\Fluxo\Etapas\Items\EditComponent::class);
                     
            $this->app->register(RouteServiceProvider::class);     
     
        }

    }
    /**
     * Configure the component for the application.
     *
     * @return void
     */
    public function configureDynamicComponent($path,$search=".blade.php")
    {
       foreach ((new Finder)->in(sprintf("%s/resources/views/components", $path))->files()->name('*.blade.php') as $component) {                   
            $componentPath = $component->getRealPath();     
            $namespace = Str::beforeLast($componentPath, $search);
            $namespace = Str::afterLast($namespace, 'components/');
            $name = Str::replace(DIRECTORY_SEPARATOR,'.',$namespace);
            if(!Str::contains($namespace, 'tall/')){
                $this->loadComponent($name, $name);
            }
        }
    }
    
    public function loadComponent($component, $alias=null){
        if ($alias == null){
            $alias=$component;
        }
        Blade::component("tall::components.{$component}",'tall-'.$alias);
    }

  
    
      /**
     * Publish the migration files.
     *
     * @return void
     */
    protected function publishMigrations()
    {
        $this->publishes([
            __DIR__.'/../../database/migrations/' => database_path('migrations'),
            __DIR__.'/../../database/factories/' => database_path('factories'),
            __DIR__.'/../../database/seeders/' => database_path('seeders'),
        ], 'tall-fluxo-migrations');
    }

    /**
     * Load our migration files.
     *
     * @return void
     */
    protected function loadMigrations()
    {
        if (config('tall-fluxo.migrate', true)) {
            $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        }
    }

    private function publishViews(): void
    {
        $pathViews = __DIR__ . '/../../resources/views';

        $this->loadViewsFrom($pathViews, 'tall');
        Blade::anonymousComponentNamespace(__DIR__ . '/../../resources/views/components', 'tall');
        if(is_dir(resource_path('views/vendor/tall-fluxo')))
        {
            $pathViews = resource_path('views/vendor/tall-fluxo');
            $this->loadViewsFrom($pathViews, 'tall');
            Blade::anonymousComponentNamespace(resource_path('views/vendor/tall/components'), 'tall');
        }

        $this->publishes([         
            __DIR__ . '/../../database/migrations/' => database_path('migrations'),
            __DIR__ . '/../../database/factories/' => database_path('factories'),
            __DIR__ . '/../../database/seeders/' => database_path('seeders'),
        ], 'tall-fluxo-migrations');

        
        $this->publishes([
            __DIR__ . '/../../resources/views' => resource_path('views/vendor/tall-fluxo'),
        ], 'tall-fluxo-views');

        $this->publishes([
            __DIR__ . '/../../config/tall-fluxo.php' => config_path('tall-fluxo.php'),
        ], 'tall-fluxo-config');
        

        $this->publishes([
            __DIR__ . '/../../database/migrations/' => database_path('migrations'),
            __DIR__ . '/../../database/factories/' => database_path('factories'),
            __DIR__ . '/../../database/seeders/' => database_path('seeders'),
            __DIR__ . '/../../resources/views' => resource_path('views/vendor/tall'),
            __DIR__ . '/../../config/tall-fluxo.php' => config_path('tall-fluxo.php'),
        ], 'tall-fluxo');

    }

}
