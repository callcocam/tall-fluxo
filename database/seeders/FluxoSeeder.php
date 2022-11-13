<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Tall\Fluxo\Models\Fluxo;
use Tall\Fluxo\Models\FluxoEtapa;
use Tall\Fluxo\Models\FluxoEtapaItem;
use Tall\Fluxo\Models\FluxoField;
use Tall\Fluxo\Models\FluxoFieldAttribute;

class FluxoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $fluxos =  Fluxo::all();
        FluxoEtapaItem::query()->forceDelete();
        FluxoEtapa::query()->forceDelete();
        FluxoField::query()->forceDelete();
        FluxoField::factory(5)->create()->each(function($model){
           $model->fluxo_field_attributes()->create(FluxoFieldAttribute::factory()->make()->toArray());
           $model->fluxo_field_attributes()->create(FluxoFieldAttribute::factory()->make([
               'name'=>'placeholder',
               'description'=>$model->name,
           ])->toArray());
        });
       if($fluxos){
           foreach($fluxos as $fluxo){
            foreach (['Fornencedor','Compras','Marketing','Estoque','Cadastro'] as $key => $etapa) { 
               $model = $fluxo->fluxo_etapas()->create(array_filter(FluxoEtapa::factory()->make([
                'name'=>$etapa,
                'fluxo_id'=>$fluxo->id,
                'ordering'=>$key,
            ])->toArray()));

                   for ($count=1; $count < rand(7, 10); $count++) { 
                    
                       $model->fluxo_etapa_items()->create(FluxoEtapaItem::factory()->make([
                           'ordering'=>$count,                                
                            'visible'=>$count<= 4 ? 1: 0,      
                       ])->toArray());
                   }  
               }
           }
       }
    }
}
