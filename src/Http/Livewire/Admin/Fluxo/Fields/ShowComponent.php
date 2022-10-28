<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/

namespace Tall\Fluxo\Http\Livewire\Admin\Fluxo\Fields;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Tall\Http\Livewire\FormComponent;
use Tall\Fluxo\Models\FluxoField;

class ShowComponent extends FormComponent
{
    use AuthorizesRequests;

    public $title = "Visualizar";

    public function mount(FluxoField $model)
    {
        $this->authorize(Route::currentRouteName());
        $this->setFormProperties($model);
    }

    public function route(){
        Route::get('/fluxos/campos/{model}/visualizar', static::class)->name('admin.fluxos.fields.view');
    }

    public function getListProperty()
    {
        return 'admin.fluxos.fields';
    }

    public function getEditProperty()
    {
      return 'admin.fluxos.fields.edit';
    }
    public function getDeleteProperty()
    {
     return 'admin.fluxos.fields.delete';
    }
    public function view()
    {
        return 'tall::admin.fluxos.fields.show';
    }
}