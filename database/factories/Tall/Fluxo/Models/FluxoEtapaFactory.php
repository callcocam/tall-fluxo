<?php

namespace Database\Factories\Tall\Fluxo\Models;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FluxoEtapa>
 */
class FluxoEtapaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=>$slug = fake()->word(),
            'slug'=>Str::slug($slug),
            'route'=>fake()->slug(),
            'path'=>fake()->slug(),            
            'tenant_id'=>Tenant::first()->id,
            'user_id'=>User::all()->random()->id,
            'updated_at' => now()->subMonths(rand(0,200))->format("Y-m-d H:i:s"),
            'created_at' => now()->subMonths(rand(0,200))->format("Y-m-d H:i:s")
        ];
    }
}
