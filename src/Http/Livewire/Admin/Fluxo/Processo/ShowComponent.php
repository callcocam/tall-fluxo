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

class ShowComponent extends FormComponent
{
    use AuthorizesRequests;

    public $title = "Visualizar";
    public $path;

    public function mount($path, FluxoEtapaProduto $model)
    {
        $this->authorize(Route::currentRouteName());
        $this->path = $path;
        $this->setFormProperties($model, FluxoEtapa::query()->where('path', $path)->first());
    }
   
    public function getListProperty()
    {
        return sprintf('admin.%s.processo.%s', data_get($this->config, 'fluxo.route', 'fluxos'),$this->config->route);
    }

    public function getEditProperty()
    {
       return sprintf('admin.%s.processo.%s.edit', data_get($this->config, 'fluxo.route', 'fluxos'),$this->config->route);
    }
    
    public function getDeleteProperty()
    {
       return sprintf('admin.%s.processo.%s.delete', data_get($this->config, 'fluxo.route', 'fluxos'),$this->config->route);
    }

    public function view()
    {
        return sprintf('tall::admin.%s.processo.show', data_get($this->config, 'fluxo.route', 'fluxos'));
    }
}