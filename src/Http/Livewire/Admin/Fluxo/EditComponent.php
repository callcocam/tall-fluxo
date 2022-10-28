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

class EditComponent extends FormComponent
{
    use AuthorizesRequests;

    public $title = "Editar";

    public function mount(Fluxo $model)
    {
        $this->authorize(Route::currentRouteName());
        $this->setFormProperties($model);
    }

    public function route(){
        Route::get('/fluxos/{model}/editar', static::class)->name('admin.fluxos.edit');
    }

    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }

    protected function fields(){
        return [
            'route'=> \Tall\View\Components\Form\Input::make('Rota de acesso', 'route')->order(2),
            'path'=> \Tall\View\Components\Form\Input::make('Url', 'path')->order(3),
            'component'=> \Tall\View\Components\Form\Input::make('Componente', 'component')->order(2),
        ];
    }
    public function getListProperty()
    {
        return 'admin.fluxos';
    }

    public function view()
    {
        return 'tall::admin.fluxos.edit';
    }
}
