<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/

namespace Tall\Fluxo\Http\Livewire\Admin\Fluxo\Fields\Validations;

use Tall\Fluxo\Models\FluxoField;
use Tall\Http\Livewire\FormComponent;

class EditComponent extends FormComponent
{

    public $title = "Editar";
    public $option;
    public $validateName;
    public $modelValidation;

    public function mount(FluxoField $model)
    {
        $this->setFormProperties($model);
        $this->modelValidation = $this->model->fluxo_field_validations()
        ->whereName($this->validateName)->first();
        data_set($this->data, 'fluxo_field_validations.name', $this->validateName);
    }

    public function removeValidation()
    {
        try {
            if ($this->modelValidation->forceDelete()) {               
                $this->modelValidation = $this->model->fluxo_field_validations()
                ->whereName($this->validateName)->first();
                $this->success( __('sucesso'), __("Cadastro excluido com sucesso!!"));
                return true;
            }
            return false;
        } catch (\PDOException $PDOException) {
            $this->error('erro', __($PDOException->getMessage()));
            return false;
        }
      
    }

    
    public function addValidation(){
  
        try {
            $this->modelValidation = $this->model->fluxo_field_validations()->create(data_get($this->data, 'fluxo_field_validations'));
            if ($this->modelValidation->exists) {
                $this->success( __('sucesso'), __("Cadastro atualizado com sucesso!!"));
                return true;
            }
            return false;
        } catch (\PDOException $PDOException) {
            $this->error('erro', __($PDOException->getMessage()));
            return false;
        }
    }

    
    public function editValidation(){
        try {
            if ($this->modelValidation->update(data_get($this->data, 'fluxo_field_validations'))) {
                $this->success( __('sucesso'), __("Cadastro atualizado com sucesso!!"));
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
            'validateName' => 'required',
        ];
    }

    public function view()
    {
        return 'tall::admin.fluxos.fields.validations.edit';
    }
}
