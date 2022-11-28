<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/

namespace Tall\Fluxo\Http\Livewire\Admin\Fluxo\Fields\Validations;

use Tall\Http\Livewire\FormComponent;
use Tall\Fluxo\Models\FluxoField;

class CreateComponent extends FormComponent
{

    public $title = "Cadastrar";

    
    public function mount(FluxoField $model)
    {
        $this->setFormProperties($model);
    }

    public function view()
    {
        return 'tall::admin.fluxos.fields.validations.create';
    }

    public function getOptionsProperty()
    {
        return config('tall-fluxo.validations',[]);
    }
}
