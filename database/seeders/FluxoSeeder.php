<?php

namespace Database\Seeders;

use App\Models\Fluxo;
use App\Models\FluxoEtapa;
use App\Models\FluxoEtapaItem;
use App\Models\FluxoField;
use App\Models\FluxoFieldAttribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
                for ($etapa=1; $etapa < 6; $etapa++) { 
                    $model = $fluxo->fluxo_etapas()->create(FluxoEtapa::factory()->make([
                        'fluxo_id'=>$fluxo->id,
                        'ordering'=>$etapa,
                    ])->toArray());

                    for ($count=1; $count < rand(7, 10); $count++) { 
                        $model->fluxo_etapa_items()->create(FluxoEtapaItem::factory()->make([
                            'ordering'=>$count,
                        ])->toArray());
                    }  
                }
            }
        }
    }
}
