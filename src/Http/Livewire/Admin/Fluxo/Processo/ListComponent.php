<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/
namespace Tall\Fluxo\Http\Livewire\Admin\Fluxo\Processo;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Tall\Fluxo\Core\Fields\Field;
use Tall\Fluxo\Models\FluxoEtapa;
use Tall\Http\Livewire\TableComponent;
class ListComponent extends TableComponent
{
    use AuthorizesRequests;
   
    public $path;
    public $etapa;
    public $currentRouteName;

    public function mount(FluxoEtapa $etapa)
    {
        $this->authorize(Route::currentRouteName());

        $this->setFormProperties($etapa, Route::currentRouteName());
    }


      /**
     * @param null $etapa
     */
    public function setFormProperties($etapa = null, $currentRouteName =null)
    {
        if(!$etapa){
            abort(404);
        }
        $this->etapa = $etapa;
        $this->currentRouteName = $currentRouteName;
        //  dd($this->etapa->toArray());
       
    }

    public function query()
    {
          $builder = $this->etapa->produtos();
        // if($role = data_get($this->filters, 'role')){
        //     $builder->whereHas('roles', function ($builder) use ($role) {
        //         $builder->where('id', $role);
        //     });
        // }
        return $builder;
    }

    public function getListProperty()
    {
        return $this->currentRouteName;
    }

    public function getCreateProperty()
    {
        return sprintf('%s.create', $this->currentRouteName);
    }

    public function getEditProperty()
    {
        return sprintf('%s.edit',$this->currentRouteName);
    }

    public function getShowProperty()
    {
    //    return sprintf('%s.view',$this->currentRouteName);
    }

    public function getDeleteProperty()
    {
        return sprintf('%s.delete',$this->currentRouteName);
    }
    public function loadData(FluxoEtapa $etapa)
    {
        $this->etapa = $etapa;
    }

    public function getOrderProperty()
    {
       return  null;
    }

    public function getFluxoEtapaItemsProperty()
    {
        $result  = collect(config('tall-fluxo.fildes.before',[]));

        // if($fluxo_etapa_items = data_get($this->etapa, 'fluxo_etapa_items')){
        //     $result->push(...$fluxo_etapa_items->map(function($field){
        //              return Field::make($field->id,
        //              $field->name,
        //              $field->slug,
        //              $field->type,
        //              $field->description,
        //              $field->width,
        //              $field->visible,
        //              $field->evento,
        //              $field->fluxo_field_id,
        //              $field->status
        //              )
        //              ->form_attributes($field->form_attributes($field))
        //              ->form_options($field->form_options())
        //              ->form_db_options($field->form_db_options())
        //              ->fluxo_field($field->fluxo_field);
        //     }));
        // }
       return $result;
    }
    public function view()
    {
        return sprintf('tall::admin.%s.processo.list', data_get($this->etapa->fluxo, 'fluxo', 'fluxos'));
    }

}
