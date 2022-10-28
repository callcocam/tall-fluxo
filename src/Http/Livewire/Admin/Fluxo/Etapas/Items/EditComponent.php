<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/

namespace Tall\Fluxo\Http\Livewire\Admin\Fluxo\Etapas\Items;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Tall\Http\Livewire\FormComponent;
use Tall\Fluxo\Models\FluxoEtapaItem;
use Tall\Fluxo\Models\FluxoField;

class EditComponent extends FormComponent
{
    use AuthorizesRequests;

    public $title = "Editar";

    public function mount(FluxoEtapaItem $model)
    {
        $this->setFormProperties($model);
    }


    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }

    public function getListProperty()
    {
        return 'admin.fluxos';
    }

    public function getFluxoFieldsProperty()
    {
        return  FluxoField::query()->where('status','published')->pluck('name','id')->toArray();
    }

    public function view()
    {
        return 'tall::admin.fluxos.etapas.items.edit';
    }
}
