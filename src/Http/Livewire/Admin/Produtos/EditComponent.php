<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/

namespace Tall\Fluxo\Http\Livewire\Admin\Produtos;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Tall\Fluxo\Core\Fields\Field;
use Tall\Http\Livewire\FormComponent;
use Tall\Fluxo\Models\FluxoEtapaProduto;

class EditComponent extends FormComponent
{
    use AuthorizesRequests;

    public $title = "Editar";
    public $products=[];

    public function mount(FluxoEtapaProduto $model)
    {
        $this->authorize(Route::currentRouteName());
        $this->setFormProperties($model);
        if ($model) {
            $this->data = data_get($model, 'produtos');
            $products = config('tall-fluxo.fildes.before',[]);
            if($products){

                foreach($products as $product){
                   
                    $this->products[] = $product->name;
                    
                    data_set($this->data, $product->name, data_get($model, $product->name));

                }
            }
        }
        // dd($model->toArray());
    }

    public function route(){
        Route::get('/produtos/{model}/editar', static::class)->name('admin.fluxo.produtos.edit');
    }

    public function rules()
    {
        return [
//            'name' => 'required',
        ];
    }

    public function getFluxoEtapaItemsProperty()
    {
        $result  = collect(config('tall-fluxo.fildes.before',[]));

         if($etapas = data_get($this->model,'fluxo.fluxo_etapas')){

         foreach($etapas as $etapa){
                if($fluxo_etapa_items = data_get($etapa,'fluxo_etapa_items_all')){

                    $result->push(...$this->cacheQuery($fluxo_etapa_items,$this->model->id ));

                }
            }
         }

       return $result->unique('fluxo_field_id');
    }


//
//    public function getFluxoEtapaItemsProperty()
//    {
//        $fluxo_fields  = collect(config('tall-fluxo.fildes.before',[]));
//
//        if($fluxo_etapa_items = data_get($this->etapa, 'fluxo_etapa_items')){
//
//            $fluxo_fields->push(...$this->cacheQuery($fluxo_etapa_items,$this->model->id ));
//        }
//        return $fluxo_fields;
//    }


    public function getListProperty()
    {
        return 'admin.fluxo.produtos';
    }

    public function view()
    {
        return 'tall::admin.produtos.edit';
    }

    protected function cacheQuery($items, $key, $timeout = 60) {
        return Cache::remember($key, $timeout, function() use($items) {
            return $items->map(function($field){
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
                    ->fluxo_field_validation(data_get($field,'fluxo_field.fluxo_field_validation'))
                    ->form_attributes($field->form_attributes($field))
                    ->form_options($field->form_options())
                    ->form_db_options($field->form_db_options())
                    ->fluxo_field($field->fluxo_field);
            });
        });
    }
}
