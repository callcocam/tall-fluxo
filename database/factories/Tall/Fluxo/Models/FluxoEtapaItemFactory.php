<?php

namespace Database\Factories\Tall\Fluxo\Models;

use App\Models\FluxoEtapaItem;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Tall\Fluxo\Models\FluxoField;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FluxoEtapaItem>
 */
class FluxoEtapaItemFactory extends Factory
{
    protected  $model = FluxoEtapaItem::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $field= FluxoField::all()->random();
        return [
            'name'=> $field->name,
            'slug'=>Str::slug($field->name),
            'type'=>$field->type,
            'fluxo_field_id'=>$field->id,
            'tenant_id'=>Tenant::first()->id,
            'user_id'=>User::all()->random()->id,
            'updated_at' => now()->subMonths(rand(0,200))->format("Y-m-d H:i:s"),
            'created_at' => now()->subMonths(rand(0,200))->format("Y-m-d H:i:s")
        ];
    }
}
