<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/

namespace Tall\Fluxo\Http\Livewire\Admin\Fluxo\Processo;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Tall\Http\Livewire\FormComponent;
use Tall\Fluxo\Models\FluxoEtapa;
use Tall\Fluxo\Models\FluxoEtapaProduto;

class CreateComponent extends FormComponent
{
    use AuthorizesRequests;

    public $title = "Cadastrar";
    public $path;

    public function mount($path, FluxoEtapaProduto $model)
    {
        $this->authorize(Route::currentRouteName());
        $this->path = $path;

        $this->setFormProperties($model, FluxoEtapa::query()->where('path', $path)->first());
       
    }


    public function rules()
    {
        return [
            'name'=>'required'
        ];
    }

    
    public function getListProperty()
    {
        return sprintf('admin.%s.processo.%s', data_get($this->config, 'fluxo.route', 'fluxos'),$this->config->route);
    }

    public function getCreateProperty()
    {
        return sprintf('admin.%s.processo.%s.create', data_get($this->config, 'fluxo.route', 'fluxos'),$this->config->route);
    }

    public function getShowProperty()
    {
       return sprintf('admin.%s.processo.%s.view', data_get($this->config, 'fluxo.route', 'fluxos'),$this->config->route);
    }
    public function getEditProperty()
    {
       return sprintf('admin.%s.processo.%s.edit', data_get($this->config, 'fluxo.route', 'fluxos'),$this->config->route);
    }
    
    public function getDeleteProperty()
    {
       return sprintf('admin.%s.processo.%s.delete', data_get($this->config, 'fluxo.route', 'fluxos'),$this->config->route);
    }

    public function getOrderProperty()
    {
       return  null;
    }

    public function getFluxoEtapaItemsProperty()
    {
       return  $this->config->fluxo_etapa_items;
    }
    public function view()
    {
        return sprintf('tall::admin.%s.processo.create', data_get($this->config, 'fluxo.route', 'fluxos'));
    }
}
