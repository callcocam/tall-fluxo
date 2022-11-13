<?php

namespace Database\Factories\Tall\Fluxo\Models;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Tall\Fluxo\Models\FluxoEtapa;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FluxoEtapaProduto>
 */
class FluxoEtapaProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'fluxo_etapa_id'=>FluxoEtapa::all()->random()->id,
            'tenant_id'=>Tenant::first()->id,
            'user_id'=>User::all()->random()->id,
            'updated_at' => now()->subMonths(rand(0,200))->format("Y-m-d H:i:s"),
            'created_at' => now()->subMonths(rand(0,200))->format("Y-m-d H:i:s")
        ];
    }
}
