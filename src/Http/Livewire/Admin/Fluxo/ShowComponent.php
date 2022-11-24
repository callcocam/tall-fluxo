<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/

namespace Tall\Fluxo\Http\Livewire\Admin\Fluxo;

use App\Models\FluxoField;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Tall\Http\Livewire\FormComponent;
use Tall\Fluxo\Models\Fluxo;

class ShowComponent extends FormComponent
{
    use AuthorizesRequests;

    public $title = "Visualizar";

    public $selected=[];
    public $selectedEtapa=[];

    public function mount(Fluxo $model)
    {
        $this->authorize(Route::currentRouteName());
        $this->setFormProperties($model);

       $this->selected = data_get($this->data, 'fields');
      
    }

    public function route(){
        Route::get('/fluxos/{model}/visualizar', static::class)->name('admin.fluxos.view');
    }


    public function getFieldsProperty()
    {
        return FluxoField::query()->where('status', 'published')->get();
    }

    public function updatedSelected($values)
    {

        $this->model->fluxo_fields()->sync(array_filter($this->selected));

        if($etapas = $this->model->fluxo_etapas){       
            foreach($etapas as $etapa){
                foreach($this->selected as $key => $value){
                    if(!$value){
                        $etapa->fluxo_etapa_items()->where('fluxo_field_id',$key)->forceDelete();
                    }
                }
            }
            return redirect()->route('admin.fluxos.view', ['model'=>$this->model]);
        }
        // if($etapas = $this->model->fluxo_etapas){       
        //     foreach($etapas as $etapa){
        //         $data = [];
        //         foreach($this->selected as $key => $value){
        //            $i=0;
        //             if($value){
        //                 if($fluxo_etapa_items = $etapa->fluxo_etapa_items()->where('fluxo_field_id',$key)->first()){
        //                     $field = FluxoField::where('id', $value)->first();
        //                     $fluxo_etapa_items->update([
        //                         'name'=> $field->name,
        //                         'description'=> $field->description,
        //                         'type'=> $field->type,
        //                         'updated_at'=> now()->format("Y-m-d"),
        //                     ]);
        //                 }else{
        //                     $field = FluxoField::where('id', $value)->first();
        //                     data_set($data,'fluxo_field_id', $field->id);
        //                     data_set($data,'name', $field->name);
        //                     data_set($data,'description', $field->description);
        //                     data_set($data,'evento', 'defer');
        //                     data_set($data,'type', $field->type);
        //                     data_set($data,'width', '12');
        //                     data_set($data,'visible', '1');
        //                     data_set($data,'ordering', $i++);
        //                     data_set($data,'user_id', auth()->id());
        //                     data_set($data,'status', 'published');
        //                     data_set($data,'created_at', now()->format("Y-m-d"));
        //                     data_set($data,'updated_at', now()->format("Y-m-d"));
        //                     $etapa->fluxo_etapa_items()->create($data);
        //                 }
        //             }
        //             else{
        //                 $etapa->fluxo_etapa_items()->where('fluxo_field_id',$key)->forceDelete();
        //             }
        //         }
        //     }
        //     return redirect()->route('admin.fluxos.view', ['model'=>$this->model]);
        // }
    }

    public function addField(FluxoField $field, $i)
    {
        if($etapas = data_get($this->selectedEtapa, $field->id)){
            foreach($etapas as $etapa){
                $data = [];
                if( $model = $this->model->fluxo_etapas()->where('id',$etapa)->first()){
                    if(!$model->fluxo_etapa_items()->where('fluxo_field_id',$field->id)->first()){
                        data_set($data,'fluxo_field_id', $field->id);
                        data_set($data,'name', $field->name);
                        data_set($data,'description', $field->description);
                        data_set($data,'evento', 'defer');
                        data_set($data,'type', $field->type);
                        data_set($data,'width', '12');
                        data_set($data,'visible', '1');
                        data_set($data,'ordering', $i++);
                        data_set($data,'user_id', auth()->id());
                        data_set($data,'status', 'published');
                        data_set($data,'created_at', now()->format("Y-m-d"));
                        data_set($data,'updated_at', now()->format("Y-m-d"));
                        $model->fluxo_etapa_items()->create($data);
                    }
                }
            }
            
            $this->emit('refreshCreate');
        }
    }

    public function updateField(FluxoField $field, $i)
    {
        if($etapas = data_get($this->selectedEtapa, $field->id)){
            foreach($etapas as $etapa){
                if( $model = $this->model->fluxo_etapas()->where('id',$etapa)->first()){
                    if($fluxo_etapa_items = $model->fluxo_etapa_items()->where('fluxo_field_id',$field->id)->first()){
                        $fluxo_etapa_items->update([
                            'name'=> $field->name,
                            'description'=> $field->description,
                            'type'=> $field->type,
                            'updated_at'=> now()->format("Y-m-d"),
                        ]);
                    }
                }
            }
            $this->emit('refreshCreate');
        }
    }

    
    public function removeField(FluxoField $field)
    {
        
        if($etapas = data_get($this->selectedEtapa, $field->id)){
            foreach($etapas as $etapa){
                if( $model = $this->model->fluxo_etapas()->where('id',$etapa)->first()){
                    $model->fluxo_etapa_items()->where('fluxo_field_id',$field->id)->forceDelete();
                }
            }
            $this->emit('refreshDelete');
            return true;
        }

        $this->addError('Etapas', 'Selecione pelo menos uma etapa');
    }

    public function getListProperty()
    {
        return 'admin.fluxos';
    }

    public function getEditProperty()
    {
      return 'admin.fluxos.edit';
    }
    public function getDeleteProperty()
    {
     return 'admin.fluxos.delete';
    }
    public function view()
    {
        return 'tall::admin.fluxos.show';
    }
}