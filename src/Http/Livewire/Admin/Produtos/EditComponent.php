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

class EditComponent extends FormComponent
{
    use AuthorizesRequests;

    public $title = "Editar";

    public function mount(FluxoEtapaProduto $model)
    {
        $this->authorize(Route::currentRouteName());
        $this->setFormProperties($model);
    }

    public function route(){
        Route::get('/produtos/{model}/editar', static::class)->name('admin.produtos.edit');
    }

    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }

    public function getFluxoEtapaItemsProperty()
    {
        $result  = collect(config('tall-fluxo.fildes.before',[]));

        if($fluxo_etapa_items = $this->etapa->fluxo_etapa_items){

            $result->push(...$fluxo_etapa_items->map(function($field){
                     return Field::make($field->id,
                     $field->name,
                     $field->slug,
                     $field->type,
                     $field->description,
                     $field->width,
                     $field->visible,
                     $field->evento,
                     $field->status,
                     $field->fluxo_field_id)
                     ->form_attributes($field->form_attributes($field))
                     ->form_options($field->form_options())
                     ->form_db_options($field->form_db_options())
                     ->fluxo_field($field->fluxo_field);
            }));
        }
       return $result;
    }
    
    public function getListProperty()
    {
        return 'admin.produtos';
    }

    public function view()
    {
        return 'tall::admin.produtos.edit';
    }
}
