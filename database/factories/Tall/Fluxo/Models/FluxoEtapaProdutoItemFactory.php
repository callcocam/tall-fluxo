<?php

namespace Database\Factories\Tall\Fluxo\Models;

use App\Models\FluxoEtapaProdutoItem;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FluxoEtapaProdutoItem>
 */
class FluxoEtapaProdutoItemFactory extends Factory
{
    protected  $model = FluxoEtapaProdutoItem::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=>$slug = fake()->word,
            'slug'=>Str::slug($slug),
            'tenant_id'=>Tenant::first()->id,
            'user_id'=>User::all()->random()->id,
            'updated_at' => now()->subMonths(rand(0,200))->format("Y-m-d H:i:s"),
            'created_at' => now()->subMonths(rand(0,200))->format("Y-m-d H:i:s")
        ];
    }
}
