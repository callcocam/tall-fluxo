<?php

namespace Database\Seeders;

use App\Models\FluxoEtapa;
use App\Models\FluxoEtapaProduto;
use App\Models\FluxoEtapaProdutoItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FluxoEtapaProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $etapas = FluxoEtapa::all();

        FluxoEtapaProdutoItem::query()->forceDelete();
        FluxoEtapaProduto::query()->forceDelete();
        foreach($etapas as $etapa){
            FluxoEtapaProduto::factory(rand(50, 500))->create([
                'fluxo_id'=>$etapa->fluxo_id
            ])->each(function($mode) use($etapa){
                $fluxo_etapa_items = $etapa->fluxo_etapa_items;
                foreach($fluxo_etapa_items as $fluxo_etapa_item){
                    // dd($fluxo_etapa_item->toArray());
                    $mode->fluxo_etapa_produto_items()->create(FluxoEtapaProdutoItem::factory()->make([
                        'fluxo_field_id'=>$fluxo_etapa_item->fluxo_field_id
                    ])->toArray());
                }
            });
        }
    }
}
