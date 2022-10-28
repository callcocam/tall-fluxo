<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/

namespace Tall\Fluxo\Http\Livewire\Admin\Fluxo\Etapas;

use Tall\Http\Livewire\FormComponent;
use Tall\Fluxo\Models\FluxoEtapa;

class EditComponent extends FormComponent
{

    public $title = "Editar";

    public function mount(FluxoEtapa $model)
    {
        $this->setFormProperties($model);
    }


    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }

    public function view()
    {
        return 'tall::admin.fluxos.etapas.edit';
    }
}
