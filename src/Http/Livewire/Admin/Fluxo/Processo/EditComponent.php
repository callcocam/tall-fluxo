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

class EditComponent extends FormComponent
{
    use AuthorizesRequests;

    public $title = "Editar";
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
    protected function save(){ 
        try {
            foreach($this->data as $fluxo_field_id => $name){
                $data['name']=$name;
                $data['fluxo_field_id']=$fluxo_field_id;
                 if($model=  $this->model->fluxo_etapa_produto_items()
                 ->where('fluxo_field_id',$fluxo_field_id)
                 ->first()){
                    $model->update($data);
                }
                else{
                    $this->model->fluxo_etapa_produto_items()->create($data);
                }
            }
            $this->success( __('sucesso'), __("Cadastro atualizado com sucesso!!"));
            return true;
        } catch (\PDOException $PDOException) {
            $this->error('erro', __($PDOException->getMessage()));
            return false;
        }

    }
    public function rules()
    {
        return [ ];
    }
    
    public function getListProperty()
    {
        return sprintf('admin.%s.processo', data_get($this->etapa, 'fluxo.id', 'fluxos'));
    }

    public function getFluxoEtapaItemsProperty()
    {
       return  $this->etapa->fluxo_etapa_items;
    }
    public function view()
    {
        return sprintf('tall::admin.%s.processo.edit', data_get($this->etapa, 'fluxo.route', 'fluxos'));
    }
}
