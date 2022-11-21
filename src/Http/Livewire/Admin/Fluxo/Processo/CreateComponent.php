<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/

namespace Tall\Fluxo\Http\Livewire\Admin\Fluxo\Processo;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Tall\Fluxo\Core\Fields\Field;
use Tall\Http\Livewire\FormComponent;
use Tall\Fluxo\Models\FluxoEtapa;
use Tall\Fluxo\Models\FluxoEtapaProduto;

class CreateComponent extends FormComponent
{
    use AuthorizesRequests;

    public $title = "Cadastrar";
    public $etapa;
    public $products=[];
    public $currentRouteName;

    public function mount(FluxoEtapa $etapa, FluxoEtapaProduto $model)
    {
        $this->currentRouteName = Route::currentRouteName();

        $this->authorize($this->currentRouteName);

        $this->setFormProperties($model, $etapa);

    }

    
     /**
     * @param null $model
     */
    public function setFormProperties($model = null, $etapa=null)
    {
        $this->model = $model;
        $this->etapa = $etapa;
        if ($model) {
            $this->data = data_get($model, 'produtos');
            
            $products = config('tall-fluxo.fildes.before',[]);
            if($products){

                foreach($products as $product){
                   
                    $this->products[] = $product->name;
                    
                    data_set($this->data, $product->name, "");

                }
            }
            data_set($this->data, 'fluxo_etapa_id', data_get($etapa, 'id'));
        }
    }

    protected function save(){
        try {
            $products = $this->data->only(array_merge(['fluxo_etapa_id'], $this->products))->toArray();
            
            if($model =  $this->etapa->produtos()->create($products)){
                $this->model  = $model;
                foreach($this->data->except(array_merge(['fluxo_etapa_id'], $this->products)) as $fluxo_field_id => $name){
                    $data['name']=$name;
                    $data['fluxo_field_id']=$fluxo_field_id;
                    $this->model->fluxo_etapa_produto_items()->create($data);
                }
                $this->success( __('sucesso'), __("Cadastro atualizado com sucesso!!"));
                $currentRouteNameEdit  = Str::replace("create",'edit', $this->currentRouteName);
                $etapa = $this->etapa;
                if(Route::has($currentRouteNameEdit)){
                    redirect()->route($currentRouteNameEdit , compact('etapa','model'));
                }
                return true;
            }
          
        } catch (\PDOException $PDOException) {
            $this->error('erro', __($PDOException->getMessage()));
            return false;
        }

    }
    public function rules()
    {
        return [];
    }

    
    public function getListProperty()
    {
        return sprintf('admin.%s.processo', data_get($this->etapa, 'fluxo.id', 'fluxos'));
    }

    public function getOrderProperty()
    {
       return  null;
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
                     $field->status)
                     ->form_attributes($field->form_attributes($field))
                     ->form_options($field->form_options())
                     ->form_db_options($field->form_db_options())
                     ->fluxo_field($field->fluxo_field);
            }));
        }
       return $result;
    }
    public function view()
    {
        return sprintf('tall::admin.%s.processo.create', data_get($this->config, 'fluxo.route', 'fluxos'));
    }
}
