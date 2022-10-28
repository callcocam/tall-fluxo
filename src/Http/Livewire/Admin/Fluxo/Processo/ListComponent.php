<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/
namespace Tall\Fluxo\Http\Livewire\Admin\Fluxo\Processo;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Tall\Fluxo\Models\FluxoEtapa;
use Tall\Fluxo\Models\FluxoEtapaProduto;
use Tall\Http\Livewire\TableComponent;
class ListComponent extends TableComponent
{
    use AuthorizesRequests;
   
    public $path;
    public $config;

    public function mount($path)
    {
        $this->authorize(Route::currentRouteName());
        $this->path = $path;
        $this->setFormProperties(FluxoEtapa::query()->where('path', $this->path)->first());
    }


      /**
     * @param null $config
     */
    public function setFormProperties($config = null)
    {
        if(!$config){
            abort(404);
        }
        $this->config = $config;
        // dd($this->config->toArray());
       
    }

    public function query()
    {
          $builder = FluxoEtapaProduto::query();
        // if($role = data_get($this->filters, 'role')){
        //     $builder->whereHas('roles', function ($builder) use ($role) {
        //         $builder->where('id', $role);
        //     });
        // }
        return $builder;
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
    public function view()
    {
        return sprintf('tall::admin.%s.processo.list', data_get($this->config, 'fluxo.route', 'fluxos'));
    }

}
