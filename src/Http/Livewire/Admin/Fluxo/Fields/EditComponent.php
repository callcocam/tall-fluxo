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

class EditComponent extends FormComponent
{
    use AuthorizesRequests;

    public $title = "Editar";
    public $currentRouteName;

    public function mount(FluxoField $model)
    {
        $this->authorize(Route::currentRouteName());
        $this->setFormProperties($model);
    }

    public function route(){
        Route::get('/fluxos/campos/{model}/editar', static::class)->name('admin.fluxos.fields.edit');
    }

    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }

    protected function fields(){
        $types = config('tall-fluxo.views.form',[]);
        $views = array_merge(config('tall-fluxo.views.db',[]), $types);
        return [
            'type'=> \Tall\View\Components\Form\Radio::make('Selecione um tipo', 'type')
            ->array(array_combine($types, $types))->order(2),
            'view'=> \Tall\View\Components\Form\Radio::make('Selecione uma vizualização', 'view')
            ->array(array_combine($views, $views))->order(2)
        ];
    }


    protected function save()
    {
            if(parent::save()){
                if (!in_array($this->model->view, ['select', 'radio', 'checkbox'])):
                    $this->model->fluxo_field_options()->forceDelete();
                    redirect()->route('admin.fluxos.fields.edit', ['model'=>$this->model]);
                endif;
                if (!in_array($this->model->view, ['db','db-select', 'db-radio', 'db-checkbox'])):
                    $this->model->fluxo_field_db()->forceDelete();
                    redirect()->route('admin.fluxos.fields.edit', ['model'=>$this->model]);
                endif;
            return true;
        }
       return false;
    }


    public function getListProperty()
    {
        return 'admin.fluxos.fields';
    }

    public function view()
    {
        return 'tall::admin.fluxos.fields.edit';
    }
}
