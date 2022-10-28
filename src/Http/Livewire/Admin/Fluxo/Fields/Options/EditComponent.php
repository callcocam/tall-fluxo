<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/

namespace Tall\Fluxo\Http\Livewire\Admin\Fluxo\Fields\Options;

use Tall\Http\Livewire\FormComponent;
use Tall\Fluxo\Models\FluxoFieldOption;

class EditComponent extends FormComponent
{

    public $title = "Editar";

    public function mount(FluxoFieldOption $model)
    {
        $this->setFormProperties($model);
    }

    public function delete()
    {

       $this->model->forceDelete();
       $this->showModal = false;
       $this->emit('refreshDelete', []);

    }

    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }

    public function view()
    {
        return 'tall::admin.fluxos.fields.options.edit';
    }
}
