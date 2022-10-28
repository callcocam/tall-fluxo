<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/

namespace Tall\Fluxo\Http\Livewire\Admin\Fluxo\Etapas;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Tall\Http\Livewire\FormComponent;
use Tall\Fluxo\Models\Fluxo;
use Tall\Fluxo\Models\FluxoEtapa;

class CreateComponent extends FormComponent
{
    use AuthorizesRequests;

    public $title = "Cadastrar";
    public $selectedStep;

    public function mount(Fluxo $model)
    {
        $this->setFormProperties($model);
        data_set($this->data,'fluxo_etapas.name', '');
        data_set($this->data,'fluxo_etapas.user_id', auth()->id());
        data_set($this->data,'fluxo_etapas.status', 'published');
        data_set($this->data,'fluxo_etapas.created_at', now()->format("Y-m-d"));
        data_set($this->data,'fluxo_etapas.updated_at', now()->format("Y-m-d"));
    }

    protected function save(){
  
        try {
            $model = $this->model->fluxo_etapas()->create(data_get($this->data, 'fluxo_etapas'));
            if ($this->model->exists) {
                $this->success( __('sucesso'), __("Cadastro atualizado com sucesso!!"));
                $this->emit('refreshCreate', $model);
                $this->reset(['data']);
                data_set($this->data,'fluxo_etapas.name', '');
                data_set($this->data,'fluxo_etapas.user_id', auth()->id());
                data_set($this->data,'fluxo_etapas.status', 'published');
                data_set($this->data,'fluxo_etapas.created_at', now()->format("Y-m-d"));
                data_set($this->data,'fluxo_etapas.updated_at', now()->format("Y-m-d"));
                return true;
            }
            return false;
        } catch (\PDOException $PDOException) {
            $this->error('erro', __($PDOException->getMessage()));
            return false;
        }
    }
    public function rules()
    {
        return [
            'name'=>'required'
        ];
    }

    public function view()
    {
        return 'tall::admin.fluxos.etapas.create';
    }

    
    public function setGroupUpdatedOrder($data)
    {
        $orders = parent::setGroupUpdatedOrder($data);
        $orders = array_filter($orders);
        if($orders){
            foreach($orders as $order => $id){
                if($model=FluxoEtapa::find( $id)){
                    $model->ordering = $order;
                    $model->update();
                }
            }
            $this->emit('refreshOrder', $orders);
        }
        return $orders;
    }
}
