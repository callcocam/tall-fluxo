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
        return [
            'view'=> \Tall\View\Components\Form\Radio::make('Selecione uma vizualização', 'view')
            ->array(
                array_flip([
                    'text'=>'Text',
                    'textarea'=>'Textarea',
                    'radio'=>'Seleção unica',
                    'checkbox'=>'Seleção multipla',
                    'select'=>'Seleção suspensa',
                    'date'=>'Data',
                    'datetime-local'=>'Data e Hora',
                ])
            )->order(2)
        ];
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
