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

    public function mount($path, FluxoEtapaProduto $model)
    {
        $this->authorize(Route::currentRouteName());
        $this->path = $path;
        $this->setFormProperties($model, FluxoEtapa::query()->where('path', $path)->first());
    }

    public function redirectList()
    {
        $this->confirm--;

        if($this->confirm){

            return;
        }
        return $this->kill(sprintf('admin.%s.processo.%s', data_get($this->config, 'fluxo.route', 'fluxos'),$this->config->route));
    }

    public function getListProperty()
    {
        return sprintf('admin.%s.processo.%s', data_get($this->config, 'fluxo.route', 'fluxos'),$this->config->route);
    }

    public function cancel()
    {
        return redirect()->route(sprintf('admin.%s.processo.%s', data_get($this->config, 'fluxo.route', 'fluxos'),$this->config->route));
    }

    public function view()
    {
        return 'tall::admin.fluxos.processo.delete';
    }
}
