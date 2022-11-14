<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Tall\Fluxo\Models\Fluxo;
use Tall\Fluxo\Models\FluxoEtapa;
use Tall\Fluxo\Models\FluxoEtapaItem;

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
      
       if($fluxos){
           foreach($fluxos as $fluxo){
                foreach (['Fornencedor','Compras','Marketing','Estoque','Cadastro'] as $key => $etapa) {
                $model = $fluxo->fluxo_etapas()
                ->create(FluxoEtapa::factory()->make([
                    'name'=>$etapa,
                    'fluxo_id'=>$fluxo->id,
                    'ordering'=>$key,
                ])->toArray());

                for ($count=0; $count < rand(1, 4); $count++) {
                    $model->fluxo_etapa_items()->create(FluxoEtapaItem::factory()->make([
                    'ordering'=>$count,
                    'visible'=>$count<= 2 ? 1: 0,
                ])->toArray());
                    }
               }
           }
       }
    }
}
