<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/

namespace Tall\Fluxo\Http\Livewire\Admin\Fluxo\Fields;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Tall\Http\Livewire\FormComponent;
use Tall\Fluxo\Models\FluxoField;

class CreateComponent extends FormComponent
{
    use AuthorizesRequests;

    public $title = "Cadastrar";

    public function mount(FluxoField $model)
    {
        $this->authorize(Route::currentRouteName());
        $this->setFormProperties($model);
        data_set($this->data,'name', '');
        data_set($this->data,'user_id', auth()->id());
        data_set($this->data,'status', 'draft');
        data_set($this->data,'created_at', now()->format("Y-m-d"));
        data_set($this->data,'updated_at', now()->format("Y-m-d"));
    }

    public function route(){
        Route::get('/fluxos/campos/cadastrar', static::class)->name('admin.fluxos.fields.create');
    }

    public function rules()
    {
        return [
            'name'=>'required'
        ];
    }

    public function getListProperty()
    {
        return 'admin.fluxos.fields';
    }
    public function getDeleteProperty()
    {
       return 'admin.fluxos.fields.delete';
    }

    public function getEditProperty()
    {
       return 'admin.posts.fields.edit';
    }

    public function getCreateProperty()
    {
       return 'admin.fluxos.fields.create';
    }
    public function view()
    {
        return 'tall::admin.fluxos.fields.create';
    }
}
