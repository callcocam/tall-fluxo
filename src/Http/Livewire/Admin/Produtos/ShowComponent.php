<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/

namespace Tall\Fluxo\Http\Livewire\Admin\Produtos;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Tall\Http\Livewire\FormComponent;
use Tall\Fluxo\Models\FluxoEtapaProduto;

class ShowComponent extends FormComponent
{
    use AuthorizesRequests;

    public $title = "Visualizar";

    public $selected=[];
    public $selectedEtapa=[];

    public function mount(FluxoEtapaProduto $model)
    {
        $this->authorize(Route::currentRouteName());
        $this->setFormProperties($model);
    }

    public function route(){
        Route::get('/produtos/{model}/visualizar', static::class)->name('admin.produtos.view');
    }



    public function getListProperty()
    {
        return 'admin.produtos';
    }

    public function getEditProperty()
    {
      return 'admin.produtos.edit';
    }
    public function getDeleteProperty()
    {
     return 'admin.produtos.delete';
    }
    public function view()
    {
        return 'tall::admin.produtos.show';
    }
}
