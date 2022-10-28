<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/

namespace Tall\Fluxo\Http\Livewire\Admin\Fluxo;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Tall\Http\Livewire\FormComponent;
use Tall\Fluxo\Models\Fluxo;

class CreateComponent extends FormComponent
{
    use AuthorizesRequests;

    public $title = "Cadastrar";

    public function mount(Fluxo $model)
    {
        $this->authorize(Route::currentRouteName());
        $this->setFormProperties($model);
        data_set($this->data,'name', '');
        data_set($this->data,'user_id', auth()->id());
        data_set($this->data,'status', 'draft');
        data_set($this->data,'created_at', now()->format("Y-m-d H:i:s"));
        data_set($this->data,'updated_at', now()->format("Y-m-d H:i:s"));
    }

    public function route(){
        Route::get('/fluxos/cadastrar', static::class)->name('admin.fluxos.create');
    }

    public function rules()
    {
        return [
            'name'=>'required'
        ];
    }

    public function getListProperty()
    {
        return 'admin.fluxos';
    }
    public function getDeleteProperty()
    {
       return 'admin.fluxos.delete';
    }

    public function getEditProperty()
    {
       return 'admin.posts.edit';
    }

    public function getCreateProperty()
    {
       return 'admin.fluxos.create';
    }
    public function view()
    {
        return 'tall::admin.fluxos.create';
    }
}
