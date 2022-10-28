<?php

use Illuminate\Support\Facades\Route;
use Tall\Fluxo\Models\Fluxo;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('/',\Tall\Http\Livewire\Pagina\DashboardComponent::class)->name('admin');    

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->prefix('admin')->group(function () {
//     Route::get('/',\Tall\Http\Livewire\Admin\DashboardComponent::class)->name('admin');    
// });
$components = [
    \Tall\Fluxo\Http\Livewire\Admin\Fluxo\ListComponent::class,
    \Tall\Fluxo\Http\Livewire\Admin\Fluxo\EditComponent::class,
    \Tall\Fluxo\Http\Livewire\Admin\Fluxo\CreateComponent::class,
    \Tall\Fluxo\Http\Livewire\Admin\Fluxo\ShowComponent::class,
    \Tall\Fluxo\Http\Livewire\Admin\Fluxo\DeleteComponent::class,
    \Tall\Fluxo\Http\Livewire\Admin\Fluxo\OrderComponent::class,
    \Tall\Fluxo\Http\Livewire\Admin\Fluxo\Fields\ListComponent::class,
    \Tall\Fluxo\Http\Livewire\Admin\Fluxo\Fields\EditComponent::class,
    \Tall\Fluxo\Http\Livewire\Admin\Fluxo\Fields\CreateComponent::class,
    \Tall\Fluxo\Http\Livewire\Admin\Fluxo\Fields\ShowComponent::class,
    \Tall\Fluxo\Http\Livewire\Admin\Fluxo\Fields\DeleteComponent::class,
    \Tall\Fluxo\Http\Livewire\Admin\Fluxo\Fields\OrderComponent::class,
];
foreach($components as $component){
    $comp =  app($component);
    $comp ->route();
}


$fluxos = Fluxo::query()->where('status', 'published')
->whereNotNull('route')->get();

if($fluxos){   
    foreach($fluxos as $fluxo){
        Route::prefix($fluxo->path)->group(function() use($fluxo) {           
            if($fluxo_etapas = $fluxo->fluxo_etapas){
                foreach($fluxo_etapas as $fluxo_etapa){
                        if(class_exists(sprintf("%s\ListComponent", $fluxo->component))){
                            Route::get(sprintf("%s/{path}",$fluxo_etapa->route ),sprintf("%s\ListComponent", $fluxo->component))->name(sprintf("admin.%s.processo.%s", $fluxo->route,$fluxo_etapa->route)); 
                        }
                        if(class_exists(sprintf("%s\CreateComponent", $fluxo->component))){
                            Route::get(sprintf("%s/{path}/cadastrar",$fluxo_etapa->route ),sprintf("%s\CreateComponent", $fluxo->component))->name(sprintf("admin.%s.processo.%s.create", $fluxo->route,$fluxo_etapa->route));    
                        }
                        if(class_exists(sprintf("%s\EditComponent", $fluxo->component))){
                            Route::get(sprintf("%s/{path}/{model}/editar",$fluxo_etapa->route ),sprintf("%s\EditComponent", $fluxo->component))->name(sprintf("admin.%s.processo.%s.edit", $fluxo->route,$fluxo_etapa->route)); 
                        }
                        if(class_exists(sprintf("%s\ShowComponent", $fluxo->component))){
                            Route::get(sprintf("%s/{path}/vizualizr",$fluxo_etapa->route ),sprintf("%s\ShowComponent", $fluxo->component))->name(sprintf("admin.%s.processo.%s.view", $fluxo->route,$fluxo_etapa->route)); 
                        }
                       
                    }
                }
           }); 
    }
}