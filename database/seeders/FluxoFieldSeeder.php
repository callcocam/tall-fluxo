<?php

namespace Database\Seeders;

use App\Models\FluxoField;
use App\Models\FluxoFieldAttribute;
use App\Models\FluxoFieldDb;
use App\Models\FluxoFieldOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FluxoFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FluxoField::query()->forceDelete();
        FluxoField::factory()->create(
            [
                'name'=>"Nome do produto",
                'view'=>'input',
                'type'=>'text',

            ]
        )->each(function($model){
         
            $model->fluxo_field_attributes()
                ->create(array_filter(FluxoFieldAttribute::factory()->make([
                    'name'=>'placeholder',
                    'description'=>$model->name,
                    ])->toArray()));

            $model->fluxo_field_attributes()
            ->create(array_filter(FluxoFieldAttribute::factory()->make([
                    'name'=>'class',
                    'description'=>'block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm',
                ])->toArray()));
        });

        FluxoField::factory()->create(
            [
                'name'=>"Descrição comercial",
                'view'=>'textarea',
                'type'=>'textarea',

            ]
        )->each(function($model){
         
            $model->fluxo_field_attributes()
                ->create(array_filter(FluxoFieldAttribute::factory()->make([
                    'name'=>'placeholder',
                    'description'=>$model->name,
                    ])->toArray()));

            $model->fluxo_field_attributes()
            ->create(array_filter(FluxoFieldAttribute::factory()->make([
                    'name'=>'class',
                    'description'=>'block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm',
                ])->toArray()));
        });

        
        FluxoField::factory()->create(
            [
                'name'=>"É App",
                'view'=>'radio',
                'type'=>'radio',

            ]
        )->each(function($model){
         
            $model->fluxo_field_attributes()
            ->create(array_filter(FluxoFieldAttribute::factory()->make([
                    'name'=>'class',
                    'description'=>'h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500',
                ])->toArray()));

            $model->fluxo_field_options()
                ->create(array_filter(FluxoFieldOption::factory()->make([
                        'name'=>'SIM',
                        'description'=>'1',
                    ])->toArray()));
            $model->fluxo_field_options()
            ->create(array_filter(FluxoFieldOption::factory()->make([
                    'name'=>'NÃO',
                    'description'=>'0',
                ])->toArray()));

                
        });

        FluxoField::factory()->create(
            [
                'name'=>"Data de cencimento",
                'view'=>'date',
                'type'=>'date',

            ]
        )->each(function($model){
         
            $model->fluxo_field_attributes()
            ->create(array_filter(FluxoFieldAttribute::factory()->make([
                    'name'=>'class',
                    'description'=>'block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm',
                ])->toArray()));
        });

        FluxoField::factory(5)->create(
            [
                'name'=>"Data de cencimento",
                'view'=>'date-time',
                'type'=>'date-time-local',

            ]
        )->each(function($model){
         
            $model->fluxo_field_attributes()
            ->create(array_filter(FluxoFieldAttribute::factory()->make([
                    'name'=>'class',
                    'description'=>'block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm',
                ])->toArray()));
        });
        


        FluxoField::factory()->create(
            [
                'name'=>"Categoria",
                'view'=>'select',
                'type'=>'select',

            ]
        )->each(function($model){
         
            $model->fluxo_field_attributes()
            ->create(array_filter(FluxoFieldAttribute::factory()->make([
                    'name'=>'class',
                    'description'=>'w-full rounded border-gray-300 text-indigo-600 focus:ring-indigo-500',
                ])->toArray()));

            $model->fluxo_field_db()
                ->create(array_filter(FluxoFieldDb::factory()->make([
                        'name'=>'Selecione um usuário',
                        'model'=>'User',
                    ])->toArray()));
                           
        });

    }
}
