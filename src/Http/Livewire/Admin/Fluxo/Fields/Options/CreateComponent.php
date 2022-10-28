<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/

namespace Tall\Fluxo\Http\Livewire\Admin\Fluxo\Fields\Options;

use Tall\Http\Livewire\FormComponent;
use Tall\Fluxo\Models\FluxoField;

class CreateComponent extends FormComponent
{

    public $title = "Cadastrar";

    
    public function mount(FluxoField $model)
    {
        $this->setFormProperties($model);
        data_set($this->data,'fluxo_field_options.name', '');
        data_set($this->data,'fluxo_field_options.user_id', auth()->id());
        data_set($this->data,'fluxo_field_options.status', 'published');
        data_set($this->data,'fluxo_field_options.created_at', now()->format("Y-m-d"));
        data_set($this->data,'fluxo_field_options.updated_at', now()->format("Y-m-d"));
    }
    protected function save(){
  
        try {
            $model = $this->model->fluxo_field_options()->create(data_get($this->data, 'fluxo_field_options'));
            if ($this->model->exists) {
                $this->success( __('sucesso'), __("Cadastro atualizado com sucesso!!"));
                $this->emit('refreshCreate', $model);
                $this->reset(['data']);
                data_set($this->data,'fluxo_field_options.name', '');
                data_set($this->data,'fluxo_field_options.user_id', auth()->id());
                data_set($this->data,'fluxo_field_options.status', 'published');
                data_set($this->data,'fluxo_field_options.created_at', now()->format("Y-m-d"));
                data_set($this->data,'fluxo_field_options.updated_at', now()->format("Y-m-d"));
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
        return 'tall::admin.fluxos.fields.options.create';
    }
}
