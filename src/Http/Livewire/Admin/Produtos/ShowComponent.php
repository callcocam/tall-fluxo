<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/

namespace Tall\Fluxo\Http\Livewire\Admin\Produtos;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Tall\Fluxo\Core\Fields\Field;
use Tall\Http\Livewire\FormComponent;
use Tall\Fluxo\Models\FluxoEtapaProduto;

class ShowComponent extends FormComponent
{
    use AuthorizesRequests;

    public $title = "Visualizar";

    public $selected=[];
    public $selectedEtapa=[];

    public function mount(FluxoEtapaProduto $model)
    {
        $this->authorize(Route::currentRouteName());
        $this->setFormProperties($model);
        // dd($model->toArray());
    }

    public function route(){
        Route::get('/produtos/{model}/visualizar', static::class)->name('admin.fluxo.produtos.view');
    }

    public function getFluxoEtapaItemsProperty()
    {
        $result  = collect(config('tall-fluxo.fildes.before',[]));

        if($etapas = data_get($this->model,'fluxo.fluxo_etapas')){

            foreach($etapas as $etapa){
                if($fluxo_etapa_items = data_get($etapa,'fluxo_etapa_items_all')){

                    $result->push(...$fluxo_etapa_items->map(function($field){
                        return Field::make($field->id,
                            $field->name,
                            $field->slug,
                            $field->type,
                            $field->description,
                            $field->width,
                            $field->visible,
                            $field->evento,
                            $field->fluxo_field_id,
                            $field->status)
                            ->form_attributes($field->form_attributes($field))
                            ->form_options($field->form_options())
                            ->form_db_options($field->form_db_options())
                            ->fluxo_field($field->fluxo_field);
                    }));

                }
            }
        }

        return $result->unique('fluxo_field_id');
    }

    public function getListProperty()
    {
        return 'admin.fluxo.produtos';
    }

    public function getEditProperty()
    {
      return 'admin.fluxo.produtos.edit';
    }
    public function getDeleteProperty()
    {
     return 'admin.fluxo.produtos.delete';
    }
    public function view()
    {
        return 'tall::admin.produtos.show';
    }
}
