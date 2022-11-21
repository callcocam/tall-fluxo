<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/

namespace Tall\Fluxo\Http\Livewire\Admin\Fluxo\Processo;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Tall\Http\Livewire\AbstractDeleteComponent;
use Tall\Fluxo\Models\FluxoEtapa;
use Tall\Fluxo\Models\FluxoEtapaProduto;

class DeleteComponent extends AbstractDeleteComponent
{
    use AuthorizesRequests;

    public $title = "Excluir";
    public $etapa;

    public function mount(FluxoEtapa $etapa, FluxoEtapaProduto $model)
    {
        $this->authorize(Route::currentRouteName());
        $this->setFormProperties($model, $etapa);
    }

     /**
     * @param null $model
     */
    public function setFormProperties($model = null, $etapa=null)
    {
        $this->model = $model;
        $this->etapa = $etapa;
        if ($model) {
            $this->data = data_get($model, 'produtos');
        }
    }

    public function redirectList()
    {
        $this->confirm--;

        if($this->confirm){

            return;
        }
        return $this->kill(sprintf('admin.%s.processo', data_get($this->etapa, 'fluxo.id', 'fluxos')));
    }

    public function getListProperty()
    {
        return sprintf('admin.%s.processo', data_get($this->etapa, 'fluxo.id', 'fluxos'));
    }

    public function cancel()
    {
        return sprintf('admin.%s.processo', data_get($this->etapa, 'fluxo.id', 'fluxos'));
    }

    public function view()
    {
        return 'tall::admin.fluxos.processo.delete';
    }
}
