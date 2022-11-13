<?php

namespace Database\Factories\Tall\Fluxo\Models;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FluxoField>
 */
class FluxoFieldFactory extends Factory
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
            'view'=>[
                'input',
                'text',
                'radio',
                'checkbox',
                'select',
                'date',
                'phone',
                'datetime-local',
                'range',
                'email',
                'number',
                'textarea'
            ][rand(0,11)],      
            'tenant_id'=>Tenant::first()->id,
            'user_id'=>User::all()->random()->id,
            'updated_at' => now()->subMonths(rand(0,200))->format("Y-m-d H:i:s"),
            'created_at' => now()->subMonths(rand(0,200))->format("Y-m-d H:i:s")
        ];
    }
}
