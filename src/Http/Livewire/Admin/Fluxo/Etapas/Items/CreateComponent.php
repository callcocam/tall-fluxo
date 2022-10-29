<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/

namespace Tall\Fluxo\Http\Livewire\Admin\Fluxo\Etapas\Items;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Tall\Http\Livewire\FormComponent;
use Tall\Fluxo\Models\FluxoEtapa;
use Tall\Fluxo\Models\FluxoField;

class CreateComponent extends FormComponent
{
    use AuthorizesRequests;

    public $title = "Cadastrar";
    public $selectedStep;

    public function mount(FluxoEtapa $model)
    {
        $this->setFormProperties($model);
        data_set($this->data,'fluxo_etapa_items.name', '');
        data_set($this->data,'fluxo_etapa_items.evento', 'defer');
        data_set($this->data,'fluxo_etapa_items.type', 'text');
        data_set($this->data,'fluxo_etapa_items.width', '12');
        data_set($this->data,'fluxo_etapa_items.visible', '1');
        data_set($this->data,'fluxo_etapa_items.user_id', auth()->id());
        data_set($this->data,'fluxo_etapa_items.status', 'published');
        data_set($this->data,'fluxo_etapa_items.created_at', now()->format("Y-m-d"));
        data_set($this->data,'fluxo_etapa_items.updated_at', now()->format("Y-m-d"));
    }

    protected function save(){
        try {
            $model = $this->model->fluxo_etapa_items()->create(data_get($this->data, 'fluxo_etapa_items'));
            if ($model) {
                $this->success( __('sucesso'), __("Cadastro atualizado com sucesso!!"));
                $this->setFormProperties($this->model);
                $this->emit('refreshCreate', $model);
                $this->reset(['data']);
                data_set($this->data,'fluxo_etapa_items.name', '');
                data_set($this->data,'fluxo_etapa_items.evento', 'defer');
                data_set($this->data,'fluxo_etapa_items.type', 'text');
                data_set($this->data,'fluxo_etapa_items.width', '12');
                data_set($this->data,'fluxo_etapa_items.visible', '1');
                data_set($this->data,'fluxo_etapa_items.user_id', auth()->id());
                data_set($this->data,'fluxo_etapa_items.status', 'published');
                data_set($this->data,'fluxo_etapa_items.created_at', now()->format("Y-m-d"));
                data_set($this->data,'fluxo_etapa_items.updated_at', now()->format("Y-m-d"));
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

    public function getFluxoFieldsProperty()
    {
        return  FluxoField::query()->where('status','published')->pluck('name','id')->toArray();
    }

    public function view()
    {
        return 'tall::admin.fluxos.etapas.items.create';
    }
}
