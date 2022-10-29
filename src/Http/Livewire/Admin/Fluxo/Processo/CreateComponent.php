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
       unset($this->data['produtos']);
    }
    protected function save(){
        try {
            $this->model = $this->model->create([
                'fluxo_id'=>data_get($this->config,'fluxo.id')
            ]);
            if ($this->model->exists) {
                foreach($this->data as $fluxo_field_id => $name){
                    $this->model->fluxo_etapa_produto_items()->create(
                        [
                            "fluxo_field_id"=>$fluxo_field_id,
                            "name"=>$name
                        ]
                    );
                }
                $this->success( __('sucesso'), __("Cadastro atualizado com sucesso!!"));
                $params=[];
                $params['path'] = $this->config->path;
                $params['model'] = $this->model;
                return redirect()->route(sprintf('admin.%s.processo.%s.edit', data_get($this->config, 'fluxo.route', 'fluxos'),$this->config->route),$params);
            }
            return false;
        } catch (\PDOException $PDOException) {
            $this->error('erro', __($PDOException->getMessage()));
            return false;
        }

    }
    public function rules()
    {
        return [];
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
