<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/

namespace Tall\Fluxo\Http\Livewire\Admin\Fluxo;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Tall\Http\Livewire\FormComponent;
use Tall\Fluxo\Models\Fluxo;

class ShowComponent extends FormComponent
{
    use AuthorizesRequests;

    public $title = "Visualizar";

    public function mount(Fluxo $model)
    {
        $this->authorize(Route::currentRouteName());
        $this->setFormProperties($model);
    }

    public function route(){
        Route::get('/fluxos/{model}/visualizar', static::class)->name('admin.fluxos.view');
    }

    public function getListProperty()
    {
        return 'admin.fluxos';
    }

    public function getEditProperty()
    {
      return 'admin.fluxos.edit';
    }
    public function getDeleteProperty()
    {
     return 'admin.fluxos.delete';
    }
    public function view()
    {
        return 'tall::admin.fluxos.show';
    }
}