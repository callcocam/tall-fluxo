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
    \Tall\Fluxo\Http\Livewire\Admin\Produtos\ListComponent::class,
    \Tall\Fluxo\Http\Livewire\Admin\Produtos\EditComponent::class,
    // \Tall\Fluxo\Http\Livewire\Admin\Produtos\CreateComponent::class,
    \Tall\Fluxo\Http\Livewire\Admin\Produtos\ShowComponent::class,
    \Tall\Fluxo\Http\Livewire\Admin\Produtos\DeleteComponent::class,
    // \Tall\Fluxo\Http\Livewire\Admin\Produtos\OrderComponent::class,
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
            Route::prefix($fluxo->slug)->group(function () use($fluxo) {
                    if($fluxo_etapas = $fluxo->fluxo_etapas){
                           foreach($fluxo_etapas as $fluxo_etapa){
                                    if(class_exists(sprintf("%s\ListComponent", $fluxo->component))){
                                        // dd(sprintf("admin.%s.processo.%s",$fluxo->id,$fluxo_etapa->id));
                                        Route::get("{etapa}",sprintf("%s\ListComponent", $fluxo->component))->name(sprintf("admin.%s.processo", $fluxo->id));
                                    }
                                    if(class_exists(sprintf("%s\CreateComponent", $fluxo->component))){
                                        Route::get('{etapa}/cadastrar',sprintf("%s\CreateComponent", $fluxo->component))->name(sprintf("admin.%s.processo.create",$fluxo->id));
                                    }
                                    if(class_exists(sprintf("%s\EditComponent", $fluxo->component))){
                                        Route::get('{etapa}/{model}/editar',sprintf("%s\EditComponent", $fluxo->component))->name(sprintf("admin.%s.processo.edit",$fluxo->id));
                                    }
                                    if(class_exists(sprintf("%s\ShowComponent", $fluxo->component))){
                                        Route::get("{etapa}/{model}/visualizar",sprintf("%s\ShowComponent", $fluxo->component))->name(sprintf("admin.%s.processo.view",$fluxo->id));
                                    }
                                    if(class_exists(sprintf("%s\DeleteComponent", $fluxo->component))){
                                        Route::get("{etapa}/{model}/delete",sprintf("%s\DeleteComponent", $fluxo->component))->name(sprintf("admin.%s.processo.delete",$fluxo->id));
                                    }
                                }
                            }
                       });

           });
    }
}
